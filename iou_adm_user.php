<script src="assets/js/jquery.min.js"></script> 
<?php
include "include/connection.php";
include "include/restrict.php";
include "include/datatables.php";

// ADD
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
  // General Manager
  } else if ($cekRole == 'gm') {
    $username             = $_POST['gm_user_name'];
    $password             = 'changeme';
    $email                = $_POST['gm_user_mail'];
    $role                 = $_POST['user_role'];
    $scope                = $_POST['gm_scope'];
    $department           = $_POST['gm_dept'];

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
  // Manager
  } else if ($cekRole == 'manager') {
    $username             = $_POST['manager_user_name'];
    $password             = 'changeme';
    $email                = $_POST['manager_user_mail'];
    $role                 = $_POST['user_role'];
    $scope                = $_POST['manager_scope'];
    $department           = $_POST['manager_dept'];

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
  // User
  } else if ($cekRole == 'user') {
    $username             = $_POST['user_user_name'];
    $password             = 'changeme';
    $email                = $_POST['user_user_mail'];
    $role                 = $_POST['user_role'];
    $scope                = $_POST['user_scope'];
    $department           = $_POST['user_dept'];

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
  // Guest
  } else if ($cekRole == 'guest') {
    $username             = $_POST['guest_user_name'];
    $password             = 'changeme';
    $email                = $_POST['guest_user_mail'];
    $role                 = $_POST['user_role'];
    $scope                = $_POST['guest_scope'];
    $department           = $_POST['guest_dept'];

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
}
// EDIT
if(isset($_POST["edit"]))
{

}
// DELETE
if(isset($_POST["delete"]))    
{
  $ID             = $_POST['uid'];

  $query = mysql_query("DELETE FROM tb_user WHERE user_id='$ID'");

  if($query) {
    header("Location: ./iou_adm_user.php?DeleteSuccess=true");                                                  
  } else {
    // echo "Updated Failed - Please contact your administrator".mysql_error();
    header("Location: ./iou_adm_user.php?DeleteFailed=true");                                                  
  }
}
// DELETE ALL
if(isset($_POST['chk_id']))
{
    $arr = $_POST['chk_id'];
    foreach ($arr as $id) {
        $query = mysql_query("DELETE FROM tb_user WHERE user_id='$id'");
    }

    if($query) {
    header("Location: ./iou_adm_user.php?DeleteSuccess=true");                                                  
    } else {
      // echo "Updated Failed - Please contact your administrator".mysql_error();
      header("Location: ./iou_adm_user.php?DeleteFailed=true");                                                  
    }
}
// UPDATE
if(isset($_POST["change_pass"]))    
{ 
  $cek_ = $_POST['mustbe_change'];
  if ($cek_ == '1') { 
    $ID                  = $_POST['uid'];
    $user_pass           = $_POST['new_pass'];
    $user_pass_update    = date('Y-m-d h:m:i');
    $user_pass_update_by = $_POST['user_pass_update_by'];
    $mustbe_change       = '1';


    $query = mysql_query("UPDATE tb_user SET user_pass='$user_pass',
                                             user_pass_update= '$user_pass_update',
                                             user_pass_update_by= '$user_pass_update_by',
                                             mustbe_change= '$mustbe_change'
                                             WHERE user_id=$ID");

    if($query) {
      header("Location: ./iou_adm_user.php?UpdatePassSuccess=true");                                      
    } else {
      header("Location: ./iou_adm_user.php?UpdatePassFailed=true");                                                  
    }
  } else {
    $ID                  = $_POST['uid'];
    $user_pass           = $_POST['new_pass'];
    $user_pass_update    = date('Y-m-d h:m:i');
    $user_pass_update_by = $_POST['user_pass_update_by'];

    $query = mysql_query("UPDATE tb_user SET user_pass='$user_pass',
                                             user_pass_update= '$user_pass_update',
                                             user_pass_update_by= '$user_pass_update_by'
                                             WHERE user_id=$ID");

    if($query) {
      header("Location: ./iou_adm_user.php?UpdatePassSuccess=true");                                       
    } else {
      header("Location: ./iou_adm_user.php?UpdatePassFailed=true");                                                  
    }
  }
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
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- End Add Users -->
            </div>
             <form action="iou_adm_user.php" method="post">
              <div style="margin-bottom: 15px;">
                <input id="submit" name="submit" type="submit" class="btn btn-sm btn-danger" value="Delete Selected" />
              </div>
              <div class="table-responsive">
                <table class="display hover" id="users">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th class="no-sort" style="text-align: center;">
                        <input id="chk_all" name="chk_all" type="checkbox"/>
                      </th>
                      <th style="text-align: center;">Username</th>
                      <th style="text-align: center;">Password</th>
                      <th style="text-align: center;">Role</th>
                      <th style="text-align: center;">Scope</th>
                      <th style="text-align: center;">Department</th>
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
                    $me = $_SESSION['username'];
                    $result = mysqli_query($con,"SELECT * FROM tb_user ORDER BY user_name ASC");
                    if(mysqli_num_rows($result)>0){
                      $no=0;
                      while($row = mysqli_fetch_array($result))
                      {
                        $no++;
                        if($row['user_name'] == $me) {
                          $show_btn = 'disabled';
                          $modal_btn = 'disabled';
                        } else {
                          $show_btn = '';
                          $modal_btn = 'modal';
                        }

                        echo "<tr>";
                        echo "<td>" . $no . ".</td>";
                        echo "<td style='text-align: center;'>
                              <input name='chk_id[]' type='checkbox' class='chkbox' value='".$row['user_id']."'/ $show_btn>
                              </td>";
                        echo "<td>" . $row['user_name'] . "</td>";
                        if ($row['user_pass'] == 'changeme') {
                          echo "<td style='text-align: center;'>
                                <span title='Password: changeme'>
                                  <font style='background: #55b8f2;padding: 5px;border-radius: 5px;font-size: 12px;color: #000;'><i class='fa fa-eye'></i> Default</font>
                                </span>
                               </td>";
                        } else {
                          echo "<td style='text-align: center;'>
                               <font style='font-size: 12px;color: #000;'>" . $row['user_pass'] . "</font>
                               <br>
                               <font style='font-size: 10px;font-weight: 300;'><i>Log: " . $row['user_pass_update'] . "</i></font>
                               <br>
                               <font style='font-size: 10px;font-weight: 300;'><i>By: " . $row['user_pass_update_by'] . "</i></font>
                               </td>";
                        }
                        echo "<td style='text-align: center;'>" . $row['user_role'] . "</td>";
                        echo "<td style='text-align: center;'>" . $row['user_scope'] . "</td>";
                        echo "<td style='text-align: center;'>" . $row['user_dept'] . "</td>";
                        echo "<td style='text-align: center;'>
                        <a href='#' data-toggle='".$modal_btn."' data-target='#edit$row[user_id]' title='Edit'>
                        <span class='btn btn-sm btn-warning' $show_btn>
                        <i class='fa fa-pencil'></i>
                        </span>
                        </a>
                        <a href='#' data-toggle='".$modal_btn."' data-target='#pass$row[user_id]' title='Change Password'>
                        <span class='btn btn-sm btn-change $show_btn'>
                        <i class='fa fa-unlock'></i>
                        </span>
                        </a>
                        <a href='#' data-toggle='".$modal_btn."' data-target='#delete$row[user_id]' title='Delete'>
                        <span class='btn btn-sm btn-danger' $show_btn>
                        <i class='fa fa-trash'></i>
                        </span>
                        </a>
                        </td>";
                        echo "</tr>";
                        ?>
                        <div class="modal fade" id="edit<?=$row['user_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[Edit Users]</b> Management Users</h4>
                              </div>
                              <form method="post" action=" ">
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" name="username" class="form-control" placeholder="client name" value="<?=$row['user_name'];?>" required readonly>
                                    <input type="hidden" name="uid" class="form-control" placeholder="client name" value="<?=$row['user_id'];?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label>User Role</label>                                  
                                    <div class="form-group">
                                      <p><i> New Role </i> </p>
                                      <select name="role_new" class="form-control">
                                        <option style="background-color: yellow;" value="<?=$row['user_role'];?>"><?=$row['user_role'];?></option>
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
                                        <option style="background-color: yellow;" value="<?=$row['user_region'];?>"><?=$row['user_region'];?></option>
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
                                        <option style="background-color: yellow;" value="<?=$row['user_dept'];?>"><?=$row['user_dept'];?></option>
                                        <option value=" ">--- SELECT ---</option>
                                        <option value="ALL">ALL</option>
                                        <option value="AIR">AIR</option>
                                        <option value="SEA">SEA</option>
                                      </select>
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

                        <div class="modal fade" id="pass<?=$row['user_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[Change Password]</b> Management Users</h4>
                              </div>
                              <form method="post" action=" ">
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" name="username" class="form-control" placeholder="client name" value="<?=$row['user_name'];?>" required readonly>
                                    <input type="hidden" name="uid" class="form-control" placeholder="client name" value="<?=$row['user_id'];?>" required>
                                  </div>
                                  <div class="form-group" id="new_pass" style="display: show;">
                                    <label>New Password <font style="color: red;">*</font></label>
                                    <input type="password" name="new_pass" id="password-field" class="form-control" placeholder="New password" required>
                                    <!-- Icon Eye -->
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    <!-- End Icon Eye -->
                                    <input type="hidden" name="uid" value="<?= $row['user_id'];?>">
                                    <input type="hidden" name="user_pass_update_by" value="<?= $_SESSION['username'];?>">
                                  </div>
                                  <div class="form-group">
                                    <input id="mustbe_change" type="checkbox"  name="mustbe_change" value="1">
                                    <label for="mustbe_change">
                                        <font style="font-weight: 400">Click if the user must update the password after sign in.</font>
                                    </label>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" name="change_pass" class="btn btn-change"><i class="fa fa-unlock"></i> Change Password</button>
                                  <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- Delete -->
                        <div class="modal fade" id="delete<?=$row['user_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[Delete Users] </b> Management User</h4>
                              </div>
                              <form method="post" action=" ">
                                <div class="modal-body">
                                    <div class="form-group">
                                      <label>Are you sure delete this user?</label>
                                      <h6>User Name : <?=$row['user_name'];?></h6>
                                      <input type="hidden" name="uid" class="form-control" placeholder="client name" value="<?=$row['user_id'];?>" required>
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
            </form>
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
  $(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#chk_all').click(function(){
        if(this.checked)
            $(".chkbox").prop("checked", true);
        else
            $(".chkbox").prop("checked", false);
    });
});

$(document).ready(function(){
    $('#delete_form').submit(function(e){
        if(!confirm("Confirm Delete?")){
            e.preventDefault();
        }
    });
});
</script>
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

