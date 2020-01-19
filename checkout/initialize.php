<?php
session_start();

$curl = curl_init();


$intamount = intval($_SESSION['total_final']);
$email = $_SESSION['id'];
$amount = $intamount * 100;  //the amount in kobo. This value is actually NGN 300

// url to go to after payment
$callback_url = 'https://southcitypharmacy.ng/checkout/callback.php';  

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'email'=>$email,
    'callback_url' => $callback_url
  ]),
  CURLOPT_HTTPHEADER => [
    "authorization: Bearer sk_live_83a9483efbee3d37c043b9946f17f1352566cc34", //replace this with your own test key
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
  // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response, true);


// comment out this line if you want to redirect the user to the payment page
//print_r($tranx['data']['authorization_url']);
// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
header('Location: ' . $tranx['data']['authorization_url']);
?>
