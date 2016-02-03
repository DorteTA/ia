<?php
/*---------------------------------------------------
logout.php
Utlogningssidan där användaren kan logga ut.
---------------------------------------------------*/

session_start();

$_SESSION = array();

session_unset();
session_destroy();

// Skickar användaren till index-sidan efter utloggning
header("Location: index.php");
?>