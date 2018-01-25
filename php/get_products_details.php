<?php
include_once 'connect.php';
$connection = openCon();
session_start();
if (isset($_GET['q'])){
	$p_name = $_GET['q'];
	$result = mysqli_query($connection,"SELECT * FROM `product` WHERE Name='$p_name'");
	$row = mysqli_fetch_assoc($result);
	$_SESSION['get_p_name'] = $p_name;
	$_SESSION['get_p_version'] = $row['Version'];
	$_SESSION['get_p_type'] = $row['Type'];
	$_SESSION['get_p_price'] = $row['Price'];
	if (isset($_GET['other'])) {
		echo 'Version: '.$row['Version'].' Type: '.$row['Type'];
	}
	elseif (isset($_GET['price'])) {
		echo $row['Price'];
	}
}

?>