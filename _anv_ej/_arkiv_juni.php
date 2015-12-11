<?php
/*---------------------------------
arkiv_juni.php
Start page with welcome
The first page the visitor sees
---------------------------------*/

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");

//Variabler

$juni ="";


$query = <<<END

	SELECT *
	FROM artikel
	WHERE kategori = 'nyhet'
	ORDER BY artikeltimestamp DESC;
END;

$res = $mysqli->query($query) or die();

//Sätter tidszonen till europäisk/svensk tidszon
date_default_timezone_set("Europe/Stockholm");


// Hämtar ut artiklar från juni månad
$query = <<<END

	SELECT * FROM artikel
	WHERE ArtikelTimeStamp LIKE '%2015-06%'
	ORDER BY ArtikelTimeStamp DESC;

END;

$res = $mysqli->query($query) or die();

//Sätter tidszonen till europäisk/svensk tidszon
date_default_timezone_set("Europe/Stockholm");


if($res->num_rows > 0)
{
	//Loops through results
	while($row = $res->fetch_object())
	{
		//Sätter tid till svenska
		setlocale(LC_TIME, "sv_SE", "sv_SE.65001", "swedish");   
		$date = strtotime($row->ArtikelTimeStamp);

		
		//encode gör att datum från DB visas med svenska tecken
		utf8_encode($date = strftime("%#d %B", $date));
		
		$artikelid = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$artikelsubtext = substr($artikelname, 0, 24);
		$artikeltimestamp = $row->ArtikelTimeStamp;
	
		
		$juni .= <<<END

		
				
          			<div class="col-md-12 sans-padding-right">			
          				
						<p class="pull-left tid-nyheter-arkiv sans-padding-left">{$date}</p>
							<a href="index.php?ArtikelId={$artikelid}">
								<p>{$artikelsubtext} ...</p>
							</a>
						
					</div>
								
	

END;
	}
}

if(!empty($_GET))
{
	$getartikelid = isset($_GET['ArtikelId']) ? $_GET['ArtikelId'] : '';

		$query = <<<END

		SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelPic, ArtikelPicThumb, ArtikelTimeStamp
		FROM artikel
		WHERE ArtikelId = "{$getartikelid}"
		ORDER by ArtikelTimeStamp DESC;
END;




	$res = $mysqli->query($query) or die();

	if($res->num_rows == 1)
	{
		while($row = $res->fetch_object())
		{
			$artikelname = $row->ArtikelName;

			
		}

	}
	
}


$content = <<<END

			
       	<div id="content">
			<div class="row">
				<div class="col-md-3">
											
				</div><!-- col-md-3 -->
				
				<div class="col-xs-12 col-md-6">
					
								
				</div><!-- mitten -->	
							
				<!-- Rad högre m sponsorkarusell-->
				<div class="col-md-3 pull-right">

					
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
													{$juni}
												</a>
		   										
											
	   									</div>	   														
	   								</ul>
								</div><!-- collapse -->
							

						</div><!-- panel-body -->
					</div><!-- panel panel-blue-->												
				</div><!-- col-xs-6 col-md-3 -->
			</div> <!-- row -->
       </div><!-- AVsluta content DIV -->

END;

//Stänger resultaten
$res->close();

//Stänger ned uppkoblingen med databasen
$mysqli->close();

//Visar innehållet av sidans header, content och footer
echo $header;
echo $content;
echo $footer;

?>
