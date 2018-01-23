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
      width: 350px;
      border-style: ridge;
      margin-top: 10%;
      margin-left: 37%;
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


  <?php
  $connection=openCon();
  $check_query = mysqli_query($connection,"SELECT * FROM `tax`");
  $rows = mysqli_num_rows($check_query);
  $row = mysqli_fetch_assoc($check_query);
  ?>


  <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <a href = "index.php" style="color: black;" class="navbar-brand">Invoicing System</a>
    <a href="php/logout.php" class="ml-auto btn btn-info btn-lg" style="background-color: #ffffff; color: gray;">Logout</a>

  </nav>

  
  <ul class="nav nav-tabs nav-pills nav-fill">
    <li class="nav-item">
      <a class="nav-link" style="color: black;" href="customer.php">Customer</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active-background" style="color: gray;">Taxes</a>
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
  
  <form action="php/update_tax.php" method="POST">
    <div class="demo-container">
      <div class="form-inline">
        <label for = "name" style="margin-left: 20px; margin-top:8px;  margin-right: 5px;">CGST :</label>
        <div class = "form-group">
          <input style="margin-top: 20px; margin-bottom: 10px;" placeholder = "CGST" name = "cgst" type = "number" class = "form-control" min="0" max="100" value="<?php if ($rows >=0) { echo $row['CGST']; }?>" />
        </div>
        <label style="margin-left: 3px; margin-top: 8px;">%</label>
      </div>
      <div class="form-inline">
        <label for = "name" style="margin-left: 20px; margin-bottom:12px; margin-right: 6px;">SGST :</label>
        <div class = "form-group">
          <input style="margin-bottom: 10px;" placeholder = "SGST" name = "sgst" type = "number" class = "form-control" min="0" max="100"  value="<?php if ($rows >=0) { echo $row['SGST']; }?>" />
        </div>
        <label style="margin-left: 3px; margin-bottom: 10px;">%</label>
      </div>
      <div class="form-inline">
        <label for = "name" style="margin-bottom:22px; margin-right: 7px; margin-left: 26px;">IGST :</label>
        <div class = "form-group">
          <input style="margin-bottom: 20px;" placeholder = "IGST" name = "igst" type = "number" class = "form-control" min="0" max="100"  value="<?php if ($rows >=0) { echo $row['IGST']; }?>" />
        </div>
        <label style="margin-left: 3px; margin-bottom: 20px;">%</label>
      </div>
    </div>
    <div class="form-group">
      <input class="btn" style="margin-left: 55%; margin-top: 10px; background-color: green;" type="submit" name="update" value="UPDATE">
    </div>
  </form>
  

</body>
</html>