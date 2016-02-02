<?php

/*---------------------------------
Connstring.php
Uppkobling till databasen
---------------------------------*/

// (HOST,  Användare, Lösenord, Databasnamn)
$mysqli = new mysqli('localhost', 'root', '', 'konstakning');

// Vid fel till uppkobling visas detta samt felnummer och uppkobling avbrytas
if(mysqli_connect_error()) {
	echo "Connect failed: " . mysqli_connect_error() . "<br>";
	exit();
}

// Visar svenska tecken
$mysqli->set_charset("utf8");

?>