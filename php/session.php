<?php
include("connect.php");
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = openCon();
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($connection,"select * from user where Username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['Username'];
$user_id=$row['User_Id'];
if(!isset($login_session)){
closeCon($connection); // Closing Connection
header("Location: index.php"); // Redirecting To Home Page
}
?>
