<?php
include("php/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Invoicing System</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
  .navbar-header {
  	height: 60px;
  }
  .navbar-brand {

  	padding-top: 0;
  	padding-bottom: 0;
  	line-height: 60px;
  	font-size: 40px;
  }

  .nav.navbar-nav > li > a {
  	padding-top: 20px;
  	padding-bottom: 20px;
  }

  .demo-container{
  	width: 35%;
  	margin-top: 13%;
  	margin-left: 34%;
  	align-items: center;
  }

  .text-color{
  	color: red;
  }

  .active-background{
  	background-color: #cfd8dc;
  }

</style>
</head>
<body>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>

	<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
		<a href = "index.php" style="color: black;" class="navbar-brand">Invoicing System</a>
		<a href="php/logout.php" class="ml-auto btn btn-info btn-lg" style="background-color: #ffffff; color: gray;">Logout</a>

	</nav>


	<ul class="nav nav-tabs nav-pills nav-fill">
		<li class="nav-item">
			<a class="nav-link" style="color: black;" href="customer.php">Customer</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" style="color: black;" href="taxes.php">Taxes</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" style="color: black;" href="products.php">Products</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" style="color: black;" href="invoices.php">Invoice</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active-background" style="color: gray;">Reports</a>
		</li>
	</ul>
	<?php $con=openCon(); $customer = mysqli_query($con, "SELECT * FROM customer"); $products = mysqli_query($con,"SELECT * FROM product");?>
	<div class="demo-container">
		<span><h4>Total Customer Registered: <strong><?php echo mysqli_num_rows($customer); ?></strong></h4></span>
		<span><a href="customer_register.php"><h4>Customer Register</h4></a></span>
		<span><h4>Total Products Registered: <strong><?php echo mysqli_num_rows($products); ?></strong></h4></span>
		<span><a href="products_register.php"><h4>Products Register</h4></a></span>
		<span><a href="invoice_printout.php"><h4>Invoice Printout</h4></a></span>
	</div>
	<?php closeCon($con); ?>
</body>
</html>