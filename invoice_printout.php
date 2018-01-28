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
  <link href="css/xeditable.css" rel="stylesheet">
  <script src="js/xeditable.js"></script>
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
      border-style: solid;
      margin-left: 2.2%;
      margin-top: 2%;
      align-items: center;
    }

    .text-color{
      color: red;
    }

    .active-background{
      background-color: #cfd8dc;
    }


    table {
      border-collapse: collapse;
      margin-left: 2%;
      width: 96%;
    }
    th {
      height: 50px;
      text-align: center;
    }
    td {
      text-align: center;
    }
    table, th, td {
      border: 1px solid black;
    }

    td input {
      border: none;
      background: transparent;
      color: black;
      text-align: center;
    }

  </style>

  <!--<script>
   /* function showInvoices(t_date) {
      var f_date = document.getElementById("f_date").value;
      if (t_date == "") {
        document.getElementById("invoice_list").innerHTML = "";
        return;
      } 
      else {
        if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } 
        else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("invoice_list").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET","php/generate_invoice_list.php?f_date="+f_date+"&t_date="+t_date,true);
        xmlhttp.send();
      }
    }*/
  </script>-->

  <script type="text/javascript">
    function PrintElem(elem)
    {
      Popup($(elem).html());
    }

    function Popup(data)
    {
      var mywindow = window.open('', 'new div', 'height=1040,width=1260');
      mywindow.document.write('<html><head><title>Print Invoice</title>');
      mywindow.document.write('<link href="css/custom_print.css" rel="stylesheet">');
      mywindow.document.write('</head><body >');
      mywindow.document.write(data);
      mywindow.document.write('</body></html>');
      return true;
    }
    function sleep(milliseconds) {
      var start = new Date().getTime();
      for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds){
          break;
        }
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
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>

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

  <h3 style="text-align: center; margin-top: 10px; margin-bottom: 20px;">Invoice Printout</h3>

  <form action="invoice_printout.php" method="GET">
    <div class="form-inline">
      <label style="margin-left: 30px;">From :</label>
      <div class = "form-group">
        <input id="f_date" style="margin-left: 5px;" placeholder = "From Date" name = "f_date" type="date" class = "form-control" value="" />
      </div>
      <label style="margin-left: 20px;">To :</label>
      <div class = "form-group">
        <input id="t_date" style="margin-left: 5px;" placeholder = "To Date" name = "t_date" type="date" class = "form-control" value="" />
      </div>
      <input style="margin-left: 10px;" class="btn" type="submit" name="submit" value="Show Invoices">
    </div>
  </form>
  <div id="invoice_list"></div>

  <?php
  $connection = openCon();
  if (isset($_GET['f_date']) && isset($_GET['t_date'])){
    $from_date = $_GET['f_date'];
    $to_date = $_GET['t_date'];
    $_SESSION['from_date'] = $from_date;
    $_SESSION['to_date'] = $to_date;
    $sql = "SELECT Invoice_No, Invoice_To, Invoice_Date FROM invoice WHERE Invoice_Date BETWEEN '$from_date' AND '$to_date'"; 
    $query = mysqli_query($connection,$sql);
    while( $row = mysqli_fetch_assoc( $query ) ) {
      $print_page = 1;
      $in_no = $row['Invoice_No'];      
      echo "<form action='' method='POST' id='invoice_form'><div class='demo-container'>";
      echo "<input id='in_no' type='hidden' name='in_no' value='$in_no'>";
      echo "<div class='form-inline'>";
      echo '<label style="margin-top: 16px; margin-left: 20px;"><strong>Invoice No : </strong>'.$row['Invoice_No'].'</label>';
      echo '<label style="margin-left: 66%; margin-top: 16px;"><strong>Invoice Date : </strong>'.$row['Invoice_Date'].'</label></div>';
      echo '<div class="form-inline">';
      echo '<label style="margin-top: 16px; margin-left: 20px;"><strong>Invoice To : </strong>'.$row['Invoice_To'].'</label>';
      echo "</div><hr style='background-color: black; height: 2px;' />";
      $invoice_item = mysqli_query($connection,"SELECT * FROM invoice_items WHERE Invoice_No = '$in_no'");
      echo "<div id='print".$print_page."'><table style='margin-bottom: 20px;'><thead><tr><th>Sl No</th><th>Product</th><th>Description</th><th>Base Price</th><th>Quantity</th><th>Subtotal</th></tr></thead><tbody>";
      $slno = 1;
      while ($items = mysqli_fetch_assoc($invoice_item)) {
        echo "<tr>";  
        echo "<td>".$slno."</td>";
        echo "<td>".$items['Product_Name']."</td>";
        echo "<td>".$items['Description']."</td>";
        echo "<td>".$items['Item_Base_Price']."</td>";
        echo "<td>".$items['Quantity']."</td>";
        echo "<td>".$items['Subtotal']."</td>";
        echo "</tr>";
        $slno++;
      }
      $result = mysqli_query($connection,"SELECT CGST_Price,SGST_Price,IGST_Price,Total_Amount FROM invoice_items WHERE Invoice_No = '$in_no'");
      $tax = mysqli_fetch_assoc($result);
      echo "<tr><td colspan='5' style='text-align: right;'><span style='margin-right: 20px; font-weight: bold;'>CGST</span></td>";
      echo "<td>".$tax['CGST_Price']."</td></tr>";
      echo "<tr><td colspan='5' style='text-align: right;'><span style='margin-right: 20px; font-weight: bold;'>SGST</span></td>";
      echo "<td>".$tax['SGST_Price']."</td></tr>";
      echo "<tr><td colspan='5' style='text-align: right;'><span style='margin-right: 20px; font-weight: bold;'>IGST</span></td>";
      echo "<td>".$tax['IGST_Price']."</td></tr>";
      echo "<tr><td colspan='5' style='text-align: right;'><span style='margin-right: 20px; font-weight: bold;'>Total</span></td>";
      echo "<td>".$tax['Total_Amount']."</td></tr>";
      echo "</tbody></table></div></div>";
      echo "<div class='form-inline'>";
      echo "<div class='form-group'><a class='btn' style='color:white; float: right; margin-left: 900px; margin-top: 20px; margin-bottom: 40px; background-color: red;' href='php/delete_invoice.php?invoice_no=".$in_no."'>Delete</a></div>";
      echo "<div class='form-group'><button class='btn btn-disabled' style='float: right; margin-left: 40px; margin-right: 50px; margin-top: 20px; margin-bottom: 40px; background-color: green;' name='in_print' onclick=\"PrintElem('#print".$print_page."')\">Print</button></div>";
      echo "</div></form>";
      $print_page++;
    }
  }
  ?>


  <?php closeCon($connection); ?>

</body>
</html>