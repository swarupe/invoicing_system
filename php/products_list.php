<?php
include_once 'connect.php';
if (isset($_GET['term'])) {
	$return_arr = array();
	try {
		$conn = openCon();
		$term = $_GET['term'];
		$stmt = mysqli_query($conn, "SELECT Name FROM product WHERE Name LIKE '%$term%'");
		while($row = mysqli_fetch_assoc($stmt)) {
			$return_arr[] =  $row['Name'];
		}
	} catch(Exception $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
	echo json_encode($return_arr);
}
?>