<?php
require_once("Database.class.php");
require_once("Database.object.class.php");

class users extends database_object 
{
   public $email;
   public $password;
   public $username;
   public $user_id;
   protected static $db_fields = Array("user_id" , "username" , "password" , "email");
   protected static $table_name = "users";
   
 public static function authenicate($email="" , $password="") 
    { 
	 global $Database;
	 $email=$Database->escape_value($email);
	 $password=$Database->escape_value($password);
	 $sql  = "SELECT * from users WHERE email='{$email}'";
	 $sql .= " AND password='{$password}'";
	 $sql .= " LIMIT 1";
	 $result=self::find_by_sql($sql);
     return !empty($result) ? array_shift($result): false;
    } 
    
 public static function find_id($username)
    {
     global $Database;
     $sql="SELECT user_id FROM users WHERE username='{$username}'";
     $result = $Database->doQuery($sql);
     $row = mysqli_fetch_array($result);
     return $row['user_id'];
    }

 public static function find_username($id)
    {
     global $Database;
     $sql="SELECT username FROM users WHERE user_id='{$id}'";
     $result = $Database->doQuery($sql);
     $row = mysqli_fetch_array($result);
     return $row['username'];
    }
}
?>