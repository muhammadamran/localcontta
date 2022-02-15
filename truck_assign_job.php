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


if(isset($_POST["assign"]))    
{    

$vendor       = $_POST['vendor'];
$remarks      = $_POST['remarks'];
$rcdid        = $_POST['rcdid'];
$user_name    = $_POST['user_name'];
$datenow    = date('Y-m-d');

  $query = mysql_query("INSERT into tb_truck_assign values(' ','$datenow','$user_name','$vendor','$rcdid','$remarks','','')");
  if($query){
    header("Location: ./truck_assign_job.php?ref=0000");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST["update"]))    
{    

  $pre_rcvd_cipl          = $_POST['pre_rcvd_cipl'];
  $pre_send_pib_draft     = $_POST['pre_send_pib_draft'];
  $pre_rcvd_pib_rev       = $_POST['pre_rcvd_pib_rev'];
  $pre_send_pib           = $_POST['pre_send_pib'];
  $pre_rcvd_complete      = $_POST['pre_rcvd_complete'];
  $pre_create_pib         = $_POST['pre_create_pib'];
  $rcd_id                 = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_pre SET pre_rcvd_cipl='$pre_rcvd_cipl',pre_send_pib_draft='$pre_send_pib_draft',pre_rcvd_pib_rev='$pre_rcvd_pib_rev',pre_send_pib='$pre_send_pib',pre_rcvd_complete='$pre_rcvd_complete',pre_create_pib='$pre_create_pib' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_pre.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST["complete"]))    
{    

  $rcd_id           = $_POST['rcdid'];
  $user_name        = $_POST['user_name'];
  $datenow          = date('Y-m-d H:i:s');

  $query = mysql_query("UPDATE tb_record_miles_import SET pre ='$datenow',action_by='$user_name' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_pre.php");                                                  
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
          <h1 class="page-header">Trucker - Assign Job</h1>
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
              <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <label>Input KN.REF/TN No.</label>
                      <div class="row">            
                        <form action="" method="get">
                          <div class="form-group col-md-8">
                            <input type="text" name="ref" class="form-control">
                          </div>
                          <div class="col-md-4">
                            <button type="submit" name="search" value="search" class="btn btn-primary">Search!</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>                      
                      <th>RcdID</th>
                      <th>HBL</th>
                      <th>AJU NO.</th>
                      <th>SHIPPER</th>
                      <th>CONSIGNEE</th>
                      <th>ETA</th>
                      <th>ATA</th>
                      <th>PARTY</th>
                      <th>ASSIGNED TRUCKER</th>
                      <th>SELECT VENDOR/TRUCKER</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $ref = $_GET['ref'];
                    $con=mysqli_connect("localhost","root","","contta");
                    $result = mysqli_query($con,"SELECT * FROM tb_master_impor WHERE rcd_ref='$ref'");
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['rcd_id'] . "</td>";
                        echo "<td>" . $row['rcd_hbl'] . "</td>";                      
                        echo "<td>" . $row['rcd_aju'] . "</td>";
                        echo "<td>" . $row['rcd_shipper'] . "</td>";               
                        echo "<td>" . $row['rcd_cnee'] . "</td>";
                        echo "<td>" . $row['rcd_eta'] . "</td>";
                        echo "<td>" . $row['rcd_ata'] . "</td>";
                        echo "<td>" . $row['rcd_party'] . "</td>"; 

                        $get_data = mysql_query("SELECT rcd_id FROM tb_truck_assign WHERE rcd_id = '$row[rcd_id]'");
                        $get1 = mysql_num_rows($get_data);
                        if ($get1 == 1) {
                          echo "<td align= ''>
                          <a href='#' data-toggle='modal' data-target='#assign$row[rcd_id]' title='View Details'><span class='label label-primary'>ASSIGNED</span></a>
                          </td>";
                        } else {
                          echo "<td align= ''>
                          <a href='#' data-toggle='modal' data-target='#xx$row[rcd_id]' title='Edit this record'><span class='label label-primary'>N/A</span></a>
                          </td>";
                        }

                        if ($get1 == 1) {
                          echo "<td align= ''>
                          <a href='#' data-toggle='modal' data-target='#xx$row[rcd_id]' title='select'><span class='label label-default disabled'>SELECT</span></a>
                          </td>";
                        } else {
                          echo "<td align= ''>
                          <a href='#' data-toggle='modal' data-target='#select$row[rcd_id]' title='select'><span class='label label-primary'>SELECT</span></a>
                          </td>";
                        }                    
                        echo "</tr>";
                        ?>

                        <div class="modal fade" id="assign<?php echo $row['rcd_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[RecordMaster] </b> Assign Job Details</h4>
                            </div>
                            <div class="modal-body">
                              <?php 
                              mysql_connect('localhost', 'root','');
                              mysql_select_db('contta'); 
                              $get_data2 = mysql_query("SELECT * FROM tb_truck_assign WHERE rcd_id = '$row[rcd_id]'");
                              $get2 = mysql_fetch_array($get_data2);
                              ?>
                              <form method="post" action=" ">
                                <div class="col-md-12">
                                  <div class="col-md-12">
                                    <div class="form-group">                                      
                                      <label>Assigned Date</label>                                      
                                      <input type="text" readonly name="post_rcvd_inv_vendor" class="form-control" value="<?php echo $get2['assign_date'];?>">
                                    </div>
                                    <div class="form-group">
                                      <label>Assigned By</label>
                                      <input type="text" readonly name="post_billing_customer" class="form-control" value="<?php echo $get2['assign_by'];?>" >
                                    </div>
                                    <div class="form-group">
                                      <label>Vendor Name</label>
                                      <input type="text" readonly name="post_billing_send" value="<?php echo $get2['assign_vendor'];?>"  class="form-control" >
                                    </div>
                                    <div class="form-group">
                                      <label>Remarks</label>
                                      <input type="text" readonly name="post_filling" value="<?php echo $get2['assign_remark'];?>"  class="form-control" >
                                    </div>
                                  </div>                         
                                </div>    
                                <div class="modal-footer">                              
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>                                                                        
                              </form>
                            </div>                            
                          </div>
                        </div>
                      </div>

                        <div class="modal fade" id="select<?php echo $row['rcd_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[RecordManage] </b> Assign Trucker Record</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" action=" ">
                                  <div class="form-group">
                                    <label>Select the vendor/trucker:</label>
                                    <div class="form-group">
                                      <select class="form-control" name="vendor" id="shipper">
                                        <option value=" ">--- SELECT ---</option>
                                        <?php
                                        $result=mysql_query("SELECT * FROM tb_trucker");
                                        while($data=mysql_fetch_array($result)) {
                                          echo "<option value='$data[trucker_name]'> $data[trucker_name] </option>";
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Delivery Address</label>
                                      <input type="text" name="remarks" class="form-control">
                                    </div>
                                    <input type="hidden" name="rcdid" class="form-control" value="<?php echo $row['rcd_id'];?>">
                                    <input type="hidden" name="user_name" class="form-control" value="<?php echo $_SESSION['username'];?>">
                                  </div>
                                  <button type="submit" name="assign" value="assign" class="btn btn-default">Assign</button>
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
