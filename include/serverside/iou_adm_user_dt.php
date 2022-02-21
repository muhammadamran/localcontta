<?php

// if($_GET['action'] == "table_data"){
	$con=mysqli_connect("localhost","root","","contta");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$search = $_POST['search']['value'];
	$limit = $_POST['length'];
	$start = $_POST['start']; 
	$sql = mysqli_query($con, "SELECT user_id FROM tb_user");
	$sql_count = mysqli_num_rows($sql);

	$query = "SELECT * FROM tb_user WHERE (user_id LIKE '%".$search."%' OR user_name LIKE '%".$search."%' OR user_role LIKE '%".$search."%')";

	$order_index = $_POST['order'][0]['column'];
	$order_field = $_POST['columns'][$order_index]['data'];
	$order_ascdesc = $_POST['order'][0]['dir'];
	$order = " ORDER BY ".$order_field." ".$order_ascdesc;
	
	$sql_data = mysqli_query($con, $query.$order." LIMIT ".$limit." OFFSET ".$start);
	$sql_filter = mysqli_query($con, $query);
	$sql_filter_count = mysqli_num_rows($sql_filter);
	$data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC);
	$callback = array(
	    'draw'=>$_POST['draw'],
	    'recordsTotal'=>$sql_count,
	    'recordsFiltered'=>$sql_filter_count,
	    'data'=>$data
	);
	header('Content-Type: application/json');
	echo json_encode($callback);
// }
?>