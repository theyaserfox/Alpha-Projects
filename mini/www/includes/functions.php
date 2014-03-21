<?php
function confirm_query($result){
	//if something went wrong with select statments 
	if(!$result)
	{
	die("error fetching information " . mysql_error());
	}
	
}
function sql_prep($value){
	//to add slashes to sql statments 
	$magic_quotes_active = get_magic_quotes_gpc();
	$php_enough_version = function_exists("mysql_real_escape_string");
	if($php_enough_version)
	{
		//if php has function mysql_real_escape_string which in late version of php
		if($magic_quotes_active)
			stripslashes($value);
		$value = mysql_real_escape_string($value);
		
		
	}
	else
	{
		//if u have early version of php
		if($magic_quotes_active)
			stripslashes($value);
			
		$value = addslashes($value);
	}
	
	return $value;
}
function redirect_to($location){
	//for simpilicity to redirect anywhere
	header("Location:{$location}");
	exit;
}


function public_navigation(){
					

					$output = "";
					
					
					
					if(isset($_SESSION['username']) && substr_compare($_SESSION['username'] , "admin" , 0 , 5))
						{
							$query = "SELECT id FROM Students Where username = {$_SESSION['username']} ";
							$result = mysql_query($query);
							$row = mysql_fetch_array($result);
							
							$output .=  "<li><a href = 'Logout.php'>Logout </a></li>";
							$output .=  "<li><a href = 'edit_student.php?students_id={$row[0]}'>Edit profile </a></li>";
						}
					else
						{
							
							$output .=  "<li><a href = 'Login.php'> Login </a></li>";
							$output .= "<li><a href = 'new_student.php'>Register </a></li>";
						
						}
					
					
				
					
					
					return $output;
}


function admin_navigation(){
					

					$output = "";
				
					
				
					
					
					$output .= "<li><a href = 'new_room.php'>+Add new Room </a></li>";
					$output .= "<li><a href = 'new_course.php'>+Add new Course</a></li>";
					$output .= "<li><a href = 'new_professor.php'>+Add new professor</a></li>";
					$output .= "<li><a href = 'new_news.php'>+Add News Post</a></li><br/>";
					
						$output .= "<li><a href = \"classes/Schedule.php\">Generate</a></li><br/>";
						
					
					$output .= "<li><a href = 'View.php?id=1'> View All Courses</a></li>";
					$output .= "<li><a href = 'View.php?id=2'> View All Rooms</a></li>";
					$output .= "<li><a href = 'View.php?id=3'> View All Students</a></li>";
					$output .= "<li><a href = 'View.php?id=4'> View All Professor</a></li><br/>";
					
					$output .= "<li><a href = 'Logout.php'>Logout </a></li>";
					return $output;
}

function viewtable($table,$headTitle){	
	global $connect;
	$query = "SELECT * FROM {$table}";
	
	$result = mysql_query($query , $connect);
		echo "<table width='100%'>";
		echo "<tbody><tr class='head'>";
		for ($i = 0 ; $i < count($headTitle) ; $i++)	
		{
			
			echo "<th>" .  $headTitle[$i] . "</th>";
		}
		echo "</tr>";
	while(($row = mysql_fetch_array($result)) > 0 ){
									
		echo "<tr bgcolor='#f2f2f2' >";
		for ($i = 1 ; $i < mysql_num_fields($result) ; $i++)		
		{	
			echo "<td>";
			echo $row[$i];							
			echo "</td>";
																	
		}							
								
		echo "<td>";
		echo "<a href='edit_{$table}.php?{$table}_id={$row[0]}'> edit </a>" ;
		echo "</td>";
		echo "</tr>";
										
									
	}
}

function newsfeed() {

    $query = mysql_query("select * from news order by id DESC Limit 3");
	$page = "";
    while ($answer = mysql_fetch_array($query)) {
       $page .= "<div style='border:1px dashed black; padding:5px; width:100%;'><h4 align='center'>" . $answer['title']."</h4><p align='center'>" . $answer['author']." : " . $answer['content'] . "</p>"."</div>";
    }
	
	echo $page;
}

function check_session(){
	if(isset($_SESSION['username']))
	{
		return 1;
	}
	else { return 0; }

}
?>








