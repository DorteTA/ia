<?php
$mysqli = new mysqli('localhost', 'root', 'Thunder14', 'konstakning'); // (HOST,  Användare, Lösenord, Databas)

if(mysqli_connect_error()) {
	echo "Connect failed: " . mysqli_connect_error() . "<br>";
	exit();
}
$mysqli->set_charset("utf8");

?>