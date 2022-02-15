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

if(isset($_POST['delete']))
{

$rcdid                = $_POST['rcdid'];
/*$del_ref            = $_POST['del_ref'];
$del_name           = $_POST['del_name'];
$date_now           = date('Y-m-d H:i:s');*/

if($did){
        $query = mysql_query("DELETE FROM tb_rcd_master WHERE rcd_ref = '$del_ref' ");
        $query .= mysql_query("DELETE FROM tb_delivery_master WHERE dlv_ref = '$del_ref' ");
        $query .= mysql_query("DELETE FROM tb_docs_master WHERE docs_ref = '$del_ref' ");
        $query .= mysql_query("DELETE FROM tb_printed_docs WHERE print_ref = '$del_ref' ");
        $query .= mysql_query("INSERT into tb_log values(' ','$del_name','delete-record','$date_now','$del_ref')");
            if($query){
                 header("Location: ./admin_rcdmanage.php");                    
            } else {
                echo "Operation Failed! Please contact your administrator".mysql_errno();
            }
    } else {
        echo "Operation Failed! Please contact your administrator".mysql_errno();
    }

}

if(isset($_POST["updatefile"]))    
{    
  $rid                = $_POST['rcd_id'];
  $uploader           = $_POST['uploader'];
  $ref                = $_POST['ref'];
  $dtype              = $_POST['dtype'];
  $date_taken         = date('Y-m-d H:i:s');
  $remark             = $_POST['remark'];
  $rcd_type             = "export";

  $uploaddir = 'file/';
  $uploadfile = $uploaddir . '_' .$rid . $rcd_type . '_' . date("YmdHis") . '_' . basename($_FILES['form']['name']);

  $query = move_uploaded_file($_FILES['form']['tmp_name'], $uploadfile);
  $query .= mysql_query("INSERT into tb_docs_list_export values(' ','$rid','$dtype','$uploadfile','$uploader','$date_taken','$remark')");
  if($query)
    if ($dtype == 'PEB') {
      $uploadplus = mysql_query("UPDATE tb_ex_custom SET peb_file ='$uploadfile' WHERE rcd_id='$rid'");
      if ($uploadplus) {
        header("Location: ./exp_efile2.php?ref=$ref");
      } 
    } elseif ($dtype == 'COO' ) {
      $uploadplus = mysql_query("UPDATE tb_ex_custom SET coo_file ='$uploadfile' WHERE rcd_id='$rid'");
      if ($uploadplus) {
        header("Location: ./exp_efile2.php?ref=$ref");
      }
    } elseif ($dtype == 'SPPB') {
      $uploadplus = mysql_query("UPDATE tb_ex_custom SET sppb_file ='$uploadfile' WHERE rcd_id='$rid'");
      if ($uploadplus) {
        header("Location: ./exp_efile2.php?ref=$ref");
      }
    } elseif ($dtype == 'INVOICE VENDOR') {
      $uploadplus = mysql_query("UPDATE tb_imp_post SET post_invoice_vendor_file ='$uploadfile' WHERE rcd_id='$rid'");
      if ($uploadplus) {
        header("Location: ./exp_efile2.php?ref=$ref");
      }
    } elseif ($dtype == 'INVOICE CUSTOMER') {
      $uploadplus = mysql_query("UPDATE tb_imp_clear SET post_customer_invoice_file ='$uploadfile' WHERE rcd_id='$rid'");
      if ($uploadplus) {
        header("Location: ./exp_efile2.php?ref=$ref");
      }
    } elseif ($dtype == 'CIPL') {
      $uploadplus = mysql_query("UPDATE tb_master_export SET cipl_file ='$uploadfile' WHERE rcd_id='$rid'");
      if ($uploadplus) {
        header("Location: ./exp_efile2.php?ref=$ref");
      }
    } elseif ($dtype == 'NPE') {
      $uploadplus = mysql_query("UPDATE tb_ex_custom SET npe_file ='$uploadfile' WHERE rcd_id='$rid'");
      if ($uploadplus) {
        header("Location: ./exp_efile2.php?ref=$ref");
      }
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<?php include 'include/head.php';?>
<body>

  <div id="wrapper">
    <?php include 'include/header.php';?>

    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Document Management (E-FILE - Export)</h1>
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
                          <div class="form-group col-md-6">
                            <input type="text" name="ref" class="form-control" required>
                          </div>
                          <div class="col-md-3">
                            <button type="submit" name="search" value="search" class="btn btn-primary">Search!</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- get data -->

                <?php

                $ref = $_GET['ref'];   
                 mysql_connect('localhost', 'root','');
                 mysql_select_db('contta'); 
                 $role1 = mysql_query("SELECT * FROM tb_master_export WHERE rcd_ref = '$ref' ");
                 $access1 = mysql_fetch_array($role1);

                ?>

                <!-- end -->

                <div class="col-lg-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <label>Record Details</label>
                      <div class="row">            
                        <div class="col-md-3">
                          Record ID : <?php echo $access1['rcd_id'];?> | TN/REF : <?php echo $_GET['ref'];?>
                        </div>
                        <div class="col-md-3">
                          JobOwner : <?php echo $access1['rcd_create_by'];?>
                        </div>
                        <div class="col-md-3">
                          Shipper Name : <?php echo $access1['rcd_shipper'];?>
                        </div>
                        <div class="col-md-3">
                          Cnee Name : <?php echo $access1['rcd_cnee'];?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>                      
                      <th>DocsID</th>
                      <th>RcdID</th>                      
                      <th>Docs Name</th>
                      <th>File</th>
                      <th>Uploadedby</th>
                      <th>Date</th>
                      <th>Remarks</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>

                    <!-- upload section -->

                    <!-- ADD NEW DOCUMENT TYPE -->

                <a href='#' data-toggle='modal' data-target='#add' title='Add'><span class='label label-success'>Add New File</span></a>
                <div class="modal fade" id="add" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>[Docs Set] </b> Add New Docs </h4>
                      </div>
                      <div class="modal-body">
                        <form method="post" action=" " accept-charset="utf-8" enctype="multipart/form-data">
                          <div class="form-group">
                            <label>Docs. Name</label>
                            <select class="form-control" name="dtype">
                              <option value=" ">--- SELECT ---</option>
                              <?php
                              mysql_connect('localhost','root','');
                              mysql_select_db('contta');
                              $result=mysql_query("SELECT * FROM tb_docs_type order by dtype_name ASC");
                              while($data=mysql_fetch_array($result)) {
                                echo "<option value='$data[dtype_name]'> $data[dtype_name] </option>";
                              }
                              ?>
                            </select>                    
                          </div>
                          <div class="form-group">
                            <input type="hidden" name="rcd_id" value="<?php echo $access1['rcd_id'];?>" class="form-control">
                            <input type="hidden" name="uploader" value="<?php echo $_SESSION['username'];?>" class="form-control">
                            <input type="hidden" name="ref" value="<?php echo $access1['rcd_ref'];?>" class="form-control">
                          </div>
                          <div class="form-group files">
                <label>Upload Your File </label>
                <input type="file" class="form-control" multiple="">
              </div>
                          <div class="form-group">
                            <label>Remarks </label>
                            <input type="text" name="remark" class="form-control">
                          </div>
                          <button type="submit" name="updatefile" value="updatefile" class="btn btn-default">Upload</button>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <hr>

                <!-- END OF ADD NEW DOCS TYPE -->

                    <!-- end -->


                    <?php
                    $ref = $_GET['ref'];                    
                    $con=mysqli_connect("localhost","root","","contta");
                    $result = mysqli_query($con,"SELECT * FROM tb_master_export INNER JOIN tb_docs_list_export ON tb_master_export.rcd_id=tb_docs_list_export.rcd_id WHERE tb_master_export.rcd_ref = '$ref'");                    
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['doc_id'] . "</td>";
                        echo "<td>" . $row['rcd_id'] . "</td>";                      
                        echo "<td>" . $row['doc_name'] . "</td>";
                        echo "<td>" . "<a href='$row[doc_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>";
                        echo "<td>" . $row['uploadby'] . "</td>";
                        echo "<td>" . $row['uploaddate'] . "</td>";
                        echo "<td>" . $row['remark'] . "</td>";
                        echo "<td align= ''>
                        
                        </td>";                  
                        echo "</tr>";
                        ?>
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
                                    <label>Are you sure to delete all details of this record?</label>
                                    <input type="hidden" name="rcdid" class="form-control" value="<?php echo $row['rcd_id'];?>">
                                    <input type="hidden" name="user_name" class="form-control" value="<?php echo $_SESSION['username'];?>">
                                  </div>
                                  <button type="submit" name="delete" value="delete" class="btn btn-default">Yes</button>
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
