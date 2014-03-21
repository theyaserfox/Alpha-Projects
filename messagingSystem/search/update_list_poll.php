<?php
require_once("../include/Session.class.php");
require_once("../include/Conversation.class.php");

global $conversation;
set_time_limit(900000000000); 
$array_list = $conversation->list_friends_poll();
$array_chat = $conversation->show_chat_notifications();  

while( $array_chat == false && $array_list == false )
    {
     sleep(2);
     $array_list = $conversation->list_friends_poll(); 
	 $array_chat = $conversation->show_chat_notifications();
    }
$array = array(
"chat" => $array_chat ,
"list" => $array_list
);	
$json_array = json_encode($array);
echo $json_array;
?>