<?php require_once("database.php")?>
<?php require_once("database_objects.php")?>
<?php

class Event extends DatabaseObject{

	public $id;
	public $name;
	public $from;
	public $to;
	public $day;
	public $content;
	public $description;
	
	static $tablename = "events";
    static $db_fields = array("id", "name" , "from", "to","day", "content" , "description");
	
	public function __construct ($name = "", $from = "", $to = "", $day= "" , $content = "", $description = "", $id=null)
	{
		$this->id = $id;
		$this->name = $name;
		$this->from = $from;
		$this->to = $to;
		$this->day = $day;
		$this->content = $content;
		$this->description = $description;		
	}
}

?>