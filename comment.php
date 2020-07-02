<?php 
	session_start();
	if($_SESSION["logged_in"]!=1){
		header("location:login.php");
	}
	$u = $_SESSION["userId"];
	$s = $_GET["post_id"];
	$con=mysqli_connect("localhost", "liang12l", "123456", "liang12l");
	if(!$con){
		exit("Could not connect:".mysqli_connect_error());
	}
	$q = "SELECT * FROM Status S, Users U where S.statusId = '$s' AND U.userId = S.userId";
	$result = mysqli_query($con, $q);
	if(mysqli_num_rows($result)==0){
		header("location:status.php");
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
<input type="hidden" id="user" value="<?=$_SESSION["userId"]?>">
<p><a href="logout.php"><input type="button" value="Logout"/></a>
<a href="status.php"><input type="button" value="Back"/></a></p>
<?php
	if($row = mysqli_fetch_assoc($result)){
?>
<article class="status_class">
	<input type="hidden" id="std" value="<?=$s?>">
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
<?php
	}
	mysqli_free_result($result);
?>
<section id="parent">
<?php
	$q2 = "SELECT * FROM Comments C, Users U where C.statusId = '$s' AND U.userId = C.userId ORDER BY date DESC";
	$result2 = mysqli_query($con, $q2);
	if(mysqli_num_rows($result2)==0){
		$error_message = "No Comment!";
?>
<p class = "error"><?=$error_message?></p></section>
<input type="hidden" id="post1" value="0"/>
<?php
	}else{
?>
</section>
<?php
		$i = 0;
		while($row = mysqli_fetch_assoc($result2)){
			$i++;
?>
<article class="comments">
	<aside class="author_class"><?=$row["firstName"]?> <?=$row["lastName"]?></aside>
	<aside class="time"><?=DATE('M d, Y h:i:s a', STRTOTIME($row["date"]))?></aside>
		<br />
		<p><?=$row["content"]?></p>
<?php 
			if(strlen($row["image"])>0){
?>
	<p><img class="imgstyle" src="upload/<?=$row["image"]?>" alt="picture"/></p>
<?php 
			}
?>
	<aside class="view">
<?php 
			$q3 = "SELECT * FROM Comment_like WHERE commentId=$row[commentId] AND userId=$_SESSION[userId]";
			$result3 = mysqli_query($con, $q3);
			if(mysqli_num_rows($result3)==0){
?>
		<img class="on" id="unlike_icon<?=$i?>" src="like01.JPG" alt="picture"/>
		<img class="off" id="like_icon<?=$i?>" src="like02.JPG" alt="picture"/>
<?php 
			}else{
?>
		<img class="off" id="unlike_icon<?=$i?>" src="like01.JPG" alt="picture"/>
		<img class="on" id="like_icon<?=$i?>" src="like02.JPG" alt="picture"/>
<?php 
			}
			mysqli_free_result($result3);
			$q4 = "SELECT * FROM Comment_like WHERE commentId=$row[commentId]";
			$result4 = mysqli_query($con, $q4);
?>
		<span id="likecount<?=$i?>"><?=mysqli_num_rows($result4)?></span> likes
		<input type="hidden" id="post<?=$i?>" value="<?=$row['commentId']?>"> 
	</aside>
</article>
<?php
		}
	}
	mysqli_free_result($result4);
	mysqli_free_result($result2);
	mysqli_close($con);
?>

<p><a href="commentform.php?post_id=<?=$s?>"><input type="button" value="Add Comment"/></a></p>

<footer>
<p>Copyright &#64; 2017 <i>Lingfeng Liang</i><br />
Last Updated: 04-04-2017</p>
</footer>
<script type="text/javascript" src="commentr.js"></script>
</body>
</html>