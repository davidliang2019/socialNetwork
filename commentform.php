<?php 
	session_start();
	if($_SESSION["logged_in"]!=1){
		header("location:login.php");
	}
	$u = $_SESSION["userId"];
	$s = $_GET["post_id"];
	if($_POST["submitted"]){
		$c = $_POST["comment_content"];
		$f = $_FILES["image"]["name"];
		$d = date('Y/m/d H:i:s', time());
		if(strlen($c)>0){
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
				$q = "INSERT INTO Comments (statusId, userId, image, content, date)
					VALUES('$s','$u','$f','$c','$d')";
			}else{
				$q = "INSERT INTO Comments (statusId, userId, content, date)
					VALUES('$s','$u','$c','$d')";
			}	
			mysqli_query($con, $q);
			mysqli_close($con);
			header("location:comment.php?post_id=$s");
		}else{
			$error_message = "Your comment is invalid!";
		}
	}
	$con=mysqli_connect("localhost", "liang12l", "123456", "liang12l");
	if(!$con){
		exit("Could not connect:".mysqli_connect_error());
	}
	$q = "SELECT * FROM Status S, Users U where S.statusId = '$s' AND U.userId = S.userId";
	$result = mysqli_query($con, $q);
	if(mysqli_num_rows($result)==0){
		header("location:status.php");
	}else{
		$row = mysqli_fetch_assoc($result);
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
<p><a href="comment.php?post_id=<?=$s?>"><input type="button" value="Back"/></a></p>

<article class="status_class">
	<aside class="author_class"><?=$row["firstName"]?> <?=$row["lastName"]?></aside>
	<aside class="time"><?=DATE('M d, Y h:i:s a', STRTOTIME($row["date"]))?></aside>
	<h1><?=$row["title"]?></h1>
	<p><?=$row["content"]?></p>
<?php 
		if(strlen($row["image"])>0){
?>
	<p><img class="imgstyle" src="upload/<?=$row["image"]?>" alt="picture"/></p>
<?php 
		}
?>
</article>

<article class="comments">
<h1>Add a comment</h1>
<p class = "error"><?=$error_message?></p>
<form id="statusForm" action="commentform.php?post_id=<?=$s?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="submitted" value="1">
	<p><textarea cols="50" rows="10" name="comment_content" id="status_id"></textarea></p>
	<p id="mytd10"></p>
	<p>Image:
	<input type="file" name="image" id="image_id"/></p>
	<p id="mytd11"></p>
	<p><input type="submit" name="submit" value="Submit"/>
	<input type="reset" name="reset" value="Reset"/></p>
</form>
</article>

<footer>
<p>Copyright &#64; 2017 <i>Lingfeng Liang</i><br />
Last Updated: 04-04-2017</p>
</footer>
<script type="text/javascript" src="commentformr.js"> </script>
</body>
</html>
<?php
	}
	mysqli_free_result($result);
	mysqli_close($con);
?>