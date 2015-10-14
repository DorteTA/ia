<?php

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");


$content .= <<<END

<body>
<!-- Laddar in resultat från sidan arkiv_maj.php i DIV med id ArkivMaj -->

<script type="text/javascript">
$(document).ready(function(){
    $("#ArkivMaj").click(function(){
        $('#ArkivMajArtiklar').load('arkiv_maj.php');

    });
    
});

</script>
    <div id="document">
        
            <div id="ArkivMaj">
                <a data-toggle="collapse" href="#maj_maanad" aria-expanded="false"
                aria-controls="collapseExample">
                   Maj <b class="caret"></b></a>
            </div>
                
            <div id="ArkivMajArtiklar" class="collapse">

                <a data-toggle="collapse" href="arkiv_maj.php" data-target="#ArkivMajArtiklar" aria-expanded="false"
                aria-controls="collapseExample">
                

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

echo $content;
?>
