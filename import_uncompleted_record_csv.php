<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");

$datenow = date('YmdHis');
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=uncompleted_record_import$datenow.xls");
 
include "include/connection.php";

?>
<table id="example1"  class="table table-bordered table-striped">
                  <thead>
                    <tr>
                    <th>RcdID</th>
                      <th>RcdDate</th>
                      <th>KNREF/TN</th>
                      <th>CNEE</th>
                      <th>AJU NO.</th>
                      <th>PreClearance</th>
                      <th>Clearance</th>
                      <th>PostClearance</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $con=mysqli_connect("localhost","root","","contta");
                     $result = mysqli_query($con,"SELECT * FROM tb_record_miles_import INNER JOIN tb_master_impor ON tb_record_miles_import.rcd_id=tb_master_impor.rcd_id WHERE tb_record_miles_import.post = '0'");
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['rcd_id'] . "</td>"; 
                        echo "<td>" . $row['rcd_create_date'] . "</td>"; 
                        echo "<td>" . $row['rcd_ref'] . "</td>";   
                        echo "<td>" . $row['rcd_cnee'] . "</td>";                      
                        echo "<td>" . $row['rcd_aju'] . "</td>";  
                        echo "<td>" . $row['pre'] . "</td>";  
                        echo "<td>" . $row['clear'] . "</td>";  
                        echo "<td>" . $row['post'] . "</td>";  
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