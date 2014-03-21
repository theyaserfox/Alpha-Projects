<?php require_once("database.php"); ?>

<?php

class DatabaseObject
{
	//database fields
	static protected $tablename;
	static protected $db_fields = array();
	
	static function find_by_sql($sql)
	{
		global $database;
		$result = mysql_query($sql , $database->connection);
		$database->confirm_query($result);
		
		$objects_array = array();
		
		while($row = $database->fetch_array($result))
		{
			$objects_array[] = static::instantiate($row);
		}
		return $objects_array;
		
		
		
	}
	
	static function find_all()
	{
		$query = "SELECT * FROM "  . static::$tablename;
	
		return static::find_by_sql($query);
	}
	static function find_by_id($id)
	{
		
		$query = "SELECT * FROM ". static::$tablename . " WHERE id = {$id} LIMIT 1";
		
		$result = static::find_by_sql($query);
		return empty($result)? false : array_shift($result);
	}
	
	static function instantiate($record)
	{
		$class = get_called_class();
		$object = new $class;
		
		foreach ($record as $attribute=>$value)
		{
			if($object->has_attribute($attribute))
			{
				$object->$attribute = $value;
			}
		}
		return $object;
	}
	
	function has_attribute($attribute)
	{
	    $object_vars = get_object_vars($this);
		
		return array_key_exists($attribute , $object_vars);
	}
	

	
	public function attributes()
	{
		$attributes = array(); 
		foreach(static::$db_fields as $db_field)
		{
			
			$attributes[$db_field] = $this->$db_field;
		}
		
		return $attributes;
	}
	
	public function clean_attributes()
	{
		global $database;
		$attributes = $this->attributes();
		$clean_attributes = array();
		foreach($attributes as $key =>$values)
		{
			$clean_attributes[$key] = $database->escape_values($values);
		}
		
		return $clean_attributes;
	}
	
	private function create()
	{
		global $database;
		$attributes = $this->clean_attributes();
		array_shift($attributes);
		//INSERT into Tablename(attriubte , attribute) VALUES("" , ""  , "");
		$query = "Insert into ";
		$query .=static::$tablename ."(" ;
		$query .=join (',' ,array_keys($attributes))   . ")" ;
		$query .= "VALUES (" ;
		$query .=  "'" . join ("', '" ,  array_values($attributes));
		$query .=  "'" . ")"	;

		$database->query($query);
	
		
		
	}
	private function update()
	{
		global $database;
		$attributes = $this->clean_attributes();
		$attribute_pairs = array();
		foreach ($attributes as $key => $value)
		{
			$attribute_pairs[] = "{$key} = '{$value}' ";
		}
		
		$query = "UPDATE " . static::$tablename . " ";
		$query .= "SET ";
		$query .= join(","  , $attribute_pairs); 
		$query.= "WHERE id = {$this->id}";
	
		$database->query($query );
		
	
	}
	
	
	public function save()
	{
		isset($this->id) ? $this->update() : $this->create();
	}
	public function delete()
	{
		global $database;
		$query = "DELETE FROM " . static::$tablename . " ";
		$query .="WHERE id = {$this->id}";

		$database->query($query);
		
	}
}


?>