<!-- START FOR IMPORT MENU MASTER -->

            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Import<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#" style="background-color: skyblue;color: white"><i class="fa fa-files-o fa-fw"></i> <b>Seafreight</b><span class="fa arrow"></span></a>
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
                                <a class="#" href="imp_cost_sheet?hbl=##"><i class="#"></i>*) Cost Sheet</a>
                            </li>
                            <li>
                                <a class="#" href="imp_efile.php?hbl=##"><i class="#"></i>*) E-FILE</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <!-- END FOR IMPORT MENU MASTER  -->