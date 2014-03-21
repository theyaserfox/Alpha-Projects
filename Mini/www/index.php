<?php include("includes/connection.php")?>
<?php include("includes/header.php")?>
<?php include("includes/functions.php")?>
<?php session_start(); ?>
<table width="100%">
<div class="articleTitle"></div>    
          <h2>Welcome to M.I.N.I's homepage</h2>
			<p>Please feel free to Login if you are already a member,register if you would like an account.:)</p>
			<p>Also don't forget to check our Project Info and/or Contact Us section.</p>
			</td>
			<td width="25%" align="center">
			<b><u><h3>Latest News:</h3></u></b>
			<?php newsfeed();?>
			</br>
			</br>
	</div>
</div>
	</table>						
<?php include("includes/footer.php")?>
</body>
</html>
