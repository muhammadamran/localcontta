<?php

include "include/connection.php";
include "include/restrict.php";

if (isset($_POST["submit"])) {  
/*  //Import uploaded file to Database
  $handle   = fopen($_FILES['file']['tmp_name'], "r"); 
  while (($data = fgetcsv($handle, 100, ",")) !== FALSE) {
    $datenow  = date('Y-m-d H:i:s');
    //echo "<br>"."asdasd".$data['0']."-".$data['1'];
    $import="INSERT into tb_freight_master values(' ','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')";
    mysql_query($import) or die(mysql_error());*/

    $uploaddir = 'file/freight/';
    $uploadfile = $uploaddir.date('Y-m-d');

    $query = move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
    if ($query) {
      if (mysql_query("LOAD DATA LOCAL INFILE '$uploadfile'
        INTO TABLE tb_freight
        FIELDS TERMINATED BY ','
        LINES TERMINATED BY '\n'
        IGNORE 1 LINES")) {
        header("Location: ./iou_adm_freight.php");   //?ntf=1
      } else{
        echo "submit data failed";
      }
    } else {
      echo "moving data failed".mysql_error();
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
            <h1 class="page-header">Upload Freight</h1>
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
               <section class="content">
                <div class="row">
                  <div class="col-md-12">

                    <div class="box box-danger">
                      <div class="box-body">
                        <form name="postform" action=" " enctype='multipart/form-data' method="post">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                            <label align="center">upload the file :</label>
                            <input type="file" name="file" class="form-control" required/>                                                  
                          </div><!-- /.form group -->
                          <button type="submit" name="submit" value="submit" class="btn btn-block btn-warning">Upload</button>                        
                        </form>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->

                  </div><!-- /.col (left) -->
                </div><!-- /.row -->

              </section><!-- /.content -->
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
