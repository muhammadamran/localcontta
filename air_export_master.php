<?php

include "include/connection.php";
include "include/restrict.php";

if(isset($_POST["create"]))    
{  

  $hbl            = $_POST['hbl'];
  $aju            = $_POST['aju'];
  $shipper        = $_POST['shipper'];
  $cnee           = $_POST['cnee'];
  $inv_no         = $_POST['inv_no'];
  $mot            = $_POST['mot'];
  $weight         = $_POST['weight'];
  $c20            = $_POST['c20'];
  $c40            = $_POST['c40'];
  $ref            = $_POST['ref'];

  if ($c20 == "0") {
    $party_sql = $c40."x40";
  } elseif ($c40 == "0") {
    $party_sql = $c20."x20";
  } elseif ($c40 == 0 and $c20 == 0) {
    $party_sql = "";
  } elseif ($c40 != 0 and $c20 != 0) {
    $party_sql = $c20."x20". " + " . $c40."x40";
  }

  $cbm            = $_POST['cbm'];
  $eta            = $_POST['eta'];
  //$ata            = $_POST['ata'];
  $coo            = $_POST['coo'];

  //$do_validation  = $_POST['do_validation'];
  $rcd_type             = "export";
  $user_name            = $_POST['user_name'];
  $datenow              = date('Y-m-d');
  $monthnow             = date('m');
  $yearnow              = date('Y');

  if ($mot == "LCL") {
    $package_sql  = $_POST['package'];
  } else {
    $package_sql  = "No package";
  }

  $query = mysql_query("INSERT into tb_master_export values(' ','$datenow','$monthnow','$yearnow','$user_name','$rcd_type','$hbl','$shipper','$cnee','$inv_no','$aju','$ref','$c20','$c40','$party_sql','$weight','$package_sql','$cbm','$eta','','$coo','','','$mot','New','')");
  $last_id = mysql_insert_id();
  $query .= mysql_query("INSERT into tb_record_miles_export values(' ','$last_id','1','1','0','0','1','1','0','0')");
  $query .= mysql_query("INSERT into tb_ex_arr(rcd_ar_id,rcd_id) values(' ','$last_id')");
  $query .= mysql_query("INSERT into tb_ex_custom(rcd_cus_id,rcd_id) values(' ','$last_id')");
  $query .= mysql_query("INSERT into tb_ex_execute(rcd_exe_id,rcd_id) values(' ','$last_id')");
  $query .= mysql_query("INSERT into tb_ex_monitor(rcd_mon_id,rcd_id) values(' ','$last_id')");

  if($query){
    header("Location: ./export_master.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST["resi"]))    
{    
  $rid                = $_POST['rid'];
  $rcd_type           = $_POST['rcd_type'];

  $date_taken         = date('Y-m-d H:i:s');

  $uploaddir = 'file/cipl/';
  $uploadfile = $uploaddir . '_' .$rid . $rcd_type . '_' . date("YmdHis") . '_' . basename($_FILES['form']['name']);

  $query = move_uploaded_file($_FILES['form']['tmp_name'], $uploadfile);
  if($query){
    if (mysql_query("UPDATE tb_master_impor SET cipl_file ='$uploadfile' WHERE rcd_id='$rid'")) {
      mysql_query("UPDATE tb_master_impor SET rcd_status = 'pre-clear' WHERE rcd_id='$rid'");
      header("Location: ./import_master.php");
    } else {
      echo "Updated Failed - Please contact your administrator".mysql_error();
    }                                                 
  } else {
    echo "Updated Failed - Please contact your administrator";
  }

}

if(isset($_POST["complete"]))    
{    

  $rcd_id           = $_POST['rcdid'];
  $user_name        = $_POST['user_name'];
  $datenow          = date('Y-m-d H:i:s');

  $query = mysql_query("UPDATE tb_master_export SET rcd_status = 'ship-arrangement' WHERE rcd_id='$rcd_id'");
  if($query){
    header("Location: ./export_master.php");                                                 
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
          <h1 class="page-header">[Airfreight] Export <i>Master</i></h1>
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
              <div class="well">
                <h4>Create New Record</h4>
                <?php include 'modals/iou_modal_rcd_create_export_air.php';?>
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>RcdID</th>
                      <th>RcdDate</th>
                      <th>RcdBy</th>
                      <th>HBL</th>
                      <th>AJU NBR</th>
                      <th>KNREF/TN</th>
                      <th>SHIPPER</th>
                      <th>CONSIGNEE</th>
                      <th>MOT</th>
                      <th>INVOICE NBR</th>
                      <th>20'</th>
                      <th>40'</th>
                      <th>PARTY</th>
                      <th>TOTAL PACKAGE LCL</th>
                      <th>TOTAL WEIGHT</th>
                      <th>TOTAL CBM</th>
                      <th>ETA</th>
                      <th>COO</th>
                      <th>CIPL</th>
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
                    $result = mysqli_query($con,"SELECT * FROM tb_master_export WHERE rcd_status = 'New' ");
                    if(mysqli_num_rows($result)>0){

                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['rcd_id'] . "</td>";
                        echo "<td>" . $row['rcd_create_date'] . "</td>";
                        echo "<td>" . $row['rcd_create_by'] . "</td>";
                        echo "<td>" . $row['rcd_hbl'] . "</td>";    
                        echo "<td>" . $row['rcd_aju'] . "</td>";
                        echo "<td>" . $row['rcd_ref'] . "</td>";
                        echo "<td>" . $row['rcd_shipper'] . "</td>";
                        echo "<td>" . $row['rcd_cnee'] . "</td>";
                        echo "<td>" . $row['rcd_mot'] . "</td>";
                        echo "<td>" . $row['rcd_inv_no'] . "</td>";
                        echo "<td>" . $row['rcd_20_type'] . "</td>";
                        echo "<td>" . $row['rcd_40_type'] . "</td>";
                        echo "<td>" . $row['rcd_party'] . "</td>";
                        echo "<td>" . $row['rcd_package'] . "</td>";
                        echo "<td>" . $row['rcd_weight'] . "</td>";
                        echo "<td>" . $row['rcd_cbm'] . "</td>";
                        echo "<td>" . $row['rcd_eta'] . "</td>";
                        echo "<td>" . $row['rcd_coo'] . "</td>";
                        if ($row['cipl_file'] == '') {
                          echo "<td>" . "File Not Found" . "</td>";
                        } else {
                          echo "<td>" . "File Uploaded" . "</td>";
                        }
                        
                        echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#confirm$row[rcd_id]' title='Completed this record'><span class='label label-primary'>Complete</span></a>
                        </td>";
                        echo "</tr>";
                        ?>
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
                                if ($row['cipl_file'] == "") {
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

                        <div class="modal fade" id="edit<?php echo $row['rcd_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[Document Management] </b> CIPL File</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" action=" "  accept-charset="utf-8" enctype="multipart/form-data">
                                  <div class="form-group">
                                    <label>Upload File</label>
                                    <input type="file" name="form" class="form-control">
                                    <input type="hidden" name="rid" class="form-control" placeholder="client name" value="<?php echo $row['rcd_id'];?>" required>
                                    <input type="hidden" name="rcd_type" class="form-control" placeholder="client name" value="<?php echo $row['rcd_type'];?>" required>
                                  </div>
                                  <button type="submit" name="resi" class="btn btn-default">Yes</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

<script type="text/javascript" src="thirdparty/chosen/chosen.jquery.js"></script>
<script src="thirdparty/input-mask/jquery.maskedinput.js"></script>
<script>
  jQuery(function($){
   $(".date2").mask("9999-99-99",{placeholder:"yyyy-mm-dd"});
   $("#date").mask("9999-99-99",{placeholder:"yyyy-mm-dd"});
   $("#phone").mask("(999) 999-9999");
   $("#tin").mask("99-9999999");
   $("#ref").mask("9999-9999-999.999");
   $("#inv").mask("aaa9999999");
   $("#shipper").chosen({width: "100%"});
   $("#cnee").chosen({width: "100%"});
 });
</script>

</body>

</html>
