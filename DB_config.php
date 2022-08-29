<?php
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "parole";

	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); // , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'")
	//$conn->exec("SET CHARACTER SET UTF8");
?>