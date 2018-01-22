<?php
include_once 'connect.php';
$connection = openCon();
session_start();
if (isset($_GET['q'])){
	$gstin = $_GET['q'];
	$result = mysqli_query($connection,"SELECT * FROM `customer` WHERE GSTIN='$gstin'");
	$row = mysqli_fetch_assoc($result);
	$_SESSION['get_gstin'] = $gstin;
	$_SESSION['get_c_name'] = $row['Name'];
	$_SESSION['get_c_ph'] = $row['Contact_Phone'];
	$_SESSION['get_c_email'] = $row['Contact_email'];
	$_SESSION['get_c_addr'] = $row['Address'];
	$_SESSION['get_c_city'] = $row['City'];
	$_SESSION['get_c_pin'] = $row['PIN'];
}


?>