<?php

$servername = "localhost";
$username = "southcit_southci";
$password = "god4@lfred";
$db = "southcit_work";

$con = mysqli_connect($servername, $username, $password,$db);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>