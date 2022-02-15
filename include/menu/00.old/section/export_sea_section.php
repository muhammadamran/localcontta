<li>
    <a href="#"><i class="fa fa-sitemap fa-fw"></i> Export<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#" style="background-color: skyblue;color: white"><i class="fa fa-files-o fa-fw"></i> <b>Seafreight</b><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="export_master.php">Export Master</a>
                </li>
                                <!-- <li>
                                    <a class="#" href="ship_arr.php"><i class="#"></i>1) Ship. Arrangement</a>
                                </li> -->

                                 <!-- 
                                =========================
                                =========================
                                START CUSTOMS SECTION 
                                =========================
                                =========================
                            -->

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


                            <!-- 
                                =========================
                                =========================
                                END CUSTOMS SECTION 
                                =========================
                                =========================
                            -->

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
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>