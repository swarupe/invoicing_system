<?php
include_once 'connect.php';
session_start();
$connection = openCon();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $num = $_POST['rowcount'];
  $invoice_no=$_POST['invoice_no'];
  $invoice_to=$_POST['invoice_to'];
  $invoice_date=$_POST['invoice_date'];
  $cgst=$_POST['cgst_p'];
  $sgst=$_POST['sgst_p'];
  $igst=$_POST['igst_p'];
  $total_price=$_POST['total_price'];
  $invoice_header = mysqli_query($connection,"INSERT INTO `invoice`(`Invoice_No`,`Invoice_Date`,`Invoice_To`) VALUES ('$invoice_no','$invoice_date','$invoice_to')");
  if(mysqli_affected_rows($connection) > 0 && $invoice_header){
    for($i=1; $i<=$num; $i++)
    {
      $pname = $_REQUEST["p_name$i"];
      $pdesc = $_REQUEST["p_description$i"];
      $pprice = $_REQUEST["p_base_price$i"];
      $pquantity = $_REQUEST["p_quantity$i"];
      $psubtotal = $_REQUEST["subtotal$i"];
      $sql = "INSERT INTO `invoice_items`(`Product_Name`,`Description`,`Item_Base_Price`,`Quantity`,`Subtotal`,`CGST_Price`,`SGST_Price`,`IGST_Price`,`Total_Amount`,`Invoice_No`) VALUES ('$pname','$pdesc','$pprice','$pquantity','$psubtotal','$cgst','$sgst','$igst','$total_price','$invoice_no')";
      $invoice_items = mysqli_query($connection,$sql);
      if(!$invoice_items)
      {
        break;
      } 
    }
  }
  if (mysqli_affected_rows($connection) > 0) {
    closeCon($connection);
    $_SESSION['invoice_success'] = "Invoice Created Successfully";
    header("Location: ../invoices.php");
  }
  else
  {
    closeCon($connection);
    $_SESSION['invoice_failed'] = "Invoice Could not be created";
    header("Location: ../invoices.php");
  }
}
?>

