<?php

/*----------------------------------------
gb-edit.php
Redigerar kommentarer i gästboken
----------------------------------------*/

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$adminId = isset($_SESSION["userId"]) ? $_SESSION["userId"] : "NULL" ;

$artikelId = isset($_GET['ArtikelId']) ? $_GET['ArtikelId'] : '';


$updated = isset($_POST['artikelmessage']) ? $_POST['msg'] : '';

if(isset($_POST['msg'])) {

	$query = <<<END
	UPDATE artikel
	SET artikelMessage = '$updated'
	WHERE ArtikelId = $ArtikelId
END;
	
	$res = $mysqli->query($query) or die("Failed.");
	}

	$query = <<<END
	SELECT * FROM artikel
	WHERE ArtikelId = $ArtikelId
END;
	
$res = $mysqli->query($query);

while($row = $res->fetch_object()){
	$artikelname = $row->ArtikelName;
	$artikelmessage = 	$row->ArtikelMessage;
	$date = $row->postTimestamp;
	
	$postContent = <<<END
	<p>
	Skriven av: {$name} <br>
	Besked: {$msg} <br>
	{$date}
	</p>
END;
	}

$content = <<<END
<form action="gb-edit.php?id={$ArtikelId}" method="post">
	<label for="msg">Redigera post: </label>
	<textarea id="msg" name="msg">{$msg}</textarea>
	<input type="submit" value="Skicka">
</form>
END;

echo $header;
echo $content;
echo $footer;

?>