<?php
$t=$_GET["table"];
$p=$_GET["post"];
$s=$_GET["abc"];

if (strlen($t)>0){
    $con=mysqli_connect("localhost", "liang12l", "123456", "liang12l");
    if(!$con){
	echo "";
    }
    $json=array("like"=>array(), "comment"=>array(), "content"=>array());
    if($t=="status"){
	$q1 = "SELECT statusId FROM Status_like";
   	$result1 = mysqli_query($con, $q1);
	while($row1 = mysqli_fetch_assoc($result1))
	    $json["like"][]=$row1;
	mysqli_free_result($result1);

	$q2 = "SELECT statusId FROM Comments";
   	$result2 = mysqli_query($con, $q2);
	while($row2 = mysqli_fetch_assoc($result2))
	    $json["comment"][]=$row2;
	mysqli_free_result($result2);

	$q3 = "SELECT * FROM Status S, Users U 
		WHERE U.userId = S.userId AND statusId>$p ORDER BY date DESC";
   	$result3 = mysqli_query($con, $q3);
	while($row3 = mysqli_fetch_assoc($result3))
	    $json["content"][]=$row3;
	mysqli_free_result($result3);
    }else if($t=="comment"){
	$q1 = "SELECT commentId FROM Comment_like";
   	$result1 = mysqli_query($con, $q1);
	while($row1 = mysqli_fetch_assoc($result1))
	    $json["like"][]=$row1;
	mysqli_free_result($result1);

	$q3 = "SELECT * FROM Comments C, Users U 
		WHERE U.userId = C.userId AND C.statusId = $s
		AND commentId>$p ORDER BY date DESC";
   	$result3 = mysqli_query($con, $q3);
	while($row3 = mysqli_fetch_assoc($result3))
	    $json["content"][]=$row3;
	mysqli_free_result($result3);
    }
    mysqli_close($con);
    echo json_encode($json);
}
?>