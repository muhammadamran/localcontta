<?php

include "include/connection.php";
include "include/restrict.php";

if(isset($_POST["update"]))    
{    

$rcd_id = $_POST['rcd_id'];

$rcd_mon_cls_con  = $_POST['rcd_mon_cls_con'];
$rcd_mon_atd  = $_POST['rcd_mon_atd'];
$rcd_mon_etd  = $_POST['rcd_mon_etd'];
$rcd_mon_ata  = $_POST['rcd_mon_ata'];
$rcd_mon_eta  = $_POST['rcd_mon_eta'];
$rcd_mon_pol  = $_POST['rcd_mon_pol'];
$rcd_mon_pod  = $_POST['rcd_mon_pod'];
$rcd_mon_mbl  = $_POST['rcd_mon_mbl'];
$rcd_mon_hbl  = $_POST['rcd_mon_hbl'];
$rcd_mon_docs_return  = $_POST['rcd_mon_docs_return'];
$rcd_mon_rcvd_by  = $_POST['rcd_mon_rcvd_by'];
$rcd_mon_delay  = $_POST['rcd_mon_delay'];
$rcd_mon_remark = $_POST['rcd_mon_remark'];
$rcd_mon_docs_cnee_1  = $_POST['rcd_mon_docs_cnee_1'];
$rcd_mon_docs_cnee_2  = $_POST['rcd_mon_docs_cnee_2']; 

$rcd_mon_cls_con_now = $_POST['rcd_mon_cls_con_now'];
$rcd_mon_atd_now = $_POST['rcd_mon_atd_now'];
$rcd_mon_etd_now = $_POST['rcd_mon_etd_now'];
$rcd_mon_docs_return_now = $_POST['rcd_mon_docs_return_now'];
$rcd_mon_docs_cnee_1_now = $_POST['rcd_mon_docs_cnee_1_now'];
$rcd_mon_docs_cnee_2_now = $_POST['rcd_mon_docs_cnee_2_now'];

if ($rcd_mon_cls_con == '') {
  $rcd_mon_cls_con_sql = $rcd_mon_cls_con_now;
} else {
  $rcd_mon_cls_con_sql = $rcd_mon_cls_con;
}

if ($rcd_mon_atd == '') {
  $rcd_mon_atd_sql = $rcd_mon_atd_now;
} else {
  $rcd_mon_atd_sql = $rcd_mon_atd;
}

if ($rcd_mon_etd == '') {
  $rcd_mon_etd_sql = $rcd_mon_etd_now;
} else {
  $rcd_mon_etd_sql = $rcd_mon_etd;
}

if ($rcd_mon_eta == '') {
  $rcd_mon_eta_sql = $rcd_mon_eta_now;
} else {
  $rcd_mon_eta_sql = $rcd_mon_eta;
}

if ($rcd_mon_ata == '') {
  $rcd_mon_ata_sql = $rcd_mon_ata_now;
} else {
  $rcd_mon_ata_sql = $rcd_mon_ata;
}

if ($rcd_mon_docs_return == '') {
  $rcd_mon_docs_return_sql = $rcd_mon_docs_return_now;
} else {
  $rcd_mon_docs_return_sql = $rcd_mon_docs_return;
}

if ($rcd_mon_docs_cnee_1 == '') {
  $rcd_mon_docs_cnee_1_sql = $rcd_mon_docs_cnee_1_now;
} else {
  $rcd_mon_docs_cnee_1_sql = $rcd_mon_docs_cnee_1;
}

if ($rcd_mon_docs_cnee_2 == '') {
  $rcd_mon_docs_cnee_2_sql = $rcd_mon_docs_cnee_2_now;
} else {
  $rcd_mon_docs_cnee_2_sql = $rcd_mon_docs_cnee_2;
}

  $query = mysql_query("UPDATE tb_ex_monitor SET rcd_mon_cls_con='$rcd_mon_cls_con_sql',rcd_mon_atd='$rcd_mon_atd_sql',rcd_mon_etd='$rcd_mon_etd_sql',rcd_mon_eta='$rcd_mon_eta_sql',rcd_mon_ata='$rcd_mon_ata_sql',rcd_mon_pod='$rcd_mon_pod',rcd_mon_pol='$rcd_mon_pol',rcd_mon_mbl='$rcd_mon_mbl',rcd_mon_hbl='$rcd_mon_hbl',rcd_mon_docs_return='$rcd_mon_docs_return_sql',rcd_mon_rcvd_by='$rcd_mon_rcvd_by',rcd_mon_delay='$rcd_mon_delay',rcd_mon_remark='$rcd_mon_remark',rcd_mon_docs_cnee_1='$rcd_mon_docs_cnee_1_sql',rcd_mon_docs_cnee_2='$rcd_mon_docs_cnee_2_sql' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./ship_mon.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["complete"]))    
{    

  $rcd_id           = $_POST['rcdid'];
  $user_name        = $_POST['user_name'];
  $datenow          = date('Y-m-d H:i:s');

  $query = mysql_query("UPDATE tb_record_miles_export SET miles_monitor ='$datenow',action_by_4='$user_name' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./ship_mon.php");                                                  
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
          <h1 class="page-header">Shipment Monitoring</h1>
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
                      <th>TN/REF</th>
                      <th>Closing Date Container</th>
                      <th>ETD</th>
                      <th>ATD</th>
                      <th>ETA</th>
                      <th>ATA</th>
                      <th>POL</th>
                      <th>POD</th>
                      <th>M-BL</th>
                      <th>H-BL</th>
                      <th>DOCS RETURN TO KN</th>
                      <th>RCVDBY</th>
                      <th>Delay (days)</th>
                      <th>Remarks (IF ANY DELAY)</th>
                      <th>DOC SEND TO CNEE</th>
                      <th>DOC RCVD BY CNEE</th>
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
                    $result = mysqli_query($con,"SELECT * FROM tb_record_miles_export INNER JOIN tb_ex_monitor ON tb_record_miles_export.rcd_id=tb_ex_monitor.rcd_id WHERE tb_record_miles_export.miles_monitor = 0 AND tb_record_miles_export.miles_execution != 0 ");
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        $grep_date = mysqli_query($con,"SELECT * FROM tb_master_export WHERE rcd_id = '$row[rcd_id]' ");
                          $grep = mysqli_fetch_array($grep_date);
                          echo "<td>" . $grep['rcd_inv_no'] . "</td>";
                        echo "<td>" . $row['rcd_mon_cls_con'] . "</td>";
                        echo "<td>" . $row['rcd_mon_etd'] . "</td>";
                        echo "<td>" . $row['rcd_mon_atd'] . "</td>";
                        echo "<td>" . $row['rcd_mon_eta'] . "</td>";
                        echo "<td>" . $row['rcd_mon_ata'] . "</td>";
                        echo "<td>" . $row['rcd_mon_pol'] . "</td>";
                        echo "<td>" . $row['rcd_mon_pod'] . "</td>";
                        echo "<td>" . $row['rcd_mon_mbl'] . "</td>";                        
                        echo "<td>" . $row['rcd_mon_hbl'] . "</td>";
                        echo "<td>" . $row['rcd_mon_docs_return'] . "</td>";
                        echo "<td>" . $row['rcd_mon_rcvd_by'] . "</td>";
                        echo "<td>" . $row['rcd_mon_delay'] . "</td>";
                        echo "<td>" . $row['rcd_mon_remark'] . "</td>";
                        echo "<td>" . $row['rcd_mon_docs_cnee_1'] . "</td>";
                        echo "<td>" . $row['rcd_mon_docs_cnee_2'] . "</td>";                        
                        echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#edit$row[rcd_id]' title='Edit this record'><span class='label label-primary'>Update</span></a>
                        <a href='#' data-toggle='modal' data-target='#confirm$row[rcd_id]' title='Completed this record'><span class='label label-primary'>Complete</span></a>
                      </td>";
                      echo "</tr>";
                      ?>

                      <div class="modal fade" id="edit<?php echo $row['rcd_id'];?>" role="dialog">
                        <div class="modal-dialogs">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[RecordMaster] </b> Update Shipment Monitoring</h4>
                            </div>
                            <div class="modal-body">
                              <form method="post" action=" ">
                                <div class="col-md-12">
                                  <div class="col-md-12">
                                  <div class="col-md-6">
                                  <!-- item -->
                                    <div class="form-group col-md-6">
                                      <label>Closing Cont. Date</label>
                                      <input type="text" name="rcd_mon_cls_con_now" value="<?php echo $row['rcd_mon_cls_con'];?>"  class="form-control" readonly>
                                      <input type="hidden" name="rcd_id" value="<?php echo $row['rcd_id'];?>"  class="form-control" >
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>Input Here!</label>
                                      <input type="datetime-local" name="rcd_mon_cls_con" class="form-control">
                                    </div>
                                    <!-- end item -->
                                    <!-- item -->
                                    <div class="form-group col-md-6">
                                      <label>ATD</label>
                                      <input type="text" name="rcd_mon_atd_now" value="<?php echo $row['rcd_mon_atd'];?>"  class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>Input Here!</label>
                                      <input type="datetime-local" name="rcd_mon_atd" class="form-control">
                                    </div>
                                    <!-- end item -->
                                    <!-- item -->
                                    <div class="form-group col-md-6">
                                      <label>ETD</label>
                                      <input type="text" name="rcd_mon_etd_now" value="<?php echo $row['rcd_mon_etd'];?>"  class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>Input Here!</label>
                                      <input type="datetime-local" name="rcd_mon_etd" class="form-control">
                                    </div>
                                    <!-- end item -->
                                    <!-- item -->
                                    <div class="form-group col-md-6">
                                      <label>ATA</label>
                                      <input type="text" name="rcd_mon_ata_now" value="<?php echo $row['rcd_mon_ata'];?>"  class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>Input Here!</label>
                                      <input type="datetime-local" name="rcd_mon_ata" class="form-control">
                                    </div>
                                    <!-- end item -->
                                    <!-- item -->
                                    <div class="form-group col-md-6">
                                      <label>ETA</label>
                                      <input type="text" name="rcd_mon_eta_now" value="<?php echo $row['rcd_mon_eta'];?>"  class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>Input Here!</label>
                                      <input type="datetime-local" name="rcd_mon_eta" class="form-control">
                                    </div>
                                    <!-- end item -->
                                    <div class="form-group">
                                      <label>POL</label>
                                      <input type="text" name="rcd_mon_pol" value="<?php echo $row['rcd_mon_pol'];?>"  class="form-control" >
                                    </div>
                                    <div class="form-group">
                                      <label>POD</label>
                                      <input type="text" name="rcd_mon_pod" value="<?php echo $row['rcd_mon_pod'];?>"  class="form-control" >
                                    </div>
                                    <div class="form-group">
                                      <label>MBL</label>
                                      <input type="text" name="rcd_mon_mbl" value="<?php echo $row['rcd_mon_mbl'];?>"  class="form-control" >
                                    </div>
                                    <div class="form-group">
                                      <label>hBL</label>
                                      <input type="text" name="rcd_mon_hbl" value="<?php echo $row['rcd_mon_hbl'];?>"  class="form-control" >
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <!-- item -->
                                    <div class="form-group col-md-6">
                                      <label>Docs Returned</label>
                                      <input type="text" name="rcd_mon_docs_return_now" value="<?php echo $row['rcd_mon_docs_return'];?>"  class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>Input Here!</label>
                                      <input type="datetime-local" name="rcd_mon_docs_return" class="form-control">
                                    </div>
                                    <!-- end item -->
                                    <div class="form-group">
                                      <label>Rcvd By</label>
                                      <input type="text" name="rcd_mon_rcvd_by" value="<?php echo $row['rcd_mon_rcvd_by'];?>"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label>Delay (days)</label>
                                      <input type="text" name="rcd_mon_delay" value="<?php echo $row['rcd_mon_delay'];?>"  class="form-control" >
                                    </div>
                                    <div class="form-group">
                                      <label>Remarks</label>
                                      <input type="text" name="rcd_mon_remark"  value="<?php echo $row['rcd_mon_remark'];?>" class="form-control" >        
                                    </div>
                                    <!-- item -->
                                    <div class="form-group col-md-6">
                                      <label>Send Docs to CNEE</label>
                                      <input type="text" name="rcd_mon_docs_cnee_1_now" value="<?php echo $row['rcd_mon_docs_cnee_1'];?>"  class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>Input Here!</label>
                                      <input type="datetime-local" name="rcd_mon_docs_cnee_1" class="form-control">
                                    </div>
                                    <!-- end item -->
                                    <div class="form-group col-md-6">
                                      <label>CNEE Rcvd</label>
                                      <input type="text" name="rcd_mon_docs_cnee_2_now" value="<?php echo $row['rcd_mon_docs_cnee_2'];?>"  class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label>Input Here!</label>
                                      <input type="datetime-local" name="rcd_mon_docs_cnee_2" class="form-control">
                                    </div>
                                    <!-- end item -->
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
