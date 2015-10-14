<?php

$hello = "Hello World.";

$header = <<<END


<html>
<head>
<meta charset="utf-8">
</head>
END;

$content = <<<END
<body>
    <div id="maj">
        {$hello}
    </div>
</body>
</html>

END;

echo $content;

?>