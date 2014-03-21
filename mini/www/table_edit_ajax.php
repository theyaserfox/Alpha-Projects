<?php
include("includes/connection.php");
if($_POST['id'])
{
$id=mysql_escape_String($_POST['id']);
$saturday=mysql_escape_String($_POST['saturday']);
$monday=mysql_escape_String($_POST['monday']);
$tuesday=mysql_escape_String($_POST['tuesday']);
$wednesday=mysql_escape_String($_POST['wednesday']);
$thursday=mysql_escape_String($_POST['thursday']);
$sql = "update present_table set saturday='$saturday',monday='$monday',tuesday='$tuesday',wednesday='$wednesday',thursday='$thursday' where id='$id'";
mysql_query($sql);
}
?>
