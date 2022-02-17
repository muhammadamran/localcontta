<?php

include "include/connection.php";
include "include/restrict.php";
include "include/datatables.php";

if(isset($_POST["create"]))    
{    

  $user_name            = $_POST['user_name'];
  $user_pass            = $_POST['user_pass'];
  $email                = $_POST['email'];
  $role                 = $_POST['role'];

  $query = mysql_query("INSERT into tb_user values(' ','$user_name','$user_pass','$email','$role')");

  if($query){
    header("Location: ./iou_adm_user.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
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
                      <span class='btn btn-sm btn-primary'>
                      <i class='fa fa-pencil'></i>
                      </span>
                      </a>
                      <a href='#' data-toggle='modal' data-target='#pass$row[user_id]' title='Change Password'>
                      <span class='btn btn-sm btn-primary'>
                      <i class='fa fa-unlock'></i>
                      </span>
                      </a>
                      <a href='#' data-toggle='modal' data-target='#delete$row[user_id]' title='Delete'>
                      <span class='btn btn-sm btn-primary'>
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

