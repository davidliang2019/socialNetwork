<?php 
	if($_POST["submitted"]){
		$f=$_POST["f_name"];
		$l=$_POST["l_name"];
		$b=$_POST["birth_date"];
		$e=$_POST["email"];
		$p=$_POST["password"];
		if(strlen($f)>0 && strlen($l)>0 && strlen($b)>0
			&&strlen($e)>0 && strlen($p)>0){
			$con=mysqli_connect("localhost", "liang12l", "123456", "liang12l");
			if(!$con){
				exit("Could not connect:".mysqli_connect_error());
			}
			$q = "INSERT INTO Users (firstName, lastName, dateOfBirth, email, password)
				VALUES('$f','$l','$b','$e','$p')";
			mysqli_query($con, $q);
			mysqli_close($con);
			header("location:login.php");
	   	}else{
			$error_message = "Your application has not been completed!";
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

<article class="signup">
<h1>SIGN UP</h1>
	<form id="signupForm" action="signup.php" method="post">
	<input type="hidden" name="submitted" value="1">
	<p class = "error"><?=$error_message?></p>
	<aside class="label_class">FIRST NAME:</aside>
	<aside class="inbox"><input type="text" size="20" name="f_name" id="fname_id"/>
	<span id="mytd3">(no leading or trailing spaces)</span></aside>
	
	<aside class="label_class">LAST NAME:</aside>
	<aside class="inbox"><input type="text" size="20" name="l_name" id="lname_id"/>
	<span id="mytd4">(no leading or trailing spaces)</span></aside>

	
	<aside class="label_class">DATE OF BIRTH:</aside>
	<aside class="inbox"><input type="text" name="birth_date" id="bdate"/>
	<span id="mytd5">(mm/dd/yyyy)</span></aside>

	<aside class="label_class">EMAIL ADDRESS:</aside>
	<aside class="inbox"><input type="text" name="email" id="email_id"/>
	<span id="mytd1">(name@hotmail.com)</span></aside>

	<aside class="label_class">PASSWORD:</aside>
	<aside class="inbox"><input type="password" size="20" name="password" id="sign_pwd"/>
	<span id="mytd7">(8 characters long, at least one non-letter character)</span></aside>

	<aside class="label_class">CONFIRM PASSWORD:</aside>
	<aside class="inbox"><input type="password" size="20" name="confirm" id="match_pwd"/>
	<span id="mytd8">(re-enter password)</span></aside>

	<aside class="label_class"><input type="submit" name="submit" value="Submit"/>
	<input type="reset" value="Reset"/></aside>
	</form>
</article>

<footer>
<p>Copyright &#64; 2017 <i>Lingfeng Liang</i><br />
Last Updated: 04-04-2017</p>
</footer>
<script type="text/javascript" src="signupr.js"> </script>
</body>
</html>