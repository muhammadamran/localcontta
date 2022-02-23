<script src="assets/js/jquery.min.js"></script> 
<?php
include "include/connection.php";
include "include/restrict.php";
include "include/datatables.php";

if(isset($_POST["create"]))    
{ 
  $check_c = $_POST['cname'];
  $check_t = $_POST['ctype'];

  $con=mysqli_connect("localhost","root","","contta");
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $result = mysqli_query($con,"SELECT user_name,type FROM tb_cnee WHERE user_name ='$check_c' AND type='$check_t'");
  $vald_c = mysqli_fetch_array($result);

  if ($vald_c == NULL) {
    $cname                = $_POST['cname'];
    $caddress             = $_POST['caddress'];
    $type                 = $_POST['ctype'];
    $regdate              = date('Y-m-d h:m:i');
    $regby                = $_POST['regby'];

    $query = mysql_query("INSERT INTO tb_cnee (user_id, user_name, user_address, type, regdate, regby)
      VALUES
      (' ','$cname','$caddress','$type','$regdate','$regby')");

    if($query){
      header("Location: ./iou_adm_cnee.php?CaddSuccess=true");                                      
    } else {
      header("Location: ./iou_adm_cnee.php?CaddFailed=true");                                                  
    }
  } else {
      header("Location: ./iou_adm_cnee.php?CaddReady=true");                                                  
  }
}
// DELETE
if(isset($_POST["delete"]))    
{
  $ID             = $_POST['uid'];

  $query = mysql_query("DELETE FROM tb_cnee WHERE user_id='$ID'");

  if($query) {
    header("Location: ./iou_adm_cnee.php?DeleteSuccess=true");                                            
  } else {
    header("Location: ./iou_adm_cnee.php?DeleteFailed=true");                              
  }
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
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Consignee</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- End Page -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-table"></i> Consignee List
          </div>
          <div class="panel-body">
            <div class="page-add">
              <!-- Add Consignee -->
              <!-- Trigger the modal with a button -->
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-Consignee">
                <i class="fas fa-plus-circle"></i> Add Consignee
              </button>
              <!-- Modal content-->
              <div class="modal fade" id="add-Consignee" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><b>[Add] </b> Consignee</h4>
                    </div>
                    <form method="post" action="">
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Consignee Name <font style="color: red;">*</font></label>
                              <input type="text" name="cname" class="form-control" placeholder="Consignee Name..." required>
                              <input type="hidden" name="regby" class="form-control" value="<?= $_SESSION['username'] ;?>">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Consignee Address <font style="color: red;">*</font></label>
                              <textarea type="text" name="caddress" class="form-control" placeholder="Consignee Address..." required></textarea>
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
              <!-- End Add Consignee -->
            </div>
            <?php
            $con=mysqli_connect("localhost","root","","contta");
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $result = mysqli_query($con,"SELECT COUNT(*) AS total FROM tb_cnee");
            $cont_c = mysqli_fetch_array($result);
            ?>
            <div class="p-b-20" style="margin-bottom: 15px;">
                <div class="alert-info">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                  <strong>Information!</strong> Total Consignee on Localcontta: <b><?= $cont_c['total'] ?> Consignee</b>.
                  <p style="margin-bottom: 0px;">Consignee List on tables only shows the last 50 data, search companies' names if you can't find them in the table.</p>
                </div>
            </div>
            <div class="table-responsive">
              <table class="display hover" id="consignee">
                <thead>
                  <tr>
                    <th class="no-sort">#</th>
                    <th style="text-align: center;">Consignee Name</th>
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
                  $result = mysqli_query($con,"SELECT * FROM tb_cnee ORDER BY regdate DESC LIMIT 50");
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
                              <h4 class="modal-title"><b>[Address]</b> Consignee</h4>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Consignee Name</label>
                                    <input type="text" name="cname" class="form-control" value="<?= $row['user_name'] ?>">
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Consignee Address</label>
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
                      <!-- Delete -->
                      <div class="modal fade" id="delete<?= $row['user_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[Delete]</b> Consignee</h4>
                            </div>
                            <form method="post" action=" ">
                              <div class="modal-body">
                                  <div class="form-group">
                                    <label>Are you sure delete this consignee?</label>
                                    <h6>Consignee Name : <?= $row['user_name'];?></h6>
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
include 'include/alert.php';
?>
