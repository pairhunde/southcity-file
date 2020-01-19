<?php

require "init.php";

$merchant_id = "	fdf2dcc24b266ed087a62bddef2184ac";
$ipn_secret = "asdfghjkl";
$debug_email = "houseofintellects@gmail.com";


$txn_id = $_POST['txn_id'];

$sql= "SELECT * FROM payments WHERE `gateway_id` = '$txn_id'";
$run_query = mysqli_query($con,$sql);
while($payment = mysqli_fetch_array($run_query)){
  $order_currency = $payment['to_currency']; //BTC
  $order_total = $payment['amount'];  
}



function edie($error_msg)
{
    global $debug_email;
    $report =  "ERROR : " . $error_msg . "\n\n";
    $report.= "POST DATA\n\n";
    foreach ($_POST as $key => $value) {
        $report .= "|$k| = |$v| \n";
    }
    mail($debug_email, "Payment Error", $report);
    die($error_msg);
}

if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
    edie("IPN Mode is not HMAC");
}

if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
    edie("No HMAC Signature Sent.");
}

$request = file_get_contents('php://input');
if ($request === false || empty($request)) {
    edie("Error in reading Post Data");
}

if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($merchant_id)) {
    edie("No or incorrect merchant id.");
}

$hmac =  hash_hmac("sha512", $request, trim($ipn_secret));
if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
    edie("HMAC signature does not match.");
}

$amount1 = floatval($_POST['amount1']); //IN USD
$amount2 = floatval($_POST['amount2']); //IN BTC
$currency1 = $_POST['currency1']; //USD
$currency2 = $_POST['currency2']; //BTC
$status = intval($_POST['status']);


if ($currency2 != $order_currency) {
    edie("Currency Mismatch");
}

if ($amount2 < $order_total) {
    edie("Amount is lesser than order total");
}

if ($status >= 100 || $status == 2) {
    // Payment is complete
    $stat = "UPDATE `payments` SET `status`= 'success' WHERE `gateway_id`= '$txn_id'";
    $run = mysqli_query($con,$stat);
} else if ($status < 0) {
    // Payment Error
    $stat = "UPDATE `payments` SET `status`= 'error' WHERE `gateway_id`= '$txn_id'";
    $run = mysqli_query($con,$stat);
} else {
    // Payment Pending
    $stat = "UPDATE `payments` SET `status`= 'pending' WHERE `gateway_id`= '$txn_id'";
    $run = mysqli_query($con,$stat);
}
die("IPN OK");
?>