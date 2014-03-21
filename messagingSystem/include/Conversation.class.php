<?php 
require_once("User.class.php");
require_once("Database.class.php");
require_once("Database.object.class.php");
require_once("Session.class.php");

class Conversation 
{  
    private $user_one;
    private $user_two;
    private $c_id;

 public function list_friends_history()
    {
      global $Database;
	  $name = $_SESSION["username"];
	  session_write_close();
	  $user_one = users::find_id($name);
      $query = "SELECT c.user_one , c.user_two  , c.c_id
      FROM users u , conversation c
      WHERE CASE
      WHEN user_one ={$user_one}
      THEN user_two = u.user_id
      WHEN user_two ={$user_one}
      THEN user_one = u.user_id
      END
      AND (user_one = {$user_one} OR user_two = {$user_one}) 
	  And c.checked='y' ";
      $result = $Database->doQuery($query);
      $array = array();
	  $checked_array = array();
      while($row = $Database->loadObjectList($result))
		{  
		 $username_one = $row['user_one'];
		 $username_two = $row['user_two'];
		 $checked_array[] = $row['c_id'];
         if ($username_one == $user_one)
		    {
		      $array[] = $username_two;
		    } 
         else
		    {
		     $array[] = $username_one;
		    }
		} 
      return $array;
    }     
	
    public function list_friends_poll()
    {
      global $Database;
	  $name=$_SESSION["username"];
	  session_write_close();
	  $user_one=users::find_id($name);
      $query1 = "SELECT c.user_one , c.user_two  , c.c_id
      FROM users u , conversation c
      WHERE CASE
      WHEN user_one ={$user_one}
      THEN user_two = u.user_id
      WHEN user_two ={$user_one}
      THEN user_one = u.user_id
      END
      AND (user_one = {$user_one} OR user_two = {$user_one}) 
	  And c.checked='n'";
      $result = $Database->doQuery($query1);
	  $num = $Database->affected_rows();
	  if($num != 0)
	    {
         $array = array();
	     $checked_array = array();
         while($row = $Database->loadObjectList($result))
		    {  
		     $username_one = $row['user_one'];
		     $username_two = $row['user_two'];
		     $checked_array[] = $row['c_id'];
             if ($username_one == $user_one)
		        {
		         $array[] = users::find_username($username_two);
		        } 
             else
		        {
		         $array[] = $name;
		        }
		    } 
	     foreach ($checked_array as $value)
	        {
	         $query = "UPDATE conversation SET checked='y' WHERE c_id={$value}";
			 $result = $Database->doQuery($query);
	        }		
         return $array;
		}
     else
		{
		 return false;
		}
    } 	
	
	public function show_history($username) 
	{
	 global $Database;
	 $name=$_SESSION["username"];
	 session_write_close();
	 $user_one=users::find_id($name);
	 $user_two=users::find_id($username);
     $array=array();
	 $c_id=$this->check_conversation($user_two);
	 if($c_id !=false)
		{
		 $query="SELECT a.reply , a.user_id_fk  FROM (SELECT * FROM conversation_reply WHERE c_id_fk ={$c_id} AND ( checked =  'y' OR user_id_fk =  '{$user_two}') ORDER BY time DESC LIMIT 10)a ORDER BY a.time ASC";
		 $result = $Database->doQuery($query);
			while($row = $Database->loadObjectList($result)) 
			{
			 if($user_one == $row['user_id_fk'])
			    {
			     $sender =users::find_username($user_two);
			    }
			 else
			    {
			     $sender ="ana";
				}	
				$array[]= $sender." : ".$row['reply'];
			}
		}
     return $array;
	}	
	
