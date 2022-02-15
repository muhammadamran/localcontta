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
<body onload="display_ct()">

  <div id="wrapper">
    <?php include 'include/header.php';?>

    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Search Page</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <label>Search by KN.REF/TN No.</label>
              <div class="row">            
                <form action="search_result_by_ref.php" method="get">
                  <div class="form-group col-md-6">
                    <input type="text" name="ref" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <select name="type" class="form-control" required> 
                      <option value="">--- SELECT ---</option>
                      <option value="Export">Export</option>
                      <option value="Import">Import</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <button type="submit" name="search" value="search" class="btn btn-primary">Search!</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <label>Search by AJU No.</label>
              <div class="row">            
                <form action="" method="get">
                  <div class="form-group col-md-6">
                    <input type="text" name="aju" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <select name="type" class="form-control" required> 
                      <option value="">--- SELECT ---</option>
                      <option value="Export">Export</option>
                      <option value="Import">Import</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <button type="submit" name="search" value="search" class="btn btn-primary">Search!</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>



    </div>
  </div>
  <!-- /#wrapper -->

  <?php include 'include/jquery.php';?>

</body>

</html>
