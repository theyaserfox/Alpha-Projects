<?php
require_once("../include/Session.class.php");
require_once("../include/Conversation.class.php");

$name = $_POST['name'];
$message = $_POST['message'];

global $conversation;
$result = $conversation->insert_reply($name , $message);
echo  "ana : " . $message;    
?>