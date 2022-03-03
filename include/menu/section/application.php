<li class="section">
    <div>
        APPLICATION SECTION
    </div>
</li>
<li class="<?= $uriSegments[2] == 'air_export_master.php' ? 'active' : '' ?>">
    <a class="<?= $uriSegments[2] == 'air_export_master.php' ? 'active' : '' ?>" href="#"><i class="fa fa-box fa-fw"></i> Export<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#" style="background-color: skyblue;color: white"><i class="fa fa-files-o fa-fw"></i> <b>Airfreight</b><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="air_export_master.php">Export Master</a>
                </li>
                <?php 
                $con=mysqli_connect("localhost","root","","contta");
                $result1 = mysqli_query($con,"SELECT * FROM tb_record_miles_export INNER JOIN tb_ex_custom ON tb_record_miles_export.rcd_id=tb_ex_custom.rcd_id WHERE tb_record_miles_export.miles_custom = 0 AND tb_record_miles_export.miles_arr != 0 AND tb_record_miles_export.mot = 'AIR' ");
                $cus_total = mysqli_num_rows($result1);
                if ($cus_total == 0) {                            
                    ?>
                    <li>
                        <a class="#" href="ship_cus.php"><i class="#"></i>1) Custom Arrangement </a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a class="#" href="ship_cus.php"><i class="#"></i>1) Custom Arrangement <i class="btn btn-danger btn-circle"><?php echo $cus_total;?></i></a>
                    </li>

                <?php }?>
                <li>
                    <a class="#" href="ship_mon.php"><i class="#"></i>2) Ship. Monitoring</a>
                </li>   
                <li>
                    <a class="#" href="exp_efile.php?ref=##"><i class="#"></i>*) E-FILE</a>
                </li>                             
            </ul>
        </li>
        <li>
            <a href="#" style="background-color: skyblue;color: white"><i class="fa fa-files-o fa-fw"></i> <b>Seafreight</b><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="export_master.php">Export Master</a>
                </li>
                <?php 
                $con=mysqli_connect("localhost","root","","contta");
                $result1 = mysqli_query($con,"SELECT * FROM tb_record_miles_export INNER JOIN tb_ex_custom ON tb_record_miles_export.rcd_id=tb_ex_custom.rcd_id WHERE tb_record_miles_export.miles_custom = 0 AND tb_record_miles_export.miles_arr != 0 AND tb_record_miles_export.mot = 'AIR' ");
                $cus_total = mysqli_num_rows($result1);
                if ($cus_total == 0) {                            
                    ?>
                    <li>
                        <a class="#" href="ship_cus.php"><i class="#"></i>1) Custom Arrangement </a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a class="#" href="ship_cus.php"><i class="#"></i>1) Custom Arrangement <i class="btn btn-danger btn-circle"><?php echo $cus_total;?></i></a>
                    </li>

                <?php }?>
                <li>
                    <a class="#" href="ship_mon.php"><i class="#"></i>2) Ship. Monitoring</a>
                </li>
                <li>
                    <a class="#" href="ship_mon.php"><i class="#"></i>3) COO Management</a>
                </li>
                <li>
                    <a class="#" href="ship_mon.php"><i class="#"></i>4) Billing</a>
                </li>
                <li>
                    <a class="#" href="ship_mon.php"><i class="#"></i>5) Set Trucker</a>
                </li> 
                <li>
                    <a class="#" href="exp_efile.php?ref=##"><i class="#"></i>*) E-FILE</a>
                </li>                             
            </ul>
        </li>
    </ul>
