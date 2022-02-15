<?php

include "include/connection.php";
include "include/restrict.php";

if(isset($_POST["create"]))    
{    

  $user_name            = $_POST['cname'];
  $caddress             = $_POST['caddress'];
  $email                = $_POST['cemail'];
  $regby                = $_POST['regby'];

  $regdate              = date('Y-m-d H:i:s');

  $query = mysql_query("INSERT into tb_cnee values(' ','$user_name','$caddress','$email','$regdate','$regby')");

  if($query){
    header("Location: ./iou_adm_cnee.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
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
          <h1 class="page-header">Consignee</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              Consignee List
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="well">
                <h4>Create New Consignee</h4>
                <a class="btn btn-block btn-default" data-toggle="modal" data-target="#myModal">CREATE!</a>
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
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Cnee Name</label>
                                <input type="text" name="cname" class="form-control" placeholder="" required>
                              </div>
                              <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="caddress" class="form-control" placeholder="" required>
                                <input type="hidden" name="regby" class="form-control" value="<?php echo $_SESSION['username'] ;?>">
                              </div>
                              <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" name="cemail" required>
                                  <option value="">---select---</option>
                                  <option value="import">import</option>
                                  <option value="export">export</option>
                                </select>
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
                      <th>CID</th>
                      <th>Cnee Name</th>
                      <th>Address</th>                      
                      <th>CneeType</th>    
                      <th>Regby</th>                  
                      <th>RegDate</th>
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
                    $result = mysqli_query($con,"SELECT * FROM tb_cnee");
                    if(mysqli_num_rows($result)>0){

                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['user_name'] . "</td>";
                        echo "<td>" . $row['user_address'] . "</td>";
                        echo "<td>" . $row['type'] . "</td>";       
                        echo "<td>" . $row['regby'] . "</td>";       
                        echo "<td>" . $row['regdate'] . "</td>";                                        
                        echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#edit$row[user_id]' title='Edit'><span class='label label-primary'>Edit</span></a>
                        <a href='#' data-toggle='modal' data-target='#delete$row[user_id]' title='Delete'><span class='label label-primary'>Delete</span></a>
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
