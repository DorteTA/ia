<?php

$hello = "April Månad";

$header = <<<END


<html>
<head>
<meta charset="utf-8">
</head>
END;

$content = <<<END
<body>
    <div id="april">
        {$hello}
    </div>
</body>
</html>

END;

echo $content;

?>