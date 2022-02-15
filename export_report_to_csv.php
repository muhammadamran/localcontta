<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");

$datenow = date('Y-m-d');
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=exportshipent-proccess$datenow.xls");
 
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
                      <th>ShipPlan</th>
                      <th>Shipper</th>
                      <th>Cnee</th>
                      <th>InvNo</th>
                      <th>PO_No.</th>
                      <th>Do_No</th>
                      <th>Liner</th>
                      <th>Cont.No</th>
                      <th>Cont.Ready</th>
                      <th>StuffStart</th>
                      <th>StuffEnd</th>
                      <th>Cont.Leave</th>
                      <th>Cont.CY</th>
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

                    $result = mysqli_query($con,"SELECT * FROM tb_record_master INNER JOIN 
                      tb_record_ship_arr ON tb_record_master.rcd_id=tb_record_ship_arr.rcd_id  
                      INNER JOIN
                      tb_record_ship_cus ON tb_record_master.rcd_id=tb_record_ship_cus.rcd_id
                      INNER JOIN
                      tb_record_ship_exe ON tb_record_master.rcd_id=tb_record_ship_exe.rcd_id
                      INNER JOIN
                      tb_record_ship_mon ON tb_record_master.rcd_id=tb_record_ship_mon.rcd_id
                      INNER JOIN 
                      tb_record_miles ON tb_record_master.rcd_id=tb_record_miles.rcd_id
                      WHERE tb_record_master.rcd_create_month='$monthnow' AND tb_record_master.rcd_create_year='$yearnow' ");

                    if(mysqli_num_rows($result)>0){ 

                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['rcd_id'] . "</td>";
                        echo "<td>" . $row['rcd_create_date'] . "</td>";
                        echo "<td>" . $row['rcd_create_by'] . "</td>";
                        echo "<td>" . $row['rcd_ship_plan'] . "</td>";                                        
                        echo "<td>" . $row['rcd_shipper'] . "</td>";
                        echo "<td>" . $row['rcd_cnee'] . "</td>";
                        echo "<td>" . $row['rcd_inv_no'] . "</td>";
                        echo "<td>" . $row['rcd_po_no'] . "</td>";
                        echo "<td>" . $row['rcd_exe_do_no'] . "</td>";
                        echo "<td>" . $row['rcd_exe_liner'] . "</td>";
                        echo "<td>" . $row['rcd_exe_con_no'] . "</td>";
                        echo "<td>" . $row['rcd_exe_truck_arrived'] . "</td>";
                        echo "<td>" . $row['rcd_exe_stuff_start'] . "</td>";
                        echo "<td>" . $row['rcd_exe_stuff_end'] . "</td>";
                        echo "<td>" . $row['rcd_exe_con_leave'] . "</td>";
                        echo "<td>" . $row['rcd_exe_con_cy'] . "</td>";
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