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
          <h1 class="page-header">Daily Report - Record Details (Date : <?php echo $_GET['datenow'];?>)</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <p>
            <button onclick="goBack()" class="btn btn-default"> <i class="fa fa-step-backward"></i> BACK</button>
          </p>
          <script>
            function goBack() {
              window.history.back();
            }
          </script>
          <div class="panel panel-default">
            <div class="panel-heading">
              Record List
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="table-responsive">
                <?php 

                $us       = $_GET['us'];
                $type     = $_GET['type'];
                $datenow  = $_GET['datenow'];

                if ($us == 'pre1') {
                  ?>

                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <p>RECORD LIST BY RECEIVED DATE CIPL FILE</p>
                    <thead>
                      <tr>
                        <th>RcdID</th>
                        <th>KNREF/TN</th>
                        <th>AJU NO.</th>
                        <th>HBL</th>
                        <th>SHIPPER</th>
                        <th>CONSIGNEE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $con=mysqli_connect("localhost","root","","contta");
                      if (mysqli_connect_errno())
                      {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      }
                      $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_pre ON tb_master_impor.rcd_id=tb_imp_pre.rcd_id WHERE tb_imp_pre.pre_rcvd_cipl = '$datenow'");
                      if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result))
                        {
                          echo "<tr>";
                          echo "<td>" . $row['rcd_id'] . "</td>";
                          echo "<td>" . $row['rcd_ref'] . "</td>";                        
                          echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                          echo "<td>" . $row['rcd_hbl'] . "</td>";
                          echo "<td>" . $row['rcd_shipper'] . "</td>";               
                          echo "<td>" . $row['rcd_cnee'] . "</td>";

                          echo "</tr>";
                        }
                      }
                      mysqli_close($con);
                      ?>
                    </tbody>
                  </table>

                  <?php
                } elseif($us == 'pre2') {
                  ?>
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <p>RECORD LIST BY SEND DRAFT PIB</p>
                    <thead>
                      <tr>
                        <th>RcdID</th>
                        <th>KNREF/TN</th>
                        <th>AJU NO.</th>
                        <th>HBL</th>
                        <th>SHIPPER</th>
                        <th>CONSIGNEE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $con=mysqli_connect("localhost","root","","contta");
                      if (mysqli_connect_errno())
                      {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      }
                      $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_pre ON tb_master_impor.rcd_id=tb_imp_pre.rcd_id WHERE tb_imp_pre.pre_send_pib_draft = '$datenow'");
                      if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result))
                        {
                          echo "<tr>";
                          echo "<td>" . $row['rcd_id'] . "</td>";
                          echo "<td>" . $row['rcd_ref'] . "</td>";                        
                          echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                          echo "<td>" . $row['rcd_hbl'] . "</td>";
                          echo "<td>" . $row['rcd_shipper'] . "</td>";               
                          echo "<td>" . $row['rcd_cnee'] . "</td>";

                          echo "</tr>";
                        }
                      }
                      mysqli_close($con);
                      ?>
                    </tbody>
                  </table>
                  <?php
                } elseif ($us == 'pre3') {
                  ?>  
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <p>RECORD LIST BY RECEIVED PIB REVISION</p>
                    <thead>
                      <tr>
                        <th>RcdID</th>
                        <th>KNREF/TN</th>
                        <th>AJU NO.</th>
                        <th>HBL</th>
                        <th>SHIPPER</th>
                        <th>CONSIGNEE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $con=mysqli_connect("localhost","root","","contta");
                      if (mysqli_connect_errno())
                      {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      }
                      $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_pre ON tb_master_impor.rcd_id=tb_imp_pre.rcd_id WHERE tb_imp_pre.pre_rcvd_pib_rev = '$datenow'");
                      if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result))
                        {
                          echo "<tr>";
                          echo "<td>" . $row['rcd_id'] . "</td>";
                          echo "<td>" . $row['rcd_ref'] . "</td>";                        
                          echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                          echo "<td>" . $row['rcd_hbl'] . "</td>";
                          echo "<td>" . $row['rcd_shipper'] . "</td>";               
                          echo "<td>" . $row['rcd_cnee'] . "</td>";

                          echo "</tr>";
                        }
                      }
                      mysqli_close($con);
                      ?>
                    </tbody>
                  </table>
                  <?php
                } elseif ($us == 'pre4') {
                  ?>
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <p>RECORD LIST BY SEND PIB</p>
                    <thead>
                      <tr>
                        <th>RcdID</th>
                        <th>KNREF/TN</th>
                        <th>AJU NO.</th>
                        <th>HBL</th>
                        <th>SHIPPER</th>
                        <th>CONSIGNEE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $con=mysqli_connect("localhost","root","","contta");
                      if (mysqli_connect_errno())
                      {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      }
                      $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_pre ON tb_master_impor.rcd_id=tb_imp_pre.rcd_id WHERE tb_imp_pre.pre_send_pib = '$datenow'");
                      if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result))
                        {
                          echo "<tr>";
                          echo "<td>" . $row['rcd_id'] . "</td>";
                          echo "<td>" . $row['rcd_ref'] . "</td>";                        
                          echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                          echo "<td>" . $row['rcd_hbl'] . "</td>";
                          echo "<td>" . $row['rcd_shipper'] . "</td>";               
                          echo "<td>" . $row['rcd_cnee'] . "</td>";

                          echo "</tr>";
                        }
                      }
                      mysqli_close($con);
                      ?>
                    </tbody>
                  </table>
                  <?php
                } elseif ($us == 'pre5') {
                  ?>
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <p>RECORD LIST BY PIB CONFIRMATION DATE</p>
                    <thead>
                      <tr>
                        <th>RcdID</th>
                        <th>KNREF/TN</th>
                        <th>AJU NO.</th>
                        <th>HBL</th>
                        <th>SHIPPER</th>
                        <th>CONSIGNEE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $con=mysqli_connect("localhost","root","","contta");
                      if (mysqli_connect_errno())
                      {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      }
                      $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_pre ON tb_master_impor.rcd_id=tb_imp_pre.rcd_id WHERE tb_imp_pre.pre_create_pib = '$datenow'");
                      if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result))
                        {
                          echo "<tr>";
                          echo "<td>" . $row['rcd_id'] . "</td>";
                          echo "<td>" . $row['rcd_ref'] . "</td>";                        
                          echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                          echo "<td>" . $row['rcd_hbl'] . "</td>";
                          echo "<td>" . $row['rcd_shipper'] . "</td>";               
                          echo "<td>" . $row['rcd_cnee'] . "</td>";

                          echo "</tr>";
                        }
                      }
                      mysqli_close($con);
                      ?>
                    </tbody>
                  </table>
                  <?php                
                } elseif ($us == 'pre6') {
                  ?>
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <p>RECORD LIST BY TRANSMIT PIB DATE</p>
                    <thead>
                      <tr>
                        <th>RcdID</th>
                        <th>KNREF/TN</th>
                        <th>AJU NO.</th>
                        <th>HBL</th>
                        <th>SHIPPER</th>
                        <th>CONSIGNEE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $con=mysqli_connect("localhost","root","","contta");
                      if (mysqli_connect_errno())
                      {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      }
                      $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_clear ON tb_master_impor.rcd_id=tb_imp_clear.rcd_id WHERE tb_imp_clear.cle_trf_pib = '$datenow'");
                      if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result))
                        {
                          echo "<tr>";
                          echo "<td>" . $row['rcd_id'] . "</td>";
                          echo "<td>" . $row['rcd_ref'] . "</td>";                        
                          echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                          echo "<td>" . $row['rcd_hbl'] . "</td>";
                          echo "<td>" . $row['rcd_shipper'] . "</td>";               
                          echo "<td>" . $row['rcd_cnee'] . "</td>";

                          echo "</tr>";
                        }
                      }
                      mysqli_close($con);
                      ?>
                    </tbody>
                  </table>
                  <?php
                } elseif ($us == 'pre7') {
                  ?>
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <p>RECORD LIST BY PAID DUTY TAX</p>
                    <thead>
                      <tr>
                        <th>RcdID</th>
                        <th>KNREF/TN</th>
                        <th>AJU NO.</th>
                        <th>HBL</th>
                        <th>SHIPPER</th>
                        <th>CONSIGNEE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $con=mysqli_connect("localhost","root","","contta");
                      if (mysqli_connect_errno())
                      {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      }
                      $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_clear ON tb_master_impor.rcd_id=tb_imp_clear.rcd_id WHERE tb_imp_clear.cle_paid_duty_tax = '$datenow'");
                      if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result))
                        {
                          echo "<tr>";
                          echo "<td>" . $row['rcd_id'] . "</td>";
                          echo "<td>" . $row['rcd_ref'] . "</td>";                        
                          echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                          echo "<td>" . $row['rcd_hbl'] . "</td>";
                          echo "<td>" . $row['rcd_shipper'] . "</td>";               
                          echo "<td>" . $row['rcd_cnee'] . "</td>";

                          echo "</tr>";
                        }
                      }
                      mysqli_close($con);
                      ?>
                    </tbody>
                  </table>
                  <?php
                } elseif ($us == 'pre8') {
                  ?>
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <p>RECORD LIST BY BILLING DATE</p>
                    <thead>
                      <tr>
                        <th>RcdID</th>
                        <th>KNREF/TN</th>
                        <th>AJU NO.</th>
                        <th>HBL</th>
                        <th>SHIPPER</th>
                        <th>CONSIGNEE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $con=mysqli_connect("localhost","root","","contta");
                      if (mysqli_connect_errno())
                      {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      }
                      $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_clear ON tb_master_impor.rcd_id=tb_imp_clear.rcd_id WHERE tb_imp_clear.cle_billing = '$datenow'");
                      if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result))
                        {
                          echo "<tr>";
                          echo "<td>" . $row['rcd_id'] . "</td>";
                          echo "<td>" . $row['rcd_ref'] . "</td>";                        
                          echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                          echo "<td>" . $row['rcd_hbl'] . "</td>";
                          echo "<td>" . $row['rcd_shipper'] . "</td>";               
                          echo "<td>" . $row['rcd_cnee'] . "</td>";

                          echo "</tr>";
                        }
                      }
                      mysqli_close($con);
                      ?>
                    </tbody>
                  </table>
                  <?php
                } elseif ($us == 'pre9') {
                  ?>

                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <p>RECORD LIST BY SPJK DATE</p>
                    <thead>
                      <tr>
                        <th>RcdID</th>
                        <th>KNREF/TN</th>
                        <th>AJU NO.</th>
                        <th>HBL</th>
                        <th>SHIPPER</th>
                        <th>CONSIGNEE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $con=mysqli_connect("localhost","root","","contta");
                      if (mysqli_connect_errno())
                      {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      }
                      $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_clear ON tb_master_impor.rcd_id=tb_imp_clear.rcd_id WHERE tb_imp_clear.cle_spjk = '$datenow'");
                      if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result))
                        {
                          echo "<tr>";
                          echo "<td>" . $row['rcd_id'] . "</td>";
                          echo "<td>" . $row['rcd_ref'] . "</td>";                        
                          echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                          echo "<td>" . $row['rcd_hbl'] . "</td>";
                          echo "<td>" . $row['rcd_shipper'] . "</td>";               
                          echo "<td>" . $row['rcd_cnee'] . "</td>";

                          echo "</tr>";
                        }
                      }
                      mysqli_close($con);
                      ?>
                    </tbody>
                  </table>

                  <?php
                } elseif ($us == 'pre10') {
                  ?>


                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <p>RECORD LIST BY SPJM DATE</p>
                    <thead>
                      <tr>
                        <th>RcdID</th>
                        <th>KNREF/TN</th>
                        <th>AJU NO.</th>
                        <th>HBL</th>
                        <th>SHIPPER</th>
                        <th>CONSIGNEE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $con=mysqli_connect("localhost","root","","contta");
                      if (mysqli_connect_errno())
                      {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      }
                      $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_clear ON tb_master_impor.rcd_id=tb_imp_clear.rcd_id WHERE tb_imp_clear.cle_spjm = '$datenow'");
                      if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result))
                        {
                          echo "<tr>";
                          echo "<td>" . $row['rcd_id'] . "</td>";
                          echo "<td>" . $row['rcd_ref'] . "</td>";                        
                          echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                          echo "<td>" . $row['rcd_hbl'] . "</td>";
                          echo "<td>" . $row['rcd_shipper'] . "</td>";               
                          echo "<td>" . $row['rcd_cnee'] . "</td>";

                          echo "</tr>";
                        }
                      }
                      mysqli_close($con);
                      ?>
                    </tbody>
                  </table>
                  <?php
                } elseif ($us == 'pre11') {
                  ?>

                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <p>RECORD LIST BY SPPB DATE</p>
                    <thead>
                      <tr>
                        <th>RcdID</th>
                        <th>KNREF/TN</th>
                        <th>AJU NO.</th>
                        <th>HBL</th>
                        <th>SHIPPER</th>
                        <th>CONSIGNEE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $con=mysqli_connect("localhost","root","","contta");
                      if (mysqli_connect_errno())
                      {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      }
                      $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_clear ON tb_master_impor.rcd_id=tb_imp_clear.rcd_id WHERE tb_imp_clear.cle_sppb = '$datenow'");
                      if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result))
                        {
                          echo "<tr>";
                          echo "<td>" . $row['rcd_id'] . "</td>";
                          echo "<td>" . $row['rcd_ref'] . "</td>";                        
                          echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                          echo "<td>" . $row['rcd_hbl'] . "</td>";
                          echo "<td>" . $row['rcd_shipper'] . "</td>";               
                          echo "<td>" . $row['rcd_cnee'] . "</td>";

                          echo "</tr>";
                        }
                      }
                      mysqli_close($con);
                      ?>
                    </tbody>
                  </table>
                  <?php
                } elseif ($us == 'pre12') {
                 ?>

                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <p>RECORD LIST BY SUBMIT COO DATE</p>
                  <thead>
                    <tr>
                      <th>RcdID</th>
                      <th>KNREF/TN</th>
                      <th>AJU NO.</th>
                      <th>HBL</th>
                      <th>SHIPPER</th>
                      <th>CONSIGNEE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $con=mysqli_connect("localhost","root","","contta");
                    if (mysqli_connect_errno())
                    {
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_clear ON tb_master_impor.rcd_id=tb_imp_clear.rcd_id WHERE tb_imp_clear.cle_submit_coo = '$datenow'");
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['rcd_id'] . "</td>";
                        echo "<td>" . $row['rcd_ref'] . "</td>";                        
                        echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                        echo "<td>" . $row['rcd_hbl'] . "</td>";
                        echo "<td>" . $row['rcd_shipper'] . "</td>";               
                        echo "<td>" . $row['rcd_cnee'] . "</td>";

                        echo "</tr>";
                      }
                    }
                    mysqli_close($con);
                    ?>
                  </tbody>
                </table>

                <?php
              } elseif ($us == 'pre13') {
               ?>
               <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <p>RECORD LIST BY RECEIVED INV. VENDOR DATE</p>
                <thead>
                  <tr>
                    <th>RcdID</th>
                    <th>KNREF/TN</th>
                    <th>AJU NO.</th>
                    <th>HBL</th>
                    <th>SHIPPER</th>
                    <th>CONSIGNEE</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $con=mysqli_connect("localhost","root","","contta");
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }
                  $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_post ON tb_master_impor.rcd_id=tb_imp_post.rcd_id WHERE tb_imp_post.post_rcvd_inv_vendor = '$datenow'");
                  if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result))
                    {
                      echo "<tr>";
                      echo "<td>" . $row['rcd_id'] . "</td>";
                      echo "<td>" . $row['rcd_ref'] . "</td>";                        
                      echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                      echo "<td>" . $row['rcd_hbl'] . "</td>";
                      echo "<td>" . $row['rcd_shipper'] . "</td>";               
                      echo "<td>" . $row['rcd_cnee'] . "</td>";

                      echo "</tr>";
                    }
                  }
                  mysqli_close($con);
                  ?>
                </tbody>
              </table>
              <?php
            } elseif ($us == 'pre14') {
              ?>

              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <p>RECORD LIST BY CREATE BILLING DATE</p>
                <thead>
                  <tr>
                    <th>RcdID</th>
                    <th>KNREF/TN</th>
                    <th>AJU NO.</th>
                    <th>HBL</th>
                    <th>SHIPPER</th>
                    <th>CONSIGNEE</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $con=mysqli_connect("localhost","root","","contta");
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }
                  $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_post ON tb_master_impor.rcd_id=tb_imp_post.rcd_id WHERE tb_imp_post.post_billing_customer = '$datenow'");
                  if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result))
                    {
                      echo "<tr>";
                      echo "<td>" . $row['rcd_id'] . "</td>";
                      echo "<td>" . $row['rcd_ref'] . "</td>";                        
                      echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                      echo "<td>" . $row['rcd_hbl'] . "</td>";
                      echo "<td>" . $row['rcd_shipper'] . "</td>";               
                      echo "<td>" . $row['rcd_cnee'] . "</td>";

                      echo "</tr>";
                    }
                  }
                  mysqli_close($con);
                  ?>
                </tbody>
              </table>
              <?php
            } elseif ($us == 'pre15') {
              ?>
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <p>RECORD LIST BY SEND BILLING DATE</p>
                <thead>
                  <tr>
                    <th>RcdID</th>
                    <th>KNREF/TN</th>
                    <th>AJU NO.</th>
                    <th>HBL</th>
                    <th>SHIPPER</th>
                    <th>CONSIGNEE</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $con=mysqli_connect("localhost","root","","contta");
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }
                  $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_post ON tb_master_impor.rcd_id=tb_imp_post.rcd_id WHERE tb_imp_post.post_billing_send = '$datenow'");
                  if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result))
                    {
                      echo "<tr>";
                      echo "<td>" . $row['rcd_id'] . "</td>";
                      echo "<td>" . $row['rcd_ref'] . "</td>";                        
                      echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                      echo "<td>" . $row['rcd_hbl'] . "</td>";
                      echo "<td>" . $row['rcd_shipper'] . "</td>";               
                      echo "<td>" . $row['rcd_cnee'] . "</td>";

                      echo "</tr>";
                    }
                  }
                  mysqli_close($con);
                  ?>
                </tbody>
              </table>

              <?php
            } elseif ($us == 'pre16') {
              ?>
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <p>RECORD LIST BY FILLING DATE</p>
                <thead>
                  <tr>
                    <th>RcdID</th>
                    <th>KNREF/TN</th>
                    <th>AJU NO.</th>
                    <th>HBL</th>
                    <th>SHIPPER</th>
                    <th>CONSIGNEE</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $con=mysqli_connect("localhost","root","","contta");
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }
                  $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_imp_post ON tb_master_impor.rcd_id=tb_imp_post.rcd_id WHERE tb_imp_post.post_filling = '$datenow'");
                  if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result))
                    {
                      echo "<tr>";
                      echo "<td>" . $row['rcd_id'] . "</td>";
                      echo "<td>" . $row['rcd_ref'] . "</td>";                        
                      echo "<td>" . $row['rcd_aju'] . "</td>";                                                

                      echo "<td>" . $row['rcd_hbl'] . "</td>";
                      echo "<td>" . $row['rcd_shipper'] . "</td>";               
                      echo "<td>" . $row['rcd_cnee'] . "</td>";

                      echo "</tr>";
                    }
                  }
                  mysqli_close($con);
                  ?>
                </tbody>
              </table>
              <?php
            }
            ?>
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
