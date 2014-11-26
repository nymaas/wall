<?php
// configuration
$dbhost 	= "localhost";
$dbname		= "wall";
$dbuser		= "root";
$dbpass		= "";
 
// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
session_start();
?>