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
  $datenow          = date('Y-m-d H:i:s');


  $query = mysql_query("INSERT into tb_record_master values(' ','$datenow','$user_name','$rcd_type','$ship_plan','$shipper','$cnee','$inv_no','$commo','$c20','$c40','$party','$po_no')");
  if($query){
    header("Location: ./export_master.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST["update"]))    
{    

  $rcd_cus_peb_date       = $_POST['create_peb'];
  $rcd_cus_no_aju         = $_POST['no_aju'];
  $rcd_cus_peb_transmit   = $_POST['transmit_date'];
  $rcd_cus_peb_nopen      = $_POST['peb_nopen'];
  $rcd_cus_npe_date       = $_POST['npe_date'];
  $rcd_cus_coo_date       = $_POST['coo_date'];
  $rcd_id                 = $_POST['rcd_id'];

  $query = mysql_query("UPDATE tb_ex_custom SET rcd_cus_peb_date='$rcd_cus_peb_date',rcd_cus_no_aju='$rcd_cus_no_aju',rcd_cus_peb_transmit='$rcd_cus_peb_transmit',rcd_cus_peb_nopen='$rcd_cus_peb_nopen',rcd_cus_npe_date='$rcd_cus_npe_date',rcd_cus_coo_date='$rcd_cus_coo_date' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./ship_cus.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["complete"]))    
{    

  $rcd_id           = $_POST['rcdid'];
  $user_name        = $_POST['user_name'];
  $datenow          = date('Y-m-d H:i:s');

  $query = mysql_query("UPDATE tb_record_miles_export SET miles_custom ='$datenow',action_by_2='$user_name' where rcd_id='$rcd_id'");
  if($query){
    header("Location: ./ship_cus.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator";
  }
}

if(isset($_POST["peb"]))    
{    
  $rid                = $_POST['rid'];  

  $date_taken         = date('Y-m-d H:i:s');

  $uploaddir = 'file/peb/';
  $uploadfile = $uploaddir . '_' .$rid . '_' . date("YmdHis") . '_' . basename($_FILES['form']['name']);

  $query = move_uploaded_file($_FILES['form']['tmp_name'], $uploadfile);
  if($query){
    if (mysql_query("UPDATE tb_record_ship_cus SET peb_file ='$uploadfile' WHERE rcd_id='$rid'")) {            
      header("Location: ./ship_cus.php");
    } else {
      echo "Updated Failed - Please contact your administrator";
    }                                                 
  } else {
    echo "Updated Failed - Please contact your administrator";
  }

}

if(isset($_POST["npe"]))    
{    
  $rid                = $_POST['rid'];  

  $date_taken         = date('Y-m-d H:i:s');

  $uploaddir = 'file/npe/';
  $uploadfile = $uploaddir . '_' .$rid . '_' . date("YmdHis") . '_' . basename($_FILES['form']['name']);

  $query = move_uploaded_file($_FILES['form']['tmp_name'], $uploadfile);
  if($query){
    if (mysql_query("UPDATE tb_record_ship_cus SET npe_file ='$uploadfile' WHERE rcd_id='$rid'")) {            
      header("Location: ./ship_cus.php");
    } else {
      echo "Updated Failed - Please contact your administrator";
    }                                                 
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
    if (mysql_query("UPDATE tb_record_ship_cus SET coo_file ='$uploadfile' WHERE rcd_id='$rid'")) {            
      header("Location: ./ship_cus.php");
    } else {
      echo "Updated Failed - Please contact your administrator";
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
    $uploadsppb = mysql_query("UPDATE tb_record_ship_cus SET sppb_file ='$uploadfile' WHERE rcd_id='$rid'");          
      if($uploadsppb){
      $to_email = "joko.afandi15@gmail.com" . "," . "titoksetoradityo@gmail.com";
      $subject = 'SPPB Allert';
      $message = 'This mail is to inform you that SPPB has been uploaded';
      $headers = 'From: noreply@kn-idcore.ap.win.int.kn';
      mail($to_email,$subject,$message,$headers);

      header("Location: ./ship_cus.php");
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
          <h1 class="page-header">Custom Arrangement</h1>
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
                      <th>CusID</th>
                      <th>RcdID</th>
                      <th>TN/REF</th>
                      <th>CreatePEB</th>
                      <th>PEB</th>
                      <th>TransmitPEB</th>
                      <th>No.Aju</th>
                      <th>NopenPEB</th>
                      <th>NPEDate</th>
                      <th>NPE</th>
                      <th>COO Date</th>
                      <th>COO</th>
                      <th>SPPB</th>
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
                    $result = mysqli_query($con,"SELECT * FROM tb_record_miles_export INNER JOIN tb_ex_custom ON tb_record_miles_export.rcd_id=tb_ex_custom.rcd_id WHERE tb_record_miles_export.miles_custom = 0 AND tb_record_miles_export.miles_arr != 0 ");
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['rcd_cus_id'] . "</td>";
                        echo "<td>" . $row['rcd_id'] . "</td>";
                        $grep_date = mysqli_query($con,"SELECT * FROM tb_master_export WHERE rcd_id = '$row[rcd_id]' ");
                        $grep = mysqli_fetch_array($grep_date);
                        echo "<td>" . $grep['rcd_inv_no'] . "</td>";
                        echo "<td>" . $row['rcd_cus_peb_date'] . "</td>";
                        if ($row['peb_file'] == "") {
                          echo "<td>" . "file not found" . "</td>";
                        } else {
                          echo "<td>" . "<a href='$row[peb_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>";  
                        }                        
                        echo "<td>" . $row['rcd_cus_peb_transmit'] . "</td>";
                        echo "<td>" . $row['rcd_cus_no_aju'] . "</td>";                        
                        echo "<td>" . $row['rcd_cus_peb_nopen'] . "</td>";
                        echo "<td>" . $row['rcd_cus_npe_date'] . "</td>";
                        if ($row['npe_file'] == "") {
                          echo "<td>" . "file not found" . "</td>";
                        } else {
                          echo "<td>" . "<a href='$row[npe_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>";  
                        }
                        echo "<td>" . $row['rcd_cus_coo_date'] . "</td>";
                        if ($row['coo_file'] == "") {
                          echo "<td>" . "file not found" . "</td>";
                        } else {
                          echo "<td>" . "<a href='$row[coo_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>";  
                        }
                        if ($row['sppb_file'] == "") {
                          echo "<td>" . "file not found" . "</td>";
                        } else {
                          echo "<td>" . "<a href='$row[sppb_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>";  
                        }                           
                        echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#update$row[rcd_id]' title='Edit this record'><span class='label label-primary'>Update</span></a>
                        <a href='#' data-toggle='modal' data-target='#confirm$row[rcd_id]' title='Completed this record'><span class='label label-primary'>Complete</span></a>
                        </td>";
                        echo "</tr>";
                        ?>
                        <div class="modal fade" id="update<?php echo $row['rcd_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[RecordMaster] </b> Update Shipment Custom</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" action=" ">
                                  <div class="col-md-12">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label>PEB Create</label>
                                        <input type="date" name="create_peb" class="form-control" value="<?php echo $row['rcd_cus_peb_date'];?>"  placeholder="create peb">
                                      </div>
                                      <div class="form-group">
                                        <label>Transmit Date</label>
                                        <input type="date" name="transmit_date" class="form-control" value="<?php echo $row['rcd_cus_peb_transmit'];?>"  placeholder="TransmitDate">
                                      </div>
                                      <div class="form-group">
                                        <label>No.Aju</label>
                                        <input type="text" name="no_aju" class="form-control"  value="<?php echo $row['rcd_cus_no_aju'];?>" >
                                      </div>
                                      <div class="form-group">
                                        <label>rcd_cus_peb_nopen</label>
                                        <input type="text" name="peb_nopen" value="<?php echo $row['rcd_cus_peb_nopen'];?>"  class="form-control" >
                                      </div>
                                      <div class="form-group">
                                        <label>rcd_cus_npe_date</label>
                                        <input type="date" name="npe_date" value="<?php echo $row['rcd_cus_npe_date'];?>"  class="form-control" >
                                        <input type="hidden" name="rcd_id" value="<?php echo $row['rcd_id'];?>"  class="form-control" >
                                      </div>
                                      <div class="form-group">
                                        <label>rcd_coo_npe_date</label>
                                        <input type="date" name="coo_date" value="<?php echo $row['rcd_cus_coo_date'];?>"  class="form-control" >
                                        <input type="hidden" name="rcd_id" value="<?php echo $row['rcd_id'];?>"  class="form-control" >
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

                        <div class="modal fade" id="peb<?php echo $row['rcd_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[Document Management] </b> PEB File</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" action=" "  accept-charset="utf-8" enctype="multipart/form-data">
                                  <div class="form-group">
                                    <label>Upload File</label>
                                    <input type="file" name="form" class="form-control">
                                    <input type="hidden" name="rid" class="form-control" placeholder="client name" value="<?php echo $row['rcd_id'];?>" required>
                                    <input type="hidden" name="rcd_type" class="form-control" placeholder="client name" value="<?php echo $row['rcd_type'];?>" required>
                                  </div>
                                  <button type="submit" name="peb" value="npe" class="btn btn-default">Yes</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="npe<?php echo $row['rcd_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[Document Management] </b> NPE File</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" action=" "  accept-charset="utf-8" enctype="multipart/form-data">
                                  <div class="form-group">
                                    <label>Upload File</label>
                                    <input type="file" name="form" class="form-control">
                                    <input type="hidden" name="rid" class="form-control" placeholder="client name" value="<?php echo $row['rcd_id'];?>" required>
                                    <input type="hidden" name="rcd_type" class="form-control" placeholder="client name" value="<?php echo $row['rcd_type'];?>" required>
                                  </div>
                                  <button type="submit" name="npe" value="npe" class="btn btn-default">Yes</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>


                        <div class="modal fade" id="coo<?php echo $row['rcd_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[Document Management] </b> COO File</h4>
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
                                <h4 class="modal-title"><b>[Document Management] </b> SPPB File</h4>
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
                                if ($row['sppb_file'] == "" AND $row['peb_file'] == "") {
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
