<?php session_start(); ?>


<?php include("includes/header.php");?>
<?php require_once("includes/functions.php");?>

<?php require_once("includes/connection.php");?>
<?php  
	$error = 0;
	if(isset($_POST['username']) && isset($_POST['password'])){
	
		$username = $_POST['username'];
		$hashed_password = md5($_POST['password']);
		
		
		if(!substr_compare($username , "admin" , 0 , 5))
		{
		$query = "SELECT username , hashed_password
		FROM admins
		WHERE username = '{$username} '
		and 
		hashed_password = '{$hashed_password}'";
		}elseif (!substr_compare($username , "prof" , 0 , 4))
		{
		
		$query = "SELECT username , hashed_password
		FROM professor
		WHERE username = '{$username} '
		and 
		hashed_password = '{$hashed_password}'";
		} else {
		
		$query = "SELECT username , hashed_password
		FROM students
		WHERE username = '{$username} '
		and 
		hashed_password = '{$hashed_password}'";
		
		}	
		$result = mysql_query($query , $connect);
		
		$row = mysql_fetch_array($result);
		 if(!$row)
			{
				$error = 1;
							
			}
					
		else{
		$username = $_SESSION['username'] = $_POST['username'];
		$_SESSION['password'] = $_POST['password'];
		if (!substr_compare($username , "admin" , 0 , 5))
			redirect_to("admin_home.php");
		else
			redirect_to("index.php");
	
		}
		
		} 
	
	

?>
<table width="100%">
					<div class="articleContent">
					<div class="rightLinks">
					<ul>
					<form id = "Regist" action = "Login.php" method = "post">
					<p>
					<?php
					if($error > 0)
					echo "<font color = 'red'>Wrong name or password </font>" . "<br/><br/>";
					?>
					<h2>Log In</h2>
					Username:
					<input type = "text" name = "username" value "" id  = "username" />

					Password:
					<input id = 'password' type = 'password'  name = 'password'/>
					</p>			
					
					<input type = 'submit' value ='Log in' />
					</form>
					</ul>
					
					</div>
					</table>
<?php include("includes/footer.php");?>
