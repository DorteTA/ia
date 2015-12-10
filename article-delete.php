<?php

/*----------------------------------------
gb-delete.php
Tar bort kommentarer i gästboken
----------------------------------------*/

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$artikelId = isset($_GET['id']) ? $_GET['id'] : '';



$query = <<<END
DELETE FROM artikel
WHERE artikelId = $artikelId
END;

$res = $mysqli->query($query) or die("Failure.");

header("Location: index.php");

?>