<?php include("includes/connection.php");?>
<?php

class Student{
	private $id;
	private $group_id;
	private $first_name;
	private $second_name;
	private $grades;
	private $age ;
	private $description;

	public function Student()
		{	
				$this->id = 0;
				$this->group_id = 0;
				$this->first_name = "default";
				$this->second_name = "default";
				$this->grades = 0;
				$this->age = 0;
				$this->description = "default";
		}
	public function input_data($id)
	{
		$query = "select * from students where id='$id'";
		$info = mysql_fetch_array(mysql_query($query));
				$this->id = $info['ID'];
				$this->group_id = $info['Student_Group_ID'];
				$this->first_name = $info['first_name'];
				$this->second_name = $info['second_name'];
				$this->grades = $info['grades'];
				$this->age = $info['age'];
				$this->description = $info['description'];
	}
	public function __get($field)
	{
		return $this->$field;
	}	
}

class Professor{
	private $id;
	private $first_name;
	private $second_name;
	private $age ;
	private $address ;
	private $description;

	public function Professor()
		{	
				$this->id = 0;
				$this->first_name = "default";
				$this->second_name = "default";
				$this->age = 0;
				$this->address = "default";
				$this->description = "default";
		}
	public function input_data($id)
	{
		$query = "select * from professor where id='$id'";
		$info = mysql_fetch_array(mysql_query($query));
				$this->id = $info['ID'];
				$this->first_name = $info['first_name'];
				$this->second_name = $info['second_name'];
				$this->age = $info['age'];
				$this->address = $info['address'];
				$this->description = $info['description'];
	}
	public function __get($field)
	{
		return $this->$field;
	}	
}

class Admin{
	private $id;
	private $first_name;
	private $second_name;
	private $age ;
	private $description;

	public function Admin()
		{	
				$this->id = 0;
				$this->first_name = "default";
				$this->second_name = "default";
				$this->age = 0;
				$this->description = "default";
		}
	public function input_data($id)
	{
		$query = "select * from admins where id='$id'";
		$info = mysql_fetch_array(mysql_query($query));
				$this->id = $info['ID'];
				$this->first_name = $info['first_name'];
				$this->second_name = $info['second_name'];
				$this->age = $info['age'];
				$this->description = $info['description'];
	}
	public function __get($field)
	{
		return $this->$field;
	}	
}

class Event{
	private $id;
	private $name;
	private $from;
	private $to;
	private $day;
	private $content;
	private $description;

	public function Event()
		{	
				$this->id = 0;
				$this->name = "default";
				$this->from = 0;
				$this->to = 0;
				$this->day = "default";
				$this->content = "default";
				$this->description = "default";
		}
	public function input_data($id)
	{
		$query = "select * from events where id='$id'";
		$info = mysql_fetch_array(mysql_query($query));
				$this->id = $info['ID'];
				$this->name = $info['name'];
				$this->from = $info['from'];
				$this->to = $info['to'];
				$this->day = $info['default'];
				$this->content = $info['content'];
				$this->description = $info['description'];
	}
	public function __get($field)
	{
		return $this->$field;
	}	
}

class Course{
	private $id;
	private $name;
	private $description;

	public function Course()
		{	
				$this->id = 0;
				$this->name = "default";
				$this->description = "default";
		}
	public function input_data($id)
	{
		$query = "select * from courses where id='$id'";
		$info = mysql_fetch_array(mysql_query($query));
				$this->id = $info['ID'];
				$this->name = $info['name'];
				$this->description = $info['description'];
	}
	public function __get($field)
	{
		return $this->$field;
	}	
}

class Room{
	private $id;
	private $name;
	private $no_seats;
	private $isLab;

	public function Room()
		{	
				$this->id = 0;
				$this->name = "default";
				$this->no_seats = 0;
				$this->isLab = 0;
		}
	public function input_data($id)
	{
		$query = "select * from rooms where id='$id'";
		$info = mysql_fetch_array(mysql_query($query));
				$this->id = $info['ID'];
				$this->name = $info['name'];
				$this->no_seats = $info['no_seats'];
				$this->isLab = $info['isLab'];
	}
	public function __get($field)
	{
		return $this->$field;
	}	
}

class Course_class{
	private $id;
	private $course_id;
	private $professor_id;
	private $room_id;
	private $student_group_id;
	private $duration;

	public function Course_class()
		{	
				$this->id = 0;
				$this->course_id = 0;
				$this->professor_id = 0;
				$this->room_id = 0;
				$this->student_group_id = 0;
				$this->duration = 0;
		}
	public function input_data($id)
	{
		$query = "select * from course_class where id='$id'";
		$info = mysql_fetch_array(mysql_query($query));
				$this->id = $info['ID'];
				$this->course_id = $info['course_id'];
				$this->professor_id = $info['professor_id'];
				$this->room_id = $info['room_id'];
				$this->student_group_id = $info['student_group_id'];
				$this->duration = $info['duration'];
	}
	public function __get($field)
	{
		return $this->$field;
	}	
}

 //$student = new Student($id,$group_id,$first_name,$second_name,$grades,$age,$description);
$student = new Student();
$student->input_data(1);
$field = "id";
echo $student->$field ."</br>";
$prof = new Professor();
$prof->input_data(1);
echo $prof->$field;
?>
