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
  $datenow              = date('Y-m-d');


  $query = mysql_query("INSERT into tb_record_master values(' ','$datenow','$user_name','$rcd_type','$ship_plan','$shipper','$cnee','$inv_no','$commo','$c20','$c40','$party','$po_no')");
  if($query){
    header("Location: ./export_master.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST["ck5"]))    
{    
  $rid                = $_POST['rid'];  

  $date_taken         = date('Y-m-d H:i:s');

  $uploaddir = 'file/ck5/';
    $uploadfile = $uploaddir . '_' .$rid . '_' . date("YmdHis") . '_' . basename($_FILES['form']['name']);

    $query = move_uploaded_file($_FILES['form']['tmp_name'], $uploadfile);
    if($query){
      if (mysql_query("UPDATE tb_record_ship_arr SET rcd_arr_ck5_file ='$uploadfile' WHERE rcd_id='$rid'")) {            
            header("Location: ./ship_arr.php");
        } else {
            echo "Updated Failed - Please contact your administrator";
        }                                                 
    } else {
      echo "Updated Failed - Please contact your administrator";
    }

}

if(isset($_POST["update"]))    
{    

$create_sipl      = $_POST['create_sipl'];
$create_ems       = $_POST['create_ems'];
$no_aju           = $_POST['no_aju'];
$StuffingDate     = $_POST['StuffingDate'];
$create_sac       = $_POST['create_sac'];
$revise_sac       = $_POST['revise_sac'];
$sac_no_pen       = $_POST['sac_no_pen'];
$app_ck5          = $_POST['app_ck5'];
$close_ck5        = $_POST['close_ck5'];
$remark           = $_POST['remark'];
$rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_record_ship_arr SET rcd_ar_aju='$no_aju',rcd_ar_ck2_app='$app_ck5',rcd_ar_ck5_close='$close_ck5',rcd_ar_ems='$create_ems',rcd_ar_sac='$create_sac',rcd_ar_sac_no='$sac_no_pen',rcd_ar_sac_rev='$revise_sac',rcd_ar_sipl='$create_sipl',rcd_ar_stuff='$StuffingDate',remarks='$remark' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./ship_arr.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["complete"]))    
{    

$rcd_id           = $_POST['rcdid'];
$user_name        = $_POST['user_name'];
  $datenow          = date('Y-m-d H:i:s');

  $query = mysql_query("UPDATE tb_record_miles SET miles_arr ='$datenow',action_by='$user_name' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./ship_arr.php");                                                  
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
          <h1 class="page-header">Shipment Arrangement</h1>
        </div>
      </div>
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
                      <th>ArID</th>
                      <th>RcdID</th>
                      <th>No.Inv</th>
                      <th>CreateSIPL</th>
                      <th>CreateEMS</th>
                      <th>No.Aju</th>
                      <th>StuffingDate</th>
                      <th>Create SAC</th>
                      <th>Revisi SAC (Pembatalan CK5#)</th>
                      <th>SAC No. PEN</th>
                      <th>Custom Approval for CK5</th>
                      <th>CK5 FILE</th>
                      <th>Closed CK 5</th>
                      <th>Remarks</th>
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
                    $result = mysqli_query($con,"SELECT * FROM tb_record_miles INNER JOIN tb_record_ship_arr ON tb_record_miles.rcd_id=tb_record_ship_arr.rcd_id WHERE tb_record_miles.miles_arr = 0 ");
                    if(mysqli_num_rows($result)>0){

                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['rcd_ar_id'] . "</td>";
                        echo "<td>" . $row['rcd_id'] . "</td>";
                        $grep_date = mysqli_query($con,"SELECT * FROM tb_record_master WHERE rcd_id = '$row[rcd_id]' ");
                          $grep = mysqli_fetch_array($grep_date);
                          echo "<td>" . $grep['rcd_inv_no'] . "</td>";
                        echo "<td>" . $row['rcd_ar_sipl'] . "</td>";
                        echo "<td>" . $row['rcd_ar_ems'] . "</td>";                                        
                        echo "<td>" . $row['rcd_ar_aju'] . "</td>";
                        echo "<td>" . $row['rcd_ar_stuff'] . "</td>";
                        echo "<td>" . $row['rcd_ar_sac'] . "</td>";
                        echo "<td>" . $row['rcd_ar_sac_rev'] . "</td>";
                        echo "<td>" . $row['rcd_ar_sac_no'] . "</td>";
                        echo "<td>" . $row['rcd_ar_ck2_app'] . "</td>";
                        if ($row['rcd_arr_ck5_file'] == "") {
                          echo "<td>" . "file not found" . "</td>";
                        } else {
                          echo "<td>" . "<a href='$row[rcd_arr_ck5_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>";  
                        }
                        echo "<td>" . $row['rcd_ar_ck5_close'] . "</td>";
                        echo "<td>" . $row['remarks'] . "</td>";
                        echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#ck5$row[rcd_id]' title='Edit this record'><span class='label label-primary'>CK5</span></a>
                        <a href='#' data-toggle='modal' data-target='#edit$row[rcd_id]' title='Edit this record'><span class='label label-primary'>Update</span></a>
                        <a href='#' data-toggle='modal' data-target='#confirm$row[rcd_id]' title='Completed this record'><span class='label label-primary'>Complete</span></a>
                      </td>";
                      echo "</tr>";
                      ?>

                      <div class="modal fade" id="ck5<?php echo $row['rcd_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[Document Management] </b> CK5 File</h4>
                            </div>
                            <div class="modal-body">
                              <form method="post" action=" "  accept-charset="utf-8" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label>Upload File</label>
                                  <input type="file" name="form" class="form-control">
                                  <input type="hidden" name="rid" class="form-control" placeholder="client name" value="<?php echo $row['rcd_id'];?>" required>
                                  <input type="hidden" name="rcd_type" class="form-control" placeholder="client name" value="<?php echo $row['rcd_type'];?>" required>
                                </div>
                                <button type="submit" name="ck5" value="ck5" class="btn btn-default">Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="edit<?php echo $row['rcd_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[RecordMaster] </b> Update Shipment Arrangement</h4>
                            </div>
                            <div class="modal-body">
                              <form method="post" action=" ">
                                <div class="col-md-12">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>CreateSIPL</label>
                                      <input type="date" name="create_sipl" class="form-control" value="<?php echo $row['rcd_ar_sipl'];?>"  placeholder="ShipmentPlanDate">
                                    </div>
                                    <div class="form-group">
                                      <label>CreateEMS</label>
                                      <input type="date" name="create_ems" class="form-control" value="<?php echo $row['rcd_ar_ems'];?>"  placeholder="ShipmentPlanDate">
                                    </div>
                                    <div class="form-group">
                                      <label>No.Aju</label>
                                      <input type="text" name="no_aju" class="form-control"  value="<?php echo $row['rcd_ar_aju'];?>" >
                                    </div>
                                    <div class="form-group">
                                      <label>StuffingDate</label>
                                      <input type="datetime-local" name="StuffingDate" value="<?php echo $row['rcd_ar_stuff'];?>"  class="form-control" >
                                    </div>
                                    <div class="form-group">
                                      <label>Create SAC</label>
                                      <input type="date" name="create_sac" value="<?php echo $row['rcd_ar_sac'];?>"  class="form-control" >
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Revisi SAC</label>
                                      <input type="text" name="revise_sac" value="<?php echo $row['rcd_ar_sac_rev'];?>"  class="form-control" >
                                    </div>
                                    <div class="form-group">
                                      <label>SAC No. Pen</label>
                                      <input type="text" name="sac_no_pen" value="<?php echo $row['rcd_ar_sac_no'];?>"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label>Approval for CK5</label>
                                      <input type="date" name="app_ck5" value="<?php echo $row['rcd_ar_ck2_app'];?>"  class="form-control">
                                    </div>                                    
                                    <div class="form-group">
                                      <label>Closed CK 5</label>
                                      <input type="date" name="close_ck5" value="<?php echo $row['rcd_ar_ck5_close'];?>"  class="form-control" >
                                    </div>
                                    <div class="form-group">
                                      <label>Remarks</label>
                                      <input type="text" name="remark"  value="<?php echo $row['remarks'];?>" class="form-control" >
                                      <input type="hidden" name="rcd_id" class="form-control" placeholder="#" value="<?php echo $row['rcd_id'];?>">
                                    </div>
                                    <button type="submit" name="update" value="update" class="btn btn-primary">Update</button>
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