</li>
<li class="<?= $uriSegments[2] == 'air_import_master.php' || $uriSegments[2] == 'air_imp_pre.php' || $uriSegments[2] == 'air_imp_clear.php' || $uriSegments[2] == 'air_imp_post.php' || $uriSegments[2] == 'import_set_trucking.php' || $uriSegments[2] == 'imp_efile.php' ? 'active' : '' ?>">
    <a class="<?= $uriSegments[2] == 'air_import_master.php' || $uriSegments[2] == 'air_imp_pre.php' || $uriSegments[2] == 'air_imp_clear.php' || $uriSegments[2] == 'air_imp_post.php' || $uriSegments[2] == 'import_set_trucking.php' || $uriSegments[2] == 'imp_efile.php' ? 'active' : '' ?>" href="#"><i class="fa fa-dolly-flatbed fa-fw"></i> Import<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#" style="background-color: skyblue;color: white"><i class="fa fa-files-o fa-fw"></i> <b>Airfreight</b><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <?php 
                $con=mysqli_connect("localhost","root","","contta");
                $result1 = mysqli_query($con,"SELECT * FROM tb_master_impor WHERE rcd_status = 'New' AND rcd_mot = 'AIR'");
                $total1 = mysqli_num_rows($result1);
                if ($total1 == 0) {                            
                    ?>
                    <li>
                        <a href="air_import_master.php">Import Master</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a class="#" href="air_import_master.php"><i class="#"></i>Import Master <i class="btn btn-primary btn-circle"><?php echo $total1;?></i></a>
                    </li>
                <?php } ?>
                <?php 
                $con=mysqli_connect("localhost","root","","contta");
                $result2 = mysqli_query($con,"SELECT * FROM tb_record_miles_import INNER JOIN tb_imp_pre ON tb_record_miles_import.rcd_id=tb_imp_pre.rcd_id WHERE tb_record_miles_import.pre = '0' AND tb_record_miles_import.mot = 'AIR' ");
                $total2 = mysqli_num_rows($result2);
                if ($total2 == 0) {                            
                    ?>
                    <li>
                        <a class="#" href="air_imp_pre.php"><i class="#"></i>1) Pre-Clearance</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a class="#" href="air_imp_pre.php"><i class="#"></i>1) Pre-Clearance <i class="btn btn-primary btn-circle"><?php echo $total2;?></i></a>
                    </li>
                <?php } ?>
                <?php 
                $con=mysqli_connect("localhost","root","","contta");
                $result3 = mysqli_query($con,"SELECT * FROM tb_record_miles_import INNER JOIN tb_imp_clear ON tb_record_miles_import.rcd_id=tb_imp_clear.rcd_id WHERE tb_record_miles_import.clear = '0' AND tb_record_miles_import.pre != '0' AND tb_record_miles_import.mot = 'AIR' ");
                $total3 = mysqli_num_rows($result3);
                if ($total3 == 0) {                            
                    ?>
                    <li>
                        <a class="#" href="air_imp_clear.php"><i class="#"></i>2) Clearance</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a class="#" href="air_imp_clear.php"><i class="#"></i>2) Clearance <i class="btn btn-primary btn-circle"><?php echo $total3;?></i></a>
                    </li>
                <?php } ?>
                <?php 
                $con=mysqli_connect("localhost","root","","contta");
                $result4 = mysqli_query($con,"SELECT * FROM tb_record_miles_import INNER JOIN tb_imp_post ON tb_record_miles_import.rcd_id=tb_imp_post.rcd_id WHERE tb_record_miles_import.post = '0' AND tb_record_miles_import.clear != '0' AND tb_record_miles_import.mot = 'AIR'");
                $total4 = mysqli_num_rows($result4);
                if ($total4 == 0) {                            
                    ?>
                    <li>
                        <a class="#" href="air_imp_post.php"><i class="#"></i>3) Post Clearance</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a class="#" href="air_imp_post.php"><i class="#"></i>3) Post Clearance <i class="btn btn-primary btn-circle"><?php echo $total4;?></i></a>
                    </li>

                <?php }?>
                <li>
                    <a class="#" href="import_set_trucking.php?ref=##"><i class="#"></i>4) Set Trucking</a>
                </li>
                <li>
                    <a class="#" href="imp_cost_sheet?hbl=##"><i class="#"></i>*) Cost Sheet</a>
                </li>
                <li>
                    <a class="#" href="imp_efile.php?hbl=##"><i class="#"></i>*) E-FILE</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" style="background-color: skyblue;color: white"><i class="fa fa-files-o fa-fw"></i> <b>Seafreight</b><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <?php 
                $con=mysqli_connect("localhost","root","","contta");
                $result1 = mysqli_query($con,"SELECT * FROM tb_master_impor WHERE rcd_status = 'New' AND rcd_mot != 'AIR' ");
                $total1 = mysqli_num_rows($result1);
                if ($total1 == 0) {                            
                    ?>
                    <li>
                        <a href="import_master.php">Import Master</a>
                    </li>

                <?php } else { ?>

                    <li>
                        <a class="#" href="import_master.php"><i class="#"></i>Import Master <i class="btn btn-primary btn-circle"><?php echo $total1;?></i></a>
                    </li>

                <?php } ?>
                <?php 
                $con=mysqli_connect("localhost","root","","contta");
                $result2 = mysqli_query($con,"SELECT * FROM tb_record_miles_import INNER JOIN tb_imp_pre ON tb_record_miles_import.rcd_id=tb_imp_pre.rcd_id WHERE tb_record_miles_import.pre = '0' AND tb_record_miles_import.mot != 'AIR' ");
                $total2 = mysqli_num_rows($result2);
                if ($total2 == 0) {                            
                    ?>

                    <li>
                        <a class="#" href="imp_pre.php"><i class="#"></i>1) Pre-Clearance</a>
                    </li>

                <?php } else { ?>

                    <li>
                        <a class="#" href="imp_pre.php"><i class="#"></i>1) Pre-Clearance <i class="btn btn-primary btn-circle"><?php echo $total2;?></i></a>
                    </li>

                <?php } ?>
                <?php 
                $con=mysqli_connect("localhost","root","","contta");
                $result3 = mysqli_query($con,"SELECT * FROM tb_record_miles_import INNER JOIN tb_imp_clear ON tb_record_miles_import.rcd_id=tb_imp_clear.rcd_id WHERE tb_record_miles_import.clear = '0' AND tb_record_miles_import.pre != '0' AND tb_record_miles_import.mot != 'AIR'");
                $total3 = mysqli_num_rows($result3);
                if ($total3 == 0) {                            
                    ?>

                    <li>
                        <a class="#" href="imp_clear.php"><i class="#"></i>2) Clearance</a>
                    </li>

                <?php } else { ?>

                    <li>
                        <a class="#" href="imp_clear.php"><i class="#"></i>2) Clearance <i class="btn btn-primary btn-circle"><?php echo $total3;?></i></a>
                    </li>

                <?php }?>
                <?php 
                $con=mysqli_connect("localhost","root","","contta");
                $result4 = mysqli_query($con,"SELECT * FROM tb_record_miles_import INNER JOIN tb_imp_post ON tb_record_miles_import.rcd_id=tb_imp_post.rcd_id WHERE tb_record_miles_import.post = '0' AND tb_record_miles_import.clear != '0' AND tb_record_miles_import.mot != 'AIR'");
                $total4 = mysqli_num_rows($result4);
                if ($total4 == 0) {                            
                    ?>

                    <li>
                        <a class="#" href="imp_post.php"><i class="#"></i>3) Post Clearance</a>
                    </li>

                <?php } else { ?>

                    <li>
                        <a class="#" href="imp_post.php"><i class="#"></i>3) Post Clearance <i class="btn btn-primary btn-circle"><?php echo $total4;?></i></a>
                    </li>

                <?php }?>
                <li>
                    <a class="#" href="import_set_trucking.php?ref=##"><i class="#"></i>4) Set Trucking</a>
                </li>
                <li>
                    <a class="#" href="imp_cost_sheet?hbl=##"><i class="#"></i>*) Cost Sheet</a>
                </li>
                <li>
                    <a class="#" href="imp_efile.php?hbl=##"><i class="#"></i>*) E-FILE</a>
                </li>
            </ul>
        </li>
    </ul>
