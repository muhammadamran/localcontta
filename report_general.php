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
          <h1 class="page-header">General Summary</h1>
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
                      <option value="2019">2019</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <button type="submit" name="search" value="search" class="btn btn-primary">Search!</button>
                  </div>
                </form>
              </div>
            </div>

            <!-- VALIDATION START TO SHOW DATA -->
            <?php 
            if ($_GET['month'] == 0 AND $_GET['year'] == 0) {
              echo "<br>";
              echo "No Data Available! Please input Month and Year parameter to execute the query process.";
              echo "<hr>";
            } else {
              $monthnow = $_GET['month'];
              $yearnow = $_GET['year'];
              ?>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="alert alert-info">
                  (Data) - Month : <?php echo $_GET['month'];?> | Year : <?php echo $_GET['year'];?>
                </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        Container Details (By Amount)
                      </div>
                      <div class="panel-body">
                        <div class="col-lg-12">
                          <?php
                                mysql_connect('localhost', 'root','');
                                mysql_select_db('contta');
                                $cont20 = mysql_query("SELECT SUM(rcd_20_type) AS totalcont20, SUM(rcd_40_type) AS totalcont40 FROM tb_record_master WHERE rcd_create_month = '$monthnow' AND rcd_create_year = '$yearnow';");
                                $contsql = mysql_fetch_array($cont20);                                
                                ?>
                          <div class="alert alert-info">
                            Cont. 20' : <a href="#" class="alert-link"><?php echo $contsql['totalcont20'];?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="alert alert-info">
                            Cont. 40' : <a href="#" class="alert-link"><?php echo $contsql['totalcont40'];?></a>
                          </div>
                        </div> 
                        <div class="col-lg-12">
                          <div class="alert alert-info">
                            <?php $totalcontainer = $contsql['totalcont20'] + $contsql['totalcont40']  ;?>
                            Total Container :  <a href="#" class="alert-link"><?php echo $totalcontainer;?></a>
                          </div>
                        </div>                            
                      </div>
                    </div>
                    <!-- /.col-lg-4 -->
                  </div>

                  <div class="col-lg-4">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        Stuffing Details
                      </div>
                      <div class="panel-body">
                        <div class="col-lg-12">
                          <?php
                                mysql_connect('localhost', 'root','');
                                mysql_select_db('contta');
                                $stuffcont = mysql_query("SELECT tb_record_master.stuffingschedule, tb_record_ship_exe.rcd_exe_truck_arrived, tb_record_master.stuffingschedule-tb_record_ship_exe.rcd_exe_truck_arrived AS delayornot FROM tb_record_master INNER JOIN tb_record_ship_exe ON tb_record_master.rcd_id=tb_record_ship_exe.rcd_id WHERE tb_record_master.rcd_create_month='$monthnow' AND tb_record_master.rcd_create_year='$yearnow';");
                                $stuffsql = mysql_fetch_array($stuffcont);                                

                                
                                $asd      = mysql_query("SELECT * FROM delayornot");
                                $asdsql = mysql_fetch_array($asd);


                                ?>
                          <div class="alert alert-info">
                            Ship. Delayed' : <a href="#" class="alert-link"><?php echo $asdsql[0];?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="alert alert-info">
                            Ship. Ontime' : <a href="#" class="alert-link"><?php echo $stuffsql['totalcont40'];?></a>
                          </div>
                        </div> 
                        <div class="col-lg-12">
                          <div class="alert alert-info">
                            <?php $totalcontainer = $contsql['totalcont20'] + $contsql['totalcont40']  ;?>
                            Total Container :  <a href="#" class="alert-link"><?php echo $totalcontainer;?></a>
                          </div>
                        </div>                            
                      </div>
                    </div>
                    <!-- /.col-lg-4 -->
                  </div>

                  <div class="col-lg-4">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        PEB/PIB Details
                      </div>
                      <div class="panel-body">
                        <div class="col-lg-12">
                          <?php
                                mysql_connect('localhost', 'root','');
                                mysql_select_db('contta');
                                $stuffcont = mysql_query("SELECT tb_record_master.stuffingschedule, tb_record_ship_exe.rcd_exe_truck_arrived, tb_record_master.stuffingschedule-tb_record_ship_exe.rcd_exe_truck_arrived AS delayornot FROM tb_record_master INNER JOIN tb_record_ship_exe ON tb_record_master.rcd_id=tb_record_ship_exe.rcd_id WHERE tb_record_master.rcd_create_month='$monthnow' AND tb_record_master.rcd_create_year='$yearnow';");
                                $stuffsql = mysql_fetch_array($stuffcont);                                

                                
                                $asd      = mysql_query("SELECT * FROM delayornot");
                                $asdsql = mysql_fetch_array($asd);


                                ?>
                          <div class="alert alert-info">
                            PEB. Delayed' : <a href="#" class="alert-link"><?php echo $asdsql[0];?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="alert alert-info">
                            PIB. Delayed' : <a href="#" class="alert-link"><?php echo $stuffsql['totalcont40'];?></a>
                          </div>
                        </div> 
                        <div class="col-lg-12">
                          <div class="alert alert-info">
                            <?php $totalcontainer = $contsql['totalcont20'] + $contsql['totalcont40']  ;?>
                            Total Container :  <a href="#" class="alert-link"><?php echo $totalcontainer;?></a>
                          </div>
                        </div>                            
                      </div>
                    </div>
                    <!-- /.col-lg-4 -->
                  </div>
                </div>

                <div class="row">
                   <div class="col-lg-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        Cost Details (By Amount)
                      </div>
                      <i>Available in the next version! (KNCONTTA v2.0)</i>
                    </div>                     
                   </div> 
                </div>

              </div>

            <?php } ?>
            <!-- END OF VALIDATTION FOR DISPLAYING THE DATA -->

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
