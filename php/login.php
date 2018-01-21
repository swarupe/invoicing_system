<?php
include("connect.php");
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	}
	else
	{
// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		$connection=openCon();
// To protect MySQL injection for Security purpose
	/*	$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysqli_real_escape_string($username);
		$password = mysqli_real_escape_string($password);*/
// SQL query to fetch information of registerd users and finds user match.
		$query = mysqli_query($connection,"select * from user where Password='$password' AND Username='$username'");
		$rows = mysqli_num_rows($query);
		$row = mysqli_fetch_assoc($query);
		if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
$_SESSION['user_id']=$row['User_Id'];
header("location: userpage.php"); // Redirecting To Other Page
} else {
	$error = "Username or Password is invalid";
}
closeCon($connection); // Closing Connection
}
}
?>