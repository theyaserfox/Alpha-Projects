<?php
require_once("../include/Conversation.class.php");
require_once("../include/Session.class.php");

$name = $_POST['name'];

if($name == null)
    {
     echo "Erro in poll" ;
    }
else
   {
     global $conversation;
	 set_time_limit(900000000000);
     $array = $conversation->show_history_poll($name);
     while($array == false)
        {
         sleep(2);
         $array = $conversation->show_history_poll($name); 
        }
		
	 $json_array = json_encode($array);
     echo $json_array;
   }
?>