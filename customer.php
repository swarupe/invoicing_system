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
      margin-top: 2.5%;
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
    function showCustomerDetails(str) {
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
          xmlhttp.open("GET","php/get_customer_details.php?q="+str,true);
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
    <div id="txtHint"></div>
    <form action="php/customer_operations.php" method="POST">
      <div class="demo-container">
        <div class="form-inline">
          <label style="margin-top: 5px; margin-left: 17px; margin-right: 5px;">GSTIN :</label>
          <div class = "form-group">
            <input style="margin-top: 17px; margin-bottom: 10px; width: 350px;" placeholder = "Enter GSTIN" name = "gstin" type="numbr" class = "auto form-control" onchange="showCustomerDetails(this.value)" value="<?php if (isset($_SESSION['get_gstin'])) { echo $_SESSION['get_gstin'];  unset($_SESSION['get_gstin']); } ?>" />
          </div>
        </div>
        <div class="form-inline">
          <label for = "name" style="margin-bottom: 12px; margin-left: 17px; margin-right: 5px;">Customer Name :</label>
          <div class = "form-group">
            <input style="margin-bottom: 10px; width: 283px;" placeholder = "Customer Name" name = "customer_name" class = "form-control" value="<?php if (isset($_SESSION['get_c_name'])) { echo $_SESSION['get_c_name']; unset($_SESSION['get_c_name']);}?>" />
          </div>
        </div>
        <div class="form-inline">
          <label for = "name" style="margin-bottom: 13px; margin-left: 17px; margin-right: 5px;">Phone Number :</label>
          <div class = "form-group">
            <input style="margin-bottom: 10px; width: 291px;" placeholder = "Customer Phone Number" name = "customer_ph_no" class = "form-control" value="<?php if (isset($_SESSION['get_c_ph'])) { echo $_SESSION['get_c_ph']; unset($_SESSION['get_c_ph']);}?>" />
          </div>
        </div>
        <div class="form-inline">
          <label for = "name" style="margin-bottom: 12px; margin-left: 17px; margin-right: 5px;">Email :</label>
          <div class = "form-group">
            <input style="margin-bottom: 10px; width: 358px;" placeholder = "Customer Email ID" name = "customer_email" type="email" class = "form-control" value="<?php if (isset($_SESSION['get_c_email'])) { echo $_SESSION['get_c_email']; unset($_SESSION['get_c_email']);}?>"/>
          </div>
        </div>
        <div class="form-inline">
          <label for = "name" style="margin-bottom: 50px; margin-left: 17px; margin-right: 5px;">Address :</label>
          <div class = "form-group">
            <textarea style="margin-bottom:10px; width: 340px;" placeholder = "Address" name = "customer_address" class = "form-control"><?php if (isset($_SESSION['get_c_addr'])) { echo $_SESSION['get_c_addr']; unset($_SESSION['get_c_addr']); }?></textarea>
          </div>
        </div>
        <div class="form-inline">
          <label for = "name" style="margin-bottom: 10px; margin-left: 17px; margin-right: 5px;">City :</label>
          <div class = "form-group">
            <input style="margin-bottom: 10px; width: 371px;" placeholder = "City" name = "customer_city" class = "form-control" value="<?php if (isset($_SESSION['get_c_city'])) { echo $_SESSION['get_c_city']; unset($_SESSION['get_c_city']);}?>"/>
          </div>
        </div>
        <div class="form-inline">
          <label for = "name" style="margin-bottom: 18px; margin-left: 17px; margin-right: 5px;">PIN :</label>
          <div class = "form-group">
            <input style="margin-bottom: 18px; width: 372px;" placeholder = "Pincode" name = "customer_pincode" class = "form-control" value="<?php if (isset($_SESSION['get_c_pin'])) { echo $_SESSION['get_c_pin']; unset($_SESSION['get_c_pin']);}?>"/>
          </div>
        </div>
      </div>
      <?php
      if (isset($_SESSION['add_success'])) {
        echo "<div class=\"alert alert-success alert-dismissable fade show\" style=\"margin-top: 10px; margin-left: 30%; width: 500px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$_SESSION['add_success']."</strong></div>  ";
        unset($_SESSION['add_success']);
      }
      if (isset($_SESSION['add_error'])) {
        echo "<div class=\"alert alert-danger alert-dismissable fade show\" style=\"margin-top: 10px; margin-left: 30%; width: 500px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$_SESSION['add_error']."</strong></div>  ";
        unset($_SESSION['add_error']);
      }


      if (isset($_SESSION['modify_success'])) {
        echo "<div class=\"alert alert-success alert-dismissable fade show\" style=\"margin-top: 10px; margin-left: 30%; width: 500px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$_SESSION['modify_success']."</strong></div>  ";
        unset($_SESSION['modify_success']);
      }
      if (isset($_SESSION['modify_error'])) {
        echo "<div class=\"alert alert-danger alert-dismissable fade show\" style=\"margin-top: 10px; margin-left: 30%; width: 500px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$_SESSION['modify_error']."</strong></div>  ";
        unset($_SESSION['modify_error']);
      }


      if (isset($_SESSION['delete_success'])) {
        echo "<div class=\"alert alert-success alert-dismissable fade show\" style=\"margin-top: 10px; margin-left: 30%; width: 500px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$_SESSION['delete_success']."</strong></div>  ";
        unset($_SESSION['delete_success']);
      }
      if (isset($_SESSION['delete_error'])) {
        echo "<div class=\"alert alert-danger alert-dismissable fade show\" style=\"margin-top: 10px; margin-left: 30%; width: 500px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$_SESSION['delete_error']."</strong></div>  ";
        unset($_SESSION['delete_error']);
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
          source: "php/gstin_list.php",
          minLength: 1
        });                

      });
    </script>

  </body>
  </html>