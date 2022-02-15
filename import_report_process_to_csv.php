<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");

$datenow = date('YmdHis');

// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=seaimportshipment-proccess$datenow.xls");

include "include/connection.php";
$monthnow  = $_GET['month'];
$yearnow   = $_GET['year'];

?>
<table id="example1"  class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>RcdID</th>
      <th>RcdDate</th>
      <th>RcdBy</th>
      <th>SPPBStatus</th>
      <th>HBL</th>
      <th>AJU NBR</th>
      <th>KNREF/TN</th>
      <th>SHIPPER</th>
      <th>CONSIGNEE</th>
      <th>INVOICE NBR</th>
      <th>MOT</th>
      <th>20'</th>
      <th>40'</th>
      <th>PARTY</th>
      <th>TOTAL PACKAGE LCL</th>
      <th>TOTAL WEIGHT</th>
      <th>TOTAL CBM</th>
      <th>ETA</th>
      <th>COO</th>
      <th>RECEIVED CIPL</th>
      <th>SEND PIB DRAFT</th>                      
      <th>RECEIVE PIB REVISION</th>                      
      <th>SEND PIB REVISION</th>
      <th>RECEIVE DOC COMPLETED</th>
      <th>PIB CONFIRMATION</th>
      <th>COO</th>
      <th>DO VALIDATION</th>
      <th>ATA</th>
      <th>RCVD DO</th>
      <th>TRANSFER PIB</th>
      <th>BILLING</th>
      <th>PAID DUTY TAX</th>
      <th>SPJK</th>
      <th>SPJM</th>
      <th>SPPB</th>
      <th>DELIVERY</th>
      <th>SUBMIT COO</th>
      <th>RCVD INV VENDOR</th>
      <th>CREATE BILLING</th>
      <th>SEND BILLING</th>
      <th>FILLING</th>
      <th>REMARKS</th>
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

    $result = mysqli_query($con,"SELECT * FROM tb_master_impor 
      INNER JOIN tb_imp_pre ON tb_master_impor.rcd_id=tb_imp_pre.rcd_id
      INNER JOIN tb_imp_clear ON tb_master_impor.rcd_id=tb_imp_clear.rcd_id
      INNER JOIN tb_imp_post ON tb_master_impor.rcd_id=tb_imp_post.rcd_id
      WHERE tb_master_impor.rcd_type = 'import' AND tb_master_impor.rcd_create_month='$monthnow' AND tb_master_impor.rcd_create_year='$yearnow' AND tb_master_impor.rcd_mot != 'AIR' ");

    if(mysqli_num_rows($result)>0){ 

      while($row = mysqli_fetch_array($result))
      {
        echo "<tr>";
        echo "<td>" . $row['rcd_id'] . "</td>";
        echo "<td>" . $row['rcd_create_date'] . "</td>";
        echo "<td>" . $row['rcd_create_by'] . "</td>";

        if ($row['cle_sppb'] == "0000-00-00") {
          echo "<td>" . "No" . "</td>";
        } else {
          echo "<td>" . "Yes" . "</td>";
        }

        echo "<td>" . $row['rcd_hbl'] . "</td>";    
        echo "<td>" . $row['rcd_aju'] . "</td>";
        echo "<td>" . $row['rcd_ref'] . "</td>";
        echo "<td>" . $row['rcd_shipper'] . "</td>";
        echo "<td>" . $row['rcd_cnee'] . "</td>";
        echo "<td>" . $row['rcd_inv_no'] . "</td>";
        echo "<td>" . $row['rcd_mot'] . "</td>";
        echo "<td>" . $row['rcd_20_type'] . "</td>";
        echo "<td>" . $row['rcd_40_type'] . "</td>";
        echo "<td>" . $row['rcd_party'] . "</td>";
        echo "<td>" . $row['rcd_package'] . "</td>";
        echo "<td>" . $row['rcd_weight'] . "</td>";
        echo "<td>" . $row['rcd_cbm'] . "</td>";
        echo "<td>" . $row['rcd_eta'] . "</td>";
        echo "<td>" . $row['rcd_coo'] . "</td>";
        echo "<td>" . $row['pre_rcvd_cipl'] . "</td>";
        echo "<td>" . $row['pre_send_pib_draft'] . "</td>";               
        echo "<td>" . $row['pre_rcvd_pib_rev'] . "</td>";
        echo "<td>" . $row['pre_send_pib'] . "</td>";
        echo "<td>" . $row['pre_rcvd_complete'] . "</td>";
        echo "<td>" . $row['pre_create_pib'] . "</td>";

        echo "<td>" . $row['rcd_coo'] . "</td>"; 
        echo "<td>" . $row['rcd_do_validation'] . "</td>";
        echo "<td>" . $row['rcd_ata'] . "</td>";
        echo "<td>" . $row['rcd_rcvd_do'] . "</td>";
        echo "<th>" . $row['cle_trf_pib'] . "</th>";
        echo "<th>" . $row['cle_billing'] . "</th>";
        echo "<th>" . $row['cle_paid_duty_tax'] . "</th>";
        echo "<th>" . $row['cle_spjk'] . "</th>";
        echo "<th>" . $row['cle_spjm'] . "</th>";
        echo "<th>" . $row['cle_sppb'] . "</th>";

        /* GET DELIVERY DATE - START */
        $dlv0 = mysql_query("SELECT dlv_date FROM tb_truck_assign WHERE rcd_id = '$row[rcd_id]' ");
        $dlv1 = mysql_fetch_array($dlv0);

        echo "<th>" . $dlv1['dlv_date'] . "</th>";
        /* GET DELIVERY DATE - END*/

        echo "<th>" . $row['cle_submit_coo'] . "</th>";
        echo "<td>" . $row['post_rcvd_inv_vendor'] . "</td>";
        echo "<td>" . $row['post_billing_customer'] . "</td>";               
        echo "<td>" . $row['post_billing_send'] . "</td>";
        echo "<td>" . $row['post_filling'] . "</td>"; 

        echo "<td>" 
        . "Pre : " . $row['pre_rev_remark'] . " // "
        . "Clear : " . $row['cle_remark'] . " // "
        . "Post : " . $row['post_remark'] . 
        "</td>"; 
        echo "</tr>";
        ?>

        <?php
      }
    } else {
      echo "<tr>";
      echo "<td colspan='10' align='center'>"."<b>"."<i>" . "No Available Record" . "</i>". "</b>" . "</td>";
      echo "</tr>";
    } 

    mysqli_close($con);
    ?>
  </tbody>
</table>