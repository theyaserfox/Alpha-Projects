<?php include("includes/header.php")?>
<?php  require_once("classes/professor.php")?>
	
	<?php
	if (isset($_POST['submit']))
	{
		$hashed_password = md5($_POST['password']);
		//("id", "first_name" , "second_name", "username","hashed_password", "description" , "age" , "phone_number" , "address")
		$pro = new Professor($_POST['firstname'] , $_POST['secondname'] , $_POST['username'] , $hashed_password , $_POST['Description'] , $_POST['age'] ,$_POST['phone_number_1'] , $_POST['address']);
		$pro->save();
	}
	
	?>
				
				 <div class="articleContent">
          <ul>
					<form id = "Registration" action = "new_professor.php"  method = "post">
					<p>
					First name</br>
					<input type = "text" name = "firstname" id  = "firstname" />
					<br />
					<br />
					Second Name</br>
					<input id = 'secondname' type = 'text'  name = 'secondname'/>
					<br />
					<br />
					Username</br>
					<input id = 'username' type = 'text'  name = 'username'/>
					<br />
					<br />
					Mobile number<br/>
					<input id = 'phone_number_1' type = 'text'  name = 'phone_number_1'/>
					<br />
					<br />
					Phone number (optional)<br/>
					<input id = 'phone_number_2' type = 'text'  name = 'phone_number_2'/>
					<br />
					<br />
					password<br/>
					<input id = 'password' type = 'password'  name = 'password'/>
					<br />
					<br />	
					confirm password<br/>
					<input id = 'confirmpass' type = 'password'  name = 'confirmpass'/>
					<br />
					<br />	
					age<br/>
					<input id = 'age' type = 'text'  name = 'age'/>
					<br />
					<br />
					address<br/>
					<input id = 'address' type = 'text'  name = 'address'/>
					<br />
					<br />
					Description<br/>
					<br />	
					<textarea  name = "Description" cols = "50" rows = "10"></textarea>
					<br />
					<br />							
					
					</br>
					</br>
					<input type="submit" value="Add new professor" name = "submit"/>
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