</li>
<li class="<?= $uriSegments[2] == 'truck_confirm_job.php' || $uriSegments[2] == 'truck_job_confirmed.php' ? 'active' : '' ?>">
    <a class="<?= $uriSegments[2] == 'truck_confirm_job.php' || $uriSegments[2] == 'truck_job_confirmed.php' ? 'active' : '' ?>" href="#"><i class="fa fa-truck-moving fa-fw"></i> Trucker<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li class="<?= $uriSegments[2] == 'truck_confirm_job.php' ? 'show' : '' ?>">
            <!-- <a class="#" href="truck_confirm_job.php?ref=0000000.php"><i class="#"></i>Confirm Job</a> -->
            <a class="#" href="truck_confirm_job.php"><i class="#"></i><i class="fas fa-caret-right" aria-hidden="true"></i> Confirm Job</a>
        </li>
        <li class="<?= $uriSegments[2] == 'truck_job_confirmed.php' ? 'show' : '' ?>">
            <!-- <a class="#" href="truck_job_confirmed.php?ref=0000000.php"><i class="#"></i>Job List</a> -->
            <a class="#" href="truck_job_confirmed.php"><i class="#"></i><i class="fas fa-caret-right" aria-hidden="true"></i> Job List</a>
        </li>                                             
    </ul>
</li>