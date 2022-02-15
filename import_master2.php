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
  $ata            = $_POST['ata'];
  $coo            = $_POST['coo'];
  $rcvd_do        = $_POST['rcvd_do'];
  $do_validation  = $_POST['do_validation'];
  $rcd_type             = "import";
  $user_name            = $_POST['user_name'];
  $datenow              = date('Y-m-d');
  $monthnow             = date('m');
  $yearnow              = date('Y');


  $query = mysql_query("INSERT into tb_master_impor values(' ','$datenow','$monthnow','$yearnow','$user_name','$rcd_type','$hbl','$shipper','$cnee','$inv_no','$aju','$c20','$c40','$party_sql','$weight','$cbm','$eta','$ata','$coo','$rcvd_do','$do_validation','$mot','New','')");
  $last_id = mysql_insert_id();
  $query .= mysql_query("INSERT into tb_record_miles_import values(' ','$last_id','0','0','0','0','0','0')");
  $query .= mysql_query("INSERT into tb_imp_pre(pre_id,rcd_id) values(' ','$last_id')");
  $query .= mysql_query("INSERT into tb_imp_clear(clear_id,rcd_id) values(' ','$last_id')");
  $query .= mysql_query("INSERT into tb_imp_post(post_id,rcd_id) values(' ','$last_id')");

  if($query){
    header("Location: ./import_master.php");                                                  
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
          <h1 class="page-header">Import - <i>Master</i></h1>
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
                <?php // include 'modals/iou_modal_rcd_create_impor.php';?>

                              <td><button class="btn btn-block btn-default" data-toggle="modal" data-target="#myModal">CREATE!</button></td>
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><b>[RecordMaster] </b> Add New Record</h4>
                    </div>
                    <div class="modal-body">
                      <form method="post" action=" ">
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>HBL</label>
                              <input type="text" name="hbl" class="form-control" required>
                            </div>

                            <div class="form-group">
                              <label>AJU NBR</label>
                              <input type="text" name="aju" class="form-control" required>
                            </div>

                            <div class="form-group">
                              <label>Shipper</label>
                              <select class="form-control" name="shipper" id="shipper">
                                <option value=" ">--- SELECT ---</option>
                                <?php
                                mysql_connect('localhost','root','');
                                mysql_select_db('contta');
                                $result=mysql_query("SELECT * FROM tb_shipper");
                                while($data=mysql_fetch_array($result)) {
                                  echo "<option value='$data[user_name]'> $data[user_name] </option>";
                                }
                                ?>
                              </select>
                            </div>

                            <div class="form-group">
                                <select class="js-example-basic-multiple">
                                  <option>--- asdasd</option>
                                  <option>asdasd</option>
                                  <option>905jdfhg</option>
                                  <option>123</option>
                                </select>
                            </div>

                            <div class="form-group">
                              <label>Consignee</label>
                              <select class="form-control" name="cnee" id="cnee">
                                <option value=" ">--- SELECT ---</option>
                                <?php
                                mysql_connect('localhost','root','');
                                mysql_select_db('contta');
                                $result=mysql_query("SELECT * FROM tb_cnee");
                                while($data=mysql_fetch_array($result)) {
                                  echo "<option value='$data[user_name]'> $data[user_name] </option>";
                                }
                                ?>
                              </select>
                            </div>

                            <div class="form-group">
                              <label>Invoice No.</label>
                              <input type="text" name="inv_no" class="form-control"  required>
                            </div>

                            <div class="form-group">
                              <label>MOT</label>
                              <select class="form-control" name="mot">
                                <option value="">---SELECT---</option>
                                <option value="FCL">FCL</option>
                                <option value="LCL">LCL</option>
                              </select>                              
                            </div>

                            <div class="form-group">
                              <label>Weight</label>
                              <input type="text" name="weight" class="form-control"  required>
                              <input type="hidden" name="user_name" class="form-control" placeholder="#" value="<?php echo $_SESSION['username'];?>">
                            </div>

                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>20'</label>
                              <input type="text" name="c20" class="form-control" required>
                            </div>

                            <div class="form-group">
                              <label>40'</label>
                              <input type="text" name="c40" class="form-control" required>
                            </div>

                            <div class="form-group">
                              <label>CBM</label>
                              <input type="text" name="cbm" class="form-control"  required>
                            </div>

                            <div class="form-group">
                              <label>ETA</label>
                              <input type="date" name="eta" class="form-control"  required>
                            </div>

                            <div class="form-group">
                              <label>ATA</label>
                              <input type="date" name="ata" class="form-control"  required>
                            </div>

                            <div class="form-group">
                              <label>COO</label>
                              <input type="text" name="coo" class="form-control"  required>
                            </div>

                            <div class="form-group">
                              <label>Rcvd DO</label>
                              <input type="date" name="rcvd_do" class="form-control"  required>
                            </div>

                            <div class="form-group">
                              <label>DO Validation</label>
                              <input type="text" name="do_validation" class="form-control"  required>
                            </div>
                            <button type="submit" name="create" value="create" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                          </div>                          

                        </div>                                                                            

                      </form>

                    </div>

                    <div class="modal-footer">



                    </div>

                  </div>

                </div>

              </div>


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
                      <th>SHIPPER</th>
                      <th>CONSIGNEE</th>
                      <th>INVOICE NBR</th>
                      <th>MOT</th>
                      <th>20'</th>
                      <th>40'</th>
                      <th>TOTAL PACKAGE LCL</th>
                      <th>TOTAL WEIGHT</th>
                      <th>TOTAL CBM</th>
                      <th>ETA</th>
                      <th>ATA</th>
                      <th>COO</th>
                      <th>RCVD DO</th>
                      <th>DO VALIDATION</th>
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
                    $result = mysqli_query($con,"SELECT * FROM tb_master_impor WHERE rcd_status = 'New' ");
                    if(mysqli_num_rows($result)>0){

                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['rcd_id'] . "</td>";
                        echo "<td>" . $row['rcd_create_date'] . "</td>";
                        echo "<td>" . $row['rcd_create_by'] . "</td>";
                        echo "<td>" . $row['rcd_hbl'] . "</td>";    
                        echo "<td>" . $row['rcd_aju'] . "</td>";
                        echo "<td>" . $row['rcd_shipper'] . "</td>";
                        echo "<td>" . $row['rcd_cnee'] . "</td>";
                        echo "<td>" . $row['rcd_mot'] . "</td>";
                        echo "<td>" . $row['rcd_inv_no'] . "</td>";
                        echo "<td>" . $row['rcd_20_type'] . "</td>";
                        echo "<td>" . $row['rcd_40_type'] . "</td>";
                        echo "<td>" . $row['rcd_party'] . "</td>";
                        echo "<td>" . $row['rcd_weight'] . "</td>";
                        echo "<td>" . $row['rcd_cbm'] . "</td>";
                        echo "<td>" . $row['rcd_eta'] . "</td>";
                        echo "<td>" . $row['rcd_ata'] . "</td>";
                        echo "<td>" . $row['rcd_coo'] . "</td>";
                        echo "<td>" . $row['rcd_rcvd_do'] . "</td>";
                        echo "<td>" . $row['rcd_do_validation'] . "</td>";
                        echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#edit$row[rcd_id]' title='Upload CIPL'><span class='label label-primary'>CIPL</span></a>
                        </td>";
                        echo "</tr>";
                        ?>
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

<script type="text/javascript">
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>

</body>

</html>
