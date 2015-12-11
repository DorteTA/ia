<?php

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");


$content .= <<<END

<body>
<!-- Laddar in resultat från sidan arkiv_maj.php i DIV med id ArkivMaj -->

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
										aria-controls="collapseExample">
	   										<a href="arkiv_maj.php" data-toggle="collapse" data-target="#maj_arkiv"
	   									aria-expanded="false"
										aria-controls="collapseExample">Maj <b class="caret"></b>
	   									</a>

	   									<div class="collapse" id="maj">

	   									<div class="collapse" id="maj_arkiv">
	   										Maj
	   									</div>
										
										</div>

	   									<!-- juni -->
	   									

	   									

	   									
											
											
										
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