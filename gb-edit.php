<?php

/*----------------------------------------
gb-edit.php
Redigerar kommentarer i gästboken
----------------------------------------*/

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$userId = isset($_SESSION["userId"]) ? $_SESSION["userId"] : "NULL" ;

$postId = isset($_GET['id']) ? $_GET['id'] : '';


$updated = isset($_POST['msg']) ? $_POST['msg'] : '';

if(isset($_POST['msg'])) {

	$query = <<<END
	UPDATE post
	SET postMessage = '$updated'
	WHERE postId = $postId
END;
	
	$res = $mysqli->query($query) or die("Failed.");
	}

	$query = <<<END
	SELECT * FROM artikel
	WHERE artikelId = $artikelId
END;
	
$res = $mysqli->query($query);

while($row = $res->fetch_object()){
	$name = $row->postName;
	$msg = 	$row->postMessage;
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
<form action="gb-edit.php?id={$postId}" method="post">
	<label for="msg">Redigera post: </label>
	<textarea id="msg" name="msg">{$msg}</textarea>
	<input type="submit" value="Skicka">
</form>
END;

echo $header;
echo $content;
echo $footer;

?>