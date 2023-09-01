<?php

$serverName = 'localhost';
$dbUserName = 'root';
$dbPassword = '';
$dbName = 'counseling';
 
// $serverName = '136.145.29.193';
// $dbUserName = 'chrtirmo';
// $dbPassword = 'chrtirmo840$cuta';
// $dbName = 'chrtirmo_db';

$conn = new mysqli($serverName, $dbUserName, $dbPassword, $dbName)  
or die('Connection was unsuccessful');

//echo 'successful connection to database';
?>