<?php
$con=mysqli_connect("localhost","root","","contta");
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$user_id             = $_POST['user_id'];

echo implode(",", $user_id);die;

$query = mysql_query("DELETE FROM tb_user WHERE user_id IN(".implode(",", $user_id).")");

	if($query) {
		header("Location: ./iou_adm_user.php?DeleteSuccess=true");                                                  
	} else {
		header("Location: ./iou_adm_user.php?DeleteFailed=true");                                                  
	}
?>