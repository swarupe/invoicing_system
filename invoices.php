<?php
include("php/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
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
</head>
<body>
 <script>
  function arrangeSno() {
   var i=0;
   $('#dataTable tr').each(function() {
    $(this).find(".sNo").html(i);
    i++;
  });
 }
 $(document).ready(function(){
  $('#addButton').click(function(){
   var sno=$('#dataTable tr').length;
   $("#rowcount").val(sno);
   trow="<tr><td><button type='button' class='rButton close'><span style='margin-right: 18px; color: red;' aria-hidden='true'>&times;</span></button></td>"+
   "<td class='sNo'>"+sno+"</td>"+
   "<td><input id='p_name"+sno+"' class='auto-pname' type='text' name='p_name"+sno+"' value='' onchange='showProductDetails(this.value,\"p_desc"+sno+"\",\"base_price"+sno+"\")'></td>"+
   "<td><input id='p_desc"+sno+"' type='text' name='p_description"+sno+"' value=''></td>"+
   "<td><input id='base_price"+sno+"' type='text' name='p_base_price"+sno+"' value=''></td>"+
   "<td><input id='quantity"+sno+"' type='text' name='p_quantity"+sno+"' value='' onchange='getTotal(\"base_price"+sno+"\",\"quantity"+sno+"\",\"subtotal"+sno+"\")'></td>"+
   "<td><input id='subtotal"+sno+"'  type='text' name='subtotal"+sno+"' value=''></td></tr>" ;
   $('#dataTable').append(trow);
   $(function() {
    $(".auto-pname").autocomplete({
      source: "php/products_list.php",
      minLength: 1
    });                
  });
 });
});
 $(document).on('click', 'button.rButton', function () {
   $(this).closest('tr').remove();
   arrangeSno();
   return false;
 });

 $(function() {
  $(".auto-gstin").autocomplete({
    source: "php/gstin_list.php",
    minLength: 1
  });                
});
 
 $(function() {
  $(".auto-pname").autocomplete({
    source: "php/products_list.php",
    minLength: 1
  });                
});

 function showProductDetails(p_name, desc, b_price ) {
  productPrice(p_name,b_price);
  if (p_name == "") {
    document.getElementById(desc).value = "";
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
        document.getElementById(desc).value = this.responseText; 
      }
    };
    xmlhttp.open("GET","php/get_products_details.php?other=5&q="+p_name,true);
    xmlhttp.send();
  }
}

function productPrice(p_name,b_price) {
  if (p_name == "") {
    document.getElementById(b_price).value = "";
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
        document.getElementById(b_price).value = this.responseText; 
      }
    };
    xmlhttp.open("GET","php/get_products_details.php?price=5&q="+p_name,true);
    xmlhttp.send();
  }
}


function getSubtotal(b_price, quantity, subtotal) {
  var theForm = document.forms["invoice_form"];
  var base_price = theForm.elements[b_price];
  var b_price;
  var quantity = theForm.elements[quantity];
  var howmany = 0;
  var subtotal = theForm.elements[subtotal];
  var subprice = 0;
  if(base_price.value!="")
  {
    b_price = parseInt(base_price.value);
  }
  if(quantity.value!="")
  {
    howmany = parseInt(quantity.value);
  }
  if(base_price.value!="" && quantity.value!=""){
    subprice = howmany * b_price;
  }
  subtotal.value = subprice;
}

function calculateTax(sum) {
  var theForm = document.forms["invoice_form"];
  var t_cgst = theForm.elements["t_cgst"].value;
  var t_sgst = theForm.elements["t_sgst"].value;
  var t_igst = theForm.elements["t_igst"].value;
  var cgst = (sum * t_cgst)/100;
  var sgst = (sum * t_sgst)/100;
  var igst = (sum * t_igst)/100;
  theForm.elements["cgst_p"].value = cgst;
  theForm.elements["sgst_p"].value = sgst;
  theForm.elements["igst_p"].value = igst;
  return(cgst+sgst+igst);
}

function getTotal(b_price, quantity, subtotal)
{
  getSubtotal(b_price, quantity, subtotal);
  var sum = 0;
  $("input[id*='subtotal']").each(function(){
    sum += +$(this).val();
  });
  var productPrice = sum + calculateTax(sum);
  document.forms["invoice_form"].elements["total_price"].value = productPrice; 
}


</script>

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
    <a class="nav-link" style="color: black;" href="products.php">Products</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active-background" style="color: gray;">Invoice</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" style="color: black;" href="reports.php">Reports</a>
  </li>
