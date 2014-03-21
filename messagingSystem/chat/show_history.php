<?php
require_once("../include/Conversation.class.php");
require_once("../include/Session.class.php");

$name = $_POST['name'];
if($name == null)
    {
     return;
    }
else
   {
     global $conversation;
     $array=$conversation->show_history($name);

     for($i=0 ; $i<count($array) ; $i++)
        {
         echo "<div class='message' id='{$array[$i]}' >" . $array[$i] . '</div>';
        }
   }
?>