<?php
include("php/session.php");
if (isset($_POST['add'])) {
  include_once 'php/add_customer.php';
  //header("Location: php/add_customer.php");
}
if (isset($_POST['modify'])) {
  header("Location: php/modify_customer.php");
}
if (isset($_POST['delete'])) {
  header("Location: php/delete_customer.php");
}
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
      margin-top: 3%;
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
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>

  <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <a href = "index.php" style="color: black;" class="navbar-brand">Invoicing System</a>
    <a href="php/logout.php" class="ml-auto btn btn-info btn-lg" style="background-color: #ffffff; color: gray;">Logout</a>

  </nav>

  
  <ul class="nav nav-tabs nav-pills nav-fill">
    <li class="nav-item">
      <a class="nav-link active-background" style="color: gray;">Customer</a>
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
      <a class="nav-link" style="color: black;" href="reports.php">Reports</a>
    </li>
  </ul>

  
  <form action="" method="POST">
    <div class="demo-container">
      <div class="form-inline">
        <label style="margin-left: 17px; margin-right: 5px;">GSTIN :</label>
        <div class = "form-group">
          <input style="margin-top: 17px; margin-bottom: 10px; width: 350px;" placeholder = "GSTIN Number" name = "gstin" type = "number" class = "auto form-control"/>
        </div>
      </div>
      <div class="form-inline">
        <label for = "name" style="margin-left: 17px; margin-right: 5px;">Customer Name :</label>
        <div class = "form-group">
          <input style="margin-bottom: 10px; width: 283px;" placeholder = "Customer Name" name = "customer_name" class = "form-control"/>
        </div>
      </div>
      <div class="form-inline">
        <label for = "name" style="margin-left: 17px; margin-right: 5px;">Phone Number :</label>
        <div class = "form-group">
          <input style="margin-bottom: 10px; width: 291px;" placeholder = "Customer Phone Number" name = "customer_ph_no" class = "form-control"/>
        </div>
      </div>
      <div class="form-inline">
        <label for = "name" style="margin-left: 17px; margin-right: 5px;">Email :</label>
        <div class = "form-group">
          <input style="margin-bottom: 10px; width: 358px;" placeholder = "Customer Email ID" name = "customer_email" type="email" class = "form-control"/>
        </div>
      </div>
      <div class="form-inline">
        <label for = "name" style="margin-left: 17px; margin-right: 5px;">Address :</label>
        <div class = "form-group">
          <textarea style="margin-bottom:10px; width: 340px;" placeholder = "Address" name = "customer_address" class = "form-control"></textarea>
        </div>
      </div>
      <div class="form-inline">
        <label for = "name" style="margin-left: 17px; margin-right: 5px;">City :</label>
        <div class = "form-group">
          <input style="margin-bottom: 10px; width: 371px;" placeholder = "City" name = "customer_city" class = "form-control"/>
        </div>
      </div>
      <div class="form-inline">
        <label for = "name" style="margin-left: 17px; margin-right: 5px;">PIN :</label>
        <div class = "form-group">
          <input style="margin-bottom: 18px; width: 372px;" placeholder = "Pincode" name = "customer_pincode" class = "form-control"/>
        </div>
      </div>
    </div>
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

    //autocomplete
    $(".auto").autocomplete({
      source: "php/gstin_list.php",
      minLength: 1
    });                

  });
</script>

</body>
</html>