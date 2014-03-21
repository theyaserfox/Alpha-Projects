<?php
include("../include/User.class.php");
include("../include/Session.class.php");

$email=$_POST["email"];
$password=$_POST["password"];

if(($email=="") || ($password == ""))
    {
	 echo "PLZ Enter Username and Password .";
    }
else
    {
     $found_user=users::authenicate($email , $password);
     if ($found_user)
        {   
		  $Session->login($found_user);
          header("Location:home.php");
		}
     else
		{
         $message="Username/password combination incorrect.";
	     echo $message . "<br/> <br/>" ;
	    header("Location:../index.php");
        }
    }
?>