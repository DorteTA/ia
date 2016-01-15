<?php
/*---------------------------------
index.php
Startsidan
---------------------------------*/

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");

// Variabler
$artikelpic = "";
$artikelpic_thumb = "";
$artikelskribent = "";
$artikelnews = "";
$artikelfotograf = "";

//Kollar om användaren är inloggat och lägger in namnet i variablen $name
if(isset($_SESSION['username'])) {
	$name = $_SESSION['username'];
}

$query = <<<END

	SELECT *
	FROM artikel
	WHERE kategori = 'nyhet'
	ORDER BY artikelTimestamp DESC;
END;

// Ger felmeddelande om databasen inte kan köras och hänvisar till felnummer, annars körs den
$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);	

// Sätter tidszonen till europäisk/svensk tidszon
date_default_timezone_set("Europe/Stockholm");


if($res->num_rows > 0) {

	//Loops through results
	while($row = $res->fetch_object()) {

		// Sätter tid till svenska
		setlocale(LC_TIME, "sv_SE", "sv_SE.65001", "swedish");   
		$date = strtotime($row->ArtikelTimeStamp);

		//encode gör att datum från DB visas på svenska
		utf8_encode($date = strftime("%#d %B %Y", $date));
		
		$artikelid = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$artikelmessage = $row->ArtikelMessage;
		$artikelsubtext = substr($artikelmessage, 0, 75);
		$artikelpic = $row->ArtikelPic;
		$artikelpic_thumb = $row->ArtikelPicThumb;
		$artikeltimestamp = $row->ArtikelTimeStamp;
		$artikelskribent = $row->ArtikelSkribent;
		$artikelfotograf = $row->ArtikelFotograf;
		
		// Visar innehållet från databasen i strängen $artikelnews
		$artikelnews .= <<<END
		
						<div class="panel-body">
							<div class="media">
								<a class="pull-left" href="index.php?ArtikelId={$artikelid}">
									{$artikelpic_thumb}
								</a>
								
								<div class="tid-nyheter">
									{$date}
								</div>
								
								<div class="media-body">
									<h4 class="media-heading">
										<a href="index.php?ArtikelId={$artikelid}">
											{$artikelname}
										</a>
									</h4>
									{$artikelsubtext} ...

								</div><!-- media body -->
							</div><!-- media -->	
						</div><!-- panel-body -->
END;
	}
}

if(!empty($_GET)) {

	$getartikelid = isset($_GET['ArtikelId']) ? $_GET['ArtikelId'] : '';

		$query = <<<END

		SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelPic, ArtikelPicThumb, ArtikelTimeStamp,
		 ArtikelSkribent, ArtikelFotograf
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
			$artikelmessage = $row->ArtikelMessage;
			$artikelpic = $row->ArtikelPic;
			$artikelpic_thumb = $row->ArtikelPicThumb;
			$artikeltimestamp = $row->ArtikelTimeStamp;
			$artikelname = $row->ArtikelName;
			$artikelskribent= $row->ArtikelSkribent;
			$artikelfotograf = $row->ArtikelFotograf;		
		}

	}
	
}


if(!empty($_GET))
{
	$getartikelid = isset($_GET['ArtikelId']) ? $_GET['ArtikelId'] : '';

		$query = <<<END

		SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelPic, ArtikelPicThumb, ArtikelTimeStamp, ArtikelSkribent,
		 ArtikelFotograf
		FROM artikel
		WHERE ArtikelId = "{$getartikelid}"
		ORDER by ArtikelTimeStamp DESC;
END;

	$res = $mysqli->query($query) or die();

	if($res->num_rows == 1)
	{
		while($row = $res->fetch_object())
		{
			$date = strtotime($row->ArtikelTimeStamp);
		
			// encode gör att datum från DB visas med svenska tecken
			utf8_encode($date = strftime("%#d %B %Y", $date));
			
			$artikelname = $row->ArtikelName;
			$artikelskribent = $row->ArtikelSkribent;
			$artikelfotograf = $row->ArtikelFotograf;

		}

	}
	
}		


$content = <<<END

