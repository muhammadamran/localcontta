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

$rcd_id                 = $_POST['rcd_id'];
$remark1                = $_POST['remark1'];
$aju                    = $_POST['aju'];

$query = mysql_query("UPDATE tb_imp_pre SET pre_rev_remark='$remark1' where rcd_id='$rcd_id'");
$query .= mysql_query("UPDATE tb_master_impor SET rcd_aju='$aju' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_pre.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
} 

if(isset($_POST["pre_rcvd_cipl"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_pre SET pre_rcvd_cipl ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_pre.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["pre_send_pib_draft"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_pre SET pre_send_pib_draft ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_pre.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["pre_rcvd_pib_rev"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_pre SET pre_rcvd_pib_rev ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_pre.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["pre_create_pib"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_pre SET pre_create_pib ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_pre.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
} 

if(isset($_POST["pre_send_pib"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_pre SET pre_send_pib ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_pre.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["pre_rcvd_complete"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_pre SET pre_rcvd_complete ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_pre.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
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

if(isset($_POST["pib"]))    
{    
  $rid                = $_POST['rid'];  

  $date_taken         = date('Y-m-d H:i:s');

  $uploaddir = 'file/pib/';
    $uploadfile = $uploaddir . '_' .$rid . '_' . date("YmdHis") . '_' . basename($_FILES['form']['name']);

    $query = move_uploaded_file($_FILES['form']['tmp_name'], $uploadfile);
    if($query){
      if (mysql_query("UPDATE tb_imp_pre SET pib_file ='$uploadfile' WHERE rcd_id='$rid'")) {            
            header("Location: ./imp_pre.php");
        } else {
            echo "Updated Failed - Please contact your administrator".mysql_error();
        }                                                 
    } else {
      echo "Updated Failed - Please contact your administrator";
    }

}

if(isset($_POST["npe"]))    
{    
  $rid                = $_POST['rid'];  

  $date_taken         = date('Y-m-d H:i:s');

  $uploaddir = 'file/npe/';
    $uploadfile = $uploaddir . '_' .$rid . '_' . date("YmdHis") . '_' . basename($_FILES['form']['name']);

    $query = move_uploaded_file($_FILES['form']['tmp_name'], $uploadfile);
    if($query){
      if (mysql_query("UPDATE tb_record_ship_cus SET npe_file ='$uploadfile' WHERE rcd_id='$rid'")) {            
            header("Location: ./ship_cus.php");
        } else {
            echo "Updated Failed - Please contact your administrator";
        }                                                 
    } else {
      echo "Updated Failed - Please contact your administrator";
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<?php include 'include/head.php';?>
<body onload="display_ct()">

  <div id="wrapper">
    <?php include 'include/header.php';?>

    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Import - Uncompleted Records</h1>
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
              <p align="left"><a href="import_uncompleted_record_csv.php"><button>Export to CSV</button></a></p>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>RcdID</th>
                      <th>RcdDate</th>
                      <th>KNREF/TN</th>
                      <th>CNEE</th>
                      <th>AJU NO.</th>
                      <th>PreClearance</th>
                      <th>Clearance</th>
                      <th>PostClearance</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $con=mysqli_connect("localhost","root","","contta");
                    if (mysqli_connect_errno())
                    {
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    $result = mysqli_query($con,"SELECT * FROM tb_record_miles_import INNER JOIN tb_master_impor ON tb_record_miles_import.rcd_id=tb_master_impor.rcd_id WHERE tb_record_miles_import.post = '0'");
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['rcd_id'] . "</td>"; 
                        echo "<td>" . $row['rcd_create_date'] . "</td>"; 
                        echo "<td>" . $row['rcd_ref'] . "</td>";   
                        echo "<td>" . $row['rcd_cnee'] . "</td>";                      
                        echo "<td>" . $row['rcd_aju'] . "</td>";  
                        echo "<td>" . $row['pre'] . "</td>";  
                        echo "<td>" . $row['clear'] . "</td>";  
                        echo "<td>" . $row['post'] . "</td>";  
                      echo "</tr>";
                      ?>
                      <div class="modal fade" id="edit<?php echo $row['rcd_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[RecordMaster] </b> Update Pre Clearance</h4>
                            </div>
                            <div class="modal-body">
                              <form method="post" action=" ">
                                <div class="col-md-12">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <?php 
                                      mysql_connect('localhost', 'root','');
                                      mysql_select_db('contta'); 
                                      $aju = mysql_query("SELECT rcd_aju FROM tb_master_impor WHERE rcd_id = '$row[rcd_id]' ");
                                      $getaju = mysql_fetch_array($aju);
                                      ?>
                                      <label>No. AJU</label>
                                      <textarea name="aju" class="form-control"><?php echo $getaju['rcd_aju']?></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label>REMARK</label>
                                      <textarea name="remark1" class="form-control"><?php echo $row['pre_rev_remark']?></textarea>
                                      <input type="hidden" name="rcd_id" value="<?php echo $row['rcd_id'];?>"  class="form-control" >
                                      <!-- <input type="text" name="remark1" value="<?php echo $row['pre_rev_remark'];?>"  class="form-control" > -->
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
                                <?php 
                                if ($row['pib_file'] == "") {
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
