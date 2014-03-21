<?php include("includes/header.php")?>
<?php require_once("classes/Room.php")?>
	<?php
	if (isset($_POST['submit']))
	{
	    
	     $room = new Room( $_POST['room_name'] , $_POST['no_seats'] , $_POST['isLab'] );
		 $room->save();
	}
			?>	
					<div class="articleContent">
					
				<ul>
					<form id = "Registration" action = "new_room.php"  method = "post">
					<p>
					Name<br/>
					<input type = "text" name = "room_name" id  = "room_name" />
					<br />
					
					Number of seats<br/>
					<input id = 'no_seats' type = 'text'  name = 'no_seats'/>
					<br />
					
					Lab<br/>
					
					<input type = 'radio' id = 'Yes' name = "isLab" value = '1' /> Yes 
					<input type = 'radio' id = 'no' name = "isLab" value = '0' /> No 		
					
					</br>
					</br>
					<input type="submit" value="Add new room" name="submit"/>
					<div id = "error">
					</div>
					</form>
					</ul>
					</div>
<?php include("includes/afooter.php"); ?>
