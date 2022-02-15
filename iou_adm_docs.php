<?php

include "include/connection.php";
include "include/restrict.php";

if(isset($_POST["create"]))    
{    

  $dname            = $_POST['dname'];

  $query = mysql_query("INSERT into tb_docs_type values(' ','$dname')");

  if($query){
    header("Location: ./iou_adm_docs.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST['delete']))
{

  $rcdid                = $_POST['uid'];

  $query = mysql_query("DELETE FROM tb_docs_type WHERE dtype_id = '$rcdid' ");

  if($query){
   header("Location: ./iou_adm_docs.php");                    
 } else {
  echo "Operation Failed! Please contact your administrator".mysql_errno();
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
          <h1 class="page-header">Document Type</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              Docs List
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="well">
                <h4>Create New Record</h4>
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
                                <label>Docs Name</label>
                                <input type="text" name="dname" class="form-control" placeholder="" required>
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
                      <th>Docs ID</th>
                      <th>Docs Name</th>                    
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
                    $result = mysqli_query($con,"SELECT * FROM tb_docs_type");
                    if(mysqli_num_rows($result)>0){

                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['dtype_id'] . "</td>";
                        echo "<td>" . $row['dtype_name'] . "</td>";                                      
                        echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#delete$row[dtype_id]' title='Delete'><span class='label label-primary'>Delete</span></a>
                        </td>";
                        echo "</tr>";
                        ?>

                        <div class="modal fade" id="delete<?php echo $row['dtype_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[docs List] </b> Delete User</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" action=" ">
                                  <div class="form-group">
                                    <label>Are you sure delete this docs record?</label>
                                    <h6>User Name : <?php echo $row['dtype_name'];?></h6>
                                    <input type="hidden" name="uid" class="form-control" placeholder="client name" value="<?php echo $row['dtype_id'];?>" required>
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
