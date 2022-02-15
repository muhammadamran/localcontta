<?php

include "include/connection.php";
include "include/restrict.php";

if(isset($_POST["create"]))    
{    

  $ship_plan            = $_POST['ship_plan'];
  $shipper              = $_POST['shipper'];
  $cnee                 = $_POST['cnee'];
  $inv_no               = $_POST['inv_no'];
  $commo                = $_POST['commo'];
  $c20                  = $_POST['c20'];
  $c40                  = $_POST['c40'];
  $party                = $_POST['party'];
  $po_no                = $_POST['po_no'];

  $rcd_type             = "export";
  $user_name            = $_POST['user_name'];
  $datenow              = date('Y-m-d');
  $monthnow             = date('m');
  $yearnow              = date('Y');


  $query = mysql_query("INSERT into tb_record_master values(' ','$datenow','$monthnow','$yearnow','$user_name','$rcd_type','$ship_plan','$shipper','$cnee','$inv_no','$commo','$c20','$c40','$party','$po_no','')");
  $last_id = mysql_insert_id();
  $query .= mysql_query("INSERT into tb_record_miles values(' ','$last_id','0','0','0','0','0','0','0','0')");
  $query .= mysql_query("INSERT into tb_record_ship_arr(rcd_ar_id,rcd_id) values(' ','$last_id')");
  $query .= mysql_query("INSERT into tb_record_ship_cus(rcd_cus_id,rcd_id) values(' ','$last_id')");
  $query .= mysql_query("INSERT into tb_record_ship_exe(rcd_exe_id,rcd_id) values(' ','$last_id')");
  $query .= mysql_query("INSERT into tb_record_ship_exe(rcd_mon_id,rcd_id) values(' ','$last_id')");
  if($query){
    header("Location: ./export_master.php");                                                  
  } else {
    echo "Updated Failed - Please contact your administrator".mysql_error();
  }
}

