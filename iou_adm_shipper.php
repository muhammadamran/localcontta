<script src="assets/js/jquery.min.js"></script> 
<?php
include "include/connection.php";
include "include/restrict.php";
include "include/datatables.php";

// ADD
if(isset($_POST["create"]))    
{ 
  $check_c = $_POST['cname'];
  $check_t = $_POST['ctype'];

  $con=mysqli_connect("localhost","root","","contta");
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $result = mysqli_query($con,"SELECT user_name,type FROM tb_shipper WHERE user_name ='$check_c' AND type='$check_t'");
  $vald_c = mysqli_fetch_array($result);

  if ($vald_c == NULL) {
    $cname                = $_POST['cname'];
    $caddress             = $_POST['caddress'];
    $type                 = $_POST['ctype'];
    $regdate              = date('Y-m-d h:m:i');
    $regby                = $_POST['regby'];

    $query = mysql_query("INSERT INTO tb_shipper (user_id, user_name, user_address, type, regdate, regby)
      VALUES
      (' ','$cname','$caddress','$type','$regdate','$regby')");

    if($query){
      header("Location: ./iou_adm_shipper.php?SaddSuccess=true");                                      
    } else {
      header("Location: ./iou_adm_shipper.php?SaddFailed=true");                                                  
    }
  } else {
      header("Location: ./iou_adm_shipper.php?SaddReady=true");                                                  
  }
}
// EDIT
if(isset($_POST["edit"]))    
{ 
  $check_c = $_POST['cname'];
  $check_t = $_POST['ctype'];

  $con=mysqli_connect("localhost","root","","contta");
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $result = mysqli_query($con,"SELECT user_name,type FROM tb_shipper WHERE user_name ='$check_c' AND type='$check_t'");
  $vald_c = mysqli_fetch_array($result);

  if ($vald_c == NULL) {
    $uid                  = $_POST['uid'];
    $cname                = $_POST['cname'];
    $caddress             = $_POST['caddress'];
    $type                 = $_POST['ctype'];
    $regdate              = date('Y-m-d h:m:i');
    $regby                = $_POST['regby'];

    $query = mysql_query("UPDATE tb_shipper SET user_name='$cname',
                                             user_address='$caddress',
                                             type='$type',
                                             regdate='$regdate',
                                             regby='$regby'
                                             WHERE user_id='$uid'");

    if($query){
      header("Location: ./iou_adm_shipper.php?SUpdateSuccessCC=true");                                      
    } else {
      header("Location: ./iou_adm_shipper.php?SUpdateFailed=true");                                                  
    }
  } else {
      header("Location: ./iou_adm_shipper.php?SUpdateReady=true");                                                  
  }
}
// DELETE
if(isset($_POST["delete"]))    
{
  $ID             = $_POST['uid'];

  $query = mysql_query("DELETE FROM tb_shipper WHERE user_id='$ID'");

  if($query) {
    header("Location: ./iou_adm_shipper.php?DeleteSuccess=true");                                            
  } else {
    header("Location: ./iou_adm_shipper.php?DeleteFailed=true");                              
  }
}

// FUNCTION SEARCHING
$findCN = '';
$findType = '';
if(isset($_GET['findone']))
{
  $findCN = $_GET['findCN'];
  $findType = $_GET['findType'];
}

$startdate = '';
$enddate = '';
if(isset($_GET['findtwo']))
{
  $startdate = $_GET['startdate'];
  $enddate = $_GET['enddate'];
}
?>
<?php include 'include/head.php';?>
<div id="wrapper">
  <?php include 'include/header.php';?>
  <div id="page-wrapper">
    <!-- Page -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          <i class="fa fa-atlas icon-title"></i> Administration
        </h1>
        <nav aria-label="breadcrumb" role="navigation">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shipper</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- End Page -->
    <!-- Search -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fas fa-filter"></i> Filter Data - by
            <select type="text" id="findby" style="background: transparent;border-color: transparent;">
              <option value="opone">Shipper</option>
              <option value="optwo">Date Range</option>
            </select>
          </div>
          <div class="panel-body">
            <div class="page-add">
              <form method="get" action="iou_adm_shipper.php" id="fformone" style="display: show;">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Shipper Name </label>
                      <?php if ($findCN == '') { ?>
                        <input type="text" name="findCN" class="form-control" placeholder="Shipper Name...">
                      <?php } else { ?>
                        <input type="text" name="findCN" class="form-control" placeholder="Shipper Name..." value="<?= $findCN; ?>">
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Type</label>
                      <select type="text" name="findType" class="form-control">
                        <?php if ($findType == '') { ?>
                        <option value="">-- Select Type --</option>
                        <?php } else { ?>
                        <option value="<?= $findType; ?>"><?= $findType; ?></option>
                        <option value="">-- Select Type --</option>
                        <?php } ?>
                        <option value="import">Import</option>
                        <option value="export">Export</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12" style="text-align: right;">
                    <a href="iou_adm_shipper.php" type="button" class="btn btn-info"><i class="fas fa-redo"></i> Reset</a>
                    <button type="submit" name="findone" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                  </div>
                </div>
              </form>
              <form method="get" action="iou_adm_shipper.php" id="fformtwo" style="display: none;">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Start Date</label>
                      <?php if ($startdate == '') { ?>
                        <input type="date" name="startdate" class="form-control">
                      <?php } else { ?>
                        <input type="date" name="startdate" class="form-control" value="<?= $startdate ?>">
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>End Date</label>
                      <?php if ($enddate == '') { ?>
                        <input type="date" name="enddate" class="form-control">
                      <?php } else { ?>
                        <input type="date" name="enddate" class="form-control" value="<?= $enddate ?>">
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-12" style="text-align: right;">
                    <a href="iou_adm_shipper.php" type="button" class="btn btn-info"><i class="fas fa-redo"></i> Reset</a>
                    <button type="submit" name="findtwo" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Search -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-table"></i> Shipper List
          </div>
          <div class="panel-body">
            <div class="page-add">
              <!-- Add Shipper -->
              <!-- Trigger the modal with a button -->
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-Shipper">
                <i class="fas fa-plus-circle"></i> Add Shipper
              </button>
              <!-- Modal content-->
              <div class="modal fade" id="add-Shipper" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><b>[Add] </b> Shipper</h4>
                    </div>
                    <form method="post" action="">
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Shipper Name <font style="color: red;">*</font></label>
                              <input type="text" name="cname" class="form-control" placeholder="Shipper Name..." required>
                              <input type="hidden" name="regby" class="form-control" value="<?= $_SESSION['username'] ;?>">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Shipper Address <font style="color: red;">*</font></label>
                              <textarea type="text" name="caddress" class="form-control" placeholder="Shipper Address..." required></textarea>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Type <font style="color: red;">*</font></label>
                              <select class="form-control" id="id_manager_dept" name="ctype" required>
                                <option value="">-- Select Type --</option>
                                <option value="import">Import</option>
                                <option value="export">Export</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="create" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- End Add Shipper -->
            </div>
            <?php
            $con=mysqli_connect("localhost","root","","contta");
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $result = mysqli_query($con,"SELECT COUNT(*) AS total FROM tb_shipper");
            $cont_c = mysqli_fetch_array($result);
            ?>
            <div class="p-b-20" style="margin-bottom: 15px;">
                <div class="alert-info">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                  <strong>Information!</strong> Total Shipper on Localcontta: <b><?= $cont_c['total'] ?> Shipper</b>.
                  <p style="margin-bottom: 0px;">Shipper List on tables only shows the last 50 data, search Shipper' names if you can't find them in the table.</p>
                </div>
            </div>
            
            <!-- Count Export Import -->
            <?php
            $con=mysqli_connect("localhost","root","","contta");
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $result_export = mysqli_query($con,"SELECT COUNT(*) AS total_export FROM tb_shipper WHERE type='export'");
            $cont_export = mysqli_fetch_array($result_export);

            $result_import = mysqli_query($con,"SELECT COUNT(*) AS total_import FROM tb_shipper WHERE type='import'");
            $cont_import = mysqli_fetch_array($result_import);
            ?>
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body p-3">
                    <div class="card-content">
                      <div style="display: grid;">
                        <font style="font-size: 25px;font-weight: 600;">Export</font>
                        <font style="font-size: 16px;font-weight: 600;"><?= $cont_export['total_export'] ?> Shipper</font>
                        <div class="card_divider"></div>
                        <font style="font-size: 10px;font-weight: 300;"><?= date_indo(date('Y-m-d'), true); ?></font>
                      </div>
                      <div class="icon-bg-na">
                        <i class="fa fa-box fa-fw detail-na" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body p-3">
                    <div class="card-content">
                      <div style="display: grid;">
                        <font style="font-size: 25px;font-weight: 600;">Import</font>
                        <font style="font-size: 16px;font-weight: 600;"><?= $cont_import['total_import'] ?> Shipper</font>
                        <div class="card_divider"></div>
                        <font style="font-size: 10px;font-weight: 300;"><?= date_indo(date('Y-m-d'), true); ?></font>
                      </div>
                      <div class="icon-bg-na">
                        <i class="fa fa-dolly-flatbed fa-fw detail-na" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Count Export Import -->
            <div class="table-responsive">
              <table class="display hover" id="shipper">
                <thead>
                  <tr>
                    <th class="no-sort">#</th>
                    <th style="text-align: center;">Shipper Name</th>
                    <th style="text-align: center;">Address</th>                      
                    <th style="text-align: center;">Type</th>    
                    <th style="text-align: center;">Date</th>                  
                    <th class="no-sort" style="text-align: center;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $con=mysqli_connect("localhost","root","","contta");
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }
                  // $result = mysqli_query($con,"SELECT * FROM tb_shipper ORDER BY regdate DESC LIMIT 50");
                  if(isset($_GET['findone']))
                  {
                    $findCN = $_GET['findCN'];
                    $findType = $_GET['findType'];
                    $result = mysqli_query($con,"SELECT * FROM tb_shipper WHERE user_name LIKE '%$findCN%' AND type LIKE '%$findType%'");       
                  } else {
                    $result = mysqli_query($con,"SELECT * FROM tb_shipper ORDER BY user_id DESC LIMIT 50");   
                  }
                  if(mysqli_num_rows($result)>0){
                    $no=0;
                    while($row = mysqli_fetch_array($result))
                    {
                      $no++;
                      echo "<tr>";
                      echo "<td>" . $no . ".</td>";
                      echo "<td>" . $row['user_name'] . "</td>";
                      echo "<td style='text-align: center;'>
                      <a href='#' data-toggle='modal' data-target='#address$row[user_id]' title='Address'>
                      <span class='btn btn-sm btn-change'>
                      <i class='fas fa-map-marker-alt'></i>
                      </span>
                      </a>
                      </td>";
                      echo "<td style='text-align: center;'>" . $row['type'] . "</td>";       
                      echo "<td style='text-align: center;'>
                      <font style='font-size: 10px;'>" . $row['regdate'] . "</font>
                      </td>";       
                      echo "<td style='text-align: center;'>
                      <a href='#' data-toggle='modal' data-target='#edit$row[user_id]' title='Edit'>
                      <span class='btn btn-sm btn-warning'>
                      <i class='fa fa-pencil'></i>
                      </span>
                      </a>
                      <a href='#' data-toggle='modal' data-target='#delete$row[user_id]' title='Delete'>
                      <span class='btn btn-sm btn-danger'>
                      <i class='fa fa-trash'></i>
                      </span>
                      </a>
                      </td>";
                      echo "</tr>";
                      ?>
                      <!-- Address -->
                      <div class="modal fade" id="address<?= $row['user_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[Address]</b> Shipper</h4>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Shipper Name</label>
                                    <input type="text" name="cname" class="form-control" value="<?= $row['user_name'] ?>">
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Shipper Address</label>
                                    <textarea type="text" name="caddress" class="form-control"><?= $row['user_address'] ?></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Address -->
                      <!-- Edit -->
                      <div class="modal fade" id="edit<?= $row['user_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[Edit] </b> Shipper</h4>
                            </div>
                            <form method="post" action="">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Shipper Name</label>
                                      <input type="text" name="cname" class="form-control" placeholder="Shipper Name..." value="<?= $row['user_name'] ?>">
                                      <input type="hidden" name="uid" class="form-control" value="<?= $row['user_id'] ?>">
                                      <input type="hidden" name="regby" class="form-control" value="<?= $_SESSION['username'] ;?>">
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Shipper Address</label>
                                      <textarea type="text" name="caddress" class="form-control" placeholder="Shipper Address..."><?= $row['user_address'] ?></textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Type</label>
                                      <select class="form-control" id="id_manager_dept" name="ctype">
                                        <option value="<?= $row['type'] ?>"><?= $row['type'] ?></option>
                                        <option value="">-- Select Type --</option>
                                        <option value="import">Import</option>
                                        <option value="export">Export</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="edit" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- End Edit -->
                      <!-- Delete -->
                      <div class="modal fade" id="delete<?= $row['user_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[Delete]</b> Shipper</h4>
                            </div>
                            <form method="post" action=" ">
                              <div class="modal-body">
                                  <div class="form-group">
                                    <label>Are you sure delete this Shipper?</label>
                                    <h6>Shipper Name : <?= $row['user_name'];?></h6>
                                    <input type="hidden" name="uid" class="form-control" value="<?= $row['user_id'];?>" required>
                                  </div>
                                  <div class="form-group">
                                    <h6>Type : <?= $row['type'];?></h6>
                                  </div>
                                  <div class="form-group">
                                    <h6>Address <br> <?= $row['user_address'];?></h6>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="delete" class="btn btn-danger"> Yes</button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal"> No</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- Delete -->
                    <?php }
                    } else {
                      echo "<tr>";
                      echo "<td colspan='6' align='center'><b><i>" . "No Available Record" . "</i></b></td>";
                      echo "</tr>";
                    }  mysqli_close($con); 
                    ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
include 'include/jquery.php';
?>
<!-- Shipper -->
<script type="text/javascript">
    // Input - Add
    if (window?.location?.href?.indexOf('SaddSuccess') > -1) {
        Swal.fire({
            title: 'Success Alert!',
            icon: 'success',
            text: 'Data saved successfully!',
        })
        history.replaceState({}, '', './iou_adm_shipper.php');
    }

    if (window?.location?.href?.indexOf('SaddFailed') > -1) {
        Swal.fire({
            title: 'Failed Alert!',
            icon: 'error',
            text: 'Data failed to save, please contact your administrator!',
        })
        history.replaceState({}, '', './iou_adm_shipper.php');
    }

    if (window?.location?.href?.indexOf('SaddReady') > -1) {
        Swal.fire({
            title: 'Failed Alert!',
            icon: 'error',
            text: 'Shipper Name already registered, please contact your administrator!',
        })
        history.replaceState({}, '', './iou_adm_shipper.php');
    }
    // End Input - Add

    // Update Data
    if (window?.location?.href?.indexOf('SUpdateSuccessCC') > -1) {
        Swal.fire({
            title: 'Success Alert!',
            icon: 'success',
            text: 'Data updated successfully!',
        })
        history.replaceState({}, '', './iou_adm_shipper.php');
    }

    if (window?.location?.href?.indexOf('SUpdateFailed') > -1) {
        Swal.fire({
            title: 'Failed Alert!',
            icon: 'error',
            text: 'Data failed to updated, please contact your administrator!',
        })
        history.replaceState({}, '', './iou_adm_shipper.php');
    }

    if (window?.location?.href?.indexOf('SUpdateReady') > -1) {
        Swal.fire({
            title: 'Failed Alert!',
            icon: 'error',
            text: 'Shipper Name already registered, please contact your administrator!',
        })
        history.replaceState({}, '', './iou_adm_shipper.php');
    }
    // End Update Data

    // Delete
    if (window?.location?.href?.indexOf('DeleteSuccess') > -1) {
        Swal.fire({
            title: 'Delete Alert!',
            icon: 'info',
            text: 'Data delete successfully!',
        })
        history.replaceState({}, '', './iou_adm_shipper.php');
    }

    if (window?.location?.href?.indexOf('DeleteFailed') > -1) {
        Swal.fire({
            title: 'Delete Alert!',
            icon: 'info',
            text: 'Data failed to delete, please contact your administrator!',
        })
        history.replaceState({}, '', './iou_adm_shipper.php');
    }
    // End Delete
</script>
<!-- Search -->
<script type="text/javascript">
  $(function() {
    $("#findby").change(function() {
      if ($(this).val() == "opone") {
        $("#fformone").show();
        $("#fformtwo").hide();
      } else if ($(this).val() == "optwo") {
        $("#fformtwo").show();
        $("#fformone").hide();
      } else {
        $("#fformone").hide();
        $("#fformtwo").hide();
      }
    });
  });
</script>
<!-- End Search -->