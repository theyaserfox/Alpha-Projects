<?php

require_once("database_objects.php");

class StudentsGroup extends DatabaseObject {
	public $ID;
	public $name;
	public $size;
	public $courseClasses = array();
	public $level;
	
	static $tablename = "student_group";
    static $db_fields = array("ID", "size" , "level" , "name");
	
	public function __construct ($name = "", $size = "",$level = "" ,  $ID=null)
	{
		$this->ID = $ID;
		$this->size = $size;
		$this->level = $level;
		$this->name = $name;
	}
	
	static public function incrementSize($id)
	{
		$query = "update student_group set size=size+1 where id = {$id}";
		$result = mysql_query($query);
	}

	public function AddClass($courseClass)
	{
		array_push($courseClasses, $courseClass);
	}

	public function __is_equal($SGTwo){
        return  $ID== $SGTwo->ID;
    }

    public function get($field)
	{
		return $this->$field;
	}

}

?>