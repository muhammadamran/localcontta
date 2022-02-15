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

  $booking_code         = $_POST['booking_code'];
  $tract_driver_name    = $_POST['tract_driver_name'];
  $tract_driver_phone   = $_POST['tract_driver_phone'];
  $tract_vehicle_no     = $_POST['tract_vehicle_no'];
  $tract_cont_no        = $_POST['tract_cont_no'];
  $tract_id             = $_POST['tract_id'];
  $seal_no              = $_POST['seal_no'];
  $cont_tear            = $_POST['cont_tear'];
  $stuffarea            = $_POST['stuffarea'];
  $rcd_id               = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_truck_job_details SET booking_code = '$booking_code' , tract_driver_name='$tract_driver_name', tract_driver_phone='$tract_driver_phone' , tract_vehicle_no = '$tract_vehicle_no' , tract_cont_no = '$tract_cont_no' , seal_no = '$seal_no' , cont_tear = '$cont_tear' , stuffarea = '$stuffarea' where tract_id='$tract_id' ");

  if($query){
    header("Location: ./truck_job_list.php?rcd_id=$rcd_id&dt=$tract_cont_no");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST["act_update"]))    
{    

  $tract_start          = $_POST['tract_start'];
  $tract_arr_in_wh      = $_POST['tract_arr_in_wh'];
  $tract_start_stuff    = $_POST['tract_start_stuff'];
  $tract_end_stuff      = $_POST['tract_end_stuff'];
  $tract_leave_wh       = $_POST['tract_leave_wh'];
  $tract_id             = $_POST['tract_id'];
  $rcd_id               = $_POST['rcd_id'];
  $tract_arr_in_dest    = $_POST['tract_arr_in_dest'];

  $query = mysql_query("UPDATE tb_truck_job_details SET tract_start = '$tract_start' , tract_arr_in_wh='$tract_arr_in_wh', tract_start_stuff='$tract_start_stuff' , tract_end_stuff = '$tract_end_stuff' , tract_leave_wh = '$tract_leave_wh' , tract_arr_in_dest = '$tract_arr_in_dest' where tract_id='$tract_id' ");

  if($query){
    header("Location: ./truck_job_list.php?rcd_id=$rcd_id&dt=$tract_start");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST["deliveryterm"]))    
{    

$tr_job_id    = $_POST['tr_job_id'];
$rcd_id       = $_POST['rcd_id'];
$dlv_date     = $_POST['dlv_date'];

  $query = mysql_query("UPDATE tb_truck_assign SET dlv_date = '$dlv_date' where truck_job_id='$tr_job_id' ");

  if($query){
    header("Location: ./truck_job_list.php?rcd_id=$rcd_id");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST["logupdate"]))    
{    

  $CurrentTime          = $_POST['CurrentTime'];
  $CurrentLocation      = $_POST['CurrentLocation'];
  $Remarks              = $_POST['Remarks'];
  $tract_id             = $_POST['tract_id'];
  $rcd_id               = $_POST['rcd_id'];
  $user_name            = $_POST['user_name'];

  $query = mysql_query("INSERT into tb_truck_job_log values('','$tract_id','$CurrentTime','$CurrentLocation','$Remarks','$user_name')");

  if($query){
    header("Location: ./truck_job_list.php?rcd_id=$rcd_id&dt=$CurrentTime");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST["add_row"]))    
{    

  $tr_job_id    = $_POST['tr_job_id'];
  $rcd_id       = $_POST['rcd_id'];
  $conType      = $_POST['conType'];
  $CurrentTime  = date('YmdHis');

  $query = mysql_query("INSERT into tb_truck_job_details(cont_type,truck_job_id,rcd_id) values('$conType','$tr_job_id','$rcd_id')");

  if($query){
    header("Location: ./truck_job_list.php?rcd_id=$rcd_id&dt=$CurrentTime");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST['delete_row']))
{
  $job_id       = $_POST['job_id'];
  $rcd_id       = $_POST['rcd_id'];

  $query = mysql_query("DELETE FROM tb_truck_job_details WHERE tract_id = '$job_id' ");

  if($query){
    header("Location: ./truck_job_list.php?rcd_id=$rcd_id&dt=$CurrentTime");                 
  } else {
    echo "Operation Failed! Please contact your administrator".mysql_errno();
  }
}


