<?php require_once("database.php")?>
<?php require_once("database_objects.php")?>
<?php

class Admin extends DatabaseObject{

	public $id;
	public $first_name;
	public $second_name;
	public $username;
	public $hashed_password;
	public $description;
	public $age;
	
	static $tablename = "admins";
    static $db_fields = array("id", "first_name" , "second_name", "username","hashed_password", "description" , "age");
	
	public function __construct ($first_name = "", $second_name = "", $username = "", $hashed_password= "" , $description = "", $age = "", $id=null)
	{
		$this->id = $id;
		$this->first_name = $first_name;
		$this->second_name = $second_name;
		$this->username = $username;
		$this->hashed_password = $hashed_password;
		$this->description = $description;
		$this->age = $age;		
	}
}

?>