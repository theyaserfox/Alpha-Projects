<?php

require_once("database.php");
require_once("database_objects.php");

class Course extends DatabaseObject {
	public $ID;
	public $name;
	public $description;

	
	static $tablename = "courses";
    static $db_fields = array("id","name","description");
	public function __construct ($name = "",$description = "" ,$id=null){
	
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
	}

	public function get($field)
	{
		return $this->$field;
	}	
}

?>