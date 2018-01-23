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

	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
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
  	width: 450px;
  	border-style: ridge;
  	margin-left: 32.5%;
  	margin-top: 4%;
  	align-items: center;
  }

  .text-color{
  	color: red;
  }

  .active-background{
  	background-color: #cfd8dc;
  }

</style>

<script>
	function showProductDetails(str) {
		if (str == "") {
			document.getElementById("txtHint").innerHTML = "";
			return;
		} else {
			if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
        	if (this.readyState == 4 && this.status == 200) {
        		document.getElementById("txtHint").innerHTML = this.responseText;
        		location.reload(); 
        	}
        };
        xmlhttp.open("GET","php/get_products_details.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>

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
			<a class="nav-link active-background" style="color: gray;">Products</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" style="color: black;" href="invoices.php">Invoice</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" style="color: black;" href="reports.php">Reports</a>
		</li>
	</ul>
	<div id="txtHint"></div>
	<form action="php/product_operations.php" method="POST">
		<div class="demo-container">
			<div class="form-inline">
				<label style="margin-top: 6px; margin-left: 17px; margin-right: 5px;">Product Name:</label>
				<div class = "form-group">
					<input style="margin-top: 17px; margin-bottom: 10px; width: 300px;" placeholder = "Enter Product Name" name = "p_name" type="text" class = "auto form-control" onchange="showProductDetails(this.value)" value="<?php if (isset($_SESSION['get_p_name'])) { echo $_SESSION['get_p_name'];  unset($_SESSION['get_p_name']); } ?>" />
				</div>
			</div>
			<div class="form-inline">
				<label style="margin-top: 5px; margin-left: 17px; margin-right: 5px;">Product Version:</label>
				<div class = "form-group">
					<input style="margin-top: 17px; margin-bottom: 10px; width: 290px;" placeholder = "Enter Product Version" name = "p_version" type="text" class = "form-control" value="<?php if (isset($_SESSION['get_p_version'])) { echo $_SESSION['get_p_version'];  unset($_SESSION['get_p_version']); } ?>" />
				</div>
			</div>
			<div class="form-inline">
				<label style="margin-top: 5px; margin-left: 17px; margin-right: 5px;">Product Type:</label>
				<div class = "form-group">
					<input style="margin-top: 17px; margin-bottom: 10px; width: 310px;" placeholder = "Enter Product Type" name = "p_type" type="text" class = "form-control" value="<?php if (isset($_SESSION['get_p_type'])) { echo $_SESSION['get_p_type'];  unset($_SESSION['get_p_type']); } ?>" />
				</div>
			</div>
			<div class="form-inline">
				<label style="margin-bottom: 2px; margin-left: 17px; margin-right: 5px;">Product Price:</label>
				<div class = "form-group">
					<input style="margin-top: 17px; margin-bottom: 18px; width: 308px;" placeholder = "Rs." name = "p_price" type="text" class = "form-control" value="<?php if (isset($_SESSION['get_p_price'])) { echo $_SESSION['get_p_price'];  unset($_SESSION['get_p_price']); } ?>" />
				</div>
			</div>

		</div>

		<?php
		if (isset($_SESSION['p_add_success'])) {
			echo "<div class=\"alert alert-success alert-dismissable fade show\" style=\"margin-top: 10px; margin-left: 30%; width: 500px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$_SESSION['p_add_success']."</strong></div>  ";
			unset($_SESSION['p_add_success']);
		}
		if (isset($_SESSION['p_add_error'])) {
			echo "<div class=\"alert alert-danger alert-dismissable fade show\" style=\"margin-top: 10px; margin-left: 30%; width: 500px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$_SESSION['p_add_error']."</strong></div>  ";
			unset($_SESSION['p_add_error']);
		}


		if (isset($_SESSION['p_modify_success'])) {
			echo "<div class=\"alert alert-success alert-dismissable fade show\" style=\"margin-top: 10px; margin-left: 30%; width: 500px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$_SESSION['p_modify_success']."</strong></div>  ";
			unset($_SESSION['p_modify_success']);
		}
		if (isset($_SESSION['p_modify_error'])) {
			echo "<div class=\"alert alert-danger alert-dismissable fade show\" style=\"margin-top: 10px; margin-left: 30%; width: 500px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$_SESSION['p_modify_error']."</strong></div>  ";
			unset($_SESSION['p_modify_error']);
		}


		if (isset($_SESSION['p_delete_success'])) {
			echo "<div class=\"alert alert-success alert-dismissable fade show\" style=\"margin-top: 10px; margin-left: 30%; width: 500px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$_SESSION['p_delete_success']."</strong></div>  ";
			unset($_SESSION['p_delete_success']);
		}
		if (isset($_SESSION['p_delete_error'])) {
			echo "<div class=\"alert alert-danger alert-dismissable fade show\" style=\"margin-top: 10px; margin-left: 30%; width: 500px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$_SESSION['p_delete_error']."</strong></div>  ";
			unset($_SESSION['p_delete_error']);
		}

		?>

		<div class="form-inline" style="width: 450px; margin-left: 39%; margin-top: 15px;">
			<div class="form-group">
				<input class="btn" style="float: left; margin-right: 20px; background-color: green;" type="submit" name="add" value="ADD">
			</div>
			<div class="form-group">
				<input class="btn" style="float: center; margin-right: 20px; background-color: ;" type="submit" name="modify" value="MODIFY">
			</div>
			<div class="form-group">
				<input class="btn" style="float: right; margin-right: 20px; background-color: red;" type="submit" name="delete" value="DELETE">
			</div>
		</div>
	</form>
	<script type="text/javascript">
		$(function() {
			$(".auto").autocomplete({
				source: "php/products_list.php",
				minLength: 1
			});                

		});
	</script>
</body>
</html>