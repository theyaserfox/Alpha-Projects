<?php require_once("includes/functions.php");?>

<?php
session_start();

$_SESSION = array();

if(isset($_COOKIE[session_name()] ) )
{
setcookie(session_name() , time() - 4200 , '/');
}

session_destroy();
redirect_to("staff.php");
?>
