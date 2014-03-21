 <?php include("includes/header.php");?>
<?php  require_once("classes/student.php");?>
<?php require_once ("classes/StudentsGroup.php");?>
	<?php
	if (isset($_POST['submit']))
	{
		$option = $_POST['option'];
		
		$hashed_password = md5($_POST['password']);
		$stu = new student($_POST['option'] , $_POST['firstname'] , $_POST['secondname'], $_POST['username'] ,$hashed_password, $_POST['grades'], $_POST['age'] ,$_POST['description']);
		$stu->save();
		StudentsGroup::incrementSize($_POST['option']);
	}
	
	?>
 <div class="articleContent">
          <ul>
					<form id = "Registration" action = "new_student.php"  method = "post">
					<table>
					<tr>
						<td>
							<label>First name:</label>
						</td>
						<td>
							<input type = "text" name = "firstname"  id  = "firstname" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Second Name:</label>
						</td>
						<td>
							<input id = 'secondname'  type = 'text'  name = 'secondname'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Username:</label>
						</td>
						<td>
							<input id = 'username' type = 'text'   name = 'username'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>password:</label>
						</td>
						<td>
							<input id = 'password' type = 'password'   name = 'password'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>confirm password:</label>
						</td>
						<td>
							<input id = 'confirmpass' type = 'password'   name = 'confirm_password'/>
						</td>
					</tr>
					
					
					<tr>
						<td>
							<label>Select Groups:</label>
						</td>
						<td>
							<select name="option">
						<?php
						$query = "SELECT * FROM student_group";
						$result = mysql_query($query);
						$count = mysql_num_rows($result);
						
						for($i = 0; $i < $count ; $i++)
						{
						$row = mysql_fetch_array($result);
						echo "<option  value=\"{$row['ID']}\">";
						echo $row['name'];
						echo "</option>";
						}
						?>
					</select>
						</td>
					</tr>
					
					<tr>
						<td>
							<label>grade:</label>
						</td>
						<td>
							<input id = 'grades' type = 'text'  name = 'grades'/>
						</td>
					</tr>
					<tr>
						<td>
						<label>Age:</label>
						</td>
						<td>
						<input id = 'age' type = 'text' name = 'age'/>
						</td>
					</tr>
				
					<tr>
						<td>
						<label>Description:</label>
						</td>
					</tr>
					<tr>
						<td colspan="10">
							<textarea  name = "description"  cols = "40" rows = "10"></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name = "submit" value=" new student" />
							<div id = "error">
							</div>
						</td>
					</tr>
					</table>
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
<?php include("includes/footer.php"); ?>
