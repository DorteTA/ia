<?php

$header = <<<END

<html>
<head>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>

END;

$content = <<<END

<body>

<!-- Laddar in resultat från sidan test2.php i DIV med id DisplayDiv -->
<script type="text/javascript">
    function loadArkivMaj() {
    $('#DisplayDiv').load('test2.php');
    return false;
}

</script>
    <div id="page">
        <form id="SubmitForm" method="post">
            <div id="SubmitDiv" style="background-color:black; color:yellow;">
                <button type="submit" form="QueryForm" onclick="return loadArkivMaj();">Submit Query</button>
            </div>
        </form>
        <div id="DisplayDiv" style="background-color:red;">
            <!-- This is where test2.php should be inserted -->
        </div>
    </div>

</body>
END;

echo $header;
echo $content;
?>
