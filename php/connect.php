<?php
function openCon()
{
	$conn = mysqli_connect("localhost","root","sS<334892","invoicing_system");
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	return $conn; 
}

function closeCon($conn)
{
	$conn->close();
}
?>