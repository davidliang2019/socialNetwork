<?php
$conn = mysqli_connect("localhost", "liang12l", "123456", "liang12l");
if (!$conn)
    die("Connection failed: " . mysqli_connect_error());
$sql = "select * from Users";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);

if (mysqli_num_rows($result)<=0){
    echo "No Records Found.<br />";
} else {
    echo "<center>";
    echo "For Testing";
    echo "<table border=1>";
    echo "<tr><th>UserID</th><th>Password</th></tr>";
    while ($row = mysqli_fetch_assoc($result)){
       	echo "<tr>";
       	echo "<td>" . $row['email'] . "</td><td>" . $row['password']. "</td>";
       	echo "</tr>";
    }
}
echo "</table></center>";

mysqli_free_result($result);
mysqli_close($con);
?>
