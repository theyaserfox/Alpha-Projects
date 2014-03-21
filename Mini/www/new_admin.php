<?php include("includes/header.php")?>
<?php include("includes/functions.php")?>
	<td id = 'navigation'>
	
				
				<?php echo admin_navigation();?>
				<td id = "page">
				
					<h2> Add Admin</h2>
					
					<ul>
					<form id = "Registration" action = "create_new_admin.php"  method = "post">
					<p>
					firstname:
					<input type = "text" name = "firstname"  id  = "firstname" />
					<br />
					<br />
					secondname:
					<input id = 'secondname' type = 'text'  name = 'secondname'/>
					<br />
					<br />
					username:
					<input id = 'username' type = 'text'  name = 'username'/>
					<br />
					<br />
					password:
					<input id = 'password' type = 'text'  name = 'password'/>
					<br />
					<br />
					age:
					<input id = 'age' type = 'text'  name = 'age'/>
					<br />
					<br />
					desc:
					<textarea rows = "10" cols = '30' name = 'Description' ></textarea>
					<br />
					<br />
					<input id = 'add_new_admin' type = 'submit' value = 'Add new admin' name = 'add_new_admin'/>
					<div id = "error">
					</div>
					</form>
					</ul>
<?php include("includes/footer.php"); ?>