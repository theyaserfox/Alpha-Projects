<?php include("includes/header.php")?>
<?php include("classes/Room.php")?>

	<?php
	$roo = Room::find_by_id($_GET['rooms_id']);
	if(isset($_POST['submit']))
	{
		$roo = new Room( $_POST['room_name'] , $_POST['no_seats'] , $_POST['isLab'], $_GET['rooms_id']);
		$roo->save();
	}
	 $roo = Room::find_by_id($_GET['rooms_id']);
	 ?>
	 <div class="articleContent">
					
				<ul>
					<form id = "Registration" action = "edit_rooms.php?rooms_id=<?php echo $_GET['rooms_id']; ?>"  method = "post">
					<p>
					Name<br/>
					<input type = "text" name = "room_name" value = '<?php echo $roo->name;?>' id  = "room_name" />
					<br />
					
					Number of seats<br/>
	
					<input id = 'no_seats' type = 'text'  name = 'no_seats' value = '<?php echo $roo->no_seats;?>' />
					<br />
					
					Lab<br/>
					
					<input type = 'radio' id = 'Yes' name = "isLab" value = '1'  /> Yes 
					<input type = 'radio' id = 'no' name = "isLab" value = '0' /> No 		
					
					</br>
					</br>
					<input type="submit" value=" Edit room" name="submit"/>
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