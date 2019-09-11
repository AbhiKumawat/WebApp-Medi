<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);

$dbname = "calendar";
$dbuser = "awsuser"; 
$dbpass = "rdspassword"; 
$dbhost01 = "rdsinstance.cm1qivy6ib7b.us-east-2.rds.amazonaws.com"; // did not use http or https; info provided from AWS
$dbport = 3306;

$bdd = new PDO("mysql:host=$dbhost01;dbname=$dbname", $dbuser, $dbpass);
?>
