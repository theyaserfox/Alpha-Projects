<?php include("includes/header.php")?>
<?php include("includes/functions.php")?>
<?php require_once("includes/connection.php");?>
<?php
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	
}
?>		

			
			
				
					<table id = "page" align = "center">
					
					<?php
						//if he pressed view all courses 
						if($id == 1)
						{
						
						viewtable("courses", array("Name","Description","More"));								
						} elseif($id == 2)
						{
						viewtable("rooms", array("Name","Number of seats","Lab (0/1)","More"));
						} elseif($id == 3)
						{
						viewtable("students", array("Group","First Name","Second Name", "Username", "Password", "Level", "Age", "Description"));
						}elseif($id == 4)
						{
						viewtable("professor", array("First Name","Second Name","Username","Password","Description","Age","Phone Number","Address","More"));
						}
						
					?>

					</table>
					
<?php include("includes/afooter.php"); ?>

