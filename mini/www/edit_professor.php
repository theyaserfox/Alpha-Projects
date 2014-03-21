<?php include("includes/header.php")?>
<?php include("classes/Professor.php")?>

	
	<?php
	$pro = Professor::find_by_id($_GET['professor_id']);
	if(isset($_POST['submit']))
	{
		$hashed_password = $pro->hashed_password;
		$pro = new Professor($_POST['firstname'] , $_POST['secondname'], $_POST['username'] ,$hashed_password, $_POST['Description'], $_POST['age'] ,$_POST['phone_number_1'] , $_POST['address'] , $_GET['professor_id'] );
		$pro->save();

		
	}
   $pro = Professor::find_by_id($_GET['professor_id']);
	?>
				
				 <div class="articleContent">
          <ul>
					<form id = "Registration" action = "edit_professor.php?professor_id=<?php echo $_GET['professor_id']; ?>"  method = "post">
					<table>
					<tr>
						<td>
							<label>First name:</label>
						</td>
						<td>
							<input type = "text" name = "firstname" value = '<?php echo $pro->first_name;?>' id  = "firstname" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Second Name:</label>
						</td>
						<td>
							<input id = 'secondname'  value = '<?php echo $pro->second_name;?>' type = 'text'  name = 'secondname'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Username:</label>
						</td>
						<td>
							<input id = 'username' type = 'text'  value = '<?php echo $pro->username;?>'  name = 'username'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Mobile number:</label>
						</td>
						<td>
							<input id = 'phone_number_1' type = 'text'  value = '<?php echo $pro->phone_number;?>' name = 'phone_number_1'/>
						</td>
					</tr>
					
					
					<tr>
						<td>
						<label>Age:</label>
						</td>
						<td>
						<input id = 'age' type = 'text' value = '<?php echo $pro->age;?>' name = 'age'/>
						</td>
					</tr>
					<tr>
						<td>
						<label>Address:</label>
						</td>
						<td>
						<input id = 'address' type = 'text' value = '<?php echo $pro->address;?>' name = 'address'/>
						</td>
					</tr>
					<tr>
						<td>
						<label>Description:</label>
						</td>
					</tr>
					<tr>
						<td colspan="10">
							<textarea  name = "Description"  cols = "40" rows = "10"><?php $pro->description;?></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name = "submit" value="Edit professor"/>
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
<?php include("includes/afooter.php"); ?>
