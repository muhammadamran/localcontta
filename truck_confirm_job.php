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


if(isset($_POST["confirm"]))    
{    

$rcd_id         = $_POST['rcd_id'];
$user_name      = $_POST['user_name'];
$datenow        = date('Y-m-d');
$truck_job_id   = $_POST['truck_job_id'];
$c20             = $_POST['c20'];
$c40             = $_POST['c40'];

  $query = mysql_query("UPDATE tb_truck_assign SET order_rcvd_by='$user_name', order_rcvd_date='$datenow' where rcd_id='$rcd_id' ");

  /* START -  GET DATA FROM MASTER RECORD */

  mysql_connect('localhost','root','');
  mysql_select_db('contta'); 
  $get_master = mysql_query("SELECT * FROM tb_record_master WHERE rcd_id = '$rcd_id' ");
  $getmas = mysql_fetch_array($get_master);

  /* END - GET DATA FROM MASTER RECORD */

  if ($query) {
    $x = 1;
    $c20 = $c20;
    while($x <= $c20) {
      mysql_query("INSERT into tb_truck_job_details(cont_type,truck_job_id,rcd_id) values('20','$truck_job_id','$rcd_id')");
      $x++;
    } 
    if ($c40 != 0) {
      $z = 1;
      $c40 = $c40;
      while($z <= $c40) {
      mysql_query("INSERT into tb_truck_job_details(cont_type,truck_job_id,rcd_id) values('40','$truck_job_id','$rcd_id')");
      $z++;
      } 
      header("Location: ./truck_confirm_job.php?notif=no40"); 
    } else {
      header("Location: ./truck_confirm_job.php?notif=no40"); 
    }
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
          <h1 class="page-header">Trucker - Confirm Job</h1>
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
                      <th>RCDID</th>
                      <th>TRUCKJOBID</th>
                      <th>ASSIGNDATE</th>
                      <th>ASSIGNBY</th>
                      <th>VENDOR</th>
                      <th>ADDRESS/DEST.</th>  
                      <th>HBL</th>         
                      <th>AJU</th>
                      <th>MOT</th>
                      <th>PARTY</th>
                      <th>CBM</th>
                      <th>PACKAGE</th>
                      <th>WEIGHT</th>
                      <th>Action</th>                 
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    /*$user_login = $_SESSION['username'];

                    mysql_connect('localhost','root','');
                    mysql_select_db('contta'); 
                    $role = mysql_query("SELECT * FROM tb_user WHERE user_name = '$user_login' ");
                    $inv = mysql_fetch_array($role);*/

                    $con=mysqli_connect("localhost","root","","contta");
                    $result = mysqli_query($con,"SELECT * FROM tb_truck_assign WHERE order_rcvd_by = '' AND assign_by != '' ");
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";

                        /*if ($row['mot'] == 'FCL' OR $row['mot'] == 'LCL') {
                          $data_sea = mysqli_query($con,"SELECT * FROM tb_master_impor WHERE rcd_id = '$row[rcd_id]' ");
                          $get1 = mysqli_fetch_array($data_sea);
                        } else {
                          $data_air = mysqli_query($con,"SELECT * FROM tb_master_export WHERE rcd_id = '$row[rcd_id]' ");
                          $get1 = mysqli_fetch_array($data_air);
                        }*/

                        echo "<td>" . $row['rcd_id'] . "</td>";
                        echo "<td>" . $row['truck_job_id'] . "</td>";                    
                        echo "<td>" . $row['assign_date'] . "</td>";
                        echo "<td>" . $row['assign_by'] . "</td>";               
                        echo "<td>" . $row['assign_vendor'] . "</td>";
                        echo "<td>" . $row['assign_remark'] . "</td>"; 

                        $role = mysql_query("SELECT * FROM tb_master_impor WHERE rcd_id = '$row[rcd_id]' ");
                        $inv = mysql_fetch_array($role);

                        echo "<td>" . $inv['rcd_hbl'] . "</td>"; 
                        echo "<td>" . $inv['rcd_aju'] . "</td>"; 
                        echo "<td>" . $inv['rcd_mot'] . "</td>"; 
                        echo "<td>" . $inv['rcd_party'] . "</td>"; 
                        echo "<td>" . $inv['rcd_cbm'] . "</td>"; 
                        echo "<td>" . $inv['rcd_package'] . "</td>"; 
                        echo "<td>" . $inv['rcd_weight'] . "</td>"; 
                        echo "<td align= ''>
                          <a href='#' data-toggle='modal' data-target='#confirm$row[rcd_id]' title='Confirm Record'><span class='label label-primary'>Confirm</span></a>
                          <a href='#' data-toggle='modal' data-target='#reject$row[rcd_id]' title='Reject Record'><span class='label label-danger'>Reject</span></a>
                          <a href='#' data-toggle='modal' data-target='#update$row[rcd_id]' title='Confirm Record'><span class='label label-primary'>Update</span></a>
                          </td>";

                        echo "</tr>";
                        ?>

                        <div class="modal fade" id="confirm<?php echo $row['rcd_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[RecordManage] </b> Confirm Job</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" action=" ">
                                  <div class="form-group">
                                    <label>Are you sure to confirm this record?</label>                                    
                                    <input type="hidden" name="truck_job_id" class="form-control" value="<?php echo $row['truck_job_id'];?>">
                                    <input type="hidden" name="rcd_id" class="form-control" value="<?php echo $row['rcd_id'];?>">
                                    <input type="hidden" name="user_name" class="form-control" value="<?php echo $_SESSION['username'];?>">
                                  </div>
                                  <div class="form-group">
                                    <label>Required Container :</label> 
                                  </div>
                                  <div class="form-group">
                                    <label>20' :</label>                                    
                                    <input type="text" readonly name="c20" class="form-control" value="<?php echo $inv['rcd_20_type'];?>">
                                    <label>40' :</label>                                    
                                    <input type="text" readonly name="c40" class="form-control" value="<?php echo $inv['rcd_40_type'];?>">
                                  </div>
                                  <button type="submit" name="confirm" value="confirm" class="btn btn-default">Yes</button>
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
