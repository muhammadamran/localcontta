<?php include 'include/restrict.php';?>
<!DOCTYPE html>
<html lang="en">
<?php 
//include 'include/restrict.php';
include 'include/head.php';
?>
<body onload="display_ct()">
    <!-- Container Page -->
    <div id="wrapper">
        <!-- <nav class="navbar navbar-default navbar-fixed-top navbar-background" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <div class="text-logo">
                        <img src="assets/images/logo/logo.svg">&nbsp;
                        <font class="font-logo-first">Local</font><font class="font-logo-second">contta</font>
                    </div>
                </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span id="ct" class="clock-ct"></span>
                </li>
                <li>
                    <span class="clock-ct">-</span>
                </li>
                <li>
                    <span class="role-show">Role : <?= $access['user_role'] . " / Scope : " . $access['user_scope'] . " / Dept : " . $access['user_dept'];?></span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
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
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Flot Charts</a>
                                </li>
                                <li>
                                    <a href="morris.html">Morris.js Charts</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="panels-wells.html">Panels and Wells</a>
                                </li>
                                <li>
                                    <a href="buttons.html">Buttons</a>
                                </li>
                                <li>
                                    <a href="notifications.html">Notifications</a>
                                </li>
                                <li>
                                    <a href="typography.html">Typography</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grid</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="blank.html">Blank Page</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="footer-sidebar">
                        <p align="center"><b> Powered by : </b> <br> <img src="assets/images/header.png"></p>
                        <p align="center"><b>LOCALCONTTA </b><i>for</i><b> CUSTOMS</b></p>
                    </div>
                </div>
            </div>
        </nav> -->
        <?php include 'include/header.php';?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <h1 class="page-header"><i class="fa fa-chart-pie icon-title"></i> Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">                            
                            <div class="pull-center">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3 class="page-header" align="center"><b>LOCAL</b>CONTTA <br></h3>
                                    </div>
                                </div>
                                <div class="row">                
                                    <p align="center"><img src="assets/images/logo.png" width="15%"></p>
                                    <hr>
                                    <p align="center">All rights reserved <br> Copyright &copy; 2019 <a href="mailto:titok.radityo@kuehne-nagel.com"><br>Kuehne+Nagel Indonesia</a><br><i>Version 1.0</i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <?php
                                mysql_connect('localhost', 'root','');
                                mysql_select_db('contta');
                                $current_month = date('m');
                                $current_year= date('Y');

                                $role_import = mysql_query("SELECT * FROM tb_master_impor WHERE rcd_create_month = '$current_month' AND rcd_create_year = '$current_year' ");
                                $import = mysql_num_rows($role_import);                                
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $import;?></div>
                                    <div>Record of This Month</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Import Records</span>
                                <!-- <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->
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
                                <?php
                                $role_export = mysql_query("SELECT * FROM tb_master_export WHERE rcd_create_month = '$current_month' AND rcd_create_year = '$current_year' ");
                                $export = mysql_num_rows($role_export);                                
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $export;?></div>
                                    <div>Record of This Month</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Export Records</span>
                                <!-- <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <?php
                                $role_all_import = mysql_query("SELECT * FROM tb_master_impor");
                                $all_im = mysql_num_rows($role_all_import);                                
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $all_im;?></div>
                                    <div>All Records</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Import Records</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                    <?php
                                    $role_all_export = mysql_query("SELECT * FROM tb_master_export");
                                    $all_ex = mysql_num_rows($role_all_export);                                
                                    ?>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $all_ex;?></div>
                                    <div>All Records</div>
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
            <div class="row">
                <div class="col-lg-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Top 10 Record - By Consignee Name (All Import Records)
                        </div>
                        <div class="panel-body">
                            <div class="list-group">
                                <?php
                                $con=mysqli_connect("localhost","root","","contta");
                                // Check connection
                                if (mysqli_connect_errno())
                                {
                                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                }
                                $get_top10 = mysqli_query($con, "SELECT rcd_cnee, count(rcd_id) as no FROM tb_master_impor GROUP by rcd_cnee ORDER BY no DESC LIMIT 10");
                                if(mysqli_num_rows($get_top10)>0){

                                    while($rowtop10 = mysqli_fetch_array($get_top10))
                                    {
                                        ?>
                                        <a href="#" class="list-group-item">
                                            <i class="fa fa-arrow-circle-right fa-fw"></i> <?php echo $rowtop10['rcd_cnee'];?>
                                            <span class="pull-right text-muted small"><em><?php echo $rowtop10['no'];?></em>
                                            </span>
                                        </a>
                                        <?php
                                    }
                                } 
                                mysqli_close($con);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Top 10 Record - By Consignee Name (All Export Records)
                        </div>
                        <div class="panel-body">
                            <div class="list-group">
                                <?php
                                $con=mysqli_connect("localhost","root","","contta");
                                // Check connection
                                if (mysqli_connect_errno())
                                {
                                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                }
                                $get_top10 = mysqli_query($con, "SELECT rcd_cnee, count(rcd_id) as no FROM tb_master_export GROUP by rcd_cnee ORDER BY no DESC LIMIT 10");
                                if(mysqli_num_rows($get_top10)>0){

                                    while($rowtop10 = mysqli_fetch_array($get_top10))
                                    {
                                        ?>
                                        <a href="#" class="list-group-item">
                                            <i class="fa fa-arrow-circle-right fa-fw"></i> <?php echo $rowtop10['rcd_cnee'];?>
                                            <span class="pull-right text-muted small"><em><?php echo $rowtop10['no'];?></em>
                                            </span>
                                        </a>
                                        <?php
                                    }
                                } 
                                mysqli_close($con);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Your Record - On Process Status
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>RcdID</th>
                                            <th>AJU No.</th>
                                            <th>HBL</th>
                                            <th>Cnee</th>
                                            <th>ETA</th>
                                            <th>ATA</th>
                                            <th>PreClear.</th>
                                            <th>Clear.</th>
                                            <th>PostClear.</th>                      
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $usernow = "raka.vemiarno";
                                        //$usernow = $_SESSION['username'];
                                        $con=mysqli_connect("localhost","root","","contta");
                                        // Check connection
                                        if (mysqli_connect_errno())
                                        {
                                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                        }
                                        $result = mysqli_query($con,"SELECT * FROM tb_master_impor INNER JOIN tb_record_miles_import ON tb_master_impor.rcd_id=tb_record_miles_import.rcd_id  WHERE tb_master_impor.rcd_type = 'import' AND tb_master_impor.rcd_create_by='$usernow' AND tb_record_miles_import.action_by_3 = 0 ");
                                        if(mysqli_num_rows($result)>0){

                                            while($row = mysqli_fetch_array($result))
                                            {
                                                echo "<tr>";
                                                echo "<td>" . $row['rcd_id'] . "</td>";
                                                echo "<td>" . $row['rcd_aju'] . "</td>"; 
                                                echo "<td>" . $row['rcd_hbl'] . "</td>";                                        
                                                echo "<td>" . $row['rcd_cnee'] . "</td>";
                                                echo "<td>" . $row['rcd_eta'] . "</td>";
                                                echo "<td>" . $row['rcd_ata'] . "</td>";
                                                echo "<td>" . $row['pre'] . "</td>";
                                                echo "<td>" . $row['clear'] . "</td>";
                                                echo "<td>" . $row['post'] . "</td>";
                                                echo "</tr>";
                                                ?>
                                                <?php
                                            }
                                        }
                                        mysqli_close($con);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Container Page -->
    <?php include 'include/jquery.php'; ?>
</body>
</html>