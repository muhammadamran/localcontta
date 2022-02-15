<div class="row">
  <div class="col-lg-12">
    <div id="accordion">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapsepack" aria-expanded="true" aria-controls="collapseOne">
              Package Details
            </button>
          </h5>
        </div>

        <div id="collapsepack" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
           <?php 
           $ref = $_GET['ref'];
           mysql_connect('localhost', 'root','');
           mysql_select_db('contta'); 
           $getsearch = mysql_query("SELECT * FROM tb_master_impor 
            INNER JOIN tb_imp_pre ON tb_master_impor.rcd_id = tb_imp_pre.rcd_id  
            INNER JOIN tb_imp_clear ON tb_master_impor.rcd_id = tb_imp_clear.rcd_id 
            INNER JOIN tb_imp_post ON tb_master_impor.rcd_id = tb_imp_post.rcd_id           
            WHERE tb_master_impor.rcd_ref = '$ref'");
           $getsql = mysql_fetch_array($getsearch);
           ?> 
           <table class="table table-striped table-bordered table-hover">                   
            <thead>
              <tr>
                <th>20'</th>
                <th>40'</th>
                <th>Party</th>
                <th>Weight</th>
                <th>Package</th>
                <th>CBM</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $getsql['rcd_20_type'];?></td>
                <td><?php echo $getsql['rcd_40_type'];?></td>
                <td><?php echo $getsql['rcd_party'];?></td>
                <td><?php echo $getsql['rcd_weight'];?></td>
                <td><?php echo $getsql['rcd_package'];?></td>
                <td><?php echo $getsql['rcd_cbm'];?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            PIB Details
          </button>
        </h5>
      </div>

      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
         <table class="table table-striped table-bordered table-hover">                   
          <thead>
            <tr>              
              <th>SEND PIB DRAFT</th>                      
              <th>RECEIVE PIB REVISION</th>                      
              <th>SEND PIB REVISION</th>
              <th>RECEIVE DOC COMPLETED</th>
              <th>PIB CONFIRMATION</th>
              <th>PIB TRANSMIT</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $getsql['pre_send_pib_draft'];?></td>
              <td><?php echo $getsql['pre_rcvd_pib_rev'];?></td>
              <td><?php echo $getsql['pre_send_pib'];?></td>
              <td><?php echo $getsql['pre_rcvd_complete'];?></td>
              <td><?php echo $getsql['pre_create_pib'];?></td>
              <td><?php echo $getsql['cle_trf_pib'];?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Customs Details
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-striped table-bordered table-hover">                   
          <thead>
            <tr>                        
              <th>PAID DUTY TAX</th>
              <th>SPJK</th>
              <th>SPJM</th>
              <th>SPPB</th>
              <th>SUBMIT COO</th>                      
              <th>RCVD DO</th>
              <th>DO VALIDATION</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $getsql['cle_paid_duty_tax'];?></td>
              <td><?php echo $getsql['cle_spjk'];?></td>
              <td><?php echo $getsql['cle_spjm'];?></td>
              <td><?php echo $getsql['cle_sppb'];?></td>
              <td><?php echo $getsql['cle_submit_coo'];?></td>
              <td><?php echo $getsql['rcd_rcvd_do'];?></td>
              <td><?php echo $getsql['rcd_do_validation'];?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Trucking Details
        </button>
      </h5>
    </div>
    <?php 
    $ref = $_GET['ref'];
    mysql_connect('localhost', 'root','');
    mysql_select_db('contta'); 
    $getsearch2 = mysql_query("SELECT * FROM tb_master_impor 
      INNER JOIN tb_truck_assign ON tb_master_impor.rcd_id = tb_truck_assign.rcd_id                
      INNER JOIN tb_truck_job_details ON tb_master_impor.rcd_id = tb_truck_job_details.rcd_id  
      WHERE tb_master_impor.rcd_ref = '$ref'");
    $getsql2 = mysql_fetch_array($getsearch2);
    ?> 
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-striped table-bordered table-hover">                   
          <thead>
            <tr>
              <th>VENDOR NAME</th>
              <th>ORDER SENT</th>                        
              <th>RCVD ORDER FROM KN</th>
              <th>RCVD BY</th>
              <th>DRIVER NAME</th>
              <th>DRIVER PHONE</th>
              <th>VEHICLE NO</th>                      
              <th>CONTAINER NO</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $getsql2['assign_vendor'];?></td>
              <td><?php echo $getsql2['order_rcvd_date'];?></td>
              <td><?php echo $getsql2['tract_order_rcvd'];?></td>
              <td><?php echo $getsql2['tract_order_rcvd_by'];?></td>
              <td><?php echo $getsql2['tract_driver_name'];?></td>
              <td><?php echo $getsql2['tract_driver_phone'];?></td>
              <td><?php echo $getsql2['tract_vehicle_no'];?></td>
              <td><?php echo $getsql2['tract_cont_no'];?></td>              
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsedel" aria-expanded="false" aria-controls="collapseThree">
          Delivery Details
        </button>
      </h5>
    </div>
    <div id="collapsedel" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-striped table-bordered table-hover">                   
          <thead>
            <tr>                        
              <th>Truck GO</th>
              <th>Arrive in warehouse</th>
              <th>Start stuff</th>
              <th>Complete stuff</th>
              <th>Leave the warehouse</th>
              <th>Arrive in dest</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $getsql2['rcd_cus_peb_date'];?></td>
              <td><?php echo $getsql2['rcd_cus_peb_transmit'];?></td>
              <td><?php echo $getsql2['rcd_cus_no_aju'];?></td>
              <td><?php echo $getsql2['rcd_cus_peb_nopen'];?></td>
              <td><?php echo $getsql2['rcd_cus_npe_date'];?></td>
              <td><?php echo $getsql2['rcd_ar_ck2_app'];?></td>
              <td><?php echo $getsql2['rcd_ar_sac_no'];?></td>
              <td><?php echo $getsql2['rcd_ar_sac'];?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          E-File
        </button>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-striped table-bordered table-hover">                   
          <thead>
            <tr>                        
              <th>PIB</th>
              <th>SPPB</th>
              <th>SIPL</th>                      
              <th>COO</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php 
              if ($getsql['pib_file'] == "") {
                echo "<td>" . "file not found" . "</td>";
              } else {
                echo "<td>" . "<a href='$getsql[pib_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>"; 
              } 
              ?>

              <?php 
              if ($getsql['sppb'] == "") {
                echo "<td>" . "file not found" . "</td>";
              } else {
                echo "<td>" . "<a href='$getsql[sppb]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>"; 
              } 
              ?>

              <?php 
              if ($getsql['cipl_file'] == "") {
                echo "<td>" . "file not found" . "</td>";
              } else {
                echo "<td>" . "<a href='$getsql[cipl_file]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>"; 
              } 
              ?>
              <?php 
              if ($getsql['coo'] == "") {
                echo "<td>" . "file not found" . "</td>";
              } else {
                echo "<td>" . "<a href='$getsql[coo]' title='File' target='_BLANK'><span class='label label-primary'>View</span></a>" . "</td>"; 
              } 
              ?>                       
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
</div>