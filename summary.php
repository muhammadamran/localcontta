<?php include "include/restrict.php";?>
<!DOCTYPE html>
<html lang="en">

<?php include 'include/head.php';?>

<body>

    <div id="wrapper">

        <?php include 'include/header.php';?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">On Process Records</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <?php
                                mysql_connect('localhost', 'root','');
                                mysql_select_db('contta');
                                $role_arr = mysql_query("SELECT * FROM tb_record_miles INNER JOIN tb_record_ship_arr ON tb_record_miles.rcd_id=tb_record_ship_arr.rcd_id WHERE tb_record_miles.miles_arr = 0");
                                $inv_arr = mysql_num_rows($role_arr);                                
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $inv_arr;?></div>
                                    <div>Ship. Arrangement</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="ship_arr.php"><span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <?php
                                    mysql_connect('localhost', 'root','');
                                    mysql_select_db('contta'); 
                                    $role_cus = mysql_query("SELECT * FROM tb_record_miles INNER JOIN tb_record_ship_cus ON tb_record_miles.rcd_id=tb_record_ship_cus.rcd_id WHERE tb_record_miles.miles_custom = 0 AND tb_record_miles.miles_arr != 0");
                                    $inv_cus = mysql_num_rows($role_cus);                                
                                    ?>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $inv_cus;?></div>
                                        <div>Custom Arrangement</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <a href="ship_cus.php"><span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-tasks fa-5x"></i>
                                        </div>
                                        <?php
                                        mysql_connect('localhost', 'root','');
                                    mysql_select_db('contta');
                                        $role_exe = mysql_query("SELECT * FROM tb_record_miles INNER JOIN tb_record_ship_exe ON tb_record_miles.rcd_id=tb_record_ship_exe.rcd_id WHERE tb_record_miles.miles_execution = 0 AND tb_record_miles.miles_custom != 0");
                                        $inv_exe = mysql_num_rows($role_exe);                                
                                        ?>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $inv_exe;?></div>
                                            <div>Ship. Execution</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <a href="ship_exe.php"><span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-tasks fa-5x"></i>
                                            </div>
                                            <?php
                                            mysql_connect('localhost', 'root','');
                                    mysql_select_db('contta'); 
                                            $role_mon = mysql_query("SELECT * FROM tb_record_miles INNER JOIN tb_record_ship_mon ON tb_record_miles.rcd_id=tb_record_ship_mon.rcd_id WHERE tb_record_miles.miles_monitor = 0 AND tb_record_miles.miles_execution != 0");
                                            $inv_mon = mysql_num_rows($role_mon);                                
                                            ?>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $inv_mon ;?></div>
                                                <div>Ship. Monitoring</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <div class="panel-footer">
                                            <a href="ship_mon.php"><span class="pull-left">View Details</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">Import Summary</h1>
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="panel panel-green">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-tasks fa-5x"></i>
                                                </div>
                                                <?php
                                            mysql_connect('localhost', 'root','');
                                    mysql_select_db('contta'); 
                                            $role_mon = mysql_query("SELECT * FROM tb_record_miles INNER JOIN tb_record_ship_mon ON tb_record_miles.rcd_id=tb_record_ship_mon.rcd_id WHERE tb_record_miles.miles_monitor = 0 AND tb_record_miles.miles_execution != 0");
                                            $inv_mon = mysql_num_rows($role_mon);                                
                                            ?>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge">0</div>
                                                    <div>Pre Clearance</div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="panel-footer">
                                                <span class="pull-left">View Details</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="panel panel-green">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-tasks fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge">0</div>
                                                    <div>Clearance</div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="panel-footer">
                                                <span class="pull-left">View Details</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="panel panel-green">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-tasks fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge">0</div>
                                                    <div>Post Clearance</div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="panel-footer">
                                                <span class="pull-left">View Details</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /#page-wrapper -->

                    </div>
                    <!-- /#wrapper -->

                    <!-- jQuery Version 1.11.0 -->
                    <script src="js/jquery-1.11.0.js"></script>

                    <!-- Bootstrap Core JavaScript -->
                    <script src="js/bootstrap.min.js"></script>

                    <!-- Metis Menu Plugin JavaScript -->
                    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

                    <!-- Morris Charts JavaScript -->
                    <script src="js/plugins/morris/raphael.min.js"></script>
                    <script src="js/plugins/morris/morris.min.js"></script>
                    <script src="js/plugins/morris/morris-data.js"></script>

                    <!-- Custom Theme JavaScript -->
                    <script src="js/sb-admin-2.js"></script>

                </body>

                </html>
