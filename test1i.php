<?php

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");


$content .= <<<END


<!-- Laddar in resultat från sidan arkiv_maj.php i DIV med id ArkivMaj -->

<script type="text/javascript">
$(document).ready(function(){
    $("#ArkivMaj").click(function(){
        $('#ArkivMajArtiklar').load('arkiv_maj.php');

    });
    
});

</script>

					<!-- kolumn höger rad 2 nyhetsarkiv -->

					<div class="panel panel-blue">
						<div class="panel-heading">
							<h3 class="panel-title">Nyhetsarkiv</h3>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<p class="divider"></p>

								<!-- Nyhetsarkiv dropdown meny inddelad i månader -->

								<div class="collapse-in" id="dokument">
								
									<ul class="list-unstyled">

          								<li class="dropdown-left">
	   									
	   									<a data-toggle="collapse" href="#juni" aria-expanded="false"
										aria-controls="collapseExample">
	   										Juni <b class="caret"></b>
	   									</a>

	   									<!-- juni -->
	   									<div class="collapse" id="juni">  									
	   										
		   										<a href="index.php?ArtikelId={$artikelid}">
													juni
												</a>
											
	   									</div>
	   									
	   								
	   									
                						<a data-toggle="collapse" href="#maj" aria-expanded="false"
										aria-controls="collapseExample" id="ArkivMaj">
										
	   										Maj <b class="caret"></b>
	   									
	   									</a>

	   									<!-- maj content -->
	   									<div class="collapse" id="maj">
	   									
	   											<div id="ArkivMajArtiklar">
	   											<a href="#">
	   												maj
	   											</a>
	   											</div>

	   									</div>
            
    

	   								</ul>
								</div><!-- collapse -->
							

						</div><!-- panel-body -->
					</div><!-- panel panel-blue-->

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