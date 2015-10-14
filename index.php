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
$artikelnews = "";
$artikel_month = "";
$juni ="";

$query = <<<END

	SELECT *
	FROM artikel
	WHERE kategori = 'nyhet'
	ORDER BY artikeltimestamp DESC;
END;

//Ger felmeddelande om databasen inte kan köras och hänvisar till felnummer, annars körs den
$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);	

// Sätter tidszonen till europäisk/svensk tidszon
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
		utf8_encode($date = strftime("%A %#d %B %Y", $date));
		
		$artikelid = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$artikelmessage = $row->ArtikelMessage;
		$artikelsubtext = substr($artikelmessage, 0, 75);
		$artikelpic = $row->ArtikelPic;
		$artikelpic_thumb = $row->ArtikelPicThumb;
		$artikeltimestamp = $row->ArtikelTimeStamp;		
		
		//Hindrar XSS-attack
		$artikelname	= htmlspecialchars($artikelname);
		$artikelmessage	= htmlspecialchars($artikelmessage);

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
			$artikelmessage = $row->ArtikelMessage;
			$artikelpic = $row->ArtikelPic;
			$artikelpic_thumb = $row->ArtikelPicThumb;
			$artikeltimestamp = $row->ArtikelTimeStamp;
			
		}

	}
	
}

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
/*

$artikelmessage = $row->ArtikelMessage;
			$artikelpic = $row->ArtikelPic;
			$artikelpic_thumb = $row->ArtikelPicThumb;
			$artikeltimestamp = $row->ArtikelTimeStamp;
*/
	   	
			
					


$content = <<<END

<div id="content">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-blue">
				<div class="panel-heading">
					<h3 class="panel-title">Nyheter</h3>
				</div><!-- panel-heading -->
				{$artikelnews}
			</div><!-- panel panel blue -->								
		</div><!-- col md 3 -->
				
		<div class="col-xs-12 col-md-6">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<h3 class="panel-title">{$artikelname}</h3>
				</div><!-- panel-heading -->
		
				<div class="panel-body-15px">
					{$artikelpic}
					<p class="padding-15px">				
						{$artikelmessage}
					</p>						
				</div><!-- panel body -->
			</div><!-- panel panel yellow -->
								
		</div><!-- col xs 12 col md 6 -->	
							
		<!-- Rad högre m sponsorkarusell-->

		<div class="col-md-3 pull-right">
			<div class="panel panel-blue">
				<div class="panel-heading">
					<h3 class="panel-title">Sponsorer</h3>
				</div><!-- panel-heading -->

				<!-- Sponsor karusell -->
				
				<div class="panel-body">
					<div id="myCarousel" class="carousel">
		  				<div id="my-carousel" class="carousel slide" data-ride="carousel">
			       			<div class="carousel-inner">
								<div class="item active">
									<a href="http://www.sporrong.se/" target="_blank">
		   								<img src="sponsor/sporrong.png" class="karusell-bild" alt="Sporrong">
	  	      						</a>
								</div><!-- item active -->

	               				<div class="item">
	               					<a href="http://nofall.se/" target="_blank">
		   								<img src="sponsor/no_fall.png" class="karusell-bild" alt="No Fall">
		   							</a>
								</div>

	               				<div class="item">
	               					<a href="http://www.mpskating.com/" target="_blank">
								   		<img src="sponsor/mp_skating.png" class="karusell-bild" alt="MP Skating">
								   	</a>
								</div>

	           				</div><!-- carousel inner -->
	           			</div><!-- carousel slide -->			
	     			</div><!-- myCarousel -->
		     	</div><!-- panel body -->
			</div><!-- panel panel-blue-->

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
								<a data-toggle="collapse" href="#juni" aria-expanded="false"
								aria-controls="collapseExample">
									Juni <b class="caret"></b>
								</a>
								<!-- juni -->
								<div class="collapse" id="juni">
									<div class="collapse-in">  									
										<a href="index.php?ArtikelId={$artikelid}">
											{$juni}
										</a>
									</div>									
	   							</div><!-- juni -->	
	   								
	   							<a data-toggle="collapse" href="#maj" aria-expanded="false"
								aria-controls="collapseExample" id="ArkivMaj">
		   							Maj <b class="caret"></b>
	   							</a>
								
								<!-- maj content -->
	   							
	   							<div class="collapse" id="maj">	
	   							
	   								<div id="ArkivMajArtiklar" class="collapse-in">
	   								
	   								<!-- arkiv maj laddas in här -->
	   								
  									</div><!-- maj -->
	   						</li>
 						</ul>
					</div><!-- collapse in -->
				</div><!-- panel body -->
			</div><!-- panel panel blue-->												
		</div><!-- col md 3 pull right -->
	</div><!-- row -->
</div><!-- content -->

<!-- Laddar in resultat från sidan arkiv_maj.php i DIV med id ArkivMaj -->
<script type="text/javascript">
$(document).ready(function(){
    $("#ArkivMaj").click(function(){
        $('#ArkivMajArtiklar').load('arkiv_maj.php');
        
    });
    return false;
});
</script>

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