<div id="content">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-blue">
				<div class="panel-heading">
					<h3 class="panel-title">Nyheter Juni</h3>
				</div><!-- panel-heading -->
				{$artikelnews}
			</div><!-- panel panel blue -->								
		</div><!-- col md 3 -->
				
		<div class="col-xs-12 col-md-6">
			<div class="panel panel-yellow">

				<!-- Rubrik -->
				<div class="panel-heading">
					<h3 class="panel-title">{$artikelname}</h3>
				</div><!-- panel heading -->

				<!-- Artikel -->		
				<div class="panel-body">

					<!-- Artikelbild -->
					<div class="col-lg-12 col-md-12 center-block img-responsive img-rounded sans-padding img-artikel pull-left">
					{$artikelpic}
					</div>
					
					<!-- Div som innehåller skribentnamn och fotografnamn -->
					<div class="col-lg-12 sans-padding pull-left">
						
						<p class="col-md-6 sans-padding-left text-muted text-left pull-left">
						Publicerad: {$date} av <i>{$artikelskribent}</i> 
						</p>

						<p class="col-md-6 text-muted text-right sans-padding-right pull-right">
						{$artikelfotograf}
						</p>
					
					</div>

					<!-- Själva artikeln -->			
						{$artikelmessage}

				</div><!-- panel body -->
			</div><!-- panel panel yellow -->
								
		</div><!-- col xs 12 col md 6 -->	
							
		<!-- Rad högre m sponsorkarusell-->

		{$sponsorer}

			<!-- kolumn höger rad 2 nyhetsarkiv -->

			<div class="panel panel-blue">
				<div class="panel-heading">
					<h3 class="panel-title">Nyhetsarkiv 2015</h3>
				</div><!-- panel-heading -->
				<div class="panel-body">
					<p class="divider"></p>
	
					<!-- Nyhetsarkiv dropdown meny inddelad i månader -->

					<div class="collapse-in" id="dokument">
						<ul class="list-unstyled">
          					<li class="dropdown-left">
					
								<!-- juni -->

	   							<a data-toggle="collapse" href="#juni" aria-expanded="false"
								aria-controls="collapseExample" id="ArkivJuni">
		   							Juni <b class="caret"></b>
	   							</a>
								
								<!-- juni innehåll -->
	   							
	   							<div class="collapse" id="juni">	
	   							
	   								<div id="ArkivJuniArtiklar" class="collapse-in">
	   								
	   								<!-- arkiv juni laddas in här -->
	   								
  									</div><!-- juni -->
  								</div><!-- juni innehåll -->
	   							
	   							<!-- maj -->

	   							<a data-toggle="collapse" href="#maj" aria-expanded="false"
								aria-controls="collapseExample" id="ArkivMaj">
		   							Maj <b class="caret"></b>
	   							</a>
								
								<!-- maj innehåll -->
	   							
	   							<div class="collapse" id="maj">	
	   							
	   								<div id="ArkivMajArtiklar" class="collapse-in">
	   								
	   								<!-- arkiv maj laddas in här -->
	   								
  									</div><!-- ArkivMajArtiklar -->
  								</div><!-- collapse maj -->

  								<!-- april -->

  								<a data-toggle="collapse" href="#april" aria-expanded="false"
								aria-controls="collapseExample" id="ArkivApril">
		   							April <b class="caret"></b>
	   							</a>
								
								<!-- april innehåll -->
	   							
	   							<div class="collapse" id="april">	
	   							
	   								<div id="ArkivAprilArtiklar" class="collapse-in">
	   								
	   								<!-- arkiv april laddas in här -->
	   								
  									</div><!-- ArkivAprilArtiklar -->
  								
  								</div><!-- collapse april -->

  								<!-- mars -->

  								<a data-toggle="collapse" href="#mars" aria-expanded="false"
								aria-controls="collapseExample" id="ArkivMars">
		   							Mars <b class="caret"></b>
	   							</a>
								
								<!-- mars innehåll -->
	   							
	   							<div class="collapse" id="mars">	
	   							
	   								<div id="ArkivMarsArtiklar" class="collapse-in">
	   								
	   								<!-- arkiv mars laddas in här -->
	   								
  									</div><!-- ArkivMarsArtiklar -->
  								
  								</div><!-- mars -->

  								<!-- februari -->

  								<a data-toggle="collapse" href="#februari" aria-expanded="false"
								aria-controls="collapseExample" id="ArkivFebruari">
		   							Februari <b class="caret"></b>
	   							</a>
								
								<!-- februari innehåll -->
	   							
	   							<div class="collapse" id="februari">	
	   							
	   								<div id="ArkivFebruariArtiklar" class="collapse-in">
	   								
	   								<!-- februari april laddas in här -->
	   								
  									</div><!-- ArkivFebruariArtiklar -->
  								
  								</div><!-- februari -->

  								<!-- januari -->

  								<a data-toggle="collapse" href="#januari" aria-expanded="false"
								aria-controls="collapseExample" id="ArkivJanuari">
		   							Januari <b class="caret"></b>
	   							</a>
								
								<!-- januari innehåll -->
	   							
	   							<div class="collapse" id="januari">
	   							
	   								<div id="ArkivJanuariArtiklar" class="collapse-in">
	   								
	   								<!-- arkiv januari laddas in här -->
	   								
  									</div><!-- ArkivJanuariArtiklar -->
  								
  								</div><!-- januari -->

	   						</li>
 						</ul>
					</div><!-- collapse in -->
				</div><!-- panel body -->
			</div><!-- panel panel blue-->

			Kalender												
		</div><!-- col md 3 pull right -->
	</div><!-- row -->
</div><!-- content -->

<!-- jQuery script som laddar in resultat från arkivsidorna, ex arkiv_maj.php i DIV med id ArkivMaj -->

<script>
$(document).ready(function(){
	$("#ArkivJuni").click(function(){
        $('#ArkivJuniArtiklar').load('arkiv_juni.php');        
    });

    $("#ArkivMaj").click(function(){
        $('#ArkivMajArtiklar').load('arkiv_maj.php');        
    });

    $("#ArkivApril").click(function(){
        $('#ArkivAprilArtiklar').load('arkiv_april.php');
    });

	$("#ArkivMars").click(function(){
        $('#ArkivMarsArtiklar').load('arkiv_mars.php');
    });

	$("#ArkivFebruari").click(function(){
        $('#ArkivFebruariArtiklar').load('arkiv_februari.php');
    });

	$("#ArkivJanuari").click(function(){
        $('#ArkivJanuariArtiklar').load('arkiv_januari.php');
    });
	return false;
});

</script>

END;

// Stänger resultaten
$res->close();

// Stänger ned uppkoblingen med databasen
$mysqli->close();

// Visar innehållet av sidans header, content och footer
echo $header;
echo $content;
echo $footer;

?>
