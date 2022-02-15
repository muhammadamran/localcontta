<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;background-color: #26c5e6;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html" style="color: white"><b style="color: white">LOCAL</b>CONTTA</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <span id="ct" class="navbar-brand"> </span>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i><b><?php echo $_SESSION['username'];?></b><i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user" style="color: white">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a class="active" href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a class="#" href="search.php"><i class="fa fa-file fa-fw"></i> Search</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-files-o fa-fw"></i> Export<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="export_master.php">Export Master</a>
                        </li>
                                <!-- <li>
                                    <a class="#" href="ship_arr.php"><i class="#"></i>1) Ship. Arrangement</a>
                                </li> -->
                                <li>
                                    <a class="#" href="ship_cus.php"><i class="#"></i>1) Custom Arrangement</a>
                                </li>
                                <li>
                                    <a class="#" href="ship_mon.php"><i class="#"></i>2) Ship. Monitoring</a>
                                </li>   
                                <li>
                                    <a class="#" href="exp_efile.php?ref=##"><i class="#"></i>*) E-FILE</a>
                                </li>                             
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Import<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <!-- 
                                =========================
                                =========================
                                START IMPORT MASTER SECTION 
                                =========================
                                =========================
                            -->

                            <?php 
                            $con=mysqli_connect("localhost","root","","contta");
                            $result1 = mysqli_query($con,"SELECT * FROM tb_master_impor WHERE rcd_status = 'New' ");
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

                            <?php }?>


                            <!-- 
                                =========================
                                =========================
                                END IMPORT MASTER SECTION 
                                =========================
                                =========================
                            -->


                            <!-- 
                                =========================
                                =========================
                                START PRE CLEARANCE SECTION 
                                =========================
                                =========================
                            -->

                            <?php 
                            $con=mysqli_connect("localhost","root","","contta");
                            $result2 = mysqli_query($con,"SELECT * FROM tb_record_miles_import INNER JOIN tb_imp_pre ON tb_record_miles_import.rcd_id=tb_imp_pre.rcd_id WHERE tb_record_miles_import.pre = '0' ");
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

                            <?php }?>


                            <!-- 
                                =========================
                                =========================
                                END PRE CLEARANCE SECTION 
                                =========================
                                =========================
                            -->


                            <!-- 
                                =========================
                                =========================
                                START CLEARANCE SECTION 
                                =========================
                                =========================
                            -->

                            <?php 
                            $con=mysqli_connect("localhost","root","","contta");
                            $result3 = mysqli_query($con,"SELECT * FROM tb_record_miles_import INNER JOIN tb_imp_clear ON tb_record_miles_import.rcd_id=tb_imp_clear.rcd_id WHERE tb_record_miles_import.clear = '0' AND tb_record_miles_import.pre != '0' ");
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


                            <!-- 
                                =========================
                                =========================
                                END CLEARANCE SECTION 
                                =========================
                                =========================
                            -->


                            <!-- 
                                =========================
                                =========================
                                START POST-CLEARANCE SECTION 
                                =========================
                                =========================
                            -->

                            <?php 
                            $con=mysqli_connect("localhost","root","","contta");
                            $result4 = mysqli_query($con,"SELECT * FROM tb_record_miles_import INNER JOIN tb_imp_post ON tb_record_miles_import.rcd_id=tb_imp_post.rcd_id WHERE tb_record_miles_import.post = '0' AND tb_record_miles_import.clear != '0'");
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


                            <!-- 
                                =========================
                                =========================
                                END POST-CLEARANCE SECTION 
                                =========================
                                =========================
                            -->
                            <li>
                                <a class="#" href="import_set_trucking.php?ref=##"><i class="#"></i>4) Set Trucking</a>
                            </li>
                            <li>
                                <a class="#" href="imp_efile.php?hbl=##"><i class="#"></i>*) E-FILE</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-truck fa-fw"></i> Trucker<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                         <li>
                            <a class="#" href="truck_confirm_job.php?ref=0000000.php"><i class="#"></i>Confirm Job</a>
                        </li>
                        <li>
                            <a class="#" href="truck_job_confirmed.php?ref=0000000.php"><i class="#"></i>Job List</a>
                        </li>
                            <!-- <li>
                                <a class="#" href="truck_vendor_activity.php"><i class="#"></i>Vendor Activity</a>
                            </li>  -->                                                 
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                        <!-- <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Vendor Clearance<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="truck_assign_job.php?ref=0000">KN - Assign Job</a>
                                </li>
                                <li>
                                    <a class="#" href="truck_confirm_job.php?ref=0000"><i class="#"></i>Confirm Job</a>
                                </li>
                                <li>
                                    <a class="#" href="truck_job_list.php"><i class="#"></i>Job List</a>
                                </li>
                                <li>
                                    <a class="#" href="truck_vendor_activity.php"><i class="#"></i>Vendor Activity</a>
                                </li>                                                  
                            </ul>
                            <!-- /.nav-second-level
                            </li> -->

                            <li>
                                <a href="#"><i class="fa fa-wrench fa-fw"></i> Administration<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">

                                    <li>
                                        <a href="iou_adm_cnee.php">Consignee</a>
                                    </li>
                                    <li>
                                        <a href="iou_adm_shipper.php">Shipper</a>
                                    </li>

                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-table fa-fw"></i> Report<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">                            
                                    <li>
                                        <a href="#"> Export Record<span class="fa arrow"></span></a>
                                        <ul class="nav nav-second-level">
                                            <li>
                                                <a href="export_report_process.php?month=0&year=0"><i class="fa fa-sitemap fa-fw"></i> Report Process</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Performance <span class="fa arrow"></span></a>
                                                <ul class="nav nav-third-level">
                                                    <li>
                                                        <a href="perform_truck_level.php?month=0&year=0">Trucking Level</a>
                                                    </li>
                                                    <li>
                                                        <a href="perfom_declaration_level.php?month=0&year=0">PEB/PIB Level</a>
                                                    </li>
                                                    <li>
                                                        <a href="perform_stuffing_level.php?month=0&year=0">Stuffing Level</a>
                                                    </li>
                                                </ul>
                                                <!-- /.nav-third-level -->
                                            </li>
                                        </ul>
                                        <!-- /.nav-second-level -->
                                    </li>
                                    <li>
                                        <a href="#"> Import Record<span class="fa arrow"></span></a>
                                        <ul class="nav nav-second-level">
                                            <li>
                                                <a href="import_report_process.php?month=0&year=0"><i class="fa fa-sitemap fa-fw"></i> Report Process</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Performance <span class="fa arrow"></span></a>
                                                <ul class="nav nav-third-level">
                                                    <li>
                                                        <a href="perform_impor_ryg_level.php?month=0&year=0">R-Y-G</a>
                                                    </li>
                                                    <li>
                                                        <a href="perfom_impor_trucking_level.php?month=0&year=0">Trucking Level</a>
                                                    </li>
                                                    <li>
                                                        <a href="perform_impor_billing_level.php?month=0&year=0">Billing Level</a>
                                                    </li>
                                                </ul>
                                                <!-- /.nav-third-level -->
                                            </li>
                                        </ul>
                                        <!-- /.nav-second-level -->
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <br>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>