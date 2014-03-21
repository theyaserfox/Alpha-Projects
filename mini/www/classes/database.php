

<?php

class Database
{
	public $connection;
	private $localhost;
	private $username;
	private $password;
	
	public function __construct($localhost="" , $username ="" , $password = "")
	{
		$this->localhost = $localhost;
		$this->username =  $username;
		$this->password = $password;
		$this->open_connection();
		
		
	}
	
	public function select_db($db_name)
	{
		$result = mysql_select_db($db_name , $this->connection);
		if(!$result)
			die(mysql_error());
		
	}
	
	public function open_connection()
	{
		$this->connection = mysql_connect( $this->localhost  , $this->username , $this->password);
		if (!$this->connection)
		{
			die("cannot connect " . mysql_error());
			
		}		
		$this->select_db("timetable");
	
	}
	
	public function close_connection()
	{
	    mysql_close( $this->connection);
	
	}
	
	public function escape_values($value)
	{
		$magic_quotes_active = get_magic_quotes_gpc();
		$php_enough_version = function_exists("mysql_real_escape_string");
		if($php_enough_version)
		{
			//if php has function mysql_real_escape_string which in late version of php
			if($magic_quotes_active)
				stripslashes($value);
			$value = mysql_real_escape_string($value);
			
			
		}
		else
		{
			//if u have early version of php
			if($magic_quotes_active)
				stripslashes($value);
				
			$value = addslashes($value);
		}
		
		return $value;
	}
	
	public function confirm_query($result)
	{
	
		if(!$result)
		{
		die("error query " . mysql_error());
		}
	
	}
	
	
	public function fetch_array($result)
	{
	return mysql_fetch_array($result);
	}
	
	public function query($query)
	{
		
		$result = mysql_query($query);
		$this->confirm_query($result);
		
	}
	
	public function inserted_id(){
		return mysql_insert_id($this->connection);
	}
}

$database = new Database("localhost" , "root" , "yoyo");
?>
