<?php
require_once("../include/Session.class.php");
require_once("../include/Conversation.class.php");

global $conversation;
$array=$conversation->list_friends_history();

for($i=0 ; $i<count($array) ; $i++)
    {
     $name = users::find_username($array[$i]);
     echo "<div class='name' id='{$name}' >" . $name . "</div>";
    }
?>