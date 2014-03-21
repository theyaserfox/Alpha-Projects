<?php

require_once("database.php");
require_once("database_objects.php");
require_once("Professor.php");
require_once("StudentsGroup.php");
require_once("Course.php");

class CourseClass extends DatabaseObject {
	public $id;
	public $professor;
	public $course;
	public $groups = array();
	public $numberOfSeats = 0;
	public $lab;
	public $duration;

	static $tablename = "course_class";
    static $db_fields = array("id", "course_id" , "professor_id", "room_id","student_group_id","duration");
	
	public function __construct ($course_id = "", $professor_id = "", $room_id = "" , $student_group_id = "", $duration = "", $id=null)
	{
		$this->id = $id;
		$this->course_id = $course_id;
		$this->professor_id = $professor_id;
		$this->room_id = $room_id;
		$this->student_group_id = $student_group_id;
		$this->duration = $duration;
	}

	// public function CourseClass($professor, $course, $groups, $numberOfStudents, $requiresLab, $duration)
	// {
	// 	$this->professor = $professor;
	// 	$this->course = $course;
	// 	$this->numberOfSeats = 0; //3shan nzawed 3aleeh 3ala 7asab el group
	// 	$this->requiresLab = $requiresLab;
	// 	$this->duration = $duration;
	// 	$this->professor->AddCourseClass($this); //depend on Professor Class
	// 	for ($i=0; $i < count($groups); $i++) { 
	// 		$groups[$i]->AddClass($this);
	// 		array_push($this->groups, $groups[$i]);
	// 		$numberOfSeats += $groups[$i]->get("$numberOfStudents");
	// 	}
	// }
	public function AddClass($courseClass)
	{
		array_push($courseClasses, $courseClass);
	}
	public function __is_equal($SGTwo){ //msh 3rfeen bnktebha ezay fl main
        return  $id == $SGTwo->id;
    }
    public function get($field)
	{
		return $this->$field;
	}
	public function ProfessorOverlaps($c) {
		return $this->professor->ID == $c->professor->ID;
	}

	public function GroupsOverlap($c) {
		$sz = count($this->groups);
		$csz = count($c->groups);
		for($i = 0; $i < $sz; $i++) {
			for($j = 0; $j < $csz; $j++) {
				if($this->groups[$i]->ID == $c->groups[$j]->ID)
					return true;
			}
		}
		return false;
	}
}

?>