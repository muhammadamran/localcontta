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
          <h1 class="page-header">Performance - <i>Trucking Level</i></h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <p>Input the parameter to run the query</p>
              <div class="row">            
                <form action="" method="get">
                  <div class="form-group col-md-4">
                    <select name="month" class="form-control">
                      <option value="">--- SELECT ---</option>
                      <option value="01">January</option>
                      <option value="02">February</option>
                      <option value="03">March</option>
                      <option value="04">April</option>
                      <option value="05">May</option>
                      <option value="06">June</option>
                      <option value="07">July</option>
                      <option value="08">August</option>
                      <option value="09">Septemeber</option>
                      <option value="10">October</option>
                      <option value="11">November</option>
                      <option value="12">December</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <select name="year" class="form-control"> 
                      <option value="">--- SELECT ---</option>
                      <option value="2018">2018</option>
                      <option value="2018">2019</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <button type="submit" name="search" value="search" class="btn btn-primary">Search!</button>
                  </div>
                </form>
              </div>
            </div>

            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>RcdID</th>
                      <th>RcdDate</th>
                      <th>ShipPlan</th>
                      <th>Shipper</th>
                      <th>Cnee</th>
                      <th>InvNo</th>
                      <th>PO_No.</th>
                      <th style='background-color: #FFFF99'>Stuffing Schedule</th>
                      <th style='background-color: #FFFF99'>StuffingStart</th>
                     <!--  <th style='background-color: #FFFF99'>Diff (Days)</th>
                      <th style='background-color: #FFFF99'>Diff (Hours)</th> -->
                      <th style='background-color: #FFFF99'>Status</th>
                      <th>LateReason</th>
                      <th>LateRemark</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $monthnow = $_GET['month'];
                    $yearnow = $_GET['year'];
                    $con=mysqli_connect("localhost","root","","contta");
                                    // Check connection
                    if (mysqli_connect_errno())
                    {
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    $result = mysqli_query($con,"SELECT * FROM tb_record_master INNER JOIN tb_record_ship_exe ON tb_record_master.rcd_id=tb_record_ship_exe.rcd_id  WHERE tb_record_master.rcd_create_month='$monthnow' AND tb_record_master.rcd_create_year='$yearnow'");
                    if(mysqli_num_rows($result)>0){

                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['rcd_id'] . "</td>";
                        echo "<td>" . $row['rcd_create_date'] . "</td>";
                        echo "<td>" . $row['rcd_ship_plan'] . "</td>";                                        
                        echo "<td>" . $row['rcd_shipper'] . "</td>";
                        echo "<td>" . $row['rcd_cnee'] . "</td>";
                        echo "<td>" . $row['rcd_inv_no'] . "</td>";
                        echo "<td>" . $row['rcd_po_no'] . "</td>";                    
                        echo "<td style='background-color: #FFFF99'>" . $row['stuffingschedule'] . "</td>";
                        echo "<td style='background-color: #FFFF99'>" . $row['rcd_exe_stuff_start'] . "</td>";

                        /*$datetime1 = new DateTime($row['stuffingschedule']);
                        $datetime2 = new DateTime($row['rcd_exe_stuff_start']);
                        $diff = $datetime1->diff($datetime2);

                        if ($row['rcd_exe_stuff_start'] == '0000-00-00 00:00:00') {
                          echo "<td style='background-color: #FFFF99'>" . "N/A" . "</td>";
                          echo "<td style='background-color: #FFFF99'>" . "N/A" . "</td>";
                        } else {
                          echo "<td style='background-color: #FFFF99'>" . $diff->d . "</td>";
                          echo "<td style='background-color: #FFFF99'>" . $diff->h . "</td>";
                        }*/

                        $showstamp1 = strtotime($row['stuffingschedule']);
                        $showstamp2 = strtotime($row['rcd_exe_stuff_start']);
                        $stampdiff = $showstamp2 - $showstamp1;

                        /* 
                          TIMESTAMP NOTE
                          1 H = 3600 
                        */

                          if ($row['rcd_exe_stuff_start'] == '0000-00-00 00:00:00') {
                            echo "<td style='background-color: #FFFF99'>" . "Still on Progress" . "</td>";
                          } else {
                            if ($stampdiff > 0) {
                              echo "<td style='background-color: red'>" . "LATE" . "</td>";
                            } else {
                              echo "<td style='background-color: #FFFF99'>" . "ONTIME" . "</td>";
                            }
                          }                        
                          echo "<td style='background-color: #FFFF99'>" . $row['stufflate'] . "</td>";  
                          echo "<td style='background-color: #FFFF99'>" . $row['stuff_remark'] . "</td>"; 
                          echo "</tr>";
                          ?>

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
