<?php 
$userid = $_SESSION['username'];
mysql_connect('localhost', 'root','');
mysql_select_db('contta'); 
$role = mysql_query("SELECT * FROM tb_user WHERE user_name = '$userid' ");
$access = mysql_fetch_array($role);

// user_role = 1.admin; 2.guest; 3.user;
// user_scope = 1.all; 2.import; 3.export;
// user_dept = 1.all; 2.sea; 3.air;

/* START SHOW MENU LIST OPTION */
// IT Departement
if ($access['user_role'] == 'admin' AND $access['user_scope'] == 'all' AND $access['user_dept'] == 'all' ) 
{ 
    include 'menu/admin/sidebar.php';
} 

/*General Manager*/
elseif ($access['user_role'] == 'user' AND $access['user_scope'] == 'all' AND $access['user_dept'] == 'all' ) 
{ 
    include 'menu/gm/sidebar.php';
} 

// Sea Freight
/*Manager*/
elseif ($access['user_role'] == 'user' AND $access['user_dept'] == 'sea' ) 
{ 
    include 'menu/manager/sea/sidebar.php';
} 
/*User Import and Export*/
elseif ($access['user_role'] == 'user' AND $access['user_dept'] == 'sea' ) 
{ 
    include 'menu/user/sea/sidebar.php';
} 

// Air Freight
/*Manager*/
elseif ($access['user_role'] == 'user' AND $access['user_scope'] == 'all' AND $access['user_dept'] == 'air' ) 
{ 
    include 'menu/manager/air/sidebar.php';
} 
/*User Import and Export*/
elseif ($access['user_role'] == 'user' AND $access['user_dept'] == 'air' ) 
{ 
    include 'menu/user/sea/sidebar.php';
} 


// Guest
/*User*/
elseif ($access['user_role'] == 'guest' AND $access['user_scope'] == 'all' AND $access['user_dept'] == 'all' ) 
{ 
    include 'menu/guest/sidebar.php';
} 
/* END SHOW MENU LIST OPTION */
?>