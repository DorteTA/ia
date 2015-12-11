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
<!-- Laddar in resultat från sidan arkiv_maj.php i DIV med id ArkivMaj -->

<script type="text/javascript">
$(document).ready(function(){
    $("#ArkivMaj").click(function(){
        $(this).load('arkiv_maj.php');

    });
    
});

</script>
    <div id="document">
        
            <div id="ArkivMaj">
                <a data-toggle="collapse" href="#maj_maanad" aria-expanded="false"
                aria-controls="collapseExample">
                   Maj <b class="caret"></b>
                   </a>
                
            <!-- This is where test2.php should be inserted -->

                
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
