<?php 
$userid = $_SESSION['username'];
mysql_connect('localhost', 'root','');
mysql_select_db('contta'); 
$role = mysql_query("SELECT * FROM tb_user WHERE user_name = '$userid' ");
$access = mysql_fetch_array($role);

/* START SHOW MENU LIST OPTION */
/*for admin IT user*/
if ($access['user_role'] == 'admin' AND $access['user_scope'] == 'all' AND $access['user_dept'] == 'all' ) 
{ 
    include 'menu/admin_menu.php';
} 
/*for GM*/
elseif ($access['user_role'] == 'user' AND $access['user_scope'] == 'all' AND $access['user_dept'] == 'all' ) 
{ 
    include 'menu/user_level_1.php';
} 
/*for manager sea*/
elseif ($access['user_role'] == 'user' AND $access['user_scope'] == 'all' AND $access['user_dept'] == 'sea' ) 
{ 
    include 'menu/user_sea_level_1.php';
} 
/*for user import sea*/
elseif ($access['user_role'] == 'user' AND $access['user_scope'] == 'import' AND $access['user_dept'] == 'sea' ) 
{ 
    include 'menu/user_sea_level_import.php';
} 
/*for user export sea*/
elseif ($access['user_role'] == 'user' AND $access['user_scope'] == 'export' AND $access['user_dept'] == 'sea' ) 
{ 
    include 'menu/user_sea_level_export.php';
} 
/*for manager air*/
elseif ($access['user_role'] == 'user' AND $access['user_scope'] == 'all' AND $access['user_dept'] == 'air' ) 
{ 
    include 'menu/user_air_level_1.php';
} 
/*for user import air*/
elseif ($access['user_role'] == 'user' AND $access['user_scope'] == 'import' AND $access['user_dept'] == 'air' ) 
{ 
    include 'menu/user_air_level_import.php';
} 
/*for user export sea*/
elseif ($access['user_role'] == 'user' AND $access['user_scope'] == 'export' AND $access['user_dept'] == 'air' ) 
{ 
    include 'menu/user_air_level_export.php';
} 
/*for guest*/
elseif ($access['user_role'] == 'guest' AND $access['user_scope'] == 'all' AND $access['user_dept'] == 'all' ) 
{ 
    include 'menu/guest_menu.php';
} 
/* END SHOW MENU LIST OPTION */
?>