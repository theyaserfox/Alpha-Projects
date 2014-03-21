<?php
class session
{
  private $logged_in;
  public $username;
  function __construct()
    {
     session_start();
     //$this->check_login();
    }
  
  private function check_login()
    {
     if(isset($_SESSION['username']))
	    {
		 $this->username=$_SESSION['username'];
		 session_write_close();
		 $this->logged_in=true;
	    }
	 else
	    {
	     unset($this->username);
		 $this->logged_in=false;
	    }
    }
  
  public function is_logged_in()
    {
     return $this->logged_in;
    }
  
  public function login($users)
    {
     if($users)
	    {
		 $this->username=$_SESSION['username']=$users->username;
		 session_write_close();
		 $this->logged_in=true;
	    }
    }
   
   public function logout()
    {
     unset($_SESSION['username']);
	 unset($this->username);
	 $this->logged_in=false;
    }   
}
$Session = new Session();
?>