<?php
session_start();

require "init.php";

$basicInfo = $coin->GetBasicProfile();
$username = $basicInfo['result']['public_name'];

$amount = $_SESSION['total_final'];
$email = $_POST['email'];

$scurrency = "NGN";
$rcurrency = "BTC";

$request = [
    'amount' => $amount,
    'currency1' => $scurrency,
    'currency2' => $rcurrency,
    'buyer_email' => $email,
    'item' => "Southcity Pharmacy",
    'address' => "",
    'ipn_url' => "https://southcitypharmacy.ng/checkout/webhook.php"
];

$result = $coin->CreateTransaction($request);
$resultamount = $result['result']['amount'];
$gatewayid = $result['result']['txn_id'];
$gatewayurl = $result['result']['status_url'];
if ($result['error'] == "ok") {
   
    		
    $sql = "INSERT INTO `payments`(`from_currency`, `entered_amount`, `to_currency`, `amount`, `gateway_id`, `gateway_url`, `status`) 
    VALUES ('$scurrency','$amount','$rcurrency','$resultamount','$gatewayid','$gatewayurl','initialized')";
    $run_query = mysqli_query($con,$sql);

} else {
    print 'Error: ' . $result['error'] . "\n";
    die();
} ?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title>Accept Cryptocurrency</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/particles.min.js"></script>
    <style>
        canvas {
            background-image: url("http://southcitypharmacy.ng/checkout/images/bg.jpeg");
            background-repeat: no-repeat;
            background-size: 100% 100%;
            position: fixed;
            display: block;
            top: 0;
            left: 0;
            z-index: 0;
        }
    </style>
    <script>
        particlesJS.load("particles-js", "json/particles.json", function() {
            console.log("particles loaded");
        });
    </script>
</head>
<body>
    <div id="particles-js"></div>
    <br><br><br>
    <div id="app" class="container">
        <div class="row row-centered">
            <div class="col-xs-12 col-md-6 offset-md-3" style="margin:auto; background: white; padding: 20px;">
                <div class="panel-heading">
                    <h1>Pay with cryptocurrency</h1>
                    <p style="font-style: italic;">to <strong><?php echo $username; ?></strong></p>
                </div>
                <hr>
                <form>
                    <label for="amount">Amount (<?php echo $rcurrency; ?>)</label>
                    <h1><?php echo $result['result']['amount'] ?> <?php echo $rcurrency ?></h1>
                    <hr>
                    <a href="<?php echo $result['result']['status_url'] ?>" class="btn btn-success btn-block">Pay Now</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
