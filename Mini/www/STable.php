<?php 

include("includes/connection.php");
include("includes/functions.php");
require_once("classes/Room.php");
require_once("classes/Course.php");
require_once("classes/student.php");
session_start();

if(isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	$query = "SELECT id From students Where username =".$username;
	$result = mysql_query($query, $connect);
	$row = mysql_fetch_array($result);
	$id = $row['id'];
}

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
<?php include("includes/header.php");

$roomObj = new Room;
$rooms = $roomObj->find_all();
for($rs = 1; $rs <= count($rooms); $rs++) {
	$roomObj = new Room;
	$roomNow = $roomObj->find_by_id($rs);
	echo $roomNow->name;

?>
<table width="100%">
<tbody><tr class="head">
<th></th><th>Sunday</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th>
</tr>
<?php

$sql=mysql_query("select * from  course_class");
$time = 9;
for($i = 0; $i < 12; $i++) {
	
?>

<tr bgcolor="#f2f2f2" class="edit_tr">

<td class="edit_td2" width="8.5%">
<span class="text"><?php if($time < 10) echo "0$time:00 "; else echo "$time:00 "?><?php if($time+1 < 10) echo "0";  ?><?php echo $time+1;  ?><?php echo ":00" ?></span>
</td>

<?php

for($j = 0; $j < 5; $j++) {

?>

<td class="edit_td" width="18.3%">
<span class="text">
<?php 

$course = new Course;

while($row=mysql_fetch_array($sql))
{
	$id=$row['id'];	
	$roomId=$row['room_id'];
	$duration=$row['duration'];
	$t=$row['time'];
	$name = $row['name'];
	$courseID = $row['course_id'];
	$day=$row['day'];
	$arr = array();
	$sql2=mysql_query("Select student_group_id From  student_groups Where class_id=".$id);
	while($row=mysql_fetch_array($sql2))
		array_push($arr, $row['student_group_id']);
	$student = Student::find_by_id(2);
	if( $t <= $i+1 && $t+$duration > $i+1 && $day == ($j+1) && $roomId == $rs && in_array($student->Student_Group_ID, $arr)) {
		$course = $course->find_by_id($courseID);
		echo $name."<br>";
	}
}
mysql_data_seek($sql,0);
?>
</span> 
</td>

<?php
}
?>
</tr>
<?php
$time++;
if($time == 12)
	$time = 1;
}
?>
</table>
<?php 
echo "<br>";
}
include("includes/footer.php")?>
</body>
</html>
