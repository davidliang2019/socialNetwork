<?php 
	session_start();
	if($_SESSION["logged_in"]!=1){
		header("location:login.php");
	}
	$u = $_SESSION["userId"];
	if($_POST["submitted"]){		
		$t = $_POST["title"];
		$c = $_POST["status_content"];
		$f = $_FILES["image"]["name"];
		$d = date('Y/m/d H:i:s', time());
		if(strlen($t)>0 && strlen($c)>0){
			$con=mysqli_connect("localhost", "liang12l", "123456", "liang12l");
			if(!$con){
				exit("Could not connect:".mysqli_connect_error());
			}
			if(strlen($f)>0){
				if ($_FILES["image"]["error"] > 0){
					exit("Upload Error: " . $_FILES["image"]["error"]);
				}
				if (!file_exists("upload/" . $f)){
					move_uploaded_file($_FILES["image"]["tmp_name"],
					"upload/" . $f);
				}
				$q = "INSERT INTO Status (userId, image, content, title, date)
					VALUES('$u','$f','$c','$t','$d')";
			}else{
				$q = "INSERT INTO Status (userId, content, title, date)
					VALUES('$u','$c','$t','$d')";
			}	
			mysqli_query($con, $q);
			mysqli_close($con);
			header("location:status.php");
		}else{
			$error_message = "Your status is invalid!";
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Science Linked Net</title>
	<link rel="stylesheet" type="text/css" href = "assignment.css"/>
	<script type="text/javascript" src="assignment.js"> </script>
</head>
<body>
<header>
	<hgroup>
		<h1>Science Linked Net</h1>
	</hgroup>
	<nav>
		<ul>
			<li><a href="http://www.uregina.ca">UofR</a></li>
			<li><a href="http://www.cs.uregina.ca">CS Department</a></li>
			<li><a href="http://www2.cs.uregina.ca/~hoeber/teaching/cs215/">CS215</a></li>
			<li><a href="http://www.cs.uregina.ca/Links/class-info/215/">Lab</a></li>
		</ul>
	</nav>
</header>

<h2>User: <?=$_SESSION["firstName"]?> <?=$_SESSION["lastName"]?></h2>
<p><a href="logout.php"><input type="button" value="Logout"/></a></p>
<p><a href="status.php"><input type="button" value="Back"/></a></p>
<article class="status_class">
<h1>New Status</h1>
	<form id="statusForm" action="statusform.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="submitted" value="1">
	<p class = "error"><?=$error_message?></p>
	<p>Title:<input type="text" size="39" name="title" id="title_id"/></p>
	<p id="mytd9"></p>
	<p>Body:<br />
	<textarea cols="50" rows="6" name="status_content" id="status_id"></textarea></p>
	<p id="mytd10"></p>
	<p>Image:<input type="file" name="image" id="image_id"/></p>
	<p id="mytd11"></p>
	<p><input type="submit" name="submit" value="Submit"/>
	<input type="reset" name="reset" value="Reset"/></p>
	</form>
</article>

<footer>
<p>Copyright &#64; 2017 <i>Lingfeng Liang</i><br />
Last Updated: 04-04-2017</p>
</footer>
<script type="text/javascript" src="statusformr.js"> </script>
</body>
</html>