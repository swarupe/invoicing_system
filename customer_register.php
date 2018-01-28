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
      width: 95%;
      height: 100%;
      margin-top: 10px;
      margin-left: 2%;
    }

    .text-color{
      color: red;
    }

    .active-background{
      background-color: #cfd8dc;
    }

    table {
      border-collapse: collapse;
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
      <a class="nav-link" style="color: black;" href="reports.php">Reports</a>
    </li>
  </ul>

  <h3 style="text-align: center; margin-top: 10px; margin-bottom: 20px;">Customer Register</h3>

  <?php
  $connection=openCon();
  $query = mysqli_query($connection,"SELECT Customer_Id,GSTIN,Name,Contact_Phone,Contact_email,Address,City,PIN FROM customer");
  ?>
  <div class="demo-container">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Customer Id</th>
          <th>GSTIN</th>
          <th>Customer Name</th>
          <th>Contact Phone</th>
          <th>Contact Email</th>
          <th>Address</th>
          <th>City</th>
          <th>PIN</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while( $row = mysqli_fetch_assoc( $query ) ) {
          echo "<tr>";
          foreach( $row as $key => $value )
          {
            echo "<td>".$value."</td>";
          }
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php closeCon($connection); ?> 
</body>
</html>