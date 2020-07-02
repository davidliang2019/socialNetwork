<?php 
	if($_POST["submitted"]){
		$e=$_POST["email"];
		$p=$_POST["password"];
		if(strlen($e)>0 && strlen($p)>0){
			$con=mysqli_connect("localhost", "liang12l", "123456", "liang12l");
			if(!$con){
				exit("Could not connect:".mysqli_connect_error());
			}
			$q = "SELECT userId, firstName, lastName FROM Users 
				WHERE email = '$e' AND password = '$p'";
			$result = mysqli_query($con, $q);
			if(mysqli_num_rows($result)>0){
				session_start();
				$_SESSION["logged_in"]=1;
				$row = mysqli_fetch_assoc($result);
				$_SESSION["userId"]=$row["userId"];
				$_SESSION["firstName"]=$row["firstName"];
				$_SESSION["lastName"]=$row["lastName"];
				header("location:status.php");
			}else{
				$error_message = "Wrong Username or Password!";
			}
			mysqli_free_result($result);
			mysqli_close($con);
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

<article class="login_class">
<h1>LOGIN</h1>
<form id="loginForm" action="login.php" method="post">
<input type="hidden" name="submitted" value="1">
<p class = "error"><?=$error_message?></p>
<aside class="label_class">USERNAME</aside>
<aside class="inbox"><input type="text" size="20" name="email" id="email_id"/></aside>
<aside class="error" id="mytd1"></aside>
<aside class="label_class">PASSWORD</aside>
<aside class="inbox"><input type="password" size="20" name="password" id="pwd_id"/></aside>
<aside class="error" id="mytd2"></aside>
<aside class="inbox"><input type="submit" name="login_submit" value="Login"/></aside>
<aside class="inbox"><a href="signup.php">Please sign up if you don't have a user name.</a></aside>
</form>
</article>

<section id="display"></section>

<script>
function display(){
       var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("display").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "sqlphp.php", true);
        xmlhttp.send();
}
document.addEventListener("DOMContentLoaded", display, false);  
</script>

<footer>
<p>Copyright &#64; 2017 <i>Lingfeng Liang</i><br />
Last Updated: 04-04-2017</p>
</footer>
<script type="text/javascript" src="loginr.js"> </script>
</body>
</html>