if(isset($_POST["resi"]))    
{    
  $rid                = $_POST['rid'];
  $rcd_type           = $_POST['rcd_type'];

  $date_taken         = date('Y-m-d H:i:s');

  $uploaddir = 'file/sipl/';
  $uploadfile = $uploaddir . '_' .$rid . $rcd_type . '_' . date("YmdHis") . '_' . basename($_FILES['form']['name']);

  $query = move_uploaded_file($_FILES['form']['tmp_name'], $uploadfile);
  if($query){
    if (mysql_query("UPDATE tb_record_master SET sipl_file ='$uploadfile' WHERE rcd_id='$rid'")) {
      mysql_query("UPDATE tb_record_miles SET miles_arr = 1 WHERE rcd_id='$rid'");
      header("Location: ./export_master.php?");
    } else {
      echo "Updated Failed - Please contact your administrator";
    }                                                 
  } else {
    echo "Updated Failed - Please contact your administrator";
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
          <h1 class="page-header">[Siemens] Import - <i>Report Process</i></h1>
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
                    <select name="month" class="form-control">
                      <option value="">--- SELECT ---</option>
                      <option value="01">January</option>
                      <option value="02">February</option>
                      <option value="03">March</option>
                      <option value="04">April</option>
                      <option value="05">May</option>
                      <option value="06">June</option>
                      <option value="07">July</option>
                      <option value="08">August</option>
                      <option value="09">Septemeber</option>
                      <option value="10">October</option>
                      <option value="11">November</option>
                      <option value="12">December</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <select name="year" class="form-control"> 
                      <option value="">--- SELECT ---</option>
                      <option value="2018">2018</option>
                      <option value="2019">2019</option>
                      <option value="2020">2020</option>
                      <option value="2021">2021</option>

                    </select>
                  </div>
                  <div class="col-md-4">
                    <button type="submit" name="search" value="search" class="btn btn-primary">Search!</button>
                  </div>
                </form>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <form action="report_cust_siemens_csv.php" method="get">
                    <input type="hidden" name="month" value="<?php echo $_GET['month'];?>">
                    <input type="hidden" name="year" value="<?php echo $_GET['year'];?>">
                    <button>Export to CSV</button>
                  </form>
                </div>            
              </div>
            </div>

            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>RcdID</th>
                      <th>RcdDate</th>
                      <th>RcdBy</th>
                      <th>AJU No.</th>
                      <th>HBL</th>
                      <th>Shipper</th>
                      <th>Cnee</th>
                      <th>InvNo</th>
                      <th>ETA</th>
                      <th>ATA</th>
                      <th>Action</th>
                      <th>CIPL</th>
                      <th>PreClearance</th>
                      <th>Clearance</th>
                      <th>PostClearance</th>                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $monthnow = $_GET['month'];
                    $yearnow = $_GET['year'];
                    $con=mysqli_connect("localhost","root","","contta");
                                    // Check connection
                    if (mysqli_connect_errno())
                    {
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_record_miles_import ON tb_master_impor.rcd_id=tb_record_miles_import.rcd_id  WHERE tb_master_impor.rcd_type = 'import' AND tb_master_impor.rcd_create_month='$monthnow' AND tb_master_impor.rcd_create_year='$yearnow' AND tb_master_impor.rcd_cnee LIKE '%siemens%' ");
                    if(mysqli_num_rows($result)>0){

                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['rcd_id'] . "</td>";
                        echo "<td>" . $row['rcd_create_date'] . "</td>";
                        echo "<td>" . $row['rcd_create_by'] . "</td>";
                        echo "<td>" . $row['rcd_aju'] . "</td>"; 
                        echo "<td>" . $row['rcd_hbl'] . "</td>";                                        
                        echo "<td>" . $row['rcd_shipper'] . "</td>";
                        echo "<td>" . $row['rcd_cnee'] . "</td>";
                        echo "<td>" . $row['rcd_inv_no'] . "</td>";
                        echo "<td>" . $row['rcd_eta'] . "</td>";
                        echo "<td>" . $row['rcd_ata'] . "</td>";
                        echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#detail$row[rcd_id]' ><span class='label label-primary'>Details</span></a>
                      </td>";
                        echo "<td align= ''>
                        <a href='$row[cipl_file]' target='_BLANK' ><span class='label label-primary'>CIPL</span></a>
                      </td>";
                        echo "<td align= ''>
                        <a href='#' data-toggle='modal' data-target='#arr$row[rcd_id]' ><span class='label label-primary'>$row[pre]</span></a>
                      </td>";
                      echo "<td align= ''>
                      <a href='#' data-toggle='modal' data-target='#custom$row[rcd_id]' ><span class='label label-primary'>$row[clear]</span></a>
                    </td>";
                    echo "<td align= ''>
                    <a href='#' data-toggle='modal' data-target='#exe$row[rcd_id]' ><span class='label label-primary'>$row[post]</span></a>
                  </td>";
                echo "</tr>";
                ?>

                <!-- SHOW DATA GENERAL INFORMATION -->

                <div class="modal fade" id="detail<?php echo $row['rcd_id'];?>" role="dialog">
                  <div class="modal-dialoga">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>[Query Result] </b> General Information Details</h4>
                      </div>
                      <?php 
                      mysql_connect('localhost', 'root','');
                      mysql_select_db('contta'); 
                      $role = mysql_query("SELECT * FROM tb_master_impor WHERE rcd_id = '$row[rcd_id]' ");
                      $exe = mysql_fetch_array($role);
                      ?> 
                      <div class="modal-body">
                        <div class="col-md-12">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>AJU No.</label>
                              <input type="text" name="rcd_aju" class="form-control" value="<?php echo $exe['rcd_aju'];?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                              <label>20'</label>
                              <input type="text" name="rcd_20_type" class="form-control" value="<?php echo $exe['rcd_20_type'];?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                              <label>40'</label>
                              <input type="text" name="rcd_40_type" class="form-control" value="<?php echo $exe['rcd_40_type'];?>" readonly>
                            </div>                              
                            <div class="form-group col-md-4">
                              <label>Party</label>
                              <input type="text" name="rcd_party" value="<?php echo $exe['rcd_40_type'];?>" class="form-control" readonly>
                            </div>                              
                            <div class="form-group col-md-4">
                              <label>Weight</label>
                              <input type="text" name="rcd_weight" value="<?php echo $exe['rcd_weight'];?>" class="form-control"  readonly>
                            </div>
                            <div class="form-group col-md-4">
                              <label>CBM</label>
                              <input type="text" name="rcd_cbm" value="<?php echo $exe['rcd_cbm'];?>"  class="form-control" readonly>
                              <input type="hidden" name="rcd_id" value="<?php echo $exe['rcd_id'];?>"  class="form-control" >
                            </div>                              
                            <div class="form-group col-md-4">
                              <label>MOT</label>
                              <input type="text" name="rcd_mot" value="<?php echo $exe['rcd_mot'];?>" class="form-control" readonly>
                            </div>                              
                          </div>                         
                        </div>                                                                           
                      </div>  
                      <div class="modal-footer">
                        <br>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- END OF SHOW DATA execution PROCESS -->

                <!-- SHOW DATA PRE CLEARANCE -->

                <div class="modal fade" id="arr<?php echo $row['rcd_id'];?>" role="dialog">
                  <div class="modal-dialoga">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>[Query Result] </b> Pre Clearance Details</h4>
                      </div>
                      <div class="modal-body"> 
                        <?php 
                        mysql_connect('localhost', 'root','');
                        mysql_select_db('contta'); 
                        $role = mysql_query("SELECT * FROM tb_imp_pre WHERE rcd_id = '$row[rcd_id]' ");
                        $arr = mysql_fetch_array($role);
                        ?>                           
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Rcvd CIPL</label>
                              <input type="date" name="create_sipl" class="form-control" value="<?php echo $arr['pre_rcvd_cipl'];?>"  placeholder="ShipmentPlanDate" readonly>
                            </div>
                            <div class="form-group">
                              <label>Send PIB Draft</label>
                              <input type="date" name="create_ems" class="form-control" value="<?php echo $arr['pre_send_pib_draft'];?>"  placeholder="ShipmentPlanDate" readonly>
                            </div>
                            <div class="form-group">
                              <label>Rcvd PIB Revision</label>
                              <input type="text" name="no_aju" class="form-control"  value="<?php echo $arr['pre_rcvd_pib_rev'];?>"  readonly>
                            </div>
                            <div class="form-group">
                              <label>SEND PIB</label>
                              <input type="date" name="StuffingDate" value="<?php echo $arr['pre_send_pib'];?>"  class="form-control"  readonly>
                            </div>
                            <div class="form-group">
                              <label>RCVD COMPLETED</label>
                              <input type="date" name="create_sac" value="<?php echo $arr['pre_rcvd_complete'];?>"  class="form-control"  readonly>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>CREATE PIB</label>
                              <input type="text" name="revise_sac" value="<?php echo $arr['pre_create_pib'];?>"  class="form-control"  readonly>
                            </div>
                          </div>                          
                        </div>                                                                            
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- END OF SHOW DATA SHIPMENT ARRANGEMENT -->

                <!-- SHOW DATA SHIPMENT CUSTOM PROCESS -->

                <div class="modal fade" id="custom<?php echo $row['rcd_id'];?>" role="dialog">
                  <div class="modal-dialoga">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>[Query Result] </b> Clearance Details</h4>
                      </div>
                      <?php 
                      mysql_connect('localhost', 'root','');
                      mysql_select_db('contta'); 
                      $role = mysql_query("SELECT * FROM tb_imp_clear WHERE rcd_id = '$row[rcd_id]' ");
                      $cus = mysql_fetch_array($role);
                      ?> 
                      <div class="modal-body">
                        <div class="col-md-12">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>TRANSFER PIB</label>
                              <input type="date" name="create_peb" class="form-control" value="<?php echo $cus['cle_trf_pib'];?>"  placeholder="create peb" readonly>
                            </div>
                            <div class="form-group">
                              <label>BILLING</label>
                              <input type="date" name="transmit_date" class="form-control" value="<?php echo $cus['cle_billing'];?>"  placeholder="TransmitDate" readonly>
                            </div>
                            <div class="form-group">
                              <label>PAID DUTY TAX</label>
                              <input type="text" name="no_aju" class="form-control"  value="<?php echo $cus['cle_paid_duty_tax'];?>"  readonly>
                            </div>
                            <div class="form-group">
                              <label>SPJK</label>
                              <input type="date" name="peb_nopen" value="<?php echo $cus['cle_spjk'];?>"  class="form-control"  readonly>
                            </div>
                            <div class="form-group">
                              <label>SPJM</label>
                              <input type="date" name="npe_date" value="<?php echo $cus['cle_spjm'];?>"  class="form-control"  readonly>
                            </div>
                            <div class="form-group">
                              <label>SPPB</label>
                              <input type="date" name="npe_date" value="<?php echo $cus['cle_sppb'];?>"  class="form-control"  readonly>
                            </div>
                            <div class="form-group">
                              <label>SPPB FILE</label>
                              <a href="<?php echo $cus['sppb'];?>" target="_BLANK"><button class="#">View</button></a>
                            </div>
                            <div class="form-group">
                              <label>COO</label>
                              <input type="date" name="npe_date" value="<?php echo $cus['cle_coo'];?>"  class="form-control"  readonly>
                            </div>
                            <?php
                            $getcoo = mysql_query("SELECT * FROM tb_master_impor WHERE rcd_id = '$row[rcd_id]' ");
                            $coo = mysql_fetch_array($getcoo);
                            ?>
                            <div class="form-group">
                              <label>COO Status</label>
                              <input type="text" name="npe_date" value="<?php echo $coo['rcd_coo'];?>"  class="form-control"  readonly>
                            </div>
                            <div class="form-group">
                              <label>COO FILE</label>
                              <a href="<?php echo $cus['coo'];?>" target="_BLANK"><button class="#">View</button></a>
                            </div>                          
                          </div>                         
                        </div>    
                        <div class="modal-footer">
                        </div>                                                                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- END OF SHOW DATA CUSTOM PROCESS -->

                <!-- SHOW DATA SHIPMENT EXECUTION PROCESS -->

                <div class="modal fade" id="exe<?php echo $row['rcd_id'];?>" role="dialog">
                  <div class="modal-dialoga">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>[Query Result] </b> Post Clearance Details</h4>
                      </div>
                      <?php 
                      mysql_connect('localhost', 'root','');
                      mysql_select_db('contta'); 
                      $role = mysql_query("SELECT * FROM tb_imp_post WHERE rcd_id = '$row[rcd_id]' ");
                      $exe = mysql_fetch_array($role);
                      ?> 
                      <div class="modal-body">
                        <div class="col-md-12">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>RCVD INVOICE VENDOR</label>
                              <input type="text" name="rcd_exe_do_no" class="form-control" value="<?php echo $exe['post_rcvd_inv_vendor'];?>" readonly>
                            </div>
                            <div class="form-group">
                              <label>BILLING CUSTOMER</label>
                              <input type="text" name="rcd_exe_liner" class="form-control" value="<?php echo $exe['post_billing_customer'];?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                              <label>SEND BILLING</label>
                              <input type="text" name="rcd_exe_truck_arrived_now" class="form-control" value="<?php echo $exe['post_billing_send'];?>" readonly>
                            </div>                              
                            <div class="form-group col-md-6">
                              <label>FILLING</label>
                              <input type="text" name="rcd_exe_stuff_start_now" value="<?php echo $exe['post_filling'];?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                              <label>INVOICE VENDOR</label>
                              <a href="<?php echo $exe['post_invoice_vendor_file'];?>" target="_BLANK"><button class="#">View</button></a>
                            </div> 
                            <div class="form-group">
                              <label>INVOICE CUSTOMER</label>
                              <a href="<?php echo $exe['post_customer_invoice_file'];?>" target="_BLANK"><button class="#">View</button></a>
                            </div>                                                           
                          </div>                         
                        </div>                                                                           
                      </div>  
                      <div class="modal-footer">
                        <br>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- END OF SHOW DATA execution PROCESS -->

                <!-- SHOW DATA SHIPMENT MONITORING PROCESS -->

                <div class="modal fade" id="mon<?php echo $row['rcd_id'];?>" role="dialog">
                  <div class="modal-dialoga">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>[Query Result] </b> Shipment Execution Details</h4>
                      </div>
                      <?php 
                      mysql_connect('localhost', 'root','');
                      mysql_select_db('contta'); 
                      $role = mysql_query("SELECT * FROM tb_record_ship_mon WHERE rcd_id = '$row[rcd_id]' ");
                      $mon = mysql_fetch_array($role);
                      ?> 
                      <div class="modal-body">
                          <div class="col-md-12">
                            <div class="col-md-12">
                              <div class="col-md-6">
                                <!-- item -->
                                <div class="form-group">
                                  <label>Closing Cont. Date</label>
                                  <input type="text" name="rcd_mon_cls_con_now" value="<?php echo $mon['rcd_mon_cls_con'];?>"  class="form-control" readonly>                                  
                                </div>                              
                                <!-- end item -->
                                <!-- item -->
                                <div class="form-group">
                                  <label>ATD</label>
                                  <input type="text" name="rcd_mon_atd_now" value="<?php echo $mon['rcd_mon_atd'];?>"  class="form-control" readonly>
                                </div>
                                <!-- end item -->
                                <!-- item -->
                                <div class="form-group">
                                  <label>ETD</label>
                                  <input type="text" name="rcd_mon_etd_now" value="<?php echo $mon['rcd_mon_etd'];?>"  class="form-control" readonly>
                                </div>
                                <!-- end item -->
                                <div class="form-group">
                                  <label>POD</label>
                                  <input type="text" name="rcd_mon_pod" value="<?php echo $mon['rcd_mon_pod'];?>"  class="form-control"  readonly>
                                </div>
                                <div class="form-group">
                                  <label>MBL</label>
                                  <input type="text" name="rcd_mon_mbl" value="<?php echo $mon['rcd_mon_mbl'];?>"  class="form-control"  readonly>
                                </div>
                                <div class="form-group">
                                  <label>hBL</label>
                                  <input type="text" name="rcd_mon_hbl" value="<?php echo $mon['rcd_mon_hbl'];?>"  class="form-control"  readonly>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <!-- item -->
                                <div class="form-group">
                                  <label>Docs Returned</label>
                                  <input type="text" name="rcd_mon_docs_return_now" value="<?php echo $mon['rcd_mon_docs_return'];?>"  class="form-control" readonly>
                                </div>
                                <!-- end item -->
                                <div class="form-group">
                                  <label>Rcvd By</label>
                                  <input type="text" name="rcd_mon_rcvd_by" value="<?php echo $mon['rcd_mon_rcvd_by'];?>"  class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                  <label>Delay (days)</label>
                                  <input type="text" name="rcd_mon_delay" value="<?php echo $mon['rcd_mon_delay'];?>"  class="form-control"  readonly>
                                </div>
                                <div class="form-group">
                                  <label>Remarks</label>
                                  <input type="text" name="rcd_mon_remark"  value="<?php echo $mon['rcd_mon_remark'];?>" class="form-control"  readonly>        
                                </div>
                                <!-- item -->
                                <div class="form-group">
                                  <label>Send Docs to CNEE</label>
                                  <input type="text" name="rcd_mon_docs_cnee_1_now" value="<?php echo $mon['rcd_mon_docs_cnee_1'];?>"  class="form-control" readonly>
                                </div>
                                <!-- end item -->
                                <div class="form-group">
                                  <label>CNEE Rcvd</label>
                                  <input type="text" name="rcd_mon_docs_cnee_2_now" value="<?php echo $mon['rcd_mon_docs_cnee_2'];?>"  class="form-control" readonly>
                                </div>
                                <!-- end item -->                                
                              </div>
                            </div>                         
                          </div>                                                                           
                      </div>  
                      <div class="modal-footer">
                        <br>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- END OF SHOW DATA CUSTOM PROCESS -->

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