</ul>
<form action="php/invoice_submit.php" method="POST" id="invoice_form">
  <div class="demo-container">
    <div class="form-inline">
      <label style="margin-top: 16px; margin-left: 20px;">Invoice No :</label>
      <div class = "form-group">
        <input style="margin-left: 10px; margin-top: 20px;" placeholder = "Enter Invoice No" name = "invoice_no" class = "form-control" value="" />
      </div>
      <label style="margin-left: 44%; margin-top: 16px;">Invoice Date :</label>
      <div class = "form-group">
        <input style="margin-left: 10px; margin-top: 20px;" name = "invoice_date" class = "form-control" value="<?php echo date('d/m/Y h:i a', time()); ?>" />
      </div>        
    </div>
    <div class="form-inline">
      <label style="margin-top: 16px; margin-left: 20px;">Invoice To :</label>
      <div class="form-group">
        <input style="margin-left: 13px; margin-top: 20px;" placeholder="Enter Customer GSTIN" name="invoice_to" class="form-control auto-gstin" value="" />
      </div>        
    </div>
    <hr style="background-color: black; height: 2px;" />

    <table id="dataTable">
      <thead>
        <tr>
          <th>Action</th>
          <th>Sl No</th>
          <th>Product</th>
          <th>Description</th>
          <th>Base Price</th>
          <th>Quantity</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><button type="button" class="rButton close" aria-label="Close"><span style="margin-right: 18px; color: red;" aria-hidden="true">&times;</span></button></td>
          <td class="sNo">1</td>
          <td><input id="p_name1" class="auto-pname" type="text" name="p_name1" value="" onchange="showProductDetails(this.value, 'p_desc1','base_price1')"></td>
          <td><input id="p_desc1" type="text" name="p_description1" value=""></td>
          <td><input id="base_price1" type="text" name="p_base_price1" value=""></td>
          <td><input id="quantity1" type="text" name="p_quantity1" value="" onchange="getTotal('base_price1','quantity1','subtotal1')"></td>
          <td><input id="subtotal1" type="text" name="subtotal1" value=""></td>
        </tr>
      </tbody>
    </table>
    <?php $connection = openCon(); 
    $query = mysqli_query($connection, "SELECT * FROM tax"); 
    $row = mysqli_fetch_assoc($query);
    ?>
    <table style="width:96%;">

      <tbody>
        <tr style="height: 50px;">
          <td style="width: 81.75%; text-align: right;"><input type="hidden" id="t_cgst" value="<?php echo $row['CGST']; ?>"><span style="margin-right: 20px; font-weight: bold;">CGST</span></td>
          <td style="width: 18.25%;"><input id="cgst_p" type="text" name="cgst_p"></td>
        </tr>
        <tr style="height: 50px;">
          <td style="text-align: right;"><input type="hidden" id="t_sgst" value="<?php echo $row['SGST']; ?>"><span style="margin-right: 20px; font-weight: bold;">SGST</span></td>
          <td><input id="sgst_p" type="text" name="sgst_p"></td>
        </tr>
        <tr style="height: 50px;">
          <td style="text-align: right;"><input type="hidden" id="t_igst" value="<?php echo $row['IGST']; ?>"><span style="margin-right: 20px; font-weight: bold;">IGST</span></td>
          <td><input id="igst_p" type="text" name="igst_p"></td>
        </tr>
        <tr style="height: 50px;">
          <td style="text-align: right;"><input type="hidden" id="rowcount" name="rowcount" value="1"><span style="margin-right: 20px; font-weight: bold;">Total</span></td>
          <td><input id="total_price" type="text" name="total_price"></td>
        </tr>
      </tbody>
    </table>
    <input style="margin: 15px 20px 10px 23px; background-color: #43a047;" class="btn" id="addButton" type="button" value="Add Items"/>
  </div>

  <?php
  if (isset($_SESSION['invoice_success'])) {
    echo "<div class=\"alert alert-success alert-dismissable fade show\" style=\"margin-top: 10px; margin-left: 30%; width: 500px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$_SESSION['invoice_success']."</strong></div>  ";
    unset($_SESSION['invoice_success']);
  }
  if (isset($_SESSION['invoice_failed'])) {
    echo "<div class=\"alert alert-danger alert-dismissable fade show\" style=\"margin-top: 10px; margin-left: 30%; width: 500px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$_SESSION['invoice_failed']."</strong></div>  ";
    unset($_SESSION['invoice_failed']);
  }
  ?>


  <div class="form-group">
    <input class="btn" style="float: right; margin-right: 125px; margin-top: 20px; margin-bottom: 60px; background-color: green;" type="submit" name="in_submit" value="Submit">
  </div>
</form>


</body>
</html>