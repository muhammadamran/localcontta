<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php" style="color: white"><b style="color: white">LOCAL</b>CONTTA</a>
</div>

<ul class="nav navbar-top-links navbar-right">
    <span id="ct" class="navbar-brand"> </span>
    <span style="color: white"><b>(Role : <?php echo $access['user_role'] . " / Scope : " . $access['user_scope'] . " / Dept : " . $access['user_dept'];?>)</b></span>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i><?php echo $_SESSION['username'];?>  <i class="fa fa-caret-down"></i>
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
    </li>
</ul>