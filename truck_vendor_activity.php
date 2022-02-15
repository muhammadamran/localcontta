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

if(isset($_POST["update"]))    
{    

$driver_name      = $_POST['driver_name'];
$tract_driver_phone     = $_POST['tract_driver_phone'];
$tract_vehicle_no     = $_POST['tract_vehicle_no'];
$tract_cont_no      = $_POST['tract_cont_no'];
$tract_id     = $_POST['tract_id'];


  $query = mysql_query("UPDATE tb_truck_job_details SET tract_driver_name='$driver_name',tract_driver_phone='$tract_driver_phone',tract_vehicle_no='$tract_vehicle_no',tract_cont_no='$tract_cont_no' where tract_id='$tract_id'");

  if($query){
    header("Location: ./truck_job_list.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST["complete"]))    
{    

  $tract_id           = $_POST['tract_id'];
  $user_name        = $_POST['user_name'];
  $datenow          = date('Y-m-d');

  $query = mysql_query("UPDATE tb_truck_job_details SET tract_order_rcvd ='$datenow' where tract_id='$tract_id'");
  if($query){
    header("Location: ./truck_job_list.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
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
          <h1 class="page-header">Trucker - Driver Activity</h1>
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
                      <th>TractID</th>
                      <th>RcdID</th>
                      <th>DriverName</th>
                      <th>Truck GO</th>
                      <th>Arrive in warehouse</th>
                      <th>Start stuff</th>
                      <th>Complete stuff</th>
                      <th>Leave the warehouse</th>
                      <th>Arrive in dest</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    /* GET DATA */

                    $user_login = $_SESSION['username'];

                    mysql_connect('localhost', 'knidcore_admin','Flatrone2241');
                    mysql_select_db('knidcore_gsk'); 
                    $role = mysql_query("SELECT * FROM tb_driver WHERE drv_username = '$user_login' ");
                    $inv = mysql_fetch_array($role);

                    $con=mysqli_connect("localhost","knidcore_admin","Flatrone2241","knidcore_gsk");
                    if (mysqli_connect_errno())
                    {
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    $result = mysqli_query($con,"SELECT * FROM tb_truck_job_details  where tract_order_rcvd = '0000-00-00' AND tract_driver_name = '$inv[drv_name]'");
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['tract_id'] . "</td>";
                        echo "<td>" . $row['rcd_id'] . "</td>";                                              
                        echo "<td>" . $row['tract_driver_name'] . "</td>";               
                        echo "<td>" . $row['tract_start'] . "</td>";
                        echo "<td>" . $row['tract_arr_in_wh'] . "</td>";
                        echo "<td>" . $row['tract_start_stuff'] . "</td>";                     
                        echo "<td>" . $row['tract_end_stuff'] . "</td>";                     
                        echo "<td>" . $row['tract_leave_wh'] . "</td>";                     
                        echo "<td>" . $row['tract_arr_in_dest'] . "</td>";                     
                        echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#edit$row[tract_id]' title='Edit this record'><span class='label label-primary'>Update</span></a>
                        <a href='#' data-toggle='modal' data-target='#confirm$row[tract_id]' title='Completed this record'><span class='label label-primary'>Complete</span></a>
                        </td>";
                        echo "</tr>";
                        ?>
                        <div class="modal fade" id="edit<?php echo $row['tract_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[RecordMaster] </b> Update Job Details</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" action=" ">
                                  <div class="col-md-12">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Driver Name</label>
                                        <select class="form-control" name="driver_name">
                                          <option value=" ">--- SELECT ---</option>
                                          <?php
                                          mysql_connect('localhost','knidcore_admin','Flatrone2241');
                                          mysql_select_db('knidcore_gsk');
                                          $result2=mysql_query("SELECT * FROM tb_driver");
                                          while($data2=mysql_fetch_array($result2)) {
                                            echo "<option value='$data2[drv_name]'> $data2[drv_name] </option>";
                                          }
                                          ?>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label>Driver Phone</label>
                                        <input type="text" name="tract_driver_phone" class="form-control" value="<?php echo $row['tract_driver_phone'];?>" >
                                      </div>
                                      <div class="form-group">
                                        <label>Vehicle No</label>
                                        <input type="text" name="tract_vehicle_no" value="<?php echo $row['tract_vehicle_no'];?>"  class="form-control" >
                                      </div>
                                      <div class="form-group">
                                        <label>Container No.</label>
                                        <input type="text" name="tract_cont_no" value="<?php echo $row['tract_cont_no'];?>"  class="form-control" >
                                        <input type="hidden" name="tract_id" value="<?php echo $row['tract_id'];?>"  class="form-control" >
                                      </div>                                   
                                    </div>                         
                                  </div>    
                                  <div class="modal-footer">
                                    <button type="submit" name="update" value="update" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                  </div>                                                                        
                                </form>
                              </div>                            
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="pib<?php echo $row['rcd_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[Document Management] </b> pib File</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" action=" "  accept-charset="utf-8" enctype="multipart/form-data">
                                  <div class="form-group">
                                    <label>Upload File</label>
                                    <input type="file" name="form" class="form-control">
                                    <input type="hidden" name="rid" class="form-control" placeholder="client name" value="<?php echo $row['rcd_id'];?>" required>
                                    <input type="hidden" name="rcd_type" class="form-control" placeholder="client name" value="<?php echo $row['rcd_type'];?>" required>
                                  </div>
                                  <button type="submit" name="pib" value="pib" class="btn btn-default">Yes</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="confirm<?php echo $row['rcd_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[RecordManage] </b> Complete Record</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" action=" ">
                                  <div class="form-group">
                                    <label>Are you sure Complete this record?</label>
                                    <h6>RecordID : <?php echo $row['tract_id'];?></h6>
                                    <input type="hidden" name="tract_id" class="form-control" value="<?php echo $row['tract_id'];?>">
                                    <input type="hidden" name="user_name" class="form-control" value="<?php echo $_SESSION['username'];?>">
                                  </div>
                                  <button type="submit" name="complete" value="complete" class="btn btn-default">Complete</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
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
