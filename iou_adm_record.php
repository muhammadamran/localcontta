<?php

include "include/connection.php";
include "include/restrict.php";

if(isset($_POST['delete']))
{

$rcd_id       = $_POST['rcd_id'];
$user_name    = $_POST['user_name'];
$date_now     = date('Y-m-d H:i:s');

if($rcd_id){
        $query = mysql_query("DELETE FROM tb_master_impor WHERE rcd_id = '$rcd_id' ");
        $query .= mysql_query("DELETE FROM tb_imp_pre WHERE rcd_id = '$rcd_id' ");
        $query .= mysql_query("DELETE FROM tb_imp_clear WHERE rcd_id = '$rcd_id' ");
        $query .= mysql_query("DELETE FROM tb_imp_post WHERE rcd_id = '$rcd_id' ");
        $query .= mysql_query("DELETE FROM tb_record_miles_import WHERE rcd_id = '$rcd_id' ");
        $query .= mysql_query("DELETE FROM tb_truck_assign WHERE rcd_id = '$rcd_id' ");
        $query .= mysql_query("INSERT into tb_log values(' ','$user_name','delete-main-record','$date_now','$rcd_id')");
            if($query){
                 header("Location: ./iou_adm_record.php?ref=000x00001");                    
            } else {
                echo "Operation Failed! Please contact your administrator".mysql_error();
            }
    } else {
        echo "Operation Failed! Please contact your administrator".mysql_error();
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
          <h1 class="page-header">Record Management</h1>
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
              <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <label>Input KN.REF/TN No.</label>
                      <div class="row">            
                        <form action="" method="get">
                          <div class="form-group col-md-6">
                            <input type="text" name="ref" class="form-control" required>
                          </div>
                          <div class="col-md-3">
                            <button type="submit" name="search" value="search" class="btn btn-primary">Search!</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>                      
                      <th>id</th>
                      <th>create_date</th>
                      <th>create_month</th>
                      <th>create_year</th>
                      <th>create_by</th>
                      <th>type</th>
                      <th>hbl</th>
                      <th>shipper</th>
                      <th>cnee</th>
                      <th>inv_no</th>
                      <th>aju</th>
                      <th>ref</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $ref = $_GET['ref'];                    
                    $con=mysqli_connect("localhost","root","","contta");
                    $result = mysqli_query($con,"SELECT * FROM tb_master_impor WHERE rcd_ref = '$ref'");                    
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                          echo "<td>" . $row['rcd_id'] . "</td>"; 
                          echo "<td>" . $row['rcd_create_date'] . "</td>"; 
                          echo "<td>" . $row['rcd_create_month'] . "</td>"; 
                          echo "<td>" . $row['rcd_create_year'] . "</td>"; 
                          echo "<td>" . $row['rcd_create_by'] . "</td>"; 
                          echo "<td>" . $row['rcd_type'] . "</td>"; 
                          echo "<td>" . $row['rcd_hbl'] . "</td>"; 
                          echo "<td>" . $row['rcd_shipper'] . "</td>"; 
                          echo "<td>" . $row['rcd_cnee'] . "</td>"; 
                          echo "<td>" . $row['rcd_inv_no'] . "</td>"; 
                          echo "<td>" . $row['rcd_aju'] . "</td>";
                          echo "<td>" . $row['rcd_ref'] . "</td>";
                          echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#select$row[rcd_id]'><span class='label label-primary'>delete</span></a>
                        </td>";             
                        echo "</tr>";
                        ?>
                        <div class="modal fade" id="select<?php echo $row['rcd_id'];?>" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>[RecordManage] </b> Delete Record</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" action=" ">
                                  <div class="form-group">
                                    <label>Are you sure to delete all details of this record?</label>
                                    <input type="hidden" name="rcd_id" class="form-control" value="<?php echo $row['rcd_id'];?>">
                                    <input type="hidden" name="user_name" class="form-control" value="<?php echo $_SESSION['username'];?>">
                                  </div>
                                  <button type="submit" name="delete" value="delete" class="btn btn-default">Yes</button>
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
