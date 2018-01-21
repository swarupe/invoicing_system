<?php
$gstin=$_POST['gstin'];
$c_name=$_POST['customer_name'];
$c_ph=$_POST['customer_ph_no'];
$c_email=$_POST['customer_email'];
$c_address=$_POST['customer_address'];
$c_city=$_POST['customer_city'];
$c_pin=$_POST['customer_pincode'];
$user_id=$_SESSION['user_id'];
$sql = "INSERT INTO `customer`(`GSTIN`, `Name`, `Contact_Phone`, `Contact_email`, `Address`, `City`, `PIN`, `User_Id`) VALUES ('$gstin','$c_name','$c_ph','$c_email','$c_address','$c_city','$c_pin','$user_id')";
$connection=openCon();
if($query = mysqli_query($connection,$sql)){
	closeCon($connection);
	header("Location: ../customer.php");
}
?>