if(isset($_POST["complete"]))    
{    

  $tract_id         = $_POST['tract_id'];
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
          <h1 class="page-header">[Truck - Import] Update Job List</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">

                <?php
                mysql_connect('localhost', 'root','');
                mysql_select_db('contta');
                $getmas = mysql_query("SELECT * FROM tb_master_impor WHERE rcd_id = '$_GET[rcd_id]'");
                $mas = mysql_fetch_array($getmas);  
                $gettruckid = mysql_query("SELECT truck_job_id,dlv_date FROM tb_truck_assign WHERE rcd_id = '$_GET[rcd_id]' ");
                $getTruckIdSql = mysql_fetch_array($gettruckid);                              
                ?>

                <div class="col-lg-4">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      Master Details
                    </div>
                    <div class="panel-body">
                      <div class="col-lg-12">
                        <div class="alert alert-info">
                          KNREF : <a href="#" class="alert-link"><?php echo $mas['rcd_ref'];?></a> <br>
                          HBL : <a href="#" class="alert-link"><?php echo $mas['rcd_hbl'];?></a> <br>
                          AJU : <a href="#" class="alert-link"><?php echo $mas['rcd_aju'];?></a> <br>
                          Shipper : <a href="#" class="alert-link"><?php echo $mas['rcd_shipper'];?></a> <br>
                          Consignee : <a href="#" class="alert-link"><?php echo $mas['rcd_cnee'];?></a> <br>
                        </div>
                      </div>                          
                    </div>
                  </div>
                  <!-- /.col-lg-4 -->
                </div>

                <div class="col-lg-4">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      Master Details
                    </div>
                    <div class="panel-body">
                      <div class="col-lg-12">
                        <div class="alert alert-info">
                          ATA : <a href="#" class="alert-link"><?php echo $mas['rcd_ata'];?></a> <br>
                          ETA : <a href="#" class="alert-link"><?php echo $mas['rcd_eta'];?></a> <br>
                          CBM : <a href="#" class="alert-link"><?php echo $mas['rcd_cbm'];?></a> <br>
                          Package : <a href="#" class="alert-link"><?php echo $mas['rcd_package'];?></a> <br>
                        </div>
                      </div>                          
                    </div>
                  </div>
                  <!-- /.col-lg-4 -->
                </div>

                <div class="col-lg-4">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      Master Details
                    </div>
                    <div class="panel-body">
                      <div class="col-lg-12">
                        <div class="alert alert-info">
                          Cont. 20' : <a href="#" class="alert-link"><?php echo $mas['rcd_20_type'];?></a> <br>
                          Cont. 40' : <a href="#" class="alert-link"><?php echo $mas['rcd_40_type'];?></a> <br>
                          ShipType : <a href="#" class="alert-link"><?php echo $mas['rcd_type'];?></a> <br>
                          RcdCreated : <a href="#" class="alert-link"><?php echo $mas['rcd_create_date'];?></a> <br>
                        </div>
                      </div>                          
                    </div>
                  </div>
                  <!-- /.col-lg-4 -->
                </div>

              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-2">
                    <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal">+ADD</button>
                  </div>
                  <div class="col-md-6">
                    
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-block btn-success" data-toggle="modal" data-target="#deliveryterm">DELIVERY</button>
                  </div>
                  <div class="col-md-2">
                    <p>DlvDate : <?php echo $getTruckIdSql['dlv_date'];;?></p>
                  </div>
                </div>
                <div class="col-lg-1">

                  <!-- MODAL FOR ADD NEW CONTAINER RECORD / START  -->
                  <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title"><b>[Vehicle Type] </b> Add Container/Truck List</h4>
                        </div>
                        <div class="modal-body">
                          <form method="post" action=" ">
                            <div class="col-md-12">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <input type="hidden" name="tr_job_id" value="<?php echo $getTruckIdSql['truck_job_id'];?>" class="form-control" required>
                                  <input type="hidden" name="rcd_id" value="<?php echo $mas['rcd_id'];?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                  <label>Type</label>
                                  <select class="form-control" name="conType">
                                    <option value="">---SELECT---</option>
                                    <option value="20">20</option>
                                    <option value="40">40</option>
                                    <option value="CDE">CDE</option>
                                    <option value="CDD">CDD</option>
                                    <option value="Flatbed">Flatbed</option>
                                    <option value="Fuso">Fuso</option>
                                    <option value="WingBox">WingBox</option>
                                    <option value="GrandMax">GrandMax</option>
                                  </select>                              
                                </div>
                                <button type="submit" name="add_row" value="add_row" class="btn btn-primary">Add</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                              </div>                          
                            </div>                                                                            
                          </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- MODAL FOR ADD NEW CONTAINER RECORD / END -->

                  <!-- MODAL FOR ADD DELIVERY DATE PER JOB RECORD / START -->
                  <div class="modal fade" id="deliveryterm" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title"><b>[Trucking] </b> Input Delivery Date</h4>
                        </div>
                        <div class="modal-body">
                          <form method="post" action=" ">
                            <div class="col-md-12">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <input type="hidden" name="tr_job_id" value="<?php echo $getTruckIdSql['truck_job_id'];?>" class="form-control" required>
                                  <input type="hidden" name="rcd_id" value="<?php echo $mas['rcd_id'];?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                 <input type="date" name="dlv_date" class="form-control" required>
                                </div>
                                <button type="submit" name="deliveryterm" value="deliveryterm" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                              </div>                          
                            </div>                                                                            
                          </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- MODAL FOR ADD DELIVERY DATE PER JOB RECORD / END -->

                </div> 
              </div>

            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>Flags</th>
                      <th>Tr.ID</th>                      
                      <th>JobID</th>
                      <th>RcdID</th>
                      <th>BookingCode</th>
                      <th>Cont/Truck Type</th>
                      <th>DriverName</th>
                      <th>MobilePh</th>          
                      <th>VehicleNo</th>
                      <th>Cont.No</th>   
                      <th>Seal.No</th> 
                      <th>TareCont</th>   
                      <th>StuffArea</th>               
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $ids  = $_GET['rcd_id'];
                    $con=mysqli_connect("localhost","root","","contta");
                    if (mysqli_connect_errno())
                    {
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    $result = mysqli_query($con,"SELECT * FROM tb_truck_job_details  where rcd_id = '$ids' ");
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td align= ''>

                        <a href='#' target='_SELF' onclick=window.open('truck_job_log_view.php?tract_id=$row[tract_id]','name','menubar=yes,toolbar=no,addressbar=no,scrollbar=no,left=250,top=100,width=500,height=300') title='view logs data'><button type='button' class='btn btn-default btn-circle'><i class='fa fa-list'></i></button></a>  

                        <a href='#' data-toggle='modal' data-target='#actview$row[tract_id]' title='view activity data'><button type='button' class='btn btn-default btn-circle'><i class='fa fa-link'></i></button></a>


                        </td>";
                        echo "<td>" . $row['tract_id'] . "</td>";
                        echo "<td>" . $row['truck_job_id'] . "</td>";                      
                        echo "<td>" . $row['rcd_id'] . "</td>";
                        echo "<td>" . $row['booking_code'] . "</td>";               
                        echo "<td>" . $row['cont_type'] . "</td>";
                        echo "<td>" . $row['tract_driver_name'] . "</td>";
                        echo "<td>" . $row['tract_driver_phone'] . "</td>";
                        echo "<td>" . $row['tract_vehicle_no'] . "</td>";    
                        echo "<td>" . $row['tract_cont_no'] . "</td>"; 
                        echo "<td>" . $row['seal_no'] . "</td>"; 
                        echo "<td>" . $row['cont_tear'] . "</td>";
                        echo "<td>" . $row['stuffarea'] . "</td>"; 
                        echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#edit$row[tract_id]' title='Edit this record'><span class='label label-primary'>Update</span></a>
                        <a href='#' data-toggle='modal' data-target='#act$row[tract_id]' title='Edit this record'><span class='label label-primary'>Activity</span></a>
                        <a href='#' data-toggle='modal' data-target='#log$row[tract_id]' title='update log status'><span class='label label-primary'>Logs</span></a>
                        <a href='#' data-toggle='modal' data-target='#remove$row[tract_id]' title='update log status'><span class='label label-danger'>Remove</span></a>
                        </td>";
                        echo "</tr>";
                        ?>

                        <div class="modal fade" id="act<?php echo $row['tract_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[RecordMaster] </b> Update Job Activity</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" action=" ">
                                  <div class="col-md-12">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Start from Depo</label>
                                        <input type="text" name="tract_start" class="form-control" value="<?php echo $row['tract_start'];?>" >
                                      </div>
                                      <div class="form-group">
                                        <label>Arrived in Warehouse</label>
                                        <input type="text" name="tract_arr_in_wh" class="form-control" value="<?php echo $row['tract_arr_in_wh'];?>" >
                                      </div>
                                      <div class="form-group">
                                        <label>Start Stuffing</label>
                                        <input type="text" name="tract_start_stuff" class="form-control" value="<?php echo $row['tract_start_stuff'];?>" >
                                      </div>
                                      <div class="form-group">
                                        <label>End Stuffing</label>
                                        <input type="text" name="tract_end_stuff" value="<?php echo $row['tract_end_stuff'];?>"  class="form-control" >
                                      </div>
                                      <div class="form-group">
                                        <label>Leave Warehouse</label>
                                        <input type="text" name="tract_leave_wh" value="<?php echo $row['tract_leave_wh'];?>"  class="form-control" >
                                        <input type="hidden" name="tract_id" value="<?php echo $row['tract_id'];?>"  class="form-control" >
                                        <input type="hidden" name="rcd_id" value="<?php echo $row['rcd_id'];?>"  class="form-control" >
                                      </div> 
                                      <div class="form-group">
                                        <label>Arrived in CY</label>
                                        <input type="text" name="tract_arr_in_dest" class="form-control" value="<?php echo $row['tract_arr_in_dest'];?>" >
                                      </div>                                 
                                    </div>                         
                                  </div>    
                                  <div class="modal-footer">
                                    <button type="submit" name="act_update" value="act_update" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                  </div>                                                                        
                                </form>
                              </div>                            
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="log<?php echo $row['tract_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[RecordMaster] </b> Update Job Logs</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" action=" ">
                                  <div class="col-md-12">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label>CurrentTime</label>
                                        <input type="text" name="CurrentTime" readonly class="form-control" value="<?php echo date('Y-m-d H:i:s');?>">
                                      </div>
                                      <div class="form-group">
                                        <label>CurrentLocation</label>
                                        <input type="text" name="CurrentLocation" class="form-control" >
                                      </div>
                                      <div class="form-group">
                                        <label>Remarks</label>
                                        <input type="text" name="Remarks" class="form-control">
                                        <input type="hidden" name="tract_id" value="<?php echo $row['tract_id'];?>"  class="form-control" >
                                        <input type="hidden" name="rcd_id" value="<?php echo $row['rcd_id'];?>"  class="form-control" >
                                        <input type="hidden" name="user_name" value="<?php echo $_SESSION['username'];?>"  class="form-control" >
                                      </div>                               
                                    </div>                         
                                  </div>    
                                  <div class="modal-footer">
                                    <button type="submit" name="logupdate" value="logupdate" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                  </div>                                                                        
                                </form>
                              </div>                            
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="remove<?php echo $row['tract_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[RecordMaster] </b> Remove Job Logs</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" action=" ">
                                  <div class="col-md-12">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Tr.ID:</label>
                                        <input type="text" name="job_id" value="<?php echo $row['tract_id'];?>" readonly class="form-control" >
                                        <label>Rcd_ID:</label>
                                        <input type="text" name="rcd_id" value="<?php echo $row['rcd_id'];?>" readonly class="form-control" >
                                        <!-- <input type="hidden" name="user_name" value="<?php echo $_SESSION['username'];?>"  class="form-control" > -->
                                      </div>                               
                                    </div>                         
                                  </div>    
                                  <div class="modal-footer">
                                    <button type="submit" name="delete_row" value="delete_row" class="btn btn-danger">Remove!</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                  </div>                                                                        
                                </form>
                              </div>                            
                            </div>
                          </div>
                        </div>

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
                                        <label>Booking Code</label>
                                        <input type="text" name="booking_code" class="form-control" value="<?php echo $row['booking_code'];?>" >
                                      </div>
                                      <div class="form-group">
                                        <label>Driver Name</label>
                                        <input type="text" name="tract_driver_name" class="form-control" value="<?php echo $row['tract_driver_name'];?>" >
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
                                        <input type="hidden" name="rcd_id" value="<?php echo $row['rcd_id'];?>"  class="form-control" >
                                      </div> 
                                      <div class="form-group">
                                        <label>Seal No.</label>
                                        <input type="text" name="seal_no" class="form-control" value="<?php echo $row['seal_no'];?>" >
                                      </div> 
                                      <div class="form-group">
                                        <label>Container Tear</label>
                                        <input type="text" name="cont_tear" class="form-control" value="<?php echo $row['cont_tear'];?>" >
                                      </div>
                                      <div class="form-group">
                                        <label>Stuff Area</label>
                                        <input type="text" name="stuffarea" class="form-control">
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
