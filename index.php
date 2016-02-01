<?php
/*---------------------------------
index.php
Startsidan / Hem
---------------------------------*/

// Uppkoblingen till databasen
include_once("inc/Connstring.php");

/*---------------------------------------------------
Använder HTML-mallen där CSS och javascript ingår,
så detta inte behövs tastas in på varje sida
---------------------------------------------------*/
include_once("inc/HTMLTemplate.php");

// Variabler
$artikelpic = "";
$artikelpic_thumb = "";
$artikelskribent = "";
$artikelnews = "";
$artikelfotograf = "";

/*---------------------------------------------------
Kollar om användaren är inloggat
och lägger in namnet i variablen $name
---------------------------------------------------*/
if(isset($_SESSION['username'])) {
	$name = $_SESSION['username'];
}

/*---------------------------------------------------
Väljer allt från tabellen artikel i DB med katogorin
nyhet, visar nyaste först och max de 5 senaste
---------------------------------------------------*/
$query = <<<END

	SELECT *
	FROM artikel
	WHERE kategori = 'nyhet'
	ORDER BY artikelTimestamp DESC
	LIMIT 5;
END;

/*---------------------------------------------------
Ger felmeddelande om databasen inte kan köras och
hänvisar till felnummer, annars körs den
---------------------------------------------------*/
$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);	

// Sätter tidszonen till europäisk/svensk tidszon
date_default_timezone_set("Europe/Stockholm");

// Om det finns några artiklar
if($res->num_rows > 0) {

	// Kör resultat
	while($row = $res->fetch_object()) {

		// Sätter tid till svenska
		setlocale(LC_TIME, "sv_SE", "sv_SE.65001", "swedish");   
		$date = strtotime($row->ArtikelTimeStamp);

		// encode gör att datum från DB visas på svenska
		utf8_encode($date = strftime("%#d %B %Y", $date));
		
		$artikelid = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$artikelmessage = $row->ArtikelMessage;

		// substr visar max antal ord anvisad här som 75
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

		SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelPic, ArtikelPicThumb,
		 ArtikelTimeStamp, ArtikelSkribent, ArtikelFotograf, kategori
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
		 ArtikelFotograf, kategori
		FROM artikel
		WHERE ArtikelId = "{$getartikelid}"
		ORDER by ArtikelTimeStamp DESC;
END;

	$res = $mysqli->query($query) or die();

	if($res->num_rows == 1)
	{
		while($row = $res->fetch_object())
		{

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

			<!-- Nyhetsarkiv -->

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

		<!-- Skatesweden -->
			
					<h3 class="panel-title blue"><strong>Skatesweden</strong></h3>							
				
					<!-- instagram -->
						
		   			<strong><p>Instagram</p></strong>
	   											   								
	   				<!-- Skatesweden Instagram -->         				
					  					
  					<blockquote class="instagram-media" data-instgrm-captioned data-instgrm-version="6"
  					 style=" background:#FFF; border:none; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0
  					  1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:658px; padding:0; width:99.375%;
  					   width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:8px;">
  					    <div style=" background:#F8F8F8; line-height:0; margin-top:40px; padding:50% 0;
  					     text-align:center; width:100%;"> <div style="
  					      background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAMAAAApWqozAAAAGFBMVEUiIiI
  					      	9PT0eHh4gIB4hIBkcHBwcHBwcHBydr+JQAAAACHRSTlMABA4YHyQsM5jtaMwAAADfSURBVDjL7ZVBEgMhCAQBAf//42xcN
  					      	bpAqakcM0ftUmFAAIBE81IqBJdS3lS6zs3bIpB9WED3YYXFPmHRfT8sgyrCP1x8uEUxLMzNWElFOYCV6mHWWwMzdPEKHlh
  					      	Lw7NWJqkHc4uIZphavDzA2JPzUDsBZziNae2S6owH8xPmX8G7zzgKEOPUoYHvGz1TBCxMkd3kwNVbU0gKHkx+iZILf77Io
  					      	fhrY1nYFnB/lQPb79drWOyJVa/DAvg9B/rLB4cC+Nqgdz/TvBbBnr6GBReqn/nRmDgaQEej7WhonozjF+Y2I/fZou/qAAA
  					      	AAElFTkSuQmCC); display:block; height:44px; margin:0 auto -44px; position:relative; top:-22px;
  					      	 width:44px;"></div></div> <p style=" margin:8px 0 0 0; padding:0 4px;">
  					      	  <a href="https://www.instagram.com/p/ggtNVvJu3E/"
  					      	   style=" color:#000;
  					      	   font-family:Arial,sans-serif;
  					      	    font-size:14px;
  					      	     font-style:normal;
  					      	      font-weight:normal;
  					      	    line-height:17px;
  					      	     text-decoration:none; word-wrap:break-word;" target="_blank">Hand</a></p>
  					      	     <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px;
  					      	      margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center;
  					      	       text-overflow:ellipsis; white-space:nowrap;">Ett filmklipp publicerat av SkateSwe
  					      	        (@skatesweden) <time style=" font-family:Arial,sans-serif; font-size:14px;
  					      	         line-height:17px;" datetime="2013-11-09T22:42:22+00:00">Nov 9, 2013 kl. 2:42 PST</time>
  					      	         </p>
  					      	         </div>
  					      	         </blockquote>
					<script async defer src="//platform.instagram.com/en_US/embeds.js"></script>
  					<p class="divider"></p>

					<strong>Twitter</strong>

					<blockquote class="twitter-tweet" data-cards="hidden" lang="sv"><p lang="sv" dir="ltr">
					Sveriges EM-trupp 2016 klar: Alexander Majorov, Joshi Helgesson, Isabelle Olsson &amp;
					 Matilda Algotsson – <a href="https://t.co/r1e1hb0VqB">https://t.co/r1e1hb0VqB</a>
					  <a href="https://twitter.com/hashtag/skatesweden?src=hash">#skatesweden</a></p>
					  &mdash; Konståkningförbundet (@skatesweden)
					   <a href="https://twitter.com/skatesweden/status/676656223920504832">15 december 2015</a>
					   </blockquote>
					<!-- script for Twitter feeds -->
					<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
					<p class="divider"></p>

					<p><strong>Facebook</strong></p>

					

					<div id="fb-root"></div>
					
					<script>(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/da_DK/sdk.js#xfbml=1&version=v2.3";
					    fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));
					</script>
					
					<div class="fb-post"
					 data-href="https://www.facebook.com/skatesweden/posts/1765399140354593" data-width="285">
					 <div class="fb-xfbml-parse-ignore">
					 
					 <blockquote cite="https://www.facebook.com/skatesweden/posts/1765399140354593">
					 <p class="14px">Uppladdningen inf&#xf6;r EM forts&#xe4;tter! L&#xe4;s om Isabelle Olssons och Matilda
					  Algotssons f&#xf6;rv&#xe4;ntningar i Skateswedens intervju. #skatesweden</p>Opslået af
					   <a href="https://www.facebook.com/skatesweden/">Skate Sweden - Swedish Figure Skating</a>
					    på&nbsp;<a href="https://www.facebook.com/skatesweden/posts/1765399140354593">19. januar 2016</a>
					    </blockquote></div></div>
						
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
