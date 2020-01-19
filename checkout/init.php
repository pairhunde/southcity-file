<?php

require "coin.php";
require "vendor/autoload.php";


$servername = "localhost";
$username = "southcit_southci";
$password = "god4@lfred";
$db = "southcit_work";

$con = mysqli_connect($servername, $username, $password,$db);

$coin = new CoinPaymentsAPI();

$coin->Setup("895C04568eFC905149356DAAbb93bFbAb1d9E7E19c317344043D953e015c4A32","f2846bf430839e4b64effa335a4eecfb99486035b2f355bdf8214409da5bdb10");

?>