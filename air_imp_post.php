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

$rcd_id                     = $_POST['rcd_id'];
$remark1                    = $_POST['remark1'];

$query = mysql_query("UPDATE tb_imp_post SET post_remark='$remark1' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_post.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST["post_rcvd_inv_vendor"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_post SET post_rcvd_inv_vendor ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_post.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["post_billing_customer"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_post SET post_billing_customer ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_post.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["post_billing_send"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_post SET post_billing_send ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_post.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["post_filling"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_post SET post_filling ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_post.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["complete"]))    
{    

  $rcd_id           = $_POST['rcdid'];
  $user_name        = $_POST['user_name'];
  $datenow          = date('Y-m-d H:i:s');

  $query = mysql_query("UPDATE tb_record_miles_import SET post ='$datenow',action_by_3='$user_name' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_pre.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST["vendor"]))    
{    
  $rid                = $_POST['rid'];  

  $date_taken         = date('Y-m-d H:i:s');

  $uploaddir = 'file/inv-vendor/';
    $uploadfile = $uploaddir . '_' .$rid . '_' . date("YmdHis") . '_' . basename($_FILES['form']['name']);

    $query = move_uploaded_file($_FILES['form']['tmp_name'], $uploadfile);
    if($query){
      if (mysql_query("UPDATE tb_imp_post SET post_invoice_vendor_file ='$uploadfile' WHERE rcd_id='$rid'")) {            
            header("Location: ./imp_post.php");
        } else {
            echo "Updated Failed - Please contact your administrator".mysql_error();
        }                                                 
    } else {
      echo "Updated Failed - Please contact your administrator";
    }

}

if(isset($_POST["cust"]))    
{    
  $rid                = $_POST['rid'];  

  $date_taken         = date('Y-m-d H:i:s');

  $uploaddir = 'file/inv-customer/';
    $uploadfile = $uploaddir . '_' .$rid . '_' . date("YmdHis") . '_' . basename($_FILES['form']['name']);

    $query = move_uploaded_file($_FILES['form']['tmp_name'], $uploadfile);
    if($query){
      if (mysql_query("UPDATE tb_imp_post SET post_customer_invoice_file ='$uploadfile' WHERE rcd_id='$rid'")) {            
            header("Location: ./imp_post.php");
        } else {
            echo "Updated Failed - Please contact your administrator".mysql_error();
        }                                                 
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
          <h1 class="page-header">[Airfreight] Import - Post</h1>
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
                      <th>PostID</th>
                      <th>RcdID</th>
                      <th>KNREF/TN</th>
                      <th>HBL</th>
                      <th>CNEE</th>
                      <th>AJU NO.</th>
                      <th>RCVD INV VENDOR</th>
                      <th>CREATE BILLING</th>
                      <th>SEND BILLING</th>
                      <th>FILLING</th>
                      <th>FILE - INVOICE VENDOR</th>
                      <th>FILE - INVOICE CUSTOMER</th>
                      <th>REMARK</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $con=mysqli_connect("localhost","root","","contta");
                    if (mysqli_connect_errno())
                    {
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    $result = mysqli_query($con,"SELECT * FROM tb_record_miles_import INNER JOIN tb_imp_post ON tb_record_miles_import.rcd_id=tb_imp_post.rcd_id WHERE tb_record_miles_import.post = '0' AND tb_record_miles_import.clear != '0' AND tb_record_miles_import.mot = 'AIR'");
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['post_id'] . "</td>";
                        echo "<td>" . $row['rcd_id'] . "</td>"; 

                        $get_data = mysql_query("SELECT rcd_aju,rcd_ref,rcd_cnee,rcd_hbl FROM tb_master_impor WHERE rcd_id = '$row[rcd_id]'");
                        $get1 = mysql_fetch_array($get_data);

                        echo "<td>" . $get1['rcd_ref'] . "</td>";
                        echo "<td>" . $get1['rcd_hbl'] . "</td>";
                        echo "<td>" . $get1['rcd_cnee'] . "</td>";                         
                        echo "<td>" . $get1['rcd_aju'] . "</td>";  

                        if ($row['post_rcvd_inv_vendor'] == "0000-00-00") {
                          echo "<td>" . 
                          "<form method='post' action=''>".
                          "<input type='hidden' value='$row[rcd_id]' name='rcd_id'>".
                          "<button type='submit' name='post_rcvd_inv_vendor' value='post_rcvd_inv_vendor' class='btn btn-primary'>Input</button>".
                          "</form>"
                          . "</td>";  
                        } else {
                          echo "<td>" . $row['post_rcvd_inv_vendor'] . "</td>";
                        }    

                        if ($row['post_billing_customer'] == "0000-00-00") {
                          echo "<td>" . 
                          "<form method='post' action=''>".
                          "<input type='hidden' value='$row[rcd_id]' name='rcd_id'>".
                          "<button type='submit' name='post_billing_customer' value='post_billing_customer' class='btn btn-primary'>Input</button>".
                          "</form>"
                          . "</td>";  
                        } else {
                          echo "<td>" . $row['post_billing_customer'] . "</td>";
                        }    

                        if ($row['post_billing_send'] == "0000-00-00") {
                          echo "<td>" . 
                          "<form method='post' action=''>".
                          "<input type='hidden' value='$row[rcd_id]' name='rcd_id'>".
                          "<button type='submit' name='post_billing_send' value='post_billing_send' class='btn btn-primary'>Input</button>".
                          "</form>"
                          . "</td>";  
                        } else {
                          echo "<td>" . $row['post_billing_send'] . "</td>";
                        }   

                        if ($row['post_filling'] == "0000-00-00") {
                          echo "<td>" . 
                          "<form method='post' action=''>".
                          "<input type='hidden' value='$row[rcd_id]' name='rcd_id'>".
                          "<button type='submit' name='post_filling' value='post_filling' class='btn btn-primary'>Input</button>".
                          "</form>"
                          . "</td>";  
                        } else {
                          echo "<td>" . $row['post_filling'] . "</td>";
                        }                                        
                                              
                        if ($row['post_invoice_vendor_file'] == "") {
                          echo "<td>" . "file not found" . "</td>";
                        } else {
                          echo "<td>" . "<a href='$row[post_invoice_vendor_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>";  
                        }
                        if ($row['post_customer_invoice_file'] == "") {
                          echo "<td>" . "file not found" . "</td>";
                        } else {
                          echo "<td>" . "<a href='$row[post_customer_invoice_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>";  
                        }
                        echo "<td>" . $row['post_remark'] . "</td>";                       
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
                              <h4 class="modal-title"><b>[RecordMaster] </b> Update Post Clearance</h4>
                            </div>
                            <div class="modal-body">
                              <form method="post" action=" ">
                                <div class="col-md-12">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label>PostClearance Remark</label>
                                      <textarea name="remark1" class="form-control"><?php echo $row['post_remark']?></textarea>
                                      <input type="hidden" name="rcd_id" value="<?php echo $row['rcd_id'];?>">
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

                      <div class="modal fade" id="vendor<?php echo $row['rcd_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[Document Management] </b> Invoice Vendor File</h4>
                            </div>
                            <div class="modal-body">
                              <form method="post" action=" "  accept-charset="utf-8" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label>Upload File</label>
                                  <input type="file" name="form" class="form-control">
                                  <input type="hidden" name="rid" class="form-control" placeholder="client name" value="<?php echo $row['rcd_id'];?>" required>
                                  <input type="hidden" name="rcd_type" class="form-control" placeholder="client name" value="<?php echo $row['rcd_type'];?>" required>
                                </div>
                                <button type="submit" name="vendor" value="vendor" class="btn btn-default">Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="cust<?php echo $row['rcd_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[Document Management] </b> Invoice Cust. File</h4>
                            </div>
                            <div class="modal-body">
                              <form method="post" action=" "  accept-charset="utf-8" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label>Upload File</label>
                                  <input type="file" name="form" class="form-control">
                                  <input type="hidden" name="rid" class="form-control" placeholder="client name" value="<?php echo $row['rcd_id'];?>" required>
                                  <input type="hidden" name="rcd_type" class="form-control" placeholder="client name" value="<?php echo $row['rcd_type'];?>" required>
                                </div>
                                <button type="submit" name="cust" value="cust" class="btn btn-default">Yes</button>
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
                                <?php 
                                if ($row['post_invoice_vendor_file'] == "" OR $row['post_customer_invoice_file'] == "") {
                                  ?>
                                  <div class="form-group">
                                    <label>This record couldn't be completed. <br> Please check the mandatory file and ensure the file was submitted</label>
                                    <h6>RecordID : <?php echo $row['rcd_id'];?></h6>
                                    <input type="hidden" name="rcdid" class="form-control" value="<?php echo $row['rcd_id'];?>">
                                    <input type="hidden" name="user_name" class="form-control" value="<?php echo $_SESSION['username'];?>">
                                    <button type="submit" name="complete" value="complete" class="btn btn-default" disabled>Complete</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal" disabled>No</button>
                                  </div>
                                  <?php
                                } else {
                                  ?>
                                  <div class="form-group">
                                    <label>Are you sure Complete this record?</label>
                                    <h6>RecordID : <?php echo $row['rcd_id'];?></h6>
                                    <input type="hidden" name="rcdid" class="form-control" value="<?php echo $row['rcd_id'];?>">
                                    <input type="hidden" name="user_name" class="form-control" value="<?php echo $_SESSION['username'];?>">
                                    <button type="submit" name="complete" value="complete" class="btn btn-default">Complete</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                  </div>
                                  <?php
                                }                             
                                ?>                                                            
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
