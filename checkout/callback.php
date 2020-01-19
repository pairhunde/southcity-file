<?php
session_start();
include "../db.php";

$curl = curl_init();
$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if(!$reference){
  die('No reference supplied');
}

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization: Bearer sk_test_f23900d32e93670e76512bcfe4e8e5fbb4af2021",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
    // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response);

if(!$tranx->status){
  // there was an error from the API
  die('API returned error: ' . $tranx->message);
}

if('success' == $tranx->data->status){
  // transaction was successful...
  // please check other things like whether you already gave value for this ref
  // if the email matches the customer who owns the product etc
  // Give value
  $user = $_SESSION["guest_uid"];
		mysqli_query($con,"update order_list set paid='1' where user_id='$user'");
		
		$uid=mysqli_insert_id($con);
		// send email
			$subject = "Your Order was successful";
			$message = "
				<html>
				<head>
				</head>
				<body>
				<header>
			    <div class='container main-menu'>
			    	<div class='row align-items-center justify-content-between d-flex'>
				<div id='logo'>
				<span style='font-family:OCR A; font-size:25px; color:black'><img src='https://southcitypharmacy.ng/scp.png'>
				<hr>
					</div>	
					</div>
				</div>
				</header>
				<div class='section-top-border'>
						<div class='row height align-items-center justify-content-center'>
							<div class='col-lg-4 col-md-4'>
					<blockquote class='generic-blockquote'>
					<p style='font-family:OCR A; font-size:14px; color:black'>You have successfully order products from our online store<br> you will be contacted by our respresentative immediately.</p>
					<p style='font-family:OCR A; font-size:14px; color:black'>Kindly contact our support if you have over needs</p>
					<br>
					<p style='font-family:OCR A; font-size:14px; color:black'><strong>Customer service line:</strong> +234 0815 5479698+2348077403689<br><strong>Email:</strong> support@southcitypharmacy.com</p>
					<hr>
					</blockquote>
					<br>
                    <p style='font-family:tahoma; font-size:14px; text-align:left;' >Kind regards<br><b> South City Pharmacy</b></p>
							</div>
						</div>
				</div>
				<br>
				<br>
				<footer>
				<hr>
				<div class='col-lg-3  col-md-12'>
                        
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					<p class='col-lg-8 col-sm-12 footer-text m-0 text-white' style='font-family:OCR A; font-size:13px; color:black'>&copy; <script>document.write(new Date().getFullYear());</script> All rights reserved |South City Pharmacies</p>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						   
                        </div>
                    </div>
				</footer>
				</body>
				</html>
				";
			//dont forget to include content-type on header if your sending html
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "From: noreply@southcitypharmacy.com". "\r\n" ;
        $to = $_SESSION['email'];
		mail($to,$subject,$message,$headers);
		
		header('location:success.html');
}
?>