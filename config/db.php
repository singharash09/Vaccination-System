<?php

include_once 'templates/header.php';

$dbServerName = "sjc353.encs.concordia.ca";
$dbUsername = "sjc353_1";
$dbPassword = "sec353CC";
$dbName = "sjc353_1";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}