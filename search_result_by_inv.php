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
          <h1 class="page-header">Search Result by Invoice No. <i>(<?php echo $_GET['inv_no'];?>)</i></h1>
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
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>RcdID</th>
                      <th>RcdDate</th>
                      <th>Mo/Year</th>
                      <th>Type</th>
                      <th>RcdBy</th>
                      <th>ShipPlan</th>
                      <th>Shipper</th>
                      <th>Cnee</th>
                      <th>PO_No.</th>                      
                      <th>Commo.</th>
                      <th>Container</th>
                      <th>StuffArea</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $inv_no = $_GET['inv_no'];                    
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
                        echo "<td>" . $row['rcd_create_month'] . "/" . $row['rcd_create_year'] . "</td>";
                        echo "<td>" . $row['rcd_type'] . "</td>";
                        echo "<td>" . $row['rcd_create_by'] . "</td>";
                        echo "<td>" . $row['rcd_ship_plan'] . "</td>";                                        
                        echo "<td>" . $row['rcd_shipper'] . "</td>";
                        echo "<td>" . $row['rcd_cnee'] . "</td>";                        
                        echo "<td>" . $row['rcd_po_no'] . "</td>";
                        echo "<td>" . $row['rcd_commo'] . "</td>";
                        echo "<td>" . $row['rcd_party'] . "</td>";
                        echo "<td>" . $row['stuffarea'] . "</td>";
                        echo "</tr>";
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

      <div class="row">
        <div class="col-lg-12">
          <div id="accordion">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Stuffing Details
                  </button>
                </h5>
              </div>

              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                 <?php 
                 $inv_no = $_GET['inv_no'];
                 mysql_connect('localhost', 'root','');
                 mysql_select_db('contta'); 
                 $getsearch = mysql_query("SELECT * FROM tb_record_master 
                  INNER JOIN tb_record_ship_arr ON tb_record_master.rcd_id = tb_record_ship_arr.rcd_id  
                  INNER JOIN tb_record_ship_cus ON tb_record_master.rcd_id = tb_record_ship_cus.rcd_id 
                  INNER JOIN tb_record_ship_exe ON tb_record_master.rcd_id = tb_record_ship_exe.rcd_id 
                  INNER JOIN tb_record_ship_mon ON tb_record_master.rcd_id = tb_record_ship_mon.rcd_id 
                  WHERE tb_record_master.rcd_inv_no = '$inv_no'");
                 $getsql = mysql_fetch_array($getsearch);
                 ?> 
                 <table class="table table-striped table-bordered table-hover">                   
                  <thead>
                    <tr>
                      <th>StuffingSchedule</th>
                      <th>TruckReady</th>
                      <th>StuffStart</th>
                      <th>StuffEnd</th>
                      <th>TruckLeave</th>
                      <th>Cont.In CY</th>
                      <th>Cont.Closed in CY</th>
                      <th>Cont.No</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $getsql['stuffingschedule'];?></td>
                      <td><?php echo $getsql['rcd_exe_truck_arrived'];?></td>
                      <td><?php echo $getsql['rcd_exe_stuff_start'];?></td>
                      <td><?php echo $getsql['rcd_exe_stuff_end'];?></td>
                      <td><?php echo $getsql['rcd_exe_con_leave'];?></td>
                      <td><?php echo $getsql['rcd_exe_con_cy'];?></td>
                      <td><?php echo $getsql['rcd_mon_cls_con'];?></td>
                      <td><?php echo $getsql['rcd_exe_con_no'];?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Freight Details
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <table class="table table-striped table-bordered table-hover">                   
                  <thead>
                    <tr>                        
                      <th>ETD</th>
                      <th>ATD</th>
                      <th>ETA</th>
                      <th>ATA</th>
                      <th>POL</th>                      
                      <th>POD</th>
                      <th>Liner</th>
                      <th>DO No.</th>
                      <th>MBL</th>
                      <th>HBL</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $getsql['rcd_mon_etd'];?></td>
                      <td><?php echo $getsql['rcd_mon_atd'];?></td>
                      <td><?php echo $getsql['rcd_mon_eta'];?></td>
                      <td><?php echo $getsql['rcd_mon_ata'];?></td>
                      <td><?php echo $getsql['rcd_mon_pol'];?></td>
                      <td><?php echo $getsql['rcd_mon_pod'];?></td>
                      <td><?php echo $getsql['rcd_exe_liner'];?></td>
                      <td><?php echo $getsql['rcd_exe_do_no'];?></td>
                      <td><?php echo $getsql['rcd_mon_mbl'];?></td>
                      <td><?php echo $getsql['rcd_mon_hbl'];?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Customs Details
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <table class="table table-striped table-bordered table-hover">                   
                  <thead>
                    <tr>                        
                      <th>PEB Date</th>
                      <th>PEB Transmit</th>
                      <th>No. Aju</th>
                      <th>NoPen</th>
                      <th>NPE Date</th>                      
                      <th>CK5 Date</th>
                      <th>SAC No.</th>
                      <th>SAC Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $getsql['rcd_cus_peb_date'];?></td>
                      <td><?php echo $getsql['rcd_cus_peb_transmit'];?></td>
                      <td><?php echo $getsql['rcd_cus_no_aju'];?></td>
                      <td><?php echo $getsql['rcd_cus_peb_nopen'];?></td>
                      <td><?php echo $getsql['rcd_cus_npe_date'];?></td>
                      <td><?php echo $getsql['rcd_ar_ck2_app'];?></td>
                      <td><?php echo $getsql['rcd_ar_sac_no'];?></td>
                      <td><?php echo $getsql['rcd_ar_sac'];?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingFour">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  E-File
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <table class="table table-striped table-bordered table-hover">                   
                  <thead>
                    <tr>                        
                      <th>PEB</th>
                      <th>NPE</th>
                      <th>SPPB</th>
                      <th>CK5</th>
                      <th>SIPL</th>                      
                      <th>COO</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php 
                      if ($getsql['peb_file'] == "") {
                        echo "<td>" . "file not found" . "</td>";
                      } else {
                        echo "<td>" . "<a href='$getsql[peb_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>"; 
                      } 
                      ?>

                      <?php 
                      if ($getsql['npe_file'] == "") {
                        echo "<td>" . "file not found" . "</td>";
                      } else {
                        echo "<td>" . "<a href='$getsql[npe_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>"; 
                      } 
                      ?>

                      <?php 
                      if ($getsql['sppb_file'] == "") {
                        echo "<td>" . "file not found" . "</td>";
                      } else {
                        echo "<td>" . "<a href='$getsql[sppb_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>"; 
                      } 
                      ?>
                      <?php 
                      if ($getsql['rcd_arr_ck5_file'] == "") {
                        echo "<td>" . "file not found" . "</td>";
                      } else {
                        echo "<td>" . "<a href='$getsql[rcd_arr_ck5_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>"; 
                      } 
                      ?>
                      <?php 
                      if ($getsql['sipl_file'] == "") {
                        echo "<td>" . "file not found" . "</td>";
                      } else {
                        echo "<td>" . "<a href='$getsql[sipl_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>"; 
                      } 
                      ?>
                      <?php 
                      if ($getsql['coo_file'] == "") {
                        echo "<td>" . "file not found" . "</td>";
                      } else {
                        echo "<td>" . "<a href='$getsql[coo_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>"; 
                      } 
                      ?>                       
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<?php include 'include/jquery.php';?>

</body>

</html>
