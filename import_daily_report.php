<?php

include "include/connection.php";
include "include/restrict.php";

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
          <h1 class="page-header">Daily Report</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <p>Input the parameter to run the query</p>
              <div class="row">            
                <form action="" method="get">
                  <div class="form-group col-md-4">
                    <input type="date" name="datenow" class="form-control">
                  </div>
                  <div class="col-md-4">
                    <button type="submit" name="search" value="search" class="btn btn-primary">Search!</button>
                  </div>
                </form>
              </div>
            </div>

            <!-- VALIDATION START TO SHOW DATA -->
            <?php 
            if ($_GET['datenow'] == 0) {
              echo "<br>";
              echo "No Data Available! Please input Month and Year parameter to execute the query process.";
              echo "<hr>";
            } else {
              $datenow = $_GET['datenow'];
              ?>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="alert alert-info">
                  (Data) - Date : <?php echo $_GET['datenow'];?>
                </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        Pre Clearance Section
                      </div>
                      <div class="panel-body">
                        <div class="col-lg-12">
                          <?php
                          mysql_connect('localhost', 'root','');
                          mysql_select_db('contta');
                          $pre1 = mysql_query("SELECT pre_rcvd_cipl FROM tb_imp_pre WHERE pre_rcvd_cipl = '$datenow'");
                          $pre1up = mysql_num_rows($pre1);                              
                          ?>
                          <div class="alert alert-info">
                            Received CIPL : <a href="import_daily_report_detail.php?us=pre1&type=pre_rcvd_cipl&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre1up;?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <?php
                          $pre2 = mysql_query("SELECT pre_send_pib_draft FROM tb_imp_pre WHERE pre_send_pib_draft = '$datenow'");
                          $pre2up = mysql_num_rows($pre2);                              
                          ?>
                          <div class="alert alert-info">
                            Send Draft PIB : <a href="import_daily_report_detail.php?us=pre2&type=pre_send_pib_draft&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre2up;?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <?php
                          $pre3 = mysql_query("SELECT pre_rcvd_pib_rev FROM tb_imp_pre WHERE pre_rcvd_pib_rev = '$datenow'");
                          $pre3up = mysql_num_rows($pre3);                              
                          ?>
                          <div class="alert alert-info">
                            Received PIB Revision : <a href="import_daily_report_detail.php?us=pre3&type=pre_send_pib_draft&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre3up;?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <?php
                          $pre4 = mysql_query("SELECT pre_send_pib FROM tb_imp_pre WHERE pre_send_pib = '$datenow'");
                          $pre4up = mysql_num_rows($pre4);                              
                          ?>
                          <div class="alert alert-info">
                            Send PIB : <a href="import_daily_report_detail.php?us=pre4&type=pre_send_pib_draft&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre4up;?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <?php
                          $pre5 = mysql_query("SELECT pre_create_pib FROM tb_imp_pre WHERE pre_create_pib = '$datenow'");
                          $pre5up = mysql_num_rows($pre5);                              
                          ?>
                          <div class="alert alert-info">
                            PIB Confirmation : <a href="import_daily_report_detail.php?us=pre5&type=pre_create_pib&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre5up;?></a>
                          </div>
                        </div>                    
                      </div>
                    </div>
                    <!-- /.col-lg-4 -->
                  </div>

                  <div class="col-lg-4">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                      Clearance Section
                      </div>
                      <div class="panel-body">
                        <div class="col-lg-12">
                          <?php
                          mysql_connect('localhost', 'root','');
                          mysql_select_db('contta');
                          $pre6 = mysql_query("SELECT cle_trf_pib FROM tb_imp_clear WHERE cle_trf_pib = '$datenow'");
                          $pre6up = mysql_num_rows($pre6);                              
                          ?>
                          <div class="alert alert-info">
                            Transfer PIB : <a href="import_daily_report_detail.php?us=pre6&type=pre_send_pib_draft&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre6up;?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <?php
                          $pre7 = mysql_query("SELECT cle_paid_duty_tax FROM tb_imp_clear WHERE cle_paid_duty_tax = '$datenow'");
                          $pre7up = mysql_num_rows($pre7);                              
                          ?>
                          <div class="alert alert-info">
                            Paid Duty Tax <a href="import_daily_report_detail.php?us=pre7&type=pre_send_pib_draft&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre7up;?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <?php
                          $pre8 = mysql_query("SELECT cle_billing FROM tb_imp_clear WHERE cle_billing = '$datenow'");
                          $pre8up = mysql_num_rows($pre8);                              
                          ?>
                          <div class="alert alert-info">
                            Billing : <a href="import_daily_report_detail.php?us=pre8&type=pre_send_pib_draft&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre8up;?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <?php
                          $pre9 = mysql_query("SELECT cle_spjk FROM tb_imp_clear WHERE cle_spjk = '$datenow'");
                          $pre9up = mysql_num_rows($pre9);                              
                          ?>
                          <div class="alert alert-info">
                            SPJK : <a href="import_daily_report_detail.php?us=pre9&type=pre_send_pib_draft&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre9up;?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <?php
                          $pre10 = mysql_query("SELECT cle_spjm FROM tb_imp_clear WHERE cle_spjm = '$datenow'");
                          $pre10up = mysql_num_rows($pre10);                              
                          ?>
                          <div class="alert alert-info">
                            SPJM : <a href="import_daily_report_detail.php?us=pre10&type=pre_send_pib_draft&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre10up;?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <?php
                          $pre11 = mysql_query("SELECT cle_sppb FROM tb_imp_clear WHERE cle_sppb = '$datenow'");
                          $pre11up = mysql_num_rows($pre11);                              
                          ?>
                          <div class="alert alert-info">
                            SPPB : <a href="import_daily_report_detail.php?us=pre11&type=pre_send_pib_draft&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre11up;?></a>
                          </div>
                        </div> 
                        <div class="col-lg-12">
                          <?php
                          $pre12 = mysql_query("SELECT cle_submit_coo FROM tb_imp_clear WHERE cle_submit_coo = '$datenow'");
                          $pre12up = mysql_num_rows($pre12);                              
                          ?>
                          <div class="alert alert-info">
                            SUBMIT COO : <a href="import_daily_report_detail.php?us=pre12&type=pre_send_pib_draft&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre12up;?></a>
                          </div>
                        </div>                    
                      </div>
                    </div>
                    <!-- /.col-lg-4 -->
                  </div>

                  <div class="col-lg-4">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        Post Clearance Section
                      </div>
                      <div class="panel-body">
                        <div class="col-lg-12">
                          <?php
                          mysql_connect('localhost', 'root','');
                          mysql_select_db('contta');
                          $pre13 = mysql_query("SELECT post_rcvd_inv_vendor FROM tb_imp_post WHERE post_rcvd_inv_vendor = '$datenow'");
                          $pre13up = mysql_num_rows($pre13);                              
                          ?>
                          <div class="alert alert-info">
                            Received Inv. Vendor : <a href="import_daily_report_detail.php?us=pre13&type=pre_send_pib_draft&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre13up;?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <?php
                          $pre14 = mysql_query("SELECT post_billing_customer FROM tb_imp_post WHERE post_billing_customer = '$datenow'");
                          $pre14up = mysql_num_rows($pre14);                              
                          ?>
                          <div class="alert alert-info">
                            Create Billing : <a href="import_daily_report_detail.php?us=pre14&type=pre_send_pib_draft&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre14up;?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <?php
                          $pre15 = mysql_query("SELECT post_billing_send FROM tb_imp_post WHERE post_billing_send = '$datenow'");
                          $pre15up = mysql_num_rows($pre15);                              
                          ?>
                          <div class="alert alert-info">
                            Send Billing : <a href="import_daily_report_detail.php?us=pre15&type=pre_send_pib_draft&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre15up;?></a>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <?php
                          $pre16 = mysql_query("SELECT post_filling FROM tb_imp_post WHERE post_filling = '$datenow'");
                          $pre16up = mysql_num_rows($pre16);                              
                          ?>
                          <div class="alert alert-info">
                            Filling : <a href="import_daily_report_detail.php?us=pre16&type=pre_send_pib_draft&datenow=<?php echo $_GET['datenow'];?>" class="alert-link"><?php echo $pre16up;?></a>
                          </div>
                        </div>                   
                      </div>
                    </div>
                    <!-- /.col-lg-4 -->
                  </div>
                </div>

            </div>

          <?php } ?>
          <!-- END OF VALIDATTION FOR DISPLAYING THE DATA -->

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
