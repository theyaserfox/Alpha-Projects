<?php include("includes/header.php")?>
<?php require_once("classes/Course.php")?>
 <?php
 if(isset($_POST['submit']))
 {
  
  $pro = new Course( $_POST['course_name'], $_POST['Description'] );
  $pro->save();
 }
 ?>
				<div class="articleContent">
			
          <ul>
					<form id = "Registration" action = "new_course.php"  method = "post">
					<p>
					Name</br>
					<input type = "text" name = "course_name" value "" id  = "course_name" />
					<br/>
					<br/>
					Description
					<br/>	
					<textarea id = 'Description'  rows="10" cols="50"  name = 'Description' ></textarea>
					<br />
					<br />
					
					<input type = 'submit' value = "Add new Course" name ="submit"/>
					<div id = "error">
					</div>
					</form>
					</ul>
					</div>
					
<?php include("includes/afooter.php"); ?>
