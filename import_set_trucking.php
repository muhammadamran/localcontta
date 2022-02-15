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

if(isset($_POST["settruck"]))    
{    

$vendor         = $_POST['vendor'];
$addressto      = $_POST['addressto'];
$rcd_id         = $_POST['rcd_id'];
$track_id       = $_POST['track_id'];
$user_name      = $_POST['user_name'];
$mot            = $_POST['mot'];
$datenow        = date('Y-m-d');


  $query = mysql_query("UPDATE tb_truck_assign SET assign_by='$user_name',assign_date='$datenow',assign_vendor='$vendor',assign_remark='$addressto', mot = '$mot' where truck_job_id = '$track_id' AND rcd_id='$rcd_id'");
  if($query){
    header("Location: ./import_set_trucking.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST["complete"]))    
{    

  $rcd_id           = $_POST['rcdid'];
  $user_name        = $_POST['user_name'];
  $datenow          = date('Y-m-d H:i:s');

  $query = mysql_query("UPDATE tb_record_miles_import SET clear ='$datenow',action_by_2='$user_name' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_clear.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["coo"]))    
{    
  $rid                = $_POST['rid'];  

  $date_taken         = date('Y-m-d H:i:s');

  $uploaddir = 'file/coo/';
  $uploadfile = $uploaddir . '_' .$rid . '_' . date("YmdHis") . '_' . basename($_FILES['form']['name']);

  $query = move_uploaded_file($_FILES['form']['tmp_name'], $uploadfile);
  if($query){
    if (mysql_query("UPDATE tb_imp_clear SET coo ='$uploadfile' WHERE rcd_id='$rid'")) {            
      header("Location: ./imp_clear.php");
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
<body onload="display_ct()">

  <div id="wrapper">
    <?php include 'include/header.php';?>

    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">[Air+Sea] Set Trucker</h1>
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
                    $result = mysqli_query($con,"SELECT * FROM tb_imp_clear INNER JOIN tb_truck_assign ON tb_imp_clear.rcd_id=tb_truck_assign.rcd_id WHERE tb_imp_clear.cle_billing != '0000-00-00' AND tb_truck_assign.assign_vendor =''");
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";

                        $get_data = mysql_query("SELECT * FROM tb_master_impor WHERE rcd_id = '$row[rcd_id]'");
                        $row2 = mysql_fetch_array($get_data);
                        echo "<td>" . $row2['rcd_id'] . "</td>"; 
                        echo "<td>" . $row2['rcd_hbl'] . "</td>";    
                        echo "<td>" . $row2['rcd_aju'] . "</td>";
                        echo "<td>" . $row2['rcd_ref'] . "</td>";
                        echo "<td>" . $row2['rcd_shipper'] . "</td>";
                        echo "<td>" . $row2['rcd_cnee'] . "</td>";
                        echo "<td>" . $row2['rcd_mot'] . "</td>";
                        echo "<td>" . $row2['rcd_inv_no'] . "</td>";
                        echo "<td>" . $row2['rcd_20_type'] . "</td>";
                        echo "<td>" . $row2['rcd_40_type'] . "</td>";
                        echo "<td>" . $row2['rcd_party'] . "</td>";
                        echo "<td>" . $row2['rcd_package'] . "</td>";
                        echo "<td>" . $row2['rcd_weight'] . "</td>";
                        echo "<td>" . $row2['rcd_cbm'] . "</td>";
                        echo "<td>" . $row2['rcd_eta'] . "</td>";
                        echo "<td>" . $row2['rcd_coo'] . "</td>";    

                        echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#edit$row[rcd_id]' title='Edit this record'><span class='label label-primary'>Set Trucker</span></a>
                        </td>";
                        echo "</tr>";
                        ?>
                        <div class="modal fade" id="edit<?php echo $row['rcd_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[RecordMaster] </b> Set Trucker</h4>
                              </div>                                                        
                              <div class="modal-body">
                                <form method="post" action=" ">
                                  <div class="col-md-12">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Address Destination</label>
                                        <input type="text" name="addressto" class="form-control" value="<?php echo $row['assign_remark'];?>" required>
                                        <input type="hidden" name="track_id" class="form-control" value="<?php echo $row['truck_job_id'];?>" required>
                                        <input type="hidden" name="rcd_id" class="form-control" value="<?php echo $row['rcd_id'];?>" required>
                                        <input type="hidden" name="mot" class="form-control" value="<?php echo $row2['rcd_mot'];?>" required>
                                        <input type="hidden" name="user_name" class="form-control" value="<?php echo $_SESSION['username'];?>" required>
                                      </div>                                    
                                      <div class="form-group">
                                        <label>Trucker/Vendor</label>                                      
                                        <select class="form-control" name="vendor" id="vendor">
                                          <option value=" ">--- SELECT ---</option>
                                          <?php
                                          $result1=mysql_query("SELECT * FROM tb_trucker");
                                          while($data=mysql_fetch_array($result1)) {
                                            echo "<option value='$data[trucker_name]'> $data[trucker_name] </option>";
                                          }
                                          ?>
                                        </select>
                                      </div> 
                                    </div>                        
                                  </div>    
                                  <div class="modal-footer">
                                    <button type="submit" name="settruck" value="settruck" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                  </div>                                                                        
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
