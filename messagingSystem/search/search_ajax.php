<?php
require_once("../include/Conversation.class.php");
require_once("../include/Session.class.php");
?>
<?php
$name = $_POST['name'];
if($name == null)
    {
     return;
    }
else
   {
     global $conversation;
     $array = $conversation->search($name);

     for($i = 0 ; $i<count($array) ; $i++)
        {
         echo "<div class='name' id='{$array[$i]}' >" . $array[$i] . '</div>';
        }
    }
?>