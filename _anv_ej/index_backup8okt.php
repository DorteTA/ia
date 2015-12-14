<?php
/*---------------------------------
index.php
Start page with welcome
The first page the visitor sees
---------------------------------*/

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");

//Variabler
$artikelpic = "";
$artikelpic_thumb = "";
$artikelnews = "";
$artikel_month = "";
$archive = "";
$maanad = "";


$query = <<<END

	SELECT *
	FROM artikel
	WHERE kategori = 'nyhet'
	ORDER BY artikeltimestamp DESC;
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
		utf8_encode($date = strftime("%A %#d %B %Y", $date));
		
		$artikelid = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$artikelmessage = $row->ArtikelMessage;
		$artikelsubtext = substr($artikelmessage, 0, 75);
		$artikelpic = $row->ArtikelPic;
		$artikelpic_thumb = $row->ArtikelPicThumb;
		$artikeltimestamp = $row->ArtikelTimeStamp;
		$archive = $row->maanad;
		
		
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

		SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelPic, ArtikelPicThumb, ArtikelTimeStamp, maanad
		FROM artikel
		WHERE ArtikelId = "{$getartikelid}"
		GROUP by maanad DESC;
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
			$archive = $row->maanad;

			
		}

	}


//WHERE ArtikelTimeStamp = DATE_FORMAT(date,'%M')='Juni'
	
}



$content = <<<END

			
       	<div id="content">
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-blue">
					<div class="panel-heading">
							<h3 class="panel-title">Nyheter</h3>
						</div><!-- panel-heading -->
						{$artikelnews}
						
					</div><!-- panel panel-blue -->								
				</div><!-- col-md-3 -->
				
				<div class="col-xs-12 col-md-6">
					<div class="panel panel-yellow">
						<div class="panel-heading">
							<h3 class="panel-title">{$artikelname}</h3>
						</div><!-- panel-heading -->
						<div class="panel-body">
							{$artikelpic}				
							{$artikelmessage}
														
						</div><!-- panel-body -->
					</div><!-- panel panel-yellow -->
								
			</div><!-- mitten -->	
							
				<!-- Rad högre m sponsorkarusell-->
				<div class="col-md-3 pull-right">
					<div id="myCarousel" class="carousel">



            			<ol class="carousel-indicators">
               				<li data-target = "#myCarousel" data-slide-to = "0" class="active"></li>
							<li data-target = "#myCarousel" data-slide-to = "1"></li>
							<li data-target = "#myCarousel" data-slide-to = "2"></li>
            			</ol>

            			<div id="my-carousel" class="carousel slide" data-ride="carousel">


	            			<div class="carousel-inner">

								<div class="item active">
									<a href="http://www.sporrong.se/" target="_blank">
		   								<img src="sponsor/sporrong.png" class="karusell-bild" alt="Sporrong">
	  	      						</a>
	  	      						<!-- Sporrong beskrivande text på bild -->
	  	      						<div class="carousel-caption">
	  	      						    <h4 class="karusell-text">Sporrong beskrivande text</h4>
		      						</div>
								</div><!-- item active -->

	               				<div class="item">
		   							<img src="sponsor/no_fall.png" class="karusell-bild" alt="No Fall">
		      						
		      						<div class="carousel-caption">
		         						<h4 class="karusell-text">No Fall beskrivande text</h4>	
		      						</div>
								</div>

	               				<div class="item">
								   <img src="sponsor/mp_skating.png" class="karusell-bild" alt="MP Skating">
									
									<div class="carousel-caption">
								    	<h4 class="karusell-text">MP Skating beskrivande text</h4>
								    </div>
								</div>

	           				</div><!-- carousel-inner -->
	           			</div><!-- carousel slide -->
           			
			
     				</div><!-- myCarousel -->



					<!-- kolumn höger rad 2 nyhetsarkiv -->

					<div class="panel panel-blue">
						<div class="panel-heading">
							<h3 class="panel-title">Nyhetsarkiv</h3>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<p class="divider"></p>
							
							<p>månad</p>
							<p>{$archive}</p>
							<p>{$date}</p>
							

						</div><!-- panel-body -->
					</div><!-- panel panel-blue-->												
				</div><!-- col-xs-6 col-md-3 -->
			</div> <!-- row -->
       </div><!-- AVsluta content DIV -->

END;

echo $header;
echo $content;
echo $footer;

?>