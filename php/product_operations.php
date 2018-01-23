<?php
include_once 'connect.php';
session_start();
$p_name=$_POST['p_name'];
$p_version=$_POST['p_version'];
$p_type=$_POST['p_type'];
$p_price=$_POST['p_price'];
$user_id=$_SESSION['user_id'];
if (isset($_POST['add'])) {
	$_SESSION['get_p_name'] = $p_name;
	$_SESSION['get_p_version'] = $p_version;
	$_SESSION['get_p_type'] = $p_type;
	$_SESSION['get_p_price'] = $p_price;
	$sql = "INSERT INTO `product`(`Name`, `Type`, `Version`, `Price`, `User_Id`) VALUES('$p_name','$p_type','$p_version','$p_price','$user_id')";
	$connection=openCon();
	$query = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection) > 0 && $query){
		$_SESSION['p_add_success'] = "Product added successfully";
		closeCon($connection);
		header("Location: ../products.php");
	}
	else{
		$_SESSION['p_add_error'] = "Product already exists";
		closeCon($connection);
		header("Location: ../products.php");
	}
}

if (isset($_POST['modify'])) {
	$_SESSION['get_p_name'] = $p_name;
	$_SESSION['get_p_version'] = $p_version;
	$_SESSION['get_p_type'] = $p_type;
	$_SESSION['get_p_price'] = $p_price;
	$sql = "UPDATE `product` SET `Type`='$p_type',`Version`='$p_version',`Price`='$p_price',`User_Id`='$user_id' WHERE Name='$p_name'";
	$connection=openCon();
	$query = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection) > 0 && $query){
		$_SESSION['p_modify_success'] = "Product details modified";
		closeCon($connection);
		header("Location: ../products.php");
	}
	else{
		$_SESSION['p_modify_error'] = "Product details could not be modified";
		closeCon($connection);
		header("Location: ../products.php");
	}
}


if (isset($_POST['delete'])) {
	$sql = "DELETE FROM `product` WHERE Name='$p_name' AND Type='$p_type' AND Version='$p_version' AND Price='$p_price'";
	$connection=openCon();
	$query = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection) > 0 && $query){
		$_SESSION['p_delete_success'] = "Product deleted successfully";
		closeCon($connection);
		header("Location: ../products.php");
	}
	else{
		$_SESSION['p_delete_error'] = "Product not exists in the database";
		closeCon($connection);
		header("Location: ../products.php");
	}
}
?>