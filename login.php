<?php 
include "include/connection.php";
if (isset($_SESSION['newuser'])) {
    //redirect ke halaman login
    // header('location:http://kn-idcore.ap.win.int.kn/contta/index.php');
    header("Location: ./index.php");
} 

if (isset($_POST['submit'])) {
    $user =$_POST['user_name'];
    $pass =$_POST['password'];
    $log_type = "login";
    $date_log = date('Y-m-d H:i:m');

    $q = mysql_query("SELECT * FROM tb_user WHERE user_name='$user' AND user_pass ='$pass'");

    if (mysql_num_rows($q) == 1) {
        session_start();
        $_SESSION['username']=$user;
        $query = mysql_query("INSERT INTO tb_log VALUES(' ','$user','$log_type','$date_log',' ')");
        if ($query) {
            header("Location: ./index.php?SignInsuccess=true");
        } else {
            echo "<h4>". "log error".mysql_error()."</h4>";
        }           
    } else {
        header("Location: ./login.php?error=true");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Localcontta | Kuehne + Nagel Indonesia</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/logo/logo.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/logo/logo.svg">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo/logo.svg">
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="assets/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/login/css/main.css">
    <link href="assets/css/localcontta.css" rel="stylesheet">
    <script src="assets/sweet/sweetalert2.all.js"></script>
    <script src="assets/sweet/sweetalert2.all.min.js"></script>
    <script src="assets/sweet/sweetalert2.js"></script>
    <script src="assets/sweet/sweetalert2.min.js"></script>
</head>
<style type="text/css">
    .swal2-styled.swal2-confirm {
        border: 0;
        border-radius: 0.25em;
        background: #002766;
        background-color: #002766;
        color: #fff;
        font-size: 1.0625em;
    }
</style>
<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('assets/images/forest2.jpg');">
            <div class="wrap-login100">
                <form class="login100-form validate-form" role="form" method="post" action="">
                    <div class="login-logo">
                        <center>
                            <img src="assets/images/logo/logo.svg" class="logo-kn">
                        </center>
                    </div>
                    <span class="login100-form-title p-b-5 p-t-27">
                        LOCALCONTTA
                        <div class="menu__divider"></div>
                    </span>
                    <div class="p-b-5 statement-login">
                        <font><i>Please Sign In</i></font>
                    </div>
                    <!-- <?php if ($alertWrong == 'YES') { ?>
                    <div class="p-b-20">
                        <div class="alert-danger ">
                          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                          <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
                        </div>
                    </div>
                    <?php } ?> -->
                    <div class="wrap-input100 validate-input" data-validate = "Enter username">
                        <input class="input100" type="text" name="user_name" placeholder="Username">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" id="password" name="password" placeholder="Password">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" onclick="myFunction()" name="remember-me">
                        <label class="label-checkbox100" for="ckb1">
                            Show password
                        </label>
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn btn-block" type="submit" name="submit" value="submit">
                            Sign In
                        </button>
                    </div>
                    <div class="text-center p-t-30">
                        <div>
                            <img src="assets/images/logo/kn-indo.png">
                        </div>
                        <hr>
                        <a class="txt1" href="#">
                            Copyright 2019 | Version 3.0.10
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Show Password -->
    <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <script type="text/javascript">
        if (window?.location?.href?.indexOf('error') > -1) {
            Swal.fire({
                title: 'Sign In Failed!',
                icon: 'error',
                text: 'Wrong username or password. Try again or contact JKT CI Team!',
            })
            history.replaceState({}, '', './login.php');
        }

        if (window?.location?.href?.indexOf('errorAccess') > -1) {
            Swal.fire({
                title: 'Access Failed!',
                icon: 'error',
                text: 'Please contact your administrator!',
            })
            history.replaceState({}, '', './login.php');
        }
    </script>
    <!-- End Show Password -->
    <div id="dropDownSelect1"></div>
    <script src="assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="assets/login/vendor/animsition/js/animsition.min.js"></script>
    <script src="assets/login/vendor/bootstrap/js/popper.js"></script>
    <script src="assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/login/vendor/select2/select2.min.js"></script>
    <script src="assets/login/vendor/daterangepicker/moment.min.js"></script>
    <script src="assets/login/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="assets/login/vendor/countdowntime/countdowntime.js"></script>
    <script src="assets/login/js/main.js"></script>
    <style type="text/css">
        body {
            padding-right:  0 !important;
        }
    </style>
</body>
</html>