 <?php include("includes/header.php");?>
<?php  require_once("classes/student.php");?>
<?php require_once ("classes/StudentsGroup.php");?>
	<?php
	$pro = Student::find_by_id($_GET['students_id']);
	if(isset($_POST['submit']))
	{
	
	//"id","student_group_id", "first_name" , "second_name", "username","hashed_password" ,"grades", "age" , "description")
		$hashed_password = $pro->hashed_password;
		
		$pro = new Student($_POST['option'],$_POST['firstname'] , $_POST['secondname'], $_POST['username'] ,$hashed_password, $_POST['grades'], $_POST['age'] ,$_POST['description'] , $_GET['students_id']);
		$pro->save();

		
	}
   $pro = Student::find_by_id($_GET['students_id']);
	
	?>
 <div class="articleContent">
          <ul>
					<form id = "Registration" action = "edit_students.php?students_id=<?php echo $_GET['students_id'];?> " method = "post">
					<table>
					<tr>
						<td>
							<label>First name:</label>
						</td>
						<td>
							<input type = "text" name = "firstname"  id  = "firstname" value ="<?php echo $pro->first_name;?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Second Name:</label>
						</td>
						<td>
							<input id = 'secondname'  type = 'text'  value ="<?php echo $pro->second_name;?> "name = 'secondname'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Username:</label>
						</td>
						<td>
							<input id = 'username' type = 'text'   value ="<?php echo $pro->username;?>" name = 'username'/>
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
						
						echo "<option  value=\"{$row['ID']}\"";
						if ($pro->student_group_id == $row['ID'])
						echo "selected" ;
						echo ">";
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
							<input id = 'grades' type = 'text'   value ="<?php echo $pro->grades;?>" name = 'grades'/>
						</td>
					</tr>
					<tr>
						<td>
						<label>Age:</label>
						</td>
						<td>
						<input id = 'age' type = 'text'  value ="<?php echo $pro->age;?>" name = 'age'/>
						</td>
					</tr>
				
					<tr>
						<td>
						<label>Description:</label>
						</td>
					</tr>
					<tr>
						<td colspan="10">
							<textarea  name = "description"  cols = "40" rows = "10"> <?php echo $pro->description;?></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name = "submit" value=" Edit student" />
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
