<?php

require_once("database.php");
require_once("database_objects.php");

class Room extends DatabaseObject {
	private static $nextRoomId;
	public $id;
	public $name;
	public $isLab;
	public $no_seats;
static $tablename = "rooms";
    static $db_fields = array("id","name","no_seats","isLab");
	
	public function __construct ($name = "", $no_seats = "" , $isLab = "" ,$id=null)
	{
		$this->id = $id;
		$this->name = $name;
		$this->no_seats = $no_seats;
		$this->isLab = $isLab;
	}

	public function get($field)
	{
		return $this->$field;
	}

	public static function RestartIDs()
	{
		$nextRoomId = 0;
	}	
}

?>