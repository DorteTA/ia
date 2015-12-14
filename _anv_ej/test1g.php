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
        
        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Link with href
</a>
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Button with data-target
</button>
<div class="collapse" id="collapseExample">
  <div class="well">
    ...
  </div>
</div>

            <div id="ArkivMaj">
                                            <a data-toggle="collapse" data-target="#ArkivMajArtiklar" href="#maj_maanad" aria-expanded="false"
                                            aria-controls="collapseExample">
                                            

                                            Maj <b class="caret"></b>
                                            </a>
                                        </div>
                
                                        <div class="collapse" id="maj_maanad" data-target="#ArkivMajArtiklar">

                                            <div id="ArkivMajArtiklar" class="collapse">

                                                <!-- This is where test2.php should be inserted -->

                                            </div>
                                        </div>
            
    </div>

   

END;

// data-target="#ArkivMajArtiklar"

/*
$(document).ready(function(){
  $("#contact").click(function(){
    $("#contents").load('url to home.php');
  });
});
*/

echo $content;
?>
