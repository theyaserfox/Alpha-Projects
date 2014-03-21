<?php
require_once("../include/Session.class.php");
?>

<link href="../css/styling.css" rel="stylesheet" type="text/css"/>
<script src="../scripts/search.js"></script>

<div id="left">
<div id="search">
<input type="text" name="search" onkeyup="search(this.value)"/>
<div class="suggestion" id="suggestion" >
</div>
</div>

<div  id="list" >
</div>
</div>

<div id="home" >
<div id="chat_bar">
</div>
</div>
