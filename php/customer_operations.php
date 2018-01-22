<?php
include_once 'connect.php';
session_start();
if (isset($_POST['add'])) {
	$gstin=$_POST['gstin'];
	$c_name=$_POST['customer_name'];
	$c_ph=$_POST['customer_ph_no'];
	$c_email=$_POST['customer_email'];
	$c_address=$_POST['customer_address'];
	$c_city=$_POST['customer_city'];
	$c_pin=$_POST['customer_pincode'];
	$user_id=$_SESSION['user_id'];

	$_SESSION['get_gstin'] = $gstin;
	$_SESSION['get_c_name'] = $c_name;
	$_SESSION['get_c_ph'] = $c_ph;
	$_SESSION['get_c_email'] = $c_email;
	$_SESSION['get_c_addr'] = $c_address;
	$_SESSION['get_c_city'] = $c_city;
	$_SESSION['get_c_pin'] = $c_pin;

	$sql = "INSERT INTO `customer`(`GSTIN`, `Name`, `Contact_Phone`, `Contact_email`, `Address`, `City`, `PIN`, `User_Id`) VALUES ('$gstin','$c_name','$c_ph','$c_email','$c_address','$c_city','$c_pin','$user_id')";
	$connection=openCon();
	$query = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection) > 0 && $query){
		$_SESSION['add_success'] = "Customer added successfully";
		closeCon($connection);
		header("Location: ../customer.php");
	}
	else{
		$_SESSION['add_error'] = "Customer already exists";
		closeCon($connection);
		header("Location: ../customer.php");
	}
}

if (isset($_POST['modify'])) {
	$gstin=$_POST['gstin'];
	$c_name=$_POST['customer_name'];
	$c_ph=$_POST['customer_ph_no'];
	$c_email=$_POST['customer_email'];
	$c_address=$_POST['customer_address'];
	$c_city=$_POST['customer_city'];
	$c_pin=$_POST['customer_pincode'];
	$user_id=$_SESSION['user_id'];

	$_SESSION['get_gstin'] = $gstin;
	$_SESSION['get_c_name'] = $c_name;
	$_SESSION['get_c_ph'] = $c_ph;
	$_SESSION['get_c_email'] = $c_email;
	$_SESSION['get_c_addr'] = $c_address;
	$_SESSION['get_c_city'] = $c_city;
	$_SESSION['get_c_pin'] = $c_pin;

	$sql = "UPDATE `customer` SET `Name`='$c_name',`Contact_Phone`='$c_ph',`Contact_email`='$c_email',`Address`='$c_address',`City`='$c_city',`PIN`='$c_pin',`User_Id`='$user_id' WHERE GSTIN='$gstin'";
	$connection=openCon();
	$query = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection) > 0 && $query){
		$_SESSION['modify_success'] = "Customer details modified successfully";
		closeCon($connection);
		header("Location: ../customer.php");
	}
	else{
		$_SESSION['modify_error'] = "Customer details could'nt modify";
		closeCon($connection);
		header("Location: ../customer.php");
	}
}


if (isset($_POST['delete'])) {
	$gstin=$_POST['gstin'];
	$c_name=$_POST['customer_name'];
	$c_ph=$_POST['customer_ph_no'];
	$c_email=$_POST['customer_email'];
	$c_address=$_POST['customer_address'];
	$c_city=$_POST['customer_city'];
	$c_pin=$_POST['customer_pincode'];
	$user_id=$_SESSION['user_id'];
	$sql = "DELETE FROM `customer` WHERE GSTIN = '$gstin'";
	$connection=openCon();
	$query = mysqli_query($connection,$sql);
	if(mysqli_affected_rows($connection) > 0 && $query){
		$_SESSION['delete_success'] = "Customer entry deleted";
		closeCon($connection);
		header("Location: ../customer.php");
	}
	else{
		$_SESSION['delete_error'] = "Customer not exists";
		closeCon($connection);
		header("Location: ../customer.php");
	}
}
?>