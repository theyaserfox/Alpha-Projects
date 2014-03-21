<?php 
include("includes/connection.php");
include("includes/functions.php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

<title>View Table</title>

<link href="stylesheets/table.css" rel="stylesheet">

<script type="text/javascript" src="javaScripts/jquery-1.6.1.js"></script>
<script type="text/javascript" src="javaScripts/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="javaScripts/table.js"></script>

</head>

<body bgcolor="#dedede">
<?php include("includes/header.php")?>
<table width="100%">
<tbody><tr class="head">
<th></th><th>Sunday</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th>
</tr>
<?php
$sql=mysql_query("select * from present_table");
$time = 9;
while($row=mysql_fetch_array($sql))
{
$id=$row['id'];
$saturday=$row['saturday'];
$monday=$row['monday'];
$tuesday=$row['tuesday'];
$wednesday=$row['wednesday'];
$thursday=$row['thursday'];
?>
<tr id="<?php echo $id; ?>" bgcolor="#f2f2f2" class="edit_tr">

<td class="edit_td2" width="8.5%">
<span id="time_<?php echo $id; ?>" class="text"><?php if($time < 10) echo "0$time:00 "; else echo "$time:00 "?><?php if($time+1 < 10) echo "0";  ?><?php echo $time+1;  ?><?php echo ":00" ?></span>
<input type="text" value="<?php echo "$time:00"; ?>" class="editbox" id="time_input_<?php echo $id; ?>" /&gt;
</td>

<td class="edit_td" width="18.3%">
<span id="saturday_<?php echo $id; ?>" class="text"><?php echo $saturday; ?></span>
<input type="text" value="<?php echo $saturday; ?>" class="
editbox" id="saturday_input_<?php echo $id; ?>" /&gt;
</td>

<td class="edit_td" width="18.3%">
<span id="monday_<?php echo $id; ?>" class="text"><?php echo $monday; ?></span> 
<input type="text" value="<?php echo $monday; ?>" class="editbox" id="monday_input_<?php echo $id; ?>"/>
</td>

<td class="edit_td" width="18.3%">
<span id="tuesday_<?php echo $id; ?>" class="text"><?php echo $tuesday; ?></span> 
<input type="text" value="<?php echo $tuesday; ?>" class="editbox" id="tuesday_input_<?php echo $id; ?>"/>
</td>

<td class="edit_td" width="18.3%">
<span id="wednesday_<?php echo $id; ?>" class="text"><?php echo $wednesday; ?></span> 
<input type="text" value="<?php echo $wednesday; ?>" class="editbox" id="wednesday_input_<?php echo $id; ?>"/>
</td>

<td class="edit_td" width="18.3%">
<span id="thursday_<?php echo $id; ?>" class="text"><?php echo $thursday; ?></span> 
<input type="text" value="<?php echo $thursday; ?>" class="editbox" id="thursday_input_<?php echo $id; ?>"/>
</td>

</tr>
<?php
$time++;
if($time == 12)
	$time = 1;
}
?>
</table>
<?php include("includes/afooter.php")?>
</body>
</html>