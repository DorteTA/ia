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
$(document).ready(function(){
    $("#SubmitDiv").click(function(){
        $('#DisplayDiv').load('test2.php');
    });
    
});

$(document).ready(function(){
    $("#SubmitDivApril").click(function(){
        $('#DisplayDivApril').load('test3.php');
    });
    
});

</script>
    <div id="maj">
        
            <div id="SubmitDiv">
                <a href="#">Maj</a>
            </div>
        
            <div id="DisplayDiv">
            <!-- This is where test2.php should be inserted -->

            </div>
    </div>

    <div id="april">
        
            <div id="SubmitDivApril">
                <a href="#">April</a>
            </div>
        
            <div id="DisplayDivApril">
            <!-- This is where test3.php should be inserted -->
            
            </div>
    </div>

</HTML>
</body>
END;

/*
$(document).ready(function(){
  $("#contact").click(function(){
    $("#contents").load('url to home.php');
  });
});
*/
echo $header;
echo $content;
?>
