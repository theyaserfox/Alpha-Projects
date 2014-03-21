<?php require_once("database.php")?>
<?php require_once("database_objects.php")?>
<?php

class News extends DatabaseObject{

	public $id;
	public $author;
	public $title;
	public $content;
	
	static $tablename = "news";
    static $db_fields = array("id","author","title","content");
	
	public function __construct ($author = "", $title = "" , $content = "" ,$id=null){
	
		$this->id = $id;
		$this->author = $author;
		$this->title = $title;
		$this->content = $content;
	}
}

?>