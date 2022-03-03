<script src="assets/js/jquery.min.js"></script> 
<?php
include "include/connection.php";
include "include/restrict.php";
include "include/datatables.php";


// FUNCTION SEARCHING
$findInputREFTN = '';
$findInputTypeREFTN = '';
$resultreftn = 'none';
if(isset($_GET['findone']))
{
  $findInputREFTN = $_GET['findInputREFTN'];
  $findInputTypeREFTN = $_GET['findInputTypeREFTN'];
  $resultreftn = 'show';
}

$findInputAJU = '';
$findInputTypeAJU = '';
$resultaju = 'none';
if(isset($_GET['findtwo']))
{
  $findInputAJU = $_GET['findInputAJU'];
  $findInputTypeAJU = $_GET['findInputTypeAJU'];
  $resultaju = 'show';
}
?>
<?php include 'include/head.php';?>
<div id="wrapper">
  <?php include 'include/header.php';?>
  <div id="page-wrapper">
    <!-- Page -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          <i class="fa fa-search icon-title"></i> Search
        </h1>
        <nav aria-label="breadcrumb" role="navigation">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Search</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- End Page -->
    <!-- Search -->
    <div class="row">
      <div class="col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fas fa-filter"></i> Filter Data - by
            <select type="text" id="findby" style="background: transparent;border-color: transparent;">
              <option value="opone">REF/TN</option>
            </select>
          </div>
          <div class="panel-body">
            <div class="page-add">
              <form method="get" action="search.php" id="fformone" style="display: show;">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Ref / Tn </label>
                      <?php if ($findInputREFTN == '') { ?>
                        <input type="text" name="findInputREFTN" id="idfindInputREFTN" class="form-control" placeholder="Input Ref / Tn...">
                      <?php } else { ?>
                        <input type="text" name="findInputREFTN" id="idfindInputREFTN" class="form-control" placeholder="Input Ref / Tn..." value="<?= $findInputREFTN; ?>">
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Type</label>
                      <select type="text" name="findInputTypeREFTN" id="idfindInputTypeREFTN" class="form-control">
                        <?php if ($findInputTypeREFTN == '') { ?>
                        <option value="">-- Select Type --</option>
                        <?php } else { ?>
                        <option value="<?= $findInputTypeREFTN; ?>"><?= $findInputTypeREFTN; ?></option>
                        <option value="">-- Select Type --</option>
                        <?php } ?>
                        <option value="import">Import</option>
                        <option value="export">Export</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12" style="text-align: right;">
                    <a href="search.php" type="button" class="btn btn-info"><i class="fas fa-redo"></i> Reset</a>
                    <button type="submit" name="findone" id="idbtnfindone" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fas fa-filter"></i> Filter Data - by
            <select type="text" id="findby" style="background: transparent;border-color: transparent;">
              <option value="opone">Aju</option>
            </select>
          </div>
          <div class="panel-body">
            <div class="page-add">
              <form method="get" action="search.php" id="fformone" style="display: show;">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Aju </label>
                      <?php if ($findInputAJU == '') { ?>
                        <input type="text" name="findInputAJU" id="idfindInputAJU" class="form-control" placeholder="Input Aju...">
                      <?php } else { ?>
                        <input type="text" name="findInputAJU" id="idfindInputAJU" class="form-control" placeholder="Input Aju..." value="<?= $findInputAJU; ?>">
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Type</label>
                      <select type="text" name="findInputTypeAJU" id="idfindInputTypeAJU" class="form-control">
                        <?php if ($findInputTypeAJU == '') { ?>
                        <option value="">-- Select Type --</option>
                        <?php } else { ?>
                        <option value="<?= $findInputTypeAJU; ?>"><?= $findInputTypeAJU; ?></option>
                        <option value="">-- Select Type --</option>
                        <?php } ?>
                        <option value="import">Import</option>
                        <option value="export">Export</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12" style="text-align: right;">
                    <a href="search.php" type="button" class="btn btn-info"><i class="fas fa-redo"></i> Reset</a>
                    <button type="submit" name="findtwo" id="idbtnfindtwo" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Search -->
    <!-- BY REF / TN -->
    <div class="row" style="display: <?= $resultreftn ?>;">
      <div class="col-lg-12">
        <?php
        $findInputTypeREFTN = $_GET['findInputTypeREFTN'];
        if ($findInputTypeREFTN == 'import') {
        ?>
        <!-- IF IMPORT -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-table"></i> Import List By Ref/TN
          </div>
          <div class="panel-body">
            <div class="p-b-20" style="margin-bottom: 15px;">
                <div class="alert-modify">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                  <div>
                    <h3 style="margin-top: 0px;"><i class="fa fa-search"></i> Search Result!</h3>
                  </div>
                  <hr>
                  <p style="margin-bottom: 0px;">Ref / Tn: <b><?= $findInputREFTN ?></b></p>
                  <p style="margin-bottom: 0px;">Type: <b><?= $findInputTypeREFTN ?></b></p>
                </div>
            </div>
            <div class="table-responsive">
              <table class="display hover" id="FINDreftnImport">
                <thead>
                  <tr>
                    <th class="no-sort">#</th>
                    <th class="no-sort" style="text-align: center;">Number</th>
                    <th class="no-sort" style="text-align: center;">Shipper & Consignee</th>
                    <th class="no-sort" style="text-align: center;">Details</th>
                    <th class="no-sort" style="text-align: center;">Record</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $con=mysqli_connect("localhost","root","","contta");
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }
                  // $result = mysqli_query($con,"SELECT * FROM tb_cnee ORDER BY regdate DESC LIMIT 50");
                  if(isset($_GET['findone']))
                  {
                    $findInputREFTN = $_GET['findInputREFTN'];
                    $findInputTypeREFTN = $_GET['findInputTypeREFTN'];
                    $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN 
                                                tb_imp_pre ON tb_master_impor.rcd_id=tb_imp_pre.rcd_id  
                                                INNER JOIN
                                                tb_imp_clear ON tb_master_impor.rcd_id=tb_imp_clear.rcd_id
                                                INNER JOIN
                                                tb_imp_post ON tb_master_impor.rcd_id=tb_imp_post.rcd_id
                                                INNER JOIN                        
                                                tb_record_miles_import ON tb_master_impor.rcd_id=tb_record_miles_import.rcd_id
                                                WHERE tb_master_impor.rcd_ref='$findInputREFTN' AND tb_master_impor.rcd_type='$findInputTypeREFTN'");       
                  }
                  if(mysqli_num_rows($result)>0){
                    $no=0;
                    while($row = mysqli_fetch_array($result))
                    {
                      $no++;
                      echo "<tr>";
                      echo "<td>" . $no . ".</td>";
                      echo "<td>
                           <font><b>ID: </b> " . $row['rcd_id'] . "</font>
                           <br>
                           <font><b>REF/TN: </b>" . $row['rcd_ref'] . "</font>
                           <br>
                           <font><b>AJU: </b>" . $row['rcd_aju'] . "</font>
                           <br>
                           <font><b>INV: </b>" . $row['rcd_inv_no'] . "</font>
                           <br>
                           <font><b>HBL: </b>" . $row['rcd_hbl'] . "</font>
                           </td>";
                      echo "<td>
                           <font><b>Shipper: </b> " . $row['rcd_shipper'] . "</font>
                           <br>
                           <font><b>Consignee: </b>" . $row['rcd_cnee'] . "</font>
                           </td>";
                      echo "<td style='text-align: center;'>
                           <font><b>ETA: </b> " . $row['rcd_eta'] . "</font>
                           <font><b>ATA: </b> " . $row['rcd_ata'] . "</font>
                           <hr>
                           <font><b>MOT: </b> " . $row['rcd_mot'] . "</font>
                           <br>
                           <font><b>COO: </b>" . $row['rcd_coo'] . "</font>
                           </td>";
                      echo "<td>
                           <font><b>Created Date:</b> " . $row['rcd_create_date'] . "</font>
                           <br>
                           <font><b>Created By: </b>" . $row['rcd_create_by'] . "</font>
                           </td>";
                      echo "</tr>";
                      ?>
                    <?php }
                    } else {
                      echo "<tr>";
                      echo "<td colspan='6' align='center'><b><i>" . "No Available Record" . "</i></b></td>";
                      echo "</tr>";
                    }  mysqli_close($con); 
                    ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- END IF IMPORT -->
        <?php
        } else if ($findInputTypeREFTN == 'export') {
        ?>
        <!-- IF EXPORT -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-table"></i> Export List By Ref/TN
          </div>
          <div class="panel-body">
            <div class="p-b-20" style="margin-bottom: 15px;">
                <div class="alert-modify">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                  <div>
                    <h3 style="margin-top: 0px;"><i class="fa fa-search"></i> Search Result!</h3>
                  </div>
                  <hr>
                  <p style="margin-bottom: 0px;">Ref / Tn: <b><?= $findInputREFTN ?></b></p>
                  <p style="margin-bottom: 0px;">Type: <b><?= $findInputTypeREFTN ?></b></p>
                </div>
            </div>
            <div class="table-responsive">
              <table class="display hover" id="FINDreftnExport">
                <thead>
                  <tr>
                    <th class="no-sort">#</th>
                    <th>RcdID</th>
                    <th>RcdDate</th>
                    <th>RcdBy</th>
                    <th>ShipPlan</th>
                    <th>Shipper</th>
                    <th>Cnee</th>
                    <th>PO_No.</th>
                    <th>SIPL</th>
                    <th>Ship. Arrangement</th>
                    <th>Ship. Custom</th>
                    <th>Ship. Execution</th>
                    <th>Ship. Monitoring</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $con=mysqli_connect("localhost","root","","contta");
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }
                  // $result = mysqli_query($con,"SELECT * FROM tb_cnee ORDER BY regdate DESC LIMIT 50");
                  if(isset($_GET['findone']))
                  {
                    $findInputREFTN = $_GET['findInputREFTN'];
                    $findInputTypeREFTN = $_GET['findInputTypeREFTN'];
                    $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN 
                                                tb_imp_pre ON tb_master_impor.rcd_id=tb_imp_pre.rcd_id  
                                                INNER JOIN
                                                tb_imp_clear ON tb_master_impor.rcd_id=tb_imp_clear.rcd_id
                                                INNER JOIN
                                                tb_imp_post ON tb_master_impor.rcd_id=tb_imp_post.rcd_id
                                                INNER JOIN                        
                                                tb_record_miles_import ON tb_master_impor.rcd_id=tb_record_miles_import.rcd_id
                                                WHERE tb_master_impor.rcd_ref='$findInputREFTN' AND tb_master_impor.rcd_type='$findInputTypeREFTN'");       
                  }
                  if(mysqli_num_rows($result)>0){
                    $no=0;
                    while($row = mysqli_fetch_array($result))
                    {
                      $no++;
                      echo "<tr>";
                      echo "<td>" . $no . ".</td>";
                      echo "<td>" . $row['rcd_id'] . "</td>";
                      echo "<td>" . $row['rcd_create_date'] . "</td>";
                      echo "<td>" . $row['rcd_create_by'] . "</td>";
                      echo "<td>" . $row['rcd_ship_plan'] . "</td>";                                        
                      echo "<td>" . $row['rcd_shipper'] . "</td>";
                      echo "<td>" . $row['rcd_cnee'] . "</td>";                        
                      echo "<td>" . $row['rcd_po_no'] . "</td>";
                      echo "<td align= ''>
                      <a href='$row[sipl_file]' target='_BLANK' ><span class='label label-primary'>SIPL</span></a>
                      </td>";
                      echo "<td align= ''>
                      <a href='#' data-toggle='modal' data-target='#arr$row[rcd_id]' ><span class='label label-primary'>$row[miles_arr]</span></a>
                      </td>";
                      echo "<td align= ''>
                      <a href='#' data-toggle='modal' data-target='#custom$row[rcd_id]' ><span class='label label-primary'>$row[miles_custom]</span></a>
                      </td>";
                      echo "<td align= ''>
                      <a href='#' data-toggle='modal' data-target='#exe$row[rcd_id]' ><span class='label label-primary'>$row[miles_execution]</span></a>
                      </td>";
                      echo "<td align= ''>
                      <a href='#' data-toggle='modal' data-target='#mon$row[rcd_id]' ><span class='label label-primary'>$row[miles_monitor]</span></a>
                      </td>";
                      echo "</tr>";
                      ?>
                    <?php }
                    } else {
                      echo "<tr>";
                      echo "<td colspan='6' align='center'><b><i>" . "No Available Record" . "</i></b></td>";
                      echo "</tr>";
                    }  mysqli_close($con); 
                    ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- END IF EXPORT -->
        <?php
        }
        ?>
      </div>
    </div>
    <!-- END BY REF / TN -->
    <!-- BY AJU -->
    <div class="row" style="display: <?= $resultaju ?>;">
      <div class="col-lg-12">
        <?php
        $findInputTypeAJU = $_GET['findInputTypeAJU'];
        if ($findInputTypeAJU == 'import') {
        ?>
        <!-- IF IMPORT -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-table"></i> Import List By AJU
          </div>
          <div class="panel-body">
            <div class="p-b-20" style="margin-bottom: 15px;">
                <div class="alert-modify">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                  <div>
                    <h3 style="margin-top: 0px;"><i class="fa fa-search"></i> Search Result!</h3>
                  </div>
                  <hr>
                  <p style="margin-bottom: 0px;">AJU: <b><?= $findInputAJU ?></b></p>
                  <p style="margin-bottom: 0px;">Type: <b><?= $findInputTypeAJU ?></b></p>
                </div>
            </div>
            <div class="table-responsive">
              <table class="display hover" id="FINDreftnImport">
                <thead>
                  <tr>
                    <th class="no-sort">#</th>
                    <th class="no-sort" style="text-align: center;">Number</th>
                    <th class="no-sort" style="text-align: center;">Shipper & Consignee</th>
                    <th class="no-sort" style="text-align: center;">Details</th>
                    <th class="no-sort" style="text-align: center;">Record</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $con=mysqli_connect("localhost","root","","contta");
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }
                  // $result = mysqli_query($con,"SELECT * FROM tb_cnee ORDER BY regdate DESC LIMIT 50");
                  if(isset($_GET['findtwo']))
                  {
                    $findInputAJU = $_GET['findInputAJU'];
                    $findInputTypeAJU = $_GET['findInputTypeAJU'];
                    $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN 
                                                tb_imp_pre ON tb_master_impor.rcd_id=tb_imp_pre.rcd_id  
                                                INNER JOIN
                                                tb_imp_clear ON tb_master_impor.rcd_id=tb_imp_clear.rcd_id
                                                INNER JOIN
                                                tb_imp_post ON tb_master_impor.rcd_id=tb_imp_post.rcd_id
                                                INNER JOIN                        
                                                tb_record_miles_import ON tb_master_impor.rcd_id=tb_record_miles_import.rcd_id
                                                WHERE tb_master_impor.rcd_aju='$findInputAJU' AND tb_master_impor.rcd_type='$findInputTypeAJU'");       
                  }
                  if(mysqli_num_rows($result)>0){
                    $no=0;
                    while($row = mysqli_fetch_array($result))
                    {
                      $no++;
                      echo "<tr>";
                      echo "<td>" . $no . ".</td>";
                      echo "<td>
                           <font><b>ID: </b> " . $row['rcd_id'] . "</font>
                           <br>
                           <font><b>REF/TN: </b>" . $row['rcd_ref'] . "</font>
                           <br>
                           <font><b>AJU: </b>" . $row['rcd_aju'] . "</font>
                           <br>
                           <font><b>INV: </b>" . $row['rcd_inv_no'] . "</font>
                           <br>
                           <font><b>HBL: </b>" . $row['rcd_hbl'] . "</font>
                           </td>";
                      echo "<td>
                           <font><b>Shipper: </b> " . $row['rcd_shipper'] . "</font>
                           <br>
                           <font><b>Consignee: </b>" . $row['rcd_cnee'] . "</font>
                           </td>";
                      echo "<td style='text-align: center;'>
                           <font><b>ETA: </b> " . $row['rcd_eta'] . "</font>
                           <font><b>ATA: </b> " . $row['rcd_ata'] . "</font>
                           <hr>
                           <font><b>MOT: </b> " . $row['rcd_mot'] . "</font>
                           <br>
                           <font><b>COO: </b>" . $row['rcd_coo'] . "</font>
                           </td>";
                      echo "<td>
                           <font><b>Created Date:</b> " . $row['rcd_create_date'] . "</font>
                           <br>
                           <font><b>Created By: </b>" . $row['rcd_create_by'] . "</font>
                           </td>";
                      echo "</tr>";
                      ?>
                    <?php }
                    } else {
                      echo "<tr>";
                      echo "<td colspan='6' align='center'><b><i>" . "No Available Record" . "</i></b></td>";
                      echo "</tr>";
                    }  mysqli_close($con); 
                    ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- END IF IMPORT -->
        <?php
        } else if ($findInputTypeAJU == 'export') {
        ?>
        <!-- IF EXPORT -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-table"></i> Export List By AJU
          </div>
          <div class="panel-body">
            <div class="p-b-20" style="margin-bottom: 15px;">
                <div class="alert-modify">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                  <div>
                    <h3 style="margin-top: 0px;"><i class="fa fa-search"></i> Search Result!</h3>
                  </div>
                  <hr>
                  <p style="margin-bottom: 0px;">AJU: <b><?= $findInputAJU ?></b></p>
                  <p style="margin-bottom: 0px;">Type: <b><?= $findInputTypeAJU ?></b></p>
                </div>
            </div>
            <div class="table-responsive">
              <table class="display hover" id="FINDreftnExport">
                <thead>
                  <tr>
                    <th class="no-sort">#</th>
                    <th>RcdID</th>
                    <th>RcdDate</th>
                    <th>RcdBy</th>
                    <th>ShipPlan</th>
                    <th>Shipper</th>
                    <th>Cnee</th>
                    <th>PO_No.</th>
                    <th>SIPL</th>
                    <th>Ship. Arrangement</th>
                    <th>Ship. Custom</th>
                    <th>Ship. Execution</th>
                    <th>Ship. Monitoring</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $con=mysqli_connect("localhost","root","","contta");
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }
                  // $result = mysqli_query($con,"SELECT * FROM tb_cnee ORDER BY regdate DESC LIMIT 50");
                  if(isset($_GET['findtwo']))
                  {
                    $findInputAJU = $_GET['findInputAJU'];
                    $findInputTypeAJU = $_GET['findInputTypeAJU'];
                    $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN 
                                                tb_imp_pre ON tb_master_impor.rcd_id=tb_imp_pre.rcd_id  
                                                INNER JOIN
                                                tb_imp_clear ON tb_master_impor.rcd_id=tb_imp_clear.rcd_id
                                                INNER JOIN
                                                tb_imp_post ON tb_master_impor.rcd_id=tb_imp_post.rcd_id
                                                INNER JOIN                        
                                                tb_record_miles_import ON tb_master_impor.rcd_id=tb_record_miles_import.rcd_id
                                                WHERE tb_master_impor.rcd_aju='$findInputAJU' AND tb_master_impor.rcd_type='$findInputTypeAJU'");       
                  }
                  if(mysqli_num_rows($result)>0){
                    $no=0;
                    while($row = mysqli_fetch_array($result))
                    {
                      $no++;
                      echo "<tr>";
                      echo "<td>" . $no . ".</td>";
                      echo "<td>" . $row['rcd_id'] . "</td>";
                      echo "<td>" . $row['rcd_create_date'] . "</td>";
                      echo "<td>" . $row['rcd_create_by'] . "</td>";
                      echo "<td>" . $row['rcd_ship_plan'] . "</td>";                                        
                      echo "<td>" . $row['rcd_shipper'] . "</td>";
                      echo "<td>" . $row['rcd_cnee'] . "</td>";                        
                      echo "<td>" . $row['rcd_po_no'] . "</td>";
                      echo "<td align= ''>
                      <a href='$row[sipl_file]' target='_BLANK' ><span class='label label-primary'>SIPL</span></a>
                      </td>";
                      echo "<td align= ''>
                      <a href='#' data-toggle='modal' data-target='#arr$row[rcd_id]' ><span class='label label-primary'>$row[miles_arr]</span></a>
                      </td>";
                      echo "<td align= ''>
                      <a href='#' data-toggle='modal' data-target='#custom$row[rcd_id]' ><span class='label label-primary'>$row[miles_custom]</span></a>
                      </td>";
                      echo "<td align= ''>
                      <a href='#' data-toggle='modal' data-target='#exe$row[rcd_id]' ><span class='label label-primary'>$row[miles_execution]</span></a>
                      </td>";
                      echo "<td align= ''>
                      <a href='#' data-toggle='modal' data-target='#mon$row[rcd_id]' ><span class='label label-primary'>$row[miles_monitor]</span></a>
                      </td>";
                      echo "</tr>";
                      ?>
                    <?php }
                    } else {
                      echo "<tr>";
                      echo "<td colspan='6' align='center'><b><i>" . "No Available Record" . "</i></b></td>";
                      echo "</tr>";
                    }  mysqli_close($con); 
                    ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- END IF EXPORT -->
        <?php
        }
        ?>
      </div>
    </div>
    <!-- END BY AJU -->
  </div>
