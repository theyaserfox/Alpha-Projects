<?php 

class Session
{
	private $isLogIn = false;
	private $UserId;
	
	public function is_logged_in()
	{
		return $isLogIn;
	}
	
	
	public function login($user)
	{
		$UserId = $_SESSION['userId'] = $user->id;
		$this->isLogIn = true;
	}
	
	public function logout()
	{
		unset($_SESSION['userId'];
		unset($this->UserId);
		$this->isLogIn = false;
		
	}
	
	public function check_login()
	{
		if(isset($_SESSION['userId'])
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}

?>