	public function show_history_poll($username)
	{
	   global $Database;	
	   $name=$_SESSION["username"];
	   session_write_close();
	   $user_one=users::find_id($name);
	   $user_two=users::find_id($username);
	   $c_id=$this->check_conversation($user_two);
		if($c_id != false)
		{
		 $query="SELECT a.reply  , a.cr_id , a.user_id_fk  FROM (SELECT * FROM conversation_reply WHERE c_id_fk ={$c_id} AND checked='n' ORDER BY time DESC LIMIT 10)a ORDER BY a.time ASC";
		 $result = $Database->doQuery($query);
		 $num = $Database->affected_rows();
	     if($num != 0)
	        {
             $array = array();
	         $checked_array = array();
             while($row = $Database->loadObjectList($result))
		        {  
		         if($user_one == $row['user_id_fk'])
				    { 
				     $array[] = $username." : ".$row['reply'];
				     $checked_array[] = $row['cr_id'];
				    }
				 else
				    {
				     return false;
				    }
		        } 
	         foreach ($checked_array as $value)
	            {
	             $query = "UPDATE conversation_reply SET checked='y' WHERE cr_id={$value}";
			     $result = $Database->doQuery($query);
	            }		
             return $array;
	        }
         else
		    {
		     return false;
	     	}
		}
	 else
		{
		 return false;
		}
	}
	
    public function insert_reply($username , $message)
    {
      global $Database;
	  $user_one = $_SESSION["username"];
	  session_write_close();
	  $user_two = users::find_id($username);
	  $c_id = $this->check_conversation($user_two);
      if($c_id != false)
        {
         $time = time();
         $ip = $_SERVER['REMOTE_ADDR'];
         $sql = "INSERT INTO conversation_reply (user_id_fk,reply,ip,time,c_id_fk) VALUES ('{$user_two}','{$message}','{$ip}','{$time}','{$c_id}')";
         $result = $Database->doQuery($sql);
		 $num = $Database->affected_rows();
         return $num;
        }
      else
        { 
         $this->create_conversation($username , $message);
        }
    }
    
    private function check_conversation($user_two)
    {
       global $Database;
	   $name = $_SESSION["username"];
	   session_write_close();
	   $user_one = users::find_id($name);
	   $sql = "SELECT c_id FROM conversation WHERE (user_one='{$user_one}' AND user_two='{$user_two}') OR(user_one='{$user_two}' AND user_two='{$user_one}')";
	   $result = $Database->doQuery($sql);
	   $c_id = database_object::find_c_id($sql);     
	   if ($result)
	   {
	   return $c_id;
	   }
       else
       {
	   return false;
	   }
    }
    
    private function create_conversation($username , $message)
    {
     global $Database;
	 $name = $_SESSION["username"];
	 session_write_close();
	 $user_one = users::find_id($name);
	 $user_two = users::find_id($username);
     $time = time();
     $ip = $_SERVER['REMOTE_ADDR'];
	 $sql = "INSERT INTO conversation (user_one,user_two,ip,time) VALUES ('{$user_one}','{$user_two}','{$ip}','{$time}')";
     $Database->doQuery($sql);
	 $this->insert_reply($username , $message);
    }  	
	
	public function search ($name)
	{
	 global $Database;
	 $sql = "SELECT username FROM users WHERE username LIKE '{$name}%'";
     $result = $Database->doQuery($sql);
     $array = array();
	 while($row = $Database->loadObjectList($result))
		{  
         $array[] = $row['username'];
	    } 
     return $array;
    }
	
    public function show_chat_notifications()
	{
	 global $Database;
	 $name = $_SESSION["username"];
	 session_write_close();
	 $user_one = users::find_id($name);
	 $sql = "SELECT c_id_fk FROM conversation_reply WHERE checked='n' AND user_id_fk ={$user_one} ";
	 $result = $Database->doQuery($sql);
	 $array = array();
	 while($row = $Database->loadObjectList($result))
	    {  
         $array[] = $row['c_id_fk'];
	    }
	 if($array == null || empty($array)==true )
        {
	     return false;  
	    }
     else
        { 	 
	     $sql = "SELECT user_one , user_two FROM conversation WHERE ";		
	     for ($i = 0 ; $i < count($array)-1 ; $i++)
            {	 
             $sql .= " c_id=" . $array[$i] . " OR";
		    }
	     $sql .= " c_id=" . $array[count($array)-1];
	     $result = $Database->doQuery($sql);
	     $return_array=array();
         while($row = $Database->loadObjectList($result))
	        {  
			 if($user_one == $row['user_one'])
			    {
			     $return_array[]=users::find_username($row['user_two']);
			    }
			 else
                { 			 
                 $return_array[] = users::find_username($row['user_one']);
			    }
	        }
	     return $return_array;
	    }
	}	
}
$conversation = new Conversation;
?>
