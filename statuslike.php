<?php
$u=$_GET["user"];
$p=$_GET["post"];

//lookup all hints from array if length of q>0
if (strlen($u)>0 && strlen($p)>0){
	$con=mysqli_connect("localhost", "liang12l", "123456", "liang12l");
	$q1 = "SELECT * FROM Status_like WHERE statusId='$p' AND userId='$u'";
	$result1 = mysqli_query($con, $q1);
	if(mysqli_num_rows($result1)==0){
		$q2 = "INSERT INTO Status_like(statusId, userId) VALUES('$p','$u')";
	}else{
		$q2 = "DELETE FROM Status_like WHERE statusId='$p' AND userId='$u'";
	}
	mysqli_query($con, $q2);
	mysqli_free_result($result1);
	
	$q3 = "SELECT * FROM Status_like WHERE statusId='$p'";
	$result3 = mysqli_query($con, $q3);
	echo mysqli_num_rows($result3);
	mysqli_free_result($result3);
	
	mysqli_close($con);
}
?>