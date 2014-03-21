<?php
class database 
{
private static $instance;
private $host;
private $userName;
private $password;
private $database;
private $connection;
	
    private function __construct()
	{ 
	 $this->host="localhost";
     $this->userName="sandy";
     $this->password="sandy";  
   	 $this->database="messaging";
	 $this->connect();
	}
	
   public function __destruct()
    {
      if(isset($this->connection))
        {
         mysqli_close($this->connection);
		 unset($this->connection);
        }
      else
        {
         die("\n");
        }
    }
   
    static function getInstance()
	{
    if(!self::$instance)
		{
		 self::$instance=new self();
        }
     return self::$instance;
    }

    public function connect() 
    {
     if(!$this->connection=mysqli_connect($this->host , $this->userName , $this->password , $this->database , 3306) )
		{
         die("Connection error: " . mysqli_connect_errno());
		}
    }

	public function doQuery($sql)
	{
	 //echo $sql;
	 $result=mysqli_query($this->connection , $sql);
	 if(!$result)
	 {
	   die("Database Query failed ");
	 }
	 return $result;
	}
	
   public function loadObjectList($result)
    {
     $obj = "No Results";
     if ($result)
        {
         $obj = mysqli_fetch_assoc($result);
        }
     return $obj;
    }
   
   public function escape_value($value)
    {
	 $value=filter_var($value, FILTER_SANITIZE_STRING);
	 $value = mysqli_real_escape_string($this->connection , $value );
	 return $value;
    }
   
   public function getId()
    {
     return mysqli_insert_id($this->connection); 
    }
	
	public function affected_rows()
	{
	  return mysqli_affected_rows($this->connection);
	}
	
	public function num_rows($result)
	{
	  return mysqli_num_rows($result);
	}
}
$Database=database::getInstance();
?>
