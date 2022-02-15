<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p align="center"><img src="images/header.png" width="30%" align="center"></p>
                <h4 align="center"><b>LOCAL</b><i> for </i> <b>CONTTA</b></h4>

                <hr>

                            <?php
                            mysql_connect('localhost', 'knidcore_admin','Flatrone2241');
                            mysql_select_db('knidcore_gsk');
                            $logid = mysql_query("SELECT * FROM tb_truck_job_log INNER JOIN tb_truck_job_details ON tb_truck_job_log.tract_id=tb_truck_job_details.tract_id WHERE tb_truck_job_log.tract_id = '$_GET[tract_id]'");
                            $showlog = mysql_fetch_array($logid);                                
                            ?>
                           <p>Tr.ID  : <?php echo $_GET['tract_id'] ;?> <br>
                            Container No.  : <?php echo $showlog['tract_cont_no'] ;?> <br>
                            Vehicle No.  : <?php echo $showlog['tract_vehicle_no'] ;?></p>

                <hr>

                <h4 align="center">JOB LOG DETAILS!</h4>

            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table style="align-items: center;" border="1px" align="center">
                        <thead>
                            <tr>
                                <th style="width: 200px;height: 50px;">LogID</th>
                                <th style="width: 200px;height: 50px;">Tr.ID</th>
                                <th style="width: 200px;height: 50px;">DateTime</th>
                                <th style="width: 200px;height: 50px;">Location</th>
                                <th style="width: 200px;height: 50px;">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          $ids  = $_GET['tract_id'];
                          $con=mysqli_connect("localhost","knidcore_admin","Flatrone2241","knidcore_gsk");
                              $result = mysqli_query($con,"SELECT * FROM tb_truck_job_log  where tract_id = '$ids' ");
                          if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_array($result))
                            {
                              echo "<tr>";
                              echo "<td>" . $row['joblog_id'] . "</td>";
                              echo "<td>" . $row['tract_id'] . "</td>";                      
                              echo "<td>" . $row['datetime_up'] . "</td>";
                              echo "<td>" . $row['current_loc'] . "</td>";               
                              echo "<td>" . $row['remark'] . "</td>";
                              echo "</tr>";

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
</div>