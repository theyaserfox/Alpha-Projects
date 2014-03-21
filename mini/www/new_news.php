<?php
include("includes/header.php");
include("includes/functions.php");
require_once("classes/News.php");
session_start();
?>		
<?php
		if (isset($_POST['submit']))
	{
	    
	     $pro = new News( $_POST['author'] , $_POST['title'] , $_POST['content'] );
		 $pro->save();
	}
        
		?>
      <div class="articleContent">
          <form action="new_news.php" method="POST">
			<label>Author</label></br>
			<input type="text" name="author"/></br>
			<label>Title</label></br>
			<input type="text" name="title"/></br>
			<label>Content</label></br>
			<textarea name="content"></textarea>
			</br>
			</br>
			<input type="submit" value="Submit" name="submit" />
			</form>
	</div>
<?php include ("includes/afooter.php"); ?>
