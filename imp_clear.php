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

if(isset($_POST["cle_submit_coo"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_clear SET cle_submit_coo ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_clear.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["cle_sppb"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_clear SET cle_sppb ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_clear.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["cle_spjm"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_clear SET cle_spjm ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_clear.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["cle_spjk"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_clear SET cle_spjk ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_clear.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["cle_paid_duty_tax"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_clear SET cle_paid_duty_tax ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_clear.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["cle_billing"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_clear SET cle_billing ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_clear.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["cle_trf_pib"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_imp_clear SET cle_trf_pib ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_clear.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["rcd_ata"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_master_impor SET rcd_ata ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_clear.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["rcd_do_validation"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_master_impor SET rcd_do_validation ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_clear.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["rcd_rcvd_do"]))    
{    

  $datenow          = date('Y-m-d');
  $rcd_id           = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_master_impor SET rcd_rcvd_do ='$datenow' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_clear.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["update"]))    
{    

  $ata                = $_POST['ata'];
  $do_validation      = $_POST['do_validation'];
  $rcd_id             = $_POST['rcd_id'];
  $remark1            = $_POST['remark1'];
  $new_coo            = $_POST['new_coo'];

  $query = mysql_query("UPDATE tb_master_impor SET rcd_ata ='$ata',rcd_do_validation='$do_validation',rcd_coo ='$new_coo' where rcd_id='$rcd_id'");
  $query .= mysql_query("UPDATE tb_imp_clear SET cle_remark='$remark1' where rcd_id='$rcd_id'");
  //$query .= mysqli_query("UPDATE tb_master_impor SET rcd_coo ='$coo1' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./imp_clear.php");                                                  
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

if(isset($_POST["sppb"]))    
{    
  $rid                = $_POST['rid'];  

  $date_taken         = date('Y-m-d H:i:s');

  $uploaddir = 'file/sppb/';
    $uploadfile = $uploaddir . '_' .$rid . '_' . date("YmdHis") . '_' . basename($_FILES['form']['name']);

    $query = move_uploaded_file($_FILES['form']['tmp_name'], $uploadfile);
    if($query){
      if (mysql_query("UPDATE tb_imp_clear SET sppb ='$uploadfile' WHERE rcd_id='$rid'")) {            
            header("Location: ./imp_clear.php");
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
          <h1 class="page-header">[Seafreight] Import - Clearance</h1>
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
                      <th>PreID</th>
                      <th>RcdID</th>
                      <th>KNREF/TN</th>
                      <th>HBL</th>
                      <th>CNEE</th>
                      <th>AJU NO.</th>
                      <th>COO</th>
                      <th>DO VALIDATION</th>
                      <th>ATA</th>
                      <th>RCVD DO</th>
                      <th>TRANSFER PIB</th>
                      <th>BILLING</th>
                      <th>PAID DUTY TAX</th>
                      <th>SPJK</th>
                      <th>SPJM</th>
                      <th>SPPB</th>
                      <th>SUBMIT COO</th>
                      <th>COO FILE</th>
                      <th>SPPB FILE</th>
                      <th>REMARK</th>
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
                    $result = mysqli_query($con,"SELECT * FROM tb_record_miles_import INNER JOIN tb_imp_clear ON tb_record_miles_import.rcd_id=tb_imp_clear.rcd_id WHERE tb_record_miles_import.clear = '0' AND tb_record_miles_import.pre != '0' AND tb_record_miles_import.mot != 'AIR'");
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['clear_id'] . "</td>";
                        echo "<td>" . $row['rcd_id'] . "</td>"; 

                        $get_data = mysql_query("SELECT rcd_aju,rcd_ref,rcd_coo,rcd_do_validation,rcd_ata,rcd_rcvd_do,rcd_cnee,rcd_hbl FROM tb_master_impor WHERE rcd_id = '$row[rcd_id]'");
                        $get1 = mysql_fetch_array($get_data);

                        echo "<td>" . $get1['rcd_ref'] . "</td>";   
                        echo "<td>" . $get1['rcd_hbl'] . "</td>";                      
                        echo "<td>" . $get1['rcd_cnee'] . "</td>";  
                        echo "<td>" . $get1['rcd_aju'] . "</td>";                        
                        echo "<td>" . $get1['rcd_coo'] . "</td>";
                        echo "<td>" . $get1['rcd_do_validation'] . "</td>";
                        echo "<td>" . $get1['rcd_ata'] . "</td>";

                        if ($get1['rcd_rcvd_do'] == "0000-00-00") {
                          echo "<td>" . 
                          "<form method='post' action=''>".
                          "<input type='hidden' value='$row[rcd_id]' name='rcd_id'>".
                          "<button type='submit' name='rcd_rcvd_do' value='rcd_rcvd_do' class='btn btn-primary'>Input</button>".
                          "</form>"
                          . "</td>";  
                        } else {
                          echo "<td>" . $get1['rcd_rcvd_do'] . "</td>";
                        } 

                        if ($row['cle_trf_pib'] == "0000-00-00") {
                          echo "<td>" . 
                          "<form method='post' action=''>".
                          "<input type='hidden' value='$row[rcd_id]' name='rcd_id'>".
                          "<button type='submit' name='cle_trf_pib' value='cle_trf_pib' class='btn btn-primary'>Input</button>".
                          "</form>"
                          . "</td>";  
                        } else {
                          echo "<td>" . $row['cle_trf_pib'] . "</td>";
                        } 

                        if ($row['cle_billing'] == "0000-00-00") {
                          echo "<td>" . 
                          "<form method='post' action=''>".
                          "<input type='hidden' value='$row[rcd_id]' name='rcd_id'>".
                          "<button type='submit' name='cle_billing' value='cle_billing' class='btn btn-primary'>Input</button>".
                          "</form>"
                          . "</td>";  
                        } else {
                          echo "<td>" . $row['cle_billing'] . "</td>";
                        } 

                        if ($row['cle_paid_duty_tax'] == "0000-00-00") {
                          echo "<td>" . 
                          "<form method='post' action=''>".
                          "<input type='hidden' value='$row[rcd_id]' name='rcd_id'>".
                          "<button type='submit' name='cle_paid_duty_tax' value='cle_paid_duty_tax' class='btn btn-primary'>Input</button>".
                          "</form>"
                          . "</td>";  
                        } else {
                          echo "<td>" . $row['cle_paid_duty_tax'] . "</td>";
                        } 


                        if ($row['cle_spjk'] == "0000-00-00") {
                          echo "<td>" . 
                          "<form method='post' action=''>".
                          "<input type='hidden' value='$row[rcd_id]' name='rcd_id'>".
                          "<button type='submit' name='cle_spjk' value='cle_spjk' class='btn btn-primary'>Input</button>".
                          "</form>"
                          . "</td>";  
                        } else {
                          echo "<td>" . $row['cle_spjk'] . "</td>";
                        }


                        if ($row['cle_spjm'] == "0000-00-00") {
                          echo "<td>" . 
                          "<form method='post' action=''>".
                          "<input type='hidden' value='$row[rcd_id]' name='rcd_id'>".
                          "<button type='submit' name='cle_spjm' value='cle_spjm' class='btn btn-primary'>Input</button>".
                          "</form>"
                          . "</td>";  
                        } else {
                          echo "<td>" . $row['cle_spjm'] . "</td>";
                        }

                        if ($row['cle_sppb'] == "0000-00-00") {
                          echo "<td>" . 
                          "<form method='post' action=''>".
                          "<input type='hidden' value='$row[rcd_id]' name='rcd_id'>".
                          "<button type='submit' name='cle_sppb' value='cle_sppb' class='btn btn-primary'>Input</button>".
                          "</form>"
                          . "</td>";  
                        } else {
                          echo "<td>" . $row['cle_sppb'] . "</td>";
                        }

                        if ($row['cle_submit_coo'] == "0000-00-00") {
                          echo "<td>" . 
                          "<form method='post' action=''>".
                          "<input type='hidden' value='$row[rcd_id]' name='rcd_id'>".
                          "<button type='submit' name='cle_submit_coo' value='cle_submit_coo' class='btn btn-primary'>Input</button>".
                          "</form>"
                          . "</td>";  
                        } else {
                          echo "<td>" . $row['cle_submit_coo'] . "</td>";
                        }

                        if ($row['coo'] == "") {
                          echo "<td>" . "file not found" . "</td>";
                        } else {
                          echo "<td>" . "<a href='$row[coo]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>";  
                        }

                        if ($row['sppb'] == "") {
                          echo "<td>" . "file not found" . "</td>";
                        } else {
                          echo "<td>" . "<a href='$row[sppb]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>";  
                        }

                        echo "<td>" . $row['cle_remark'] . "</td>";     

                        echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#edit$row[rcd_id]' title='Edit this record'><span class='label label-primary'>Update</span></a>
                        <a href='#' data-toggle='modal' data-target='#confirm$row[rcd_id]' title='Completed this record'><span class='label label-primary'>Complete</span></a>
                      </td>";
                      echo "</tr>";
                      ?>
                      <div class="modal fade" id="edit<?php echo $row['rcd_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[RecordMaster] </b> Update Clearance</h4>
                            </div>                                                        
                            <div class="modal-body">
                              <form method="post" action=" ">
                                <div class="col-md-12">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label>COO</label>
                                      <select name="new_coo" class="form-control" required>
                                        <option value="<?php echo $get1['rcd_coo'];?>" style="background-color: yellow;"><?php echo $get1['rcd_coo'];?></option>
                                        <option value="">-- SELECT --</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>ATA</label>
                                      <input type="date" name="ata" class="form-control" value="<?php echo $get1['rcd_ata'];?>" required>
                                      <input type="hidden" name="rcd_id" class="form-control" value="<?php echo $row['rcd_id'];?>" required>
                                    </div>                                    
                                    <div class="form-group">
                                      <label>DO VALIDATION</label>                                      
                                      <input type="date" name="do_validation" class="form-control" value="<?php echo $get1['rcd_do_validation'];?>">
                                    </div>
                                    <div class="form-group">
                                      <label>Clearance Remark</label>
                                      <textarea name="remark1" class="form-control"><?php echo $row['cle_remark']?></textarea>
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

                      <div class="modal fade" id="coo<?php echo $row['rcd_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[Document Management] </b> coo File</h4>
                            </div>
                            <div class="modal-body">
                              <form method="post" action=" "  accept-charset="utf-8" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label>Upload File</label>
                                  <input type="file" name="form" class="form-control">
                                  <input type="hidden" name="rid" class="form-control" placeholder="client name" value="<?php echo $row['rcd_id'];?>" required>
                                  <input type="hidden" name="rcd_type" class="form-control" placeholder="client name" value="<?php echo $row['rcd_type'];?>" required>
                                </div>
                                <button type="submit" name="coo" value="coo" class="btn btn-default">Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="sppb<?php echo $row['rcd_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[Document Management] </b> sppb File</h4>
                            </div>
                            <div class="modal-body">
                              <form method="post" action=" "  accept-charset="utf-8" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label>Upload File</label>
                                  <input type="file" name="form" class="form-control">
                                  <input type="hidden" name="rid" class="form-control" placeholder="client name" value="<?php echo $row['rcd_id'];?>" required>
                                  <input type="hidden" name="rcd_type" class="form-control" placeholder="client name" value="<?php echo $row['rcd_type'];?>" required>
                                </div>
                                <button type="submit" name="sppb" value="sppb" class="btn btn-default">Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                                <?php 
                                /*if ($row['coo'] == "" OR $row['sppb'] == "") {*/
                                if ($row['sppb'] == "") {
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
