<script src="assets/js/jquery.min.js"></script> 
<?php
include 'include/restrict.php';
include 'include/head.php';
include "include/datatables.php";
?>
<!-- Main Page -->
<div id="wrapper">
    <?php include 'include/header.php';?>
    <div id="page-wrapper">
        <!-- Page Title -->
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <h1 class="page-header"><i class="fas fa-house-user icon-title"></i> Home</h1>
                </div>
            </div>
        </div>
        <!-- End Page Title -->
        <style type="text/css">
            @media (min-width: 991.5px) {
                .position-oke {
                    display: flex;
                    align-items: center;
                }
            }
            .logo-dashboard-oke {
                background: transparent;
                padding: 20px;
                border-radius: 5px;
                margin-bottom: 10px;
            }
            .title-oke {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .title-oke-two {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 10px;
            }
            .oke__divider {
                background: rgb(0 39 102);
                height: 5px;
                margin: 0px 329px;
                box-sizing: border-box;
                width: calc(100% - 654px);
                margin-bottom: 10px;
            }
            .kn-oke {
                font-size: 14px;
                font-weight: 600;
                color: #002766;
                text-transform: uppercase;
            }
            .kn-oke:hover {
                font-size: 14px;
                font-weight: 600;
                color: #26c5e6;
                text-transform: uppercase;
            }
            .oke-lah {
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
        <!-- <div class="row position-oke"> -->
        <div class="row">
            <div class="col-md-12">
                <div class="logo-dashboard-oke">
                    <div class="title-oke">
                        <font class="font-logo-first" style="color: #002766;">Local</font><font class="font-logo-second" style="color: #002766;">contta</font>
                    </div>
                    <div class="oke__divider"></div>
                    <div class="title-oke-two">
                        <img src="assets/images/logo.png" width="30%">
                    </div>
                    <div class="oke-lah">
                        <font style="font-size: 10px;font-weight: 300;">All rights reserved | Copyright &copy; 2019</font>
                    </div>
                    <div class="oke-lah">
                        <a href="mailto:titok.radityo@kuehne-nagel.com" class="kn-oke">Kuehne+Nagel Indonesia</a>
                    </div>
                    <div class="oke-lah">
                        <font style="font-size: 9px;">Version 3.0.10</font>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
include 'include/jquery.php';
include 'include/alert.php';
?>
<!-- End Main Page -->