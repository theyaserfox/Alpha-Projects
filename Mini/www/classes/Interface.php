<?php
include("includes/connection.php");
include("includes/functions.php");

class user_interface
{
private $header;
private $footer;
private $afooter;
private $main;

public function __construct(){
	$this->header = "<html class=\"no-js\">
				<head>
					<meta charset=\"utf-8\">
					<!-- Always force latest IE rendering engine & Chrome Frame -->
					<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">

					<!-- Put your title here! -->
					<title></title>

					<meta name=\"description\" content=\"\">

					 <!-- Mobile viewport optimized: h5bp.com/viewport -->
					<meta name=\"viewport\" content=\"width=device-width\">

					<link href=\"style.css\" rel=\"stylesheet\">

					<!-- Load Open Sans and Merriweather from Google Fonts
						For optimal performance, customize it to load the styles you need:
						http://goo.gl/QufgJ
					-->
					<link href=\"//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700|Merriweather:400,700,900\" rel=\"stylesheet\">

					<!-- All JavaScript at the bottom, except for Modernizr
						Modernizr enables HTML5 elements & feature detects; It includes Respond, a polyfill for min/max-width CSS3 Media Queries
						For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
					<script src=\"js/modernizr-2.6.1.min.js\"></script>
				</head>

				<body>

					<!-- Prompt IE 6 and 7 users to install Chrome Frame:		chromium.org/developers/how-tos/chrome-frame-getting-started -->
					<!--[if lt IE 8]>
						<p class=\"chromeframe alert alert-warning\">Your browser is <em>ancient!</em> <a href=\"http://browsehappy.com/\">Upgrade to a different browser</a> or <a href=\"http://www.google.com/chromeframe/?redirect=true\">install Google Chrome Frame</a> to experience this site.</p>
					<![endif]-->

					<header id=\"master-header\" class=\"clearfix\" role=\"banner\">

						<hgroup>
							<h1 id=\"site-title\"><a href=\"index.php\" title=\"Your Site Name\">mini</a></h1>
							<h2 id=\"site-description\"></h2>
						</hgroup>

					</header> <!-- #master-header -->

				<div id=\"main\" class=\"row clearfix\">

					<!-- Main navigation -->
					<nav class=\"main-navigation clearfix span12\" role=\"navigation\">
						<h3 class=\"assistive-text\">Main menu</h3>
						<ul>
							<li class=\"current\"><a href=\"index.php\">Home</a></li>
							<li><a href=\"TableEdit.php\">Time Table</a></li>
							<li>
								<a href=\"projectinfo.php\">About</a>
								<ul class=\"sub-menu\">
									<li><a href=\"projectinfo2.php\">Progess</a></li>
									<li><a href=\"projectinfo3.php\">Team members</a></li>
								</ul>
							</li>
							<li><a href=\"contactus.php\">Contact</a></li>
						</ul>
					</nav> <!-- #main-navigation -->

				<div id=\"content\" role=\"main\" class=\"span7\">";
	$public_navi = public_navigation();
	$admin_navi = admin_navigation();
	$this->footer = "</div> <!-- #content -->

				<div id=\"sidebar\" role=\"complementary\" class=\"span4\">
					<aside class=\"widget\">
						<h3 class=\"widget-title\">Menu</h3>".$public_navi."
					</aside> <!-- .widget -->

				</div> <!-- #sidebar -->

				</div> <!-- #main -->

					<footer id=\"footer\" role=\"contentinfo\">
						<p>
							Copyright &copy; 2013 <a href=\"#\">mini.com</a>
							<span class=\"sep\">|</span>
							Design by <a href=\"#\" title=\"Design by FIVE Team\">FIVE Team</a>
						</p>
					</footer> <!-- #footer -->

					<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
					<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js\"></script>
					<script>window.jQuery || document.write('<script src=\"js/jquery-1.7.2.min.js\"><\/script>')</script>

					<!-- Load custom scripts -->
					<script src=\"js/script.js\"></script>
							</body>
							</html>";
	$this->afooter = "</div> <!-- #content -->

						<div id=\"sidebar\" role=\"complementary\" class=\"span4\">
							<aside class=\"widget\">
								<h3 class=\"widget-title\">Menu</h3>"
								.$admin_navi.
								"</aside> <!-- .widget -->
						</div> <!-- #sidebar -->

						</div> <!-- #main -->

							<footer id=\"footer\" role=\"contentinfo\">
								<p>
									Copyright &copy; 2013 <a href=\"#\">mini.com</a>
									<span class=\"sep\">|</span>
									Design by <a href=\"#\" title=\"Design by FIVE Team\">FIVE Team</a>
								</p>
							</footer> <!-- #footer -->

							<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
							<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js\"></script>
							<script>window.jQuery || document.write('<script src=\"js/jquery-1.7.2.min.js\"><\/script>')</script>

							<!-- Load custom scripts -->
							<script src=\"js/script.js\"></script>
						</body>
						</html>";
}
public function view_header(){
	return $this->header;
					
}
public function view_footer(){
	return $this->footer;
}
public function view_afooter(){
	return $this->afooter;
}
public function contactus_form(){
	$this->main = "<table width=\"100%\">			
	<div class=\"articleTitle\"></div>
        
        
					<p> If you are encountering any technical problems </br>or you would like to contact us for other reasons.</p>
					<p>Please email us at miniproject@fcih.com or leave a small comment.</p>
					<form action=\"contactus.php\" method=\"POST\">
					<table >
					<tr>
					<td><label>Sender:</label></td>
					<td><input type=\"text\" name=\"sender\"/></td>
					</tr>
					<tr>
					<td><label>Title:</label></td>
					<td><input type=\"text\" name=\"title\"/></td>
					</tr>
					<tr>
					<tr>
					<td><label>Email:</label></td>
					<td><input type=\"email\" name=\"email\"/></td>
					</tr>
					<tr>
					<td colspan=\"5\"><textarea rows=\"10\" cols=\"50\" name=\"text\"></textarea></td>
					</tr>
					<tr><td><input type=\"submit\" value=\"Submit\"/></td></tr>
					</form>
					</div>
					</table>";
}
public function index_page(){
$news = newsfeed();
$this->main = "<table width=\"100%\">
			<div class=\"articleTitle\"></div>    
			<h2>Welcome to M.I.N.I's homepage</h2>
			<p>Please feel free to Login if you are already a member,register if you would like an account.:)</p>
			<p>Also don't forget to check our Project Info and/or Contact Us section.</p>
			</td>
			<td width=\"25%\" align=\"center\">
			<b><u><h3>Latest News:</h3></u></b>"
			.$news.
			"</br>
			</br>
			</div>
			</div>
			</table>";
}
public function login_form($error){
	$message = "";
	if($error > 0)
	{
		$message = "<font color = 'red'>Wrong name or password </font><br/><br/>";
	}
	$this->main = "<table width=\"100%\">
					<div class=\"articleContent\">
					<div class=\"rightLinks\">
					<ul>
					<form id = \"Regist\" action = \"Login.php\" method = \"post\">
					<p>".$message."
					<h2>Log In</h2>
					Username:
					<input type = \"text\" name = \"username\" value \"\" id  = \"username\" />

					Password:
					<input id = 'password' type = 'password'  name = 'password'/>
					</p>			
					
					<input type = 'submit' value ='Log in' />
					</form>
					</ul>
					
					</div>
			</table>";
}
public function admin_page(){
	$news = newsfeed();
	$this->main = "<table width=\"100%\">

				  <div class=\"articleContent\">
					 <div class=\"rightLinks\">
						
					<p>
					  <b><u>	<h3>Latest News:</h3></u></b>
						".$news."
					</p>
					</div>
					</table>";
}	
public function register(){
	$this->main = "<table width=\"100%\">
				   <div class=\"articleContent\">
					<div class=\"rightLinks\">
				<h2>Register</h2>
				<ul>
					<form id = \"Registration\" action = \"create_new_user.php\"  method = \"post\">
					<p>
					Username:
					<input type = \"text\" name = \"username\" value \"\" id  = \"username\" />
					<br />
					<br />
					Password:
					<input id = 'password' type = 'password'  name = 'password'/>
					<br />
					<br />
					Confirm password:
					<input id = 'confirmpass' type = 'password'  name = 'confirmpass'/>
					<br />
					<br />
					Email:
					<input id = 'email' type = 'email'  name = 'email'/>
					</p>			
					<br />
					<br />
					<input type = 'submit' value ='sign up' />
					<div >
					<p  ><font id = \"error\" color = \"red\"> </font></p>
					</div>
					</form>
					</ul>
					</div>
					<h2> </h2>
					<script type = \"text/javascript\" > 
						function validate ()
							{						
							
							document.getElementById(\"Registration\").onsubmit = function(){
							var password = document.getElementById(\"password\").value;
							var cpassword = document.getElementById(\"confirmpass\").value;
						
							if ((password !== cpassword) || (password == null) || (password == \" \"))
								{
								
								document.getElementById(\"error\").innerHTML = \"password doesnt matches\"
								return false;
								} else {
								
								return true;			
								}
								}
													
							}	
							window.onload = function(){
							
							validate();
}
					</script>
					</table>";
}
public function addnews(){
	$this->main = "<div class=\"articleContent\">
			<form action=\"createpost.php\" method=\"POST\">
			<table>
				<tr>
					<td>
						<label>Author</label></br>
					</td>
					<td>
						<input type=\"text\" name=\"author\"/></br>
					</td>
				</tr>
				<tr>
					<td>
						<label>Title</label></br>
					</td>
					<td>
						<input type=\"text\" name=\"title\"/></br>
					</td>
				</tr>
				<tr>
					<td>
						<label>Content</label></br>
					</td>
				</tr>
				<tr>
					<td colspan=\"5\">
						<textarea name=\"content\" rows=\"10\" cols=\"25\"></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<input type=\"submit\" value=\"Submit\" />
					</td>
				</tr>
			</table>
			</form>
	</div>";
}
public function new_room(){
	$this->main = "<div class=\"articleContent\">
					
				<ul>
					<form id = \"Registration\" action = \"create_new_room.php\"  method = \"post\">
					<table>
					<tr>
						<td>
							<label>Name:</label>
						</td>
						<td>
							<input type = \"text\" name = \"room_name\" id  = \"room_name\" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Number of seats:</label>
						</td>
						<td>
							<input id = 'no_seats' type = 'text'  name = 'no_seats'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Lab:</label>
						</td>
						<td>
							<input type = 'radio' id = 'Yes' name = \"isLab\" value = '1' /> Yes 
							&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
							<input type = 'radio' id = 'Yes' name = \"isLab\" value = '1' /> No 		
						</td>
					<tr>
						<td>
						<input type=\"submit\" value=\"Add new room\"/>
						</td>
					</tr>
					<tr>
						<td>
						<div id = \"error\">
						</div>
						</td>
					</tr>
					</table>
					</form>
					</ul>
					</div>";
}
public function new_course(){
	$this->main = "<div class=\"articleContent\">
			
          <ul>
					<form id = \"Registration\" action = \"create_new_course.php\"  method = \"post\">
					<table>
					<tr>
					<td>
						<label>Name:</label>
						</td>
						<td>
							<input type = \"text\" name = \"course_name\" value \"\" id  = \"course_name\" />
						</td>
						</tr>
						<tr>
							<td>
								<label>Description:</label>
							</td>
						</tr>
						<tr>
							<td colspan=\"5\">	
								<textarea id = 'Description'  rows=\"10\" cols=\"32\"  name = 'Description' ></textarea>
							</td>
						</tr>
						<tr>
							<td>
								<input type = 'submit' value = \"Add new Course\" />
							</td>
							<td>
								<div id = \"error\">
								</div>
							</td>
						</tr>
					</table>
					</form>
					</ul>
					</div>";
}
public function new_professor(){
	$this->main = "<div class=\"articleContent\">
          <ul>
					<form id = \"Registration\" action = \"create_new_professor.php\"  method = \"post\">
					<table>
					<tr>
						<td>
							<label>First name:</label>
						</td>
						<td>
							<input type = \"text\" name = \"firstname\" id  = \"firstname\" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Second Name:</label>
						</td>
						<td>
							<input id = 'secondname' type = 'text'  name = 'secondname'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Username:</label>
						</td>
						<td>
							<input id = 'username' type = 'text'  name = 'username'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Mobile number:</label>
						</td>
						<td>
							<input id = 'phone_number_1' type = 'text'  name = 'phone_number_1'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Phone number (optional):</label>
						</td>
						<td>
							<input id = 'phone_number_2' type = 'text'  name = 'phone_number_2'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Password:</label>
						</td>
						<td>
							<input id = 'password' type = 'password'  name = 'password'/>
						</td>
					</tr>
					<tr>
						<td>
						<label>Confirm password:</label>
						</td>
						<td>
						<input id = 'confirmpass' type = 'password'  name = 'confirmpass'/>
						</td>
					</tr>
					<tr>
						<td>
						<label>Age:</label>
						</td>
						<td>
						<input id = 'age' type = 'text'  name = 'age'/>
						</td>
					</tr>
					<tr>
						<td>
						<label>Address:</label>
						</td>
						<td>
						<input id = 'address' type = 'text'  name = 'address'/>
						</td>
					</tr>
					<tr>
						<td>
						<label>Description:</label>
						</td>
					</tr>
					<tr>
						<td colspan=\"10\">
							<textarea  name = \"Description\" cols = \"40\" rows = \"10\"></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input type=\"submit\" value=\"Add new professor\"/>
							<div id = \"error\">
							</div>
						</td>
					</tr>
					</table>
					</form>
					</ul>
					</div>
					
					
						<script type = \"text/javascript\" > 
						function validate ()
							{						
							
							document.getElementById(\"Registration\").onsubmit = function(){
							var password = document.getElementById(\"password\").value;
							var cpassword = document.getElementById(\"confirmpass\").value;
						
							if ((password !== cpassword) || (password == null) || (password == \" \"))
								{
								
								document.getElementById(\"error\").innerHTML = \"password doesnt matches\"
								return false;
								} else {
								
								return true;			
								}
								}
													
							}	
							window.onload = function(){
							
							validate();
							}
					</script>";
}
public function project_info($num){
	if($num == 1){
		$this->main = "<table width=\"100%\">	
				<div class=\"articleTitle\"></div>
        
        
				  <b><h3> M.I.N.I</h3></b>
							<ul>
							<li><b>M.I.N.I</b> is a Software Engineering 1 course's Project for level 2 students in Faculty of Computers and Information , Helwan University.</li>
							<li>It stands for \"<b>MINI Is Not Impossible</b>\" which would be considered a recursive acronym.</li></br>
							<li>Its main idea is creating a website that could manage the faculty's database in order to come up with a Time Schedule, with the least amount of conflicts arising.</li></br>
							<li>Many people said such project would be quite impossible since there will always be conflicts , but we have decided to accept that challenge and aspire to do
							something outstanding that could help our Faculty manage its Time-tables with maximum satisfaction and minimum risk of conflicts between lectures and lab sections as possible.</li></br>
							<li>To do so, we decided to apply a series of actions that are backed up by the genetic algorithm and try to generate a schedule that satisfies all conditions given
							by the help of our Database.</li></br>
						
							
					</div>	
				</table>";
	}
	if($num == 2){
		$this->main = "<table width=\"100%\">	
						<div class=\"articleTitle\"></div>
								
								
								  <b><h3> M.I.N.I</h3></b>
											<u><b><li>Below will be a log of our progress in the project:</li></b></u>
												<ul>
												<u><b><h4>First Week:</h4></b></u>
												<li>Agreement on Project and Coding language.</li>
												<li>Dividing Tasks on Team members.</li>
												<li>Collecting Software Requirements Specificiations Data.</li>
												<u><b><h4>Second Week:</h4></b></u>
												<li>Applying the plan.</li>
												<li>Writing the S.R.S Document.</li>
												<li>Coding the Login & Register module.(CMS)</li>
												<li>Understanding the genetic algorithm.</li>
												<u><b><h4>Third Week:</h4></b></u>
												<li>Work postponed because of exams.</li>
												<u><b><h4>Fourth Week:</h4></b></u>
												<li>Working on the two modules and implementing them.</li>
												</ul>
											</ul>

											
							</div>	
						</table>";
	}
	if($num == 3){
		$this->main = "<table width=\"100%\">	
						<div class=\"articleTitle\"></div>
								
								
								  <b><h3> M.I.N.I</h3></b>
										<div class=\"articleContent\">
											<h2>Team members:</h2>
											<ul>
											<li>Maram El Sayed Mohamed - Analysis.</li>
											<li>Nesma Talaat Abaas - Web Design & Database.</li>
											<li>Yasser Omar Mohamed - Core Coding.</li>
											<li>Kirolos Magdy Nageeb - Lib Coding & Database.</li>
											<li>Fady Aziz Fouad - Lib & Core Coding.</li>
											</ul>
										</div>
											
							</div>	
						</table>";
	
	}
}

public function view_main(){
	return $this->main;
}

};
$interface = new user_interface();
$navigation = & $interface;
?>