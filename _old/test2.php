<?php

// Uppkoblingen till databasen
include_once("Connstring.php");

// Använder HTML-mallen där CSS och javascript ingår,
// så detta inte behövs tastas in på varje sida
include_once("HTMLTemplate.php");
include_once("inc/Arkiv.php");

$content = <<<END

<!DOCTYPE html>
<html>
<body>

<h1>Welcome to my home page!</h1>
<p>$visa_artiklar</p>

</body>
</html>
END;

 echo $content;
?>