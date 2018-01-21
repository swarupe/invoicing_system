<?php
include_once 'connect.php';
if (isset($_GET['term'])) {
	$return_arr = array();
	try {
		$conn = openCon();
		$term = $_GET['term'];
		$stmt = mysqli_query($conn, "SELECT GSTIN FROM customer WHERE GSTIN LIKE '%$term%'");
		while($row = mysqli_fetch_assoc($stmt)) {
			$return_arr[] =  $row['GSTIN'];
		}
	} catch(Exception $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
	echo json_encode($return_arr);
}
?>

<?php
/*
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'sS<334892');
define('DB_NAME', 'invoicing_system');

if (isset($_GET['term'])){
	$return_arr = array();

	try {
		$conn = new PDO("mysql:host=".DB_SERVER.";port=8889;dbname=".DB_NAME, DB_USER, DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare('SELECT GSTIN FROM customer WHERE GSTIN LIKE :term');
		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));

		while($row = $stmt->fetch()) {
			$return_arr[] =  $row['GSTIN'];
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}


	/* Toss back results as json encoded array. */
//	echo json_encode($return_arr);
//}




	?>


