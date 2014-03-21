<?php
require_once("Database.class.php");

class database_object 
{
	  protected static $db_fields;
	  protected static $table_name;

     public static function find_c_id($sql) 
        {
         global $Database;
         $result = $Database->doQuery($sql);
         $row = mysqli_fetch_array($result);
         return $row['c_id'];
        }

      public static function find_by_sql($sql="") 
	    {
         global $Database;
         $result_set = $Database->doQuery($sql);
         $object_array = array();
         while ($row = $Database->loadObjectList($result_set)) 
		    {
             $object_array[] = static::instantiate($row);
            }
         return $object_array;
        }

	 private static function instantiate($record) 
	    {
		 $class_name=get_called_class();
         $object = new $class_name;
		 foreach($record as $attribute=>$value)
		    {
		     if($object->has_attribute($attribute))
	   		    {
     		     $object->$attribute = $value;
		        }
		    }
		 return $object;
	    }
	
	private function has_attribute($attribute)
	{
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() 
	{ 
	  $attributes = array();
	  foreach(static::$db_fields as $field) 
	    {
	      if(property_exists($this, $field))
		    {
	         $attributes[$field] = $this->$field;
	        }
	    }
	 return $attributes;
	}
	
	protected function sanitized_attributes() 
	{
	 global $Database;
	 $clean_attributes = array();
	 foreach($this->attributes() as $key => $value)
	    {
	     $clean_attributes[$key] = $Database->escape_value($value);
	    }
	 return $clean_attributes;
	}

	public function create() 
	{
	 global $Database;
	 $attributes = $this->sanitized_attributes();
	 $sql = "INSERT INTO ".static::$table_name." (";
	 $sql .= join(" , ", array_keys($attributes));
	 $sql .= ") VALUES ('";
	 $sql .= join("' , '", array_values($attributes));
	 $sql .= "')";
     $result=$Database->doQuery($sql);
	 if($result)
	    {
		 if(static::$table_name === "user")
		    {
		     $this->id = $Database->getId();
		    }
	     return true;
	    }
		else 
		{
	     return false;
	    }
	}

	public function update() 
	{
	 global $Database;
     $value=static::$db_fields[0];
	 $sql = "UPDATE ".static::$table_name." SET ";
	 $sql .= static::$db_fields[($this->counter)-1]." = '".$this->where;
	 $sql .= "' WHERE ".$value." = '".$Database->escape_value($this->name)."'";
	  echo $sql;
	 $result=$Database->doQuery($sql);
	
	 if($result)
	    {
	     return true;
	    }
		else 
		{
	     return false;
	    } 
	}

	public function delete() 
	{
	  global $Database;
	  $value=static::$db_fields[0];
	  $sql = "DELETE FROM ".static::$table_name;
	  $sql .= " WHERE ".static::$db_fields[0]." = '".$Database->escape_value($this->$value);
	  $sql .= " ' LIMIT 1";
	  $result=$Database->doQuery($sql);
	 if($result)
	    {
	     return true;
	    }
		else 
		{
	     return false;
	    }	  
    }
}
?>