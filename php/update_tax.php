<?php
include("connect.php");
session_start();
if (isset($_POST['update'])) {
	if (!(empty($_POST['cgst']) && empty($_POST['sgst']) && empty($_POST['sgst'])) ) {
		$cgst=$_POST['cgst'];
		$sgst=$_POST['sgst'];
		$igst=$_POST['igst'];
		$user_id=$_SESSION['user_id'];
		$connection=openCon();
		$check_query = mysqli_query($connection,"SELECT * FROM `tax`");
		$rows = mysqli_num_rows($check_query);
		$row = mysqli_fetch_assoc($check_query);
		if($row >= 1) {
			$tax_id=$row['Tax_Id'];
			$update_query =	mysqli_query($connection,"UPDATE `tax` SET `CGST` = '$cgst', `SGST` = '$sgst', `IGST` = '$igst' WHERE `tax`.`Tax_Id` = '$tax_id'");
		}
		else {
			$query = mysqli_query($connection,"INSERT INTO `tax`(`CGST`, `SGST`, `IGST`, `User_Id`) VALUES ('$cgst','$sgst','$igst','$user_id')");
		}
		closeCon($connection);
		header("location: ../taxes.php");
	}
}
?>