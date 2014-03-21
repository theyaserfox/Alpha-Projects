<?php

//connection to database
$connect = mysql_connect("localhost" , "root" , "yoyo");
if(!$connect)
{
die( "could connect to db " . mysql_error());
}

//select database
$select_db = mysql_select_db("timetable" , $connect);
if(!$select_db)
{
die( "could connect to db " . mysql_error());
} 
?>

