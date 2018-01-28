<?php
include_once 'connect.php';
session_start();
$con = openCon();
if(isset($_GET['invoice_no'])) {
	$in_no = $_GET['invoice_no'];
	$sql = "DELETE FROM `invoice` WHERE Invoice_No='$in_no'";
	$result = mysqli_query($con,$sql);
	$from_date = $_SESSION['from_date'];
	$to_date = $_SESSION['to_date'];
	if($result){
		header("Location: ../invoice_printout.php?f_date=".$from_date."&t_date=".$to_date);
	}
}

?>