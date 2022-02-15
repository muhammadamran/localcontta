<?php

include "include/connection.php";
include "include/restrict.php";

if(isset($_POST["create"]))    
{    

  $ship_plan            = $_POST['ship_plan'];
  $shipper              = $_POST['shipper'];
  $cnee                 = $_POST['cnee'];
  $inv_no               = $_POST['inv_no'];
  $commo                = $_POST['commo'];
  $c20                  = $_POST['c20'];
  $c40                  = $_POST['c40'];
  $party                = $_POST['party'];
  $po_no                = $_POST['po_no'];
  $rcd_type             = "export";
  $user_name            = $_POST['user_name'];
  $datenow              = date('Y-m-d H:i:s');

  $query = mysql_query("INSERT into tb_record_master values(' ','$datenow','$user_name','$rcd_type','$ship_plan','$shipper','$cnee','$inv_no','$commo','$c20','$c40','$party','$po_no')");
  if($query){
    header("Location: ./export_master.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}


if(isset($_POST["confirm"]))    
{     

$rcd_id         = $_POST['rcd_id'];
$user_name      = $_POST['user_name'];
$datenow        = date('Y-m-d');
$truck_job_id   = $_POST['truck_job_id'];

  $query = mysql_query("UPDATE tb_truck_assign SET order_rcvd_by='$user_name', order_rcvd_date='$datenow' where rcd_id='$rcdid' ");
  $query .= mysql_query("INSERT into tb_truck_job_details values(' ','','$user_name','','','','','$truck_job_id','$rcdid','','','','','','','')");
  if($query){
    header("Location: ./truck_confirm_job.php?ref=0000");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<?php include 'include/head.php';?>
<body>

  <div id="wrapper">
    <?php include 'include/header.php';?>

    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Trucker - Job List</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              Record List
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>                      
                      <th>RcdID</th>
                      <th>REF</th>
                      <th>HBL</th>
                      <th>AJU NO.</th>
                      <th>SHIPPER</th>
                      <th>CONSIGNEE</th>
                      <th>ETD</th>
                      <th>ATA</th>
                      <th>PARTY</th>
                      <th>VENDOR</th>         
                      <th>ConfirmDate</th> 
                      <th>ConfirmBy</th>           
                      <th>Action</th>                 
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $con=mysqli_connect("localhost","root","","contta");
                    $result = mysqli_query($con,"SELECT * FROM tb_truck_assign INNER JOIN tb_master_impor ON tb_truck_assign.rcd_id=tb_master_impor.rcd_id where tb_truck_assign.order_rcvd_by != '' ");

                    
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['rcd_id'] . "</td>";
                        echo "<td>" . $row['rcd_ref'] . "</td>";   
                        echo "<td>" . $row['rcd_hbl'] . "</td>";                   
                        echo "<td>" . $row['rcd_aju'] . "</td>";
                        echo "<td>" . $row['rcd_shipper'] . "</td>";               
                        echo "<td>" . $row['rcd_cnee'] . "</td>";
                        echo "<td>" . $row['rcd_eta'] . "</td>";
                        echo "<td>" . $row['rcd_ata'] . "</td>";
                        echo "<td>" . $row['rcd_party'] . "</td>"; 
                        echo "<td>" . $row['assign_vendor'] . "</td>"; 
                        echo "<td>" . $row['order_rcvd_date'] . "</td>";
                        echo "<td>" . $row['order_rcvd_by'] . "</td>";

                        echo "<td align= ''>
                          <a href='truck_job_list.php?rcd_id=$row[rcd_id]' title='Update Jobs List'><span class='label label-primary'>Update!</span></a>
                          </td>";

                        echo "</tr>";
                      }
                    }
                    mysqli_close($con);
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->

            </div>
            <!-- /.panel-body -->
          </div>
          <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <!-- /#page-wrapper -->
  </div>
  <!-- /#wrapper -->

  <?php include 'include/jquery.php';?>

</body>

</html>
