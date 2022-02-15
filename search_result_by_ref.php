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
  $monthnow             = date('m');
  $yearnow              = date('Y');


  $query = mysql_query("INSERT into tb_record_master values(' ','$datenow','$monthnow','$yearnow','$user_name','$rcd_type','$ship_plan','$shipper','$cnee','$inv_no','$commo','$c20','$c40','$party','$po_no','')");
  $last_id = mysql_insert_id();
  $query .= mysql_query("INSERT into tb_record_miles values(' ','$last_id','0','0','0','0','0','0','0','0')");
  $query .= mysql_query("INSERT into tb_record_ship_arr(rcd_ar_id,rcd_id) values(' ','$last_id')");
  $query .= mysql_query("INSERT into tb_record_ship_cus(rcd_cus_id,rcd_id) values(' ','$last_id')");
  $query .= mysql_query("INSERT into tb_record_ship_exe(rcd_exe_id,rcd_id) values(' ','$last_id')");
  $query .= mysql_query("INSERT into tb_record_ship_exe(rcd_mon_id,rcd_id) values(' ','$last_id')");
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

  $uploaddir = 'file/sipl/';
  $uploadfile = $uploaddir . '_' .$rid . $rcd_type . '_' . date("YmdHis") . '_' . basename($_FILES['form']['name']);

  $query = move_uploaded_file($_FILES['form']['tmp_name'], $uploadfile);
  if($query){
    if (mysql_query("UPDATE tb_record_master SET sipl_file ='$uploadfile' WHERE rcd_id='$rid'")) {
      mysql_query("UPDATE tb_record_miles SET miles_arr = 1 WHERE rcd_id='$rid'");
      header("Location: ./export_master.php?");
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
<body>

  <div id="wrapper">
    <?php include 'include/header.php';?>

    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Search Result by KNREF/TN NO. <i>(<?php echo $_GET['ref'];?>)</i></h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="table-responsive">
                <?php 
                $type     = $_GET['type'];
                if ($type == "Export") {            
                  ?>
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                      <tr>
                        <th>RcdID</th>
                        <th>RcdDate</th>
                        <th>RcdBy</th>
                        <th>ShipPlan</th>
                        <th>Shipper</th>
                        <th>Cnee</th>
                        <th>PO_No.</th>
                        <th>SIPL</th>
                        <th>Ship. Arrangement</th>
                        <th>Ship. Custom</th>
                        <th>Ship. Execution</th>
                        <th>Ship. Monitoring</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $ref    = $_GET['ref'];
                      $con=mysqli_connect("localhost","root","","contta");
                                    // Check connection
                      if (mysqli_connect_errno())
                      {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      }

                      $result = mysqli_query($con,"SELECT * FROM tb_record_master INNER JOIN 
                        tb_record_ship_arr ON tb_record_master.rcd_id=tb_record_ship_arr.rcd_id  
                        INNER JOIN
                        tb_record_ship_cus ON tb_record_master.rcd_id=tb_record_ship_cus.rcd_id
                        INNER JOIN
                        tb_record_ship_exe ON tb_record_master.rcd_id=tb_record_ship_exe.rcd_id
                        INNER JOIN
                        tb_record_ship_mon ON tb_record_master.rcd_id=tb_record_ship_mon.rcd_id
                        INNER JOIN 
                        tb_record_miles ON tb_record_master.rcd_id=tb_record_miles.rcd_id
                        WHERE tb_record_master.rcd_inv_no='$inv_no'");

                      if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result))
                        {
                          echo "<tr>";
                          echo "<td>" . $row['rcd_id'] . "</td>";
                          echo "<td>" . $row['rcd_create_date'] . "</td>";
                          echo "<td>" . $row['rcd_create_by'] . "</td>";
                          echo "<td>" . $row['rcd_ship_plan'] . "</td>";                                        
                          echo "<td>" . $row['rcd_shipper'] . "</td>";
                          echo "<td>" . $row['rcd_cnee'] . "</td>";                        
                          echo "<td>" . $row['rcd_po_no'] . "</td>";
                          echo "<td align= ''>
                          <a href='$row[sipl_file]' target='_BLANK' ><span class='label label-primary'>SIPL</span></a>
                          </td>";
                          echo "<td align= ''>
                          <a href='#' data-toggle='modal' data-target='#arr$row[rcd_id]' ><span class='label label-primary'>$row[miles_arr]</span></a>
                          </td>";
                          echo "<td align= ''>
                          <a href='#' data-toggle='modal' data-target='#custom$row[rcd_id]' ><span class='label label-primary'>$row[miles_custom]</span></a>
                          </td>";
                          echo "<td align= ''>
                          <a href='#' data-toggle='modal' data-target='#exe$row[rcd_id]' ><span class='label label-primary'>$row[miles_execution]</span></a>
                          </td>";
                          echo "<td align= ''>
                          <a href='#' data-toggle='modal' data-target='#mon$row[rcd_id]' ><span class='label label-primary'>$row[miles_monitor]</span></a>
                          </td>";
                          echo "</tr>";

                          include 'include/result_by_ref_ship_arr.php';
                          include 'include/result_by_ref_ship_custom.php';
                          include 'include/result_by_ref_ship_exe.php';
                          include 'include/result_by_ref_ship_mon.php';                   
                        }
                      }
                      mysqli_close($con);
                      ?>
                    </tbody>
                  </table>
                <?php } else {
                  ?>
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                      <tr>
                        <th>RcdID</th>
                        <th>RcdDate</th>
                        <th>RcdBy</th>
                        <th>HBL</th>
                        <th>AJU</th>
                        <th>REF</th>
                        <th>SHIPPER.</th>
                        <th>CNEE</th>
                        <th>INV.NO</th>
                        <th>MOT</th>
                        <th>COO</th>                     
                        <th>ETA</th>
                        <th>ATA</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $ref    = $_GET['ref'];
                      $con=mysqli_connect("localhost","root","","contta");
                                    // Check connection
                      if (mysqli_connect_errno())
                      {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      }
                      $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN 
                        tb_imp_pre ON tb_master_impor.rcd_id=tb_imp_pre.rcd_id  
                        INNER JOIN
                        tb_imp_clear ON tb_master_impor.rcd_id=tb_imp_clear.rcd_id
                        INNER JOIN
                        tb_imp_post ON tb_master_impor.rcd_id=tb_imp_post.rcd_id
                        INNER JOIN                        
                        tb_record_miles_import ON tb_master_impor.rcd_id=tb_record_miles_import.rcd_id
                        WHERE tb_master_impor.rcd_ref='$ref'");

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
                          echo "<td>" . $row['rcd_inv_no'] . "</td>";
                          echo "<td>" . $row['rcd_mot'] . "</td>";
                          echo "<td>" . $row['rcd_coo'] . "</td>";
                          echo "<td>" . $row['rcd_eta'] . "</td>";
                          echo "<td>" . $row['rcd_ata'] . "</td>";
                          echo "</tr>";                                                        
                        }
                      }
                      mysqli_close($con);
                      ?>
                    </tbody>
                  </table>

                <?php 
                include 'include/result_by_ref_import.php';
                } ?>
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
