<?php

require_once("database.php");
require_once("database_objects.php");

class Professor extends DatabaseObject {
	public $ID;
	public $first_name;
	public $second_name;
	public $username;
	public $hashed_password;
	public $description;
	public $age;
	public $phone_number;
	public $address;


	static $tablename = "professor";
    static $db_fields = array("id", "first_name" , "second_name", "username","hashed_password", "description" , "age" , "phone_number" , "address");
	
	public function __construct ($first_name = "", $second_name = "", $username = "", $hashed_password= "" , $description = "", $age = "", $phone_number = "", $address= ""  , $id=null)
	{
		$this->id = $id;
		
		$this->first_name = $first_name;
		$this->second_name = $second_name;
		$this->username = $username;
		$this->hashed_password = $hashed_password;
		$this->description = $description;
		$this->age = $age;
		$this->phone_number = $phone_number;
		$this->address = $address;
		
		
		
	}
	public function AddCourseClass($courseClass)
	{
		array_push($courseClasses, $courseClass);
	}
	public function __is_equal($profTwo){
        return  $id == $profTwo->id;
    }
	public function get($field)
	{
		return $this->$field;
	}	
}

?>