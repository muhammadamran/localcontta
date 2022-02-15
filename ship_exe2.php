<?php

include "include/connection.php";
include "include/restrict.php";

if(isset($_POST["update"]))    
{    

$rcd_exe_do_no          = $_POST['rcd_exe_do_no'];
$rcd_exe_liner          = $_POST['rcd_exe_liner'];
$rcd_exe_truck_arrived  = $_POST['rcd_exe_truck_arrived'];
$rcd_exe_stuff_start    = $_POST['rcd_exe_stuff_start'];
$rcd_exe_con_no         = $_POST['rcd_exe_con_no'];
$rcd_exe_con_leave      = $_POST['rcd_exe_con_leave'];
$rcd_id                 = $_POST['rcd_id'];
$rcd_exe_con_cy         = $_POST['rcd_exe_con_cy'];

$rcd_exe_truck_arrived_now  = $_POST['rcd_exe_truck_arrived_now'];
$rcd_exe_stuff_start_now    = $_POST['rcd_exe_stuff_start_now'];
$rcd_exe_con_leave_now      = $_POST['rcd_exe_con_leave_now'];
$rcd_exe_con_cy_now         = $_POST['rcd_exe_con_cy_now'];

if ($rcd_exe_truck_arrived == '') {
  $rcd_exe_truck_arrived_sql = $rcd_exe_truck_arrived_now;
} else {
  $rcd_exe_truck_arrived_sql = $rcd_exe_truck_arrived;
}

if ($rcd_exe_stuff_start == '') {
  $rcd_exe_stuff_start_sql = $rcd_exe_stuff_start_now;
} else {
  $rcd_exe_stuff_start_sql = $rcd_exe_stuff_start;
}

if ($rcd_exe_con_leave == '') {
  $rcd_exe_con_leave_sql = $rcd_exe_con_leave_now;
} else {
  $rcd_exe_con_leave_sql = $rcd_exe_con_leave;
}

if ($rcd_exe_con_cy == '') {
  $rcd_exe_con_cy_sql = $rcd_exe_con_cy_now;
} else {
  $rcd_exe_con_cy_sql = $rcd_exe_con_cy;
}

  $query = mysql_query("UPDATE tb_record_ship_exe SET rcd_exe_do_no='$rcd_exe_do_no',rcd_exe_liner='$rcd_exe_liner',rcd_exe_truck_arrived='$rcd_exe_truck_arrived_sql',rcd_exe_stuff_start='$rcd_exe_stuff_start_sql',rcd_exe_con_no='$rcd_exe_con_no',rcd_exe_con_leave='$rcd_exe_con_leave_sql',rcd_exe_con_cy='$rcd_exe_con_cy_sql' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./ship_exe.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["complete"]))    
{    

  $rcd_id           = $_POST['rcdid'];
  $user_name        = $_POST['user_name'];
  $datenow          = date('Y-m-d H:i:s');

  $query = mysql_query("UPDATE tb_record_miles SET miles_execution ='$datenow',action_by_3='$user_name' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./ship_exe.php");                                                  
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
          <h1 class="page-header">Shipment Execution - TRANSPORT DETAILS</h1>
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
                      <th>ExeID</th>
                      <th>RcdID</th>
                      <th>Inv.No</th>
                      <th>DO No.</th>
                      <th>Liner</th>
                      <th>TruckArrived</th>
                      <th>StartStuffing</th>
                      <th>Container No.</th>
                      <th>Cont. Leave</th>
                      <th>Cont. in CY</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $con=mysqli_connect("localhost","root","","contta");
                                    // Check connection
                    if (mysqli_connect_errno())
                    {
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    $result = mysqli_query($con,"SELECT * FROM tb_record_miles INNER JOIN tb_record_ship_exe ON tb_record_miles.rcd_id=tb_record_ship_exe.rcd_id WHERE tb_record_miles.miles_execution = '0' AND tb_record_miles.miles_custom != '0' ");
                    if(mysqli_num_rows($result)>0){

                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['rcd_exe_id'] . "</td>";
                        echo "<td>" . $row['rcd_id'] . "</td>";
                        $grep_date = mysqli_query($con,"SELECT * FROM tb_record_master WHERE rcd_id = '$row[rcd_id]' ");
                          $grep = mysqli_fetch_array($grep_date);
                          echo "<td>" . $grep['rcd_inv_no'] . "</td>";
                        echo "<td>" . $row['rcd_exe_do_no'] . "</td>";
                        echo "<td>" . $row['rcd_exe_liner'] . "</td>";
                        echo "<td>" . $row['rcd_exe_truck_arrived'] . "</td>";
                        echo "<td>" . $row['rcd_exe_stuff_start'] . "</td>";
                        echo "<td>" . $row['rcd_exe_con_no'] . "</td>";
                        echo "<td>" . $row['rcd_exe_con_leave'] . "</td>";
                        echo "<td>" . $row['rcd_exe_con_cy'] . "</td>";
                        echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#edit$row[rcd_id]' title='Edit this record'><span class='label label-primary'>Update</span></a>
                        <a href='#' data-toggle='modal' data-target='#confirm$row[rcd_id]' title='Completed this record'><span class='label label-primary'>Complete</span></a>
                      </td>";
                      echo "</tr>";
                      ?>
                      <div class="modal fade" id="edit<?php echo $row['rcd_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[RecordMaster] </b> Update Shipment Execution</h4>
                            </div>
                            <div class="modal-body">
                              <form method="post" action=" ">
                                <div class="col-md-12">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label>DO No.</label>
                                      <input type="text" name="rcd_exe_do_no" class="form-control" value="<?php echo $row['rcd_exe_do_no'];?>">
                                    </div>
                                    <div class="form-group">
                                      <label>Liner</label>
                                      <input type="text" name="rcd_exe_liner" class="form-control" value="<?php echo $row['rcd_exe_liner'];?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>TruckArrived</label>
                                      <input type="text" name="rcd_exe_truck_arrived_now" class="form-control" value="<?php echo $row['rcd_exe_truck_arrived'];?>" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>Input Here!</label>
                                      <input type="datetime-local" name="rcd_exe_truck_arrived" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>StuffingStart</label>
                                      <input type="text" name="rcd_exe_stuff_start_now" value="<?php echo $row['rcd_exe_stuff_start'];?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>Input Here!</label>
                                      <input type="datetime-local" name="rcd_exe_stuff_start" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                      <label>Container No.</label>
                                      <input type="text" name="rcd_exe_con_no" value="<?php echo $row['rcd_exe_con_no'];?>" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>Cont. Leave</label>
                                      <input type="text" name="rcd_exe_con_leave_now" value="<?php echo $row['rcd_exe_con_leave'];?>"  class="form-control" readonly>
                                      <input type="hidden" name="rcd_id" value="<?php echo $row['rcd_id'];?>"  class="form-control" >
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>Input Here!</label>
                                      <input type="datetime-local" name="rcd_exe_con_leave" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>Container in CY</label>
                                      <input type="text" name="rcd_exe_con_cy_now" value="<?php echo $row['rcd_exe_con_cy'];?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>Input Here!</label>
                                      <input type="datetime-local" name="rcd_exe_con_cy" class="form-control">
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
                                  <h6>RecordID : <?php echo $row['rcd_id'];?></h6>
                                  <input type="hidden" name="rcdid" class="form-control" value="<?php echo $row['rcd_id'];?>">
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
