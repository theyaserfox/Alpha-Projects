<?php require_once("database.php")?>
<?php require_once("database_objects.php")?>
<?php

class Student_group extends DatabaseObject{

	public $id;	
	public $section;
	
	static $tablename = "student_group_sections";
    static $db_fields = array("id", "section");
	
	public function __construct ($section = "", $id=null)
	{
		$this->id = $id;
		$this->section = $section;
	}
}

?>