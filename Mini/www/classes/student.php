<?php require_once("database.php")?>
<?php require_once("database_objects.php")?>
<?php

class Student extends DatabaseObject{

	public $id;
	public $student_group_id;
	public $first_name;
	public $second_name;
	public $username;
	public $hashed_password;
	public $grades;
	public $age;
	public $description;
	
	static $tablename = "students";
    static $db_fields = array("id","student_group_id", "first_name" , "second_name", "username","hashed_password" ,"grades", "age" , "description");
	
	public function __construct ($student_group_id = "",$first_name = "", $second_name = "", $username = "", $hashed_password= "" ,$grades = "", $age = "", $description = "",$id=null)
	{
		$this->id = $id;
		$this->student_group_id = $student_group_id;
		$this->first_name = $first_name;
		$this->second_name = $second_name;
		$this->username = $username;
		$this->hashed_password = $hashed_password;
		$this->grades = $grades;
		$this->age = $age;
		$this->description = $description;
		
	}
	
	
}

?>