</div>
<?php 
include 'include/jquery.php';
?>
<!-- Consignee -->
<script type="text/javascript">
    // Input - Add
    if (window?.location?.href?.indexOf('CaddSuccess') > -1) {
        Swal.fire({
            title: 'Success Alert!',
            icon: 'success',
            text: 'Data saved successfully!',
        })
        history.replaceState({}, '', './search.php');
    }

    if (window?.location?.href?.indexOf('CaddFailed') > -1) {
        Swal.fire({
            title: 'Failed Alert!',
            icon: 'error',
            text: 'Data failed to save, please contact your administrator!',
        })
        history.replaceState({}, '', './search.php');
    }

    if (window?.location?.href?.indexOf('CaddReady') > -1) {
        Swal.fire({
            title: 'Failed Alert!',
            icon: 'error',
            text: 'Consignee Name already registered, please contact your administrator!',
        })
        history.replaceState({}, '', './search.php');
    }
    // End Input - Add

    // Update Data
    if (window?.location?.href?.indexOf('CUpdateSuccessCC') > -1) {
        Swal.fire({
            title: 'Success Alert!',
            icon: 'success',
            text: 'Data updated successfully!',
        })
        history.replaceState({}, '', './search.php');
    }

    if (window?.location?.href?.indexOf('CUpdateFailed') > -1) {
        Swal.fire({
            title: 'Failed Alert!',
            icon: 'error',
            text: 'Data failed to updated, please contact your administrator!',
        })
        history.replaceState({}, '', './search.php');
    }

    if (window?.location?.href?.indexOf('CUpdateReady') > -1) {
        Swal.fire({
            title: 'Failed Alert!',
            icon: 'error',
            text: 'Consignee Name already registered, please contact your administrator!',
        })
        history.replaceState({}, '', './search.php');
    }
    // End Update Data

    // Delete
    if (window?.location?.href?.indexOf('DeleteSuccess') > -1) {
        Swal.fire({
            title: 'Delete Alert!',
            icon: 'info',
            text: 'Data delete successfully!',
        })
        history.replaceState({}, '', './search.php');
    }

    if (window?.location?.href?.indexOf('DeleteFailed') > -1) {
        Swal.fire({
            title: 'Delete Alert!',
            icon: 'info',
            text: 'Data failed to delete, please contact your administrator!',
        })
        history.replaceState({}, '', './search.php');
    }
    // End Delete
</script>
