<script src="assets/js/jquery.min.js"></script> 
<?php
include "include/connection.php";
include "include/restrict.php";
include "include/datatables.php";

$con=mysqli_connect("localhost","root","","contta");
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$uid    = $_GET['user_id'];
$result = mysqli_query($con,"SELECT * FROM tb_user WHERE user_id ='$uid'");
$row = mysqli_fetch_array($result);

// EDIT
if(isset($_POST["edit"]))    
{    
  // Admin
  $cekRole =  $_POST['user_role_edit'];
  if ($cekRole == 'admin') {
    $email                = $_POST['admin_user_mail'];
    $role                 = $_POST['user_role_edit'];
    $scope                = $_POST['admin_scope_edit'];
    $department           = $_POST['admin_dept_edit'];

    $query = mysql_query("UPDATE tb_user SET user_mail='$email',
    										 user_role='$role',
    										 user_scope='$scope',
    										 user_dept='$department'
    										 WHERE user_id='$uid'");
    if($query) {
      header("Location: ./iou_adm_user.php?UpdateSuccess=true");                                         
    } else {
      header("Location: ./iou_adm_user.php?UpdateFailed=true");                                                  
    }
  // General Manager
  } else if ($cekRole == 'gm') {
    $email                = $_POST['gm_user_mail_edit'];
    $role                 = $_POST['user_role_edit'];
    $scope                = $_POST['gm_scope_edit'];
    $department           = $_POST['gm_dept_edit'];

    $query = mysql_query("UPDATE tb_user SET user_mail='$email',
    										 user_role='$role',
    										 user_scope='$scope',
    										 user_dept='$department'
    										 WHERE user_id='$uid'");
    if($query) {
      header("Location: ./iou_adm_user.php?UpdateSuccess=true");                                
    } else {
      header("Location: ./iou_adm_user.php?UpdateFailed=true");                                                  
    }
  // Manager
  } else if ($cekRole == 'manager') {
    $email                = $_POST['manager_user_mail_edit'];
    $role                 = $_POST['user_role_edit'];
    $scope                = $_POST['manager_scope_edit'];
    $department           = $_POST['manager_dept_edit'];

    $query = mysql_query("UPDATE tb_user SET user_mail='$email',
    										 user_role='$role',
    										 user_scope='$scope',
    										 user_dept='$department'
    										 WHERE user_id='$uid'");
    if($query) {
      header("Location: ./iou_adm_user.php?UpdateSuccess=true");                                            
    } else {
      header("Location: ./iou_adm_user.php?UpdateFailed=true");                                                  
    }
  // User
  } else if ($cekRole == 'user') {
    $email                = $_POST['user_user_mail_edit'];
    $role                 = $_POST['user_role_edit'];
    $scope                = $_POST['user_scope_edit'];
    $department           = $_POST['user_dept_edit'];

    $query = mysql_query("UPDATE tb_user SET user_mail='$email',
    										 user_role='$role',
    										 user_scope='$scope',
    										 user_dept='$department'
    										 WHERE user_id='$uid'");
    if($query) {
      header("Location: ./iou_adm_user.php?UpdateSuccess=true");                                      
    } else {
      header("Location: ./iou_adm_user.php?UpdateFailed=true");                                                  
    }
  // Guest
  } else if ($cekRole == 'guest') {
    $email                = $_POST['guest_user_mail_edit'];
    $role                 = $_POST['user_role_edit'];
    $scope                = $_POST['guest_scope_edit'];
    $department           = $_POST['guest_dept_edit'];

    $query = mysql_query("UPDATE tb_user SET user_mail='$email',
    										 user_role='$role',
    										 user_scope='$scope',
    										 user_dept='$department'
    										 WHERE user_id='$uid'");
    if($query) {
      header("Location: ./iou_adm_user.php?UpdateSuccess=true");                                              
    } else {
      header("Location: ./iou_adm_user.php?UpdateFailed=true");                                                  
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
						<li class="breadcrumb-item">Management Users</li>
						<li class="breadcrumb-item active" aria-current="page">Edit Users</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-table"></i> Management Users | <i class="fa fa-user"></i> <?= $row['user_name'];?>
					</div>
					<div class="panel-body">
						<form method="post" action=" ">
							<div class="modal-body">
								<!-- Read Only Edut -->
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>User Name</label>
											<input type="text" name="username" class="form-control" value="<?=$row['user_name'];?>" readonly>
											<input type="hidden" name="uid" value="<?=$row['user_id'];?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Current Role</label>
											<input type="text" name="cur_role" class="form-control" value="<?=$row['user_role'];?>"  readonly>
										</div>
									</div>
								</div>
								<!-- End Read Only Edit -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Choose New Role</label>                                  
											<div class="form-group">
												<select class="form-control" name="user_role_edit" id="input-role-edit" required>
													<option id="option_empty" value="">-- Select New User Role --</option>
													<option id="option_admin" value="admin">Administrator</option>
													<option id="option_gm" value="gm">General Manager</option>
													<option id="option_manager" value="manager">Manager</option>
													<option id="option_user" value="user">User</option>
													<option id="option_guest" value="guest">Guest</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<!-- Admin Scope and Department -->
								<div class="row" id="admin_input_edit" style="display:none;">
									<div class="col-md-6">
										<div class="form-group">
											<label>Scope</label>
											<input type="text" class="form-control" name="admin_scope_edit" value="all" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Department</label>
											<input type="text" class="form-control" name="admin_dept_edit" value="all" readonly>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-control" name="admin_user_mail_edit" placeholder="Input email..." value="<?= $row['user_mail'] ?>">
										</div>
									</div>
								</div>
								<!-- End Admin Scope and Department -->
								<!-- GM Scope and Department -->
								<div class="row" id="gm_input_edit" style="display:none;">
									<div class="col-md-6">
										<div class="form-group">
											<label>Scope</label>
											<input type="text" class="form-control" name="gm_scope_edit" value="all" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Department</label>
											<input type="text" class="form-control" name="gm_dept_edit" value="all" readonly>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-control" name="gm_user_mail_edit" placeholder="Input email..." value="<?= $row['user_mail'] ?>">
										</div>
									</div>
								</div>
								<!-- End GM Scope and Department -->
								<!-- Guest Scope and Department -->
								<div class="row" id="guest_input_edit" style="display:none;">
									<div class="col-md-6">
										<div class="form-group">
											<label>Scope</label>
											<input type="text" class="form-control" name="guest_scope_edit" value="all" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Department</label>
											<input type="text" class="form-control" name="guest_dept_edit" value="all" readonly>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-control" name="guest_user_mail_edit" placeholder="Input email..." value="<?= $row['user_mail'] ?>">
										</div>
									</div>
								</div>
								<!-- End Guest Scope and Department -->
								<!-- Manager Scope and Department -->
								<div class="row" id="manager_input_edit" style="display:none;">
									<div class="col-md-6">
										<div class="form-group">
											<label>Scope</label>
											<input type="text" class="form-control" name="manager_scope_edit" value="all" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Department</label>
											<select class="form-control" id="id_manager_dept_edit" name="manager_dept">
												<?php if ($row['user_dept'] == 'sea') { ?>
													<option value="<?= $row['user_dept'] ?>">Sea Freight</option>
												<?php } else if ($row['user_dept'] == 'air') { ?>
													<option value="<?= $row['user_dept'] ?>">Air Freight</option>
												<?php } ?>
												<option value="">-- Select User Role --</option>
												<option value="sea">Sea Freight</option>
												<option value="air">Air Freight</option>
											</select>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-control" name="manager_user_mail_edit" placeholder="Input email..." value="<?= $row['user_mail'] ?>">
										</div>
									</div>
								</div>
								<!-- End Manager Scope and Department -->
								<!-- User Scope and Department -->
								<div class="row" id="user_input_edit" style="display:none;">
									<div class="col-md-6">
										<div class="form-group">
											<label>Scope</label>
											<select class="form-control" id="id_user_scope" name="user_scope_edit">
												<?php if ($row['user_role'] == 'user') { ?>
													<option value="<?= $row['user_scope'] ?>"><?= $row['user_scope'] ?></option>
													<option value="">-- Select Scope --</option>
													<option value="import">Import</option>
													<option value="export">Export</option>
												<?php } else { ?>
													<option value="">-- Select Scope --</option>
													<option value="import">Import</option>
													<option value="export">Export</option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Department</label>
											<select class="form-control" id="id_user_dept" name="user_dept_edit">
												<?php if ($row['user_role'] == 'user' || $row['user_role'] == 'manager') { ?>
													<?php if ($row['user_dept'] == 'sea') { ?>
														<option value="<?= $row['user_dept'] ?>">Sea Freight</option>
													<?php } else if ($row['user_dept'] == 'air') { ?>
														<option value="<?= $row['user_dept'] ?>">Air Freight</option>
													<?php } ?>
													<option value="">-- Select Department --</option>
													<option value="sea">Sea Freight</option>
													<option value="air">Air Freight</option>
												<?php } else { ?>
													<option value="">-- Select Scope --</option>
													<option value="import">Import</option>
													<option value="export">Export</option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-control" name="user_user_mail_edit" placeholder="Input email..." value="<?= $row['user_mail'] ?>">
										</div>
									</div>
								</div>
								<!-- End User Scope and Department -->
							</div>
							<div class="modal-footer">
								<button type="submit" name="edit" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button>
								<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
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
<!-- Add, Edit, Validasi -->
<script type="text/javascript">
  // Edit
  $(function() {
  	$("#input-role-edit").change(function() {
  		if ($(this).val() == "admin") {
  			$("#admin_input_edit").show();
  			$("#gm_input_edit").hide();
  			$("#guest_input_edit").hide();
  			$("#manager_input_edit").hide();
  			$("#user_input_edit").hide();
  		} else if ($(this).val() == "gm") {
  			$("#gm_input_edit").show();
  			$("#admin_input_edit").hide();
  			$("#guest_input_edit").hide();
  			$("#manager_input_edit").hide();
  			$("#user_input_edit").hide();
  		} else if ($(this).val() == "guest") {
  			$("#guest_input_edit").show();
  			$("#admin_input_edit").hide();
  			$("#gm_input_edit").hide();
  			$("#manager_input_edit").hide();
  			$("#user_input_edit").hide();
  		} else if ($(this).val() == "manager") {
  			$("#manager_input_edit").show();
  			$("#admin_input_edit").hide();
  			$("#gm_input_edit").hide();
  			$("#guest_input_edit").hide();
  			$("#user_input_edit").hide();
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
  			$("#user_input_edit").show();
  			$("#admin_input_edit").hide();
  			$("#gm_input_edit").hide();
  			$("#guest_input_edit").hide();
  			$("#manager_input_edit").hide();  
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
  			$("#admin_input_edit").hide();
  			$("#gm_input_edit").hide();
  			$("#guest_input_edit").hide();
  			$("#manager_input_edit").hide();
  			$("#user_input_edit").hide();
  		}
  	});
  });
</script>
<!-- End Add, Edit, Validasi -->