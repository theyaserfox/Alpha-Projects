<?php include("includes/header.php")?>
<?php include("classes/Course.php")?>

<?php
	$co = Course::find_by_id($_GET['courses_id']);
	if(isset($_POST['submit']))
	{
		$co = new Course ($_POST['name'], $_POST['description'] ,$_GET['courses_id'] );
		$co->save();
	}
   $co = Course::find_by_id($_GET['courses_id']);
   ?>
				<div class="articleContent">
			
          <ul>
					<form id = "Registration" action = "edit_courses.php?courses_id=<?php echo $_GET['courses_id']; ?>"  method = "post">
					<p>
					Name</br>
					
					<input type = "text" name = "name" value = '<?php echo $co->name;?>' id  = "name" />
					<br/>
					<br/>
					Description
					<br/>	
					<textarea id = 'description'  rows="10" cols="50"  name = 'description' ><?php $co->description;?></textarea>
					<br />
					<br />
					
					<input type = 'submit' value = "edit Course" name ="submit"/>
					<div id = "error">
					</div>
					</form>
					</ul>
					</div>
   
   
<script type = "text/javascript" > 
						function validate ()
							{						
							
							document.getElementById("Registration").onsubmit = function(){
							var password = document.getElementById("password").value;
							var cpassword = document.getElementById("confirmpass").value;
						
							if ((password !== cpassword) || (password == null) || (password == " "))
								{
								
								document.getElementById("error").innerHTML = "password doesnt matches"
								return false;
								} else {
								
								return true;			
								}
								}
													
							}	
							window.onload = function(){
							
							validate();
							}
					</script>
<?php include("includes/afooter.php"); ?>
