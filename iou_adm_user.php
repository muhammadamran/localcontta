<?php
include "include/connection.php";
include "include/restrict.php";
include "include/datatables.php";

if(isset($_POST["create"]))    
{    
  // Admin
  $cekRole =  $_POST['user_role'];
  if ($cekRole == 'admin') {
    $username             = $_POST['admin_user_name'];
    $password             = 'changeme';
    $email                = $_POST['admin_user_mail'];
    $role                 = $_POST['user_role'];
    $scope                = $_POST['admin_scope'];
    $department           = $_POST['admin_dept'];

    $query = mysql_query("INSERT INTO tb_user
                          (user_id,user_name,user_pass,user_mail,user_role,user_scope,user_dept)
                          VALUES
                          ('','$username','$password','$email','$role','$scope','$department')");

    if($query) {
      header("Location: ./iou_adm_user.php?InputSuccess=true");                                                  
    } else {
      // echo "Updated Failed - Please contact your administrator".mysql_error();
      header("Location: ./iou_adm_user.php?InputFailed=true");                                                  
    }
  }
  // General Manager
  // Manager
  // User
  // Guest
}
?>
<?php include 'include/head.php';?>
<div id="wrapper">
  <?php include 'include/header.php';?>
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          <i class="fa fa-atlas icon-title"></i> Administration
        </h1>
        <nav aria-label="breadcrumb" role="navigation">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Management Users</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-table"></i> Management Users
          </div>
          <div class="panel-body">
            <div class="page-add">
              <!-- Add Users -->
              <!-- Trigger the modal with a button -->
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-users">
                <i class="fa fa-user-plus"></i> Add Users
              </button>
              <!-- Modal content-->
              <div class="modal fade" id="add-users" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><b>[Add Users] </b> Management User</h4>
                    </div>
                    <form method="post" action="">
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>User Role</label>
                              <select class="form-control" name="user_role" id="input-role" required>
                                <option id="option_empty" value="">-- Select User Role --</option>
                                <option id="option_admin" value="admin">Administrator</option>
                                <option id="option_gm" value="gm">General Manager</option>
                                <option id="option_manager" value="manager">Manager</option>
                                <option id="option_user" value="user">User</option>
                                <option id="option_guest" value="guest">Guest</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <!-- Admin Scope and Department -->
                        <div class="row" id="admin_input" style="display:none;">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Scope</label>
                              <input type="text" class="form-control" name="admin_scope" value="all" readonly>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Department</label>
                              <input type="text" class="form-control" name="admin_dept" value="all" readonly>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Username <font style="color: red;">*</font></label>
                                <input type="text" class="form-control" name="admin_user_name" placeholder="Input username...">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Email <font style="color: red;">*</font></label>
                                <input type="email" class="form-control" name="admin_user_mail" placeholder="Input email...">
                            </div>
                          </div>
                        </div>
                        <!-- End Admin Scope and Department -->
                        <!-- GM Scope and Department -->
                        <div class="row" id="gm_input" style="display:none;">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Scope</label>
                              <input type="text" class="form-control" name="gm_scope" value="all" readonly>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Department</label>
                              <input type="text" class="form-control" name="gm_dept" value="all" readonly>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Username <font style="color: red;">*</font></label>
                                <input type="text" class="form-control" name="gm_user_name" placeholder="Input username...">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Email <font style="color: red;">*</font></label>
                                <input type="email" class="form-control" name="gm_user_mail" placeholder="Input email...">
                            </div>
                          </div>
                        </div>
                        <!-- End GM Scope and Department -->
                        <!-- Guest Scope and Department -->
                        <div class="row" id="guest_input" style="display:none;">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Scope</label>
                              <input type="text" class="form-control" name="guest_scope" value="all" readonly>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Department</label>
                              <input type="text" class="form-control" name="guest_dept" value="all" readonly>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Username <font style="color: red;">*</font></label>
                                <input type="text" class="form-control" name="guest_user_name" placeholder="Input username...">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Email <font style="color: red;">*</font></label>
                                <input type="email" class="form-control" name="guest_user_mail" placeholder="Input email...">
                            </div>
                          </div>
                        </div>
                        <!-- End Guest Scope and Department -->
                        <!-- Manager Scope and Department -->
                        <div class="row" id="manager_input" style="display:none;">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Scope</label>
                              <input type="text" class="form-control" name="manager_scope" value="all" readonly>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Department <font style="color: red;">*</font></label>
                              <select class="form-control" id="id_manager_dept" name="manager_dept">
                                <option value="">-- Select User Role --</option>
                                <option value="sea">Sea Freight</option>
                                <option value="air">Air Freight</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Username <font style="color: red;">*</font></label>
                                <input type="text" class="form-control" name="manager_user_name" placeholder="Input username...">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Email <font style="color: red;">*</font></label>
                                <input type="email" class="form-control" name="manager_user_mail" placeholder="Input email...">
                            </div>
                          </div>
                        </div>
                        <!-- End Manager Scope and Department -->
                        <!-- User Scope and Department -->
                        <div class="row" id="user_input" style="display:none;">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Scope <font style="color: red;">*</font></label>
                              <select class="form-control" id="id_user_scope" name="user_scope">
                                <option value="">-- Select Scope --</option>
                                <option value="import">Import</option>
                                <option value="export">Export</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Department <font style="color: red;">*</font></label>
                              <select class="form-control" id="id_user_dept" name="user_dept">
                                <option value="">-- Select Department --</option>
                                <option value="sea">Sea Freight</option>
                                <option value="air">Air Freight</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Username <font style="color: red;">*</font></label>
                                <input type="text" class="form-control" name="user_user_name" placeholder="Input username...">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Email <font style="color: red;">*</font></label>
                                <input type="email" class="form-control" name="user_user_mail" placeholder="Input email...">
                            </div>
                          </div>
                        </div>
                        <!-- End User Scope and Department -->
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="create" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- End Add Users -->
            </div>
            <div class="table-responsive">
              <table class="display hover" id="users">
                <thead>
                  <tr>
                    <th>#</th>
                    <th style="text-align: center;">Username</th>
                    <th style="text-align: center;">Role</th>
                    <th class="no-sort" style="text-align: center;">Action</th>
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
                  $result = mysqli_query($con,"SELECT * FROM tb_user ORDER BY user_name ASC");
                  if(mysqli_num_rows($result)>0){
                    $no=0;
                    while($row = mysqli_fetch_array($result))
                    {
                      $no++;
                      echo "<tr>";
                      echo "<td>" . $no . ".</td>";
                      echo "<td>" . $row['user_name'] . "</td>";
                      echo "<td style='text-align: center;'>" . $row['user_role'] . "</td>";
                      echo "<td style='text-align: center;'>
                      <a href='#' data-toggle='modal' data-target='#edit$row[user_id]' title='Edit'>
                      <span class='btn btn-sm btn-warning'>
                      <i class='fa fa-pencil'></i>
                      </span>
                      </a>
                      <a href='#' data-toggle='modal' data-target='#pass$row[user_id]' title='Change Password'>
                      <span class='btn btn-sm btn-change'>
                      <i class='fa fa-unlock'></i>
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
                      <div class="modal fade" id="edit<?php echo $row['user_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[User List] </b> Update User</h4>
                            </div>
                            <div class="modal-body">
                              <form method="post" action=" ">
                                <div class="form-group">
                                  <label>User Name</label>
                                  <input type="text" name="username" class="form-control" placeholder="client name" value="<?php echo $row['user_name'];?>" required readonly>
                                  <input type="hidden" name="uid" class="form-control" placeholder="client name" value="<?php echo $row['user_id'];?>" required>
                                </div>
                                <div class="form-group">
                                  <label>User Role</label>                                  
                                  <div class="form-group">
                                    <p><i> New Role </i> </p>
                                    <select name="role_new" class="form-control">
                                      <option style="background-color: yellow;" value="<?php echo $row['user_role'];?>"><?php echo $row['user_role'];?></option>
                                      <option value=" ">--- SELECT ---</option>
                                      <option value="Administrator">Administrator</option>
                                      <option value="Billing">Billing</option>
                                      <option value="CG/Finance">CG/Finance</option>
                                      <option value="Special">Special</option>
                                      <option value="Guest">Guest</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <p><i> Region </i> </p>
                                    <select name="region" class="form-control">
                                      <option style="background-color: yellow;" value="<?php echo $row['user_region'];?>"><?php echo $row['user_region'];?></option>
                                      <option value=" ">--- SELECT ---</option>
                                      <option value="JKT">JKT</option>
                                      <option value="SUB">SUB</option>
                                      <option value="SRG">SRG</option>
                                      <option value="BTH">BTH</option>
                                      <option value="MES">MES</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <p><i> Department </i> </p>
                                    <select name="dept1" class="form-control">
                                      <option style="background-color: yellow;" value="<?php echo $row['user_dept'];?>"><?php echo $row['user_dept'];?></option>
                                      <option value=" ">--- SELECT ---</option>
                                      <option value="ALL">ALL</option>
                                      <option value="AIR">AIR</option>
                                      <option value="SEA">SEA</option>
                                    </select>
                                  </div>
                                </div>
                                <button type="submit" name="update" class="btn btn-default">Update</button>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="pass<?php echo $row['user_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[User List] </b> Change Password</h4>
                            </div>
                            <div class="modal-body">
                              <form method="post" action=" ">
                                <div class="form-group">
                                  <label>User Name</label>
                                  <input type="text" name="username" class="form-control" placeholder="client name" value="<?php echo $row['user_name'];?>" required readonly>
                                  <input type="hidden" name="uid" class="form-control" placeholder="client name" value="<?php echo $row['user_id'];?>" required>
                                </div>
                                <div class="form-group">
                                  <label>New Password</label>
                                  <input type="password" name="new_pass" class="form-control" placeholder="new password" required>
                                </div>
                                <button type="submit" name="pass" class="btn btn-default">Change Password</button>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="delete<?php echo $row['user_id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><b>[user List] </b> Delete User</h4>
                            </div>
                            <div class="modal-body">
                              <form method="post" action=" ">
                                <div class="form-group">
                                  <label>Are you sure delete this user?</label>
                                  <h6>User Name : <?php echo $row['user_name'];?></h6>
                                  <input type="hidden" name="uid" class="form-control" placeholder="client name" value="<?php echo $row['user_id'];?>" required>
                                </div>
                                <button type="submit" name="delete" class="btn btn-default">Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php
                    }
                  } else {
                    echo "<tr>";
                    echo "<td colspan='7' align='center'>"."<b>"."<i>" . "No Available Record" . "</i>". "</b>" . "</td>";
                    echo "</tr>";
                  }  mysqli_close($con); ?>
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
<script type="text/javascript">
  $(function() {
    $("#input-role").change(function() {
      if ($(this).val() == "admin") {
        $("#admin_input").show();
        $("#gm_input").hide();
        $("#guest_input").hide();
        $("#manager_input").hide();
        $("#user_input").hide();
      } else if ($(this).val() == "gm") {
        $("#gm_input").show();
        $("#admin_input").hide();
        $("#guest_input").hide();
        $("#manager_input").hide();
        $("#user_input").hide();
      } else if ($(this).val() == "guest") {
        $("#guest_input").show();
        $("#admin_input").hide();
        $("#gm_input").hide();
        $("#manager_input").hide();
        $("#user_input").hide();
      } else if ($(this).val() == "manager") {
        $("#manager_input").show();
        $("#admin_input").hide();
        $("#gm_input").hide();
        $("#guest_input").hide();
        $("#user_input").hide();
        Swal.fire({
          icon: 'info',
          title: 'Information!',
          imageWidth: 400,
          imageHeight: 250,
          imageAlt: 'Custom image',
          html: '<font style="font-size: 12px;font-weight: 300;">Make sure the mandarory input is not empty. <br><b>Pay attention to the input label <font style="color: red">*</font></b></font>',
          showCloseButton: false,
          showCancelButton: false,
          focusConfirm: false,
          confirmButtonText: 'OK'
        })
      } else if ($(this).val() == "user") {
        $("#user_input").show();
        $("#admin_input").hide();
        $("#gm_input").hide();
        $("#guest_input").hide();
        $("#manager_input").hide();  
        Swal.fire({
          icon: 'info',
          title: 'Information!',
          imageWidth: 400,
          imageHeight: 250,
          imageAlt: 'Custom image',
          html: '<font style="font-size: 12px;font-weight: 300;">Make sure the mandarory input is not empty. <br><b>Pay attention to the input label <font style="color: red">*</font></b></font>',
          showCloseButton: false,
          showCancelButton: false,
          focusConfirm: false,
          confirmButtonText: 'OK'
        })    
      } else {
        $("#admin_input").hide();
        $("#gm_input").hide();
        $("#guest_input").hide();
        $("#manager_input").hide();
        $("#user_input").hide();
      }
    });
  });

  function validasi() {
    var v_option_manager = document.getElementById("option_manager").value;
    // Manager
    var input_manager_dept = document.getElementById("id_manager_dept").value;
    // User
    var input_user_scope = document.getElementById("id_user_scope").value;
    var input_user_dept = document.getElementById("id_user_dept").value;

    if (v_option_manager == "manager" && input_manager_dept != "") {
        return true;
    } else {
      Swal.fire({
        icon: 'info',
        title: 'Information!',
        imageWidth: 400,
        imageHeight: 250,
        imageAlt: 'Custom image',
        html: '<font style="font-size: 12px;font-weight: 300;">Make sure the mandarory input is not empty. <br><b>Pay attention to the input label <font style="color: red">*</font></b></font>',
        showCloseButton: false,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText: 'OK'
      })
      return false;
    }
  }
  </script>

