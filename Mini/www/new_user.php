<?php include("includes/functions.php")?>
<?php include("includes/header.php");?>
<table width="100%">
				   <div class="articleContent">
					<div class="rightLinks">
				<h2>Register</h2>
				<ul>
					<form id = "Registration" action = "create_new_user.php"  method = "post">
					<p>
					Username:
					<input type = "text" name = "username" value "" id  = "username" />
					<br />
					<br />
					Password:
					<input id = 'password' type = 'password'  name = 'password'/>
					<br />
					<br />
					Confirm password:
					<input id = 'confirmpass' type = 'password'  name = 'confirmpass'/>
					<br />
					<br />
					Email:
					<input id = 'email' type = 'email'  name = 'email'/>
					</p>			
					<br />
					<br />
					<input type = 'submit' value ='sign up' />
					<div >
					<p  ><font id = "error" color = "red"> </font></p>
					</div>
					</form>
					</ul>
					</div>
					<h2> </h2>
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
					</table>
<?php include("includes/footer.php");?>
