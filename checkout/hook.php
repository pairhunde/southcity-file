<?php
  
  require "init.php";

$merchant_id = "0a9a6957a883ef530949c67934408ce8";
$ipn_secret = "asdfghjkl";
$debug_email = "houseofintellects@gmail.com";

  $txn_id = $_POST['txn_id'];


$sql= "SELECT * FROM payments WHERE `gateway_id` = '$txn_id'";
$run_query = mysqli_query($con,$sql);
while($payment = mysqli_fetch_array($run_query)){
  $order_currency = $payment['to_currency']; //BTC
  $order_total = $payment['amount'];  
}


  $sql = "INSERT INTO `payments`(`from_currency`, `entered_amount`, `to_currency`, `amount`, `gateway_id`, `gateway_url`, `status`) 
  VALUES ('$order_currency','$order_total','$order_currency','$order_total','$txn_id','dvsvdsnbvdsnbd','initialized')";
  $run_query = mysqli_query($con,$sql);

?>
