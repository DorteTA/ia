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

$query = <<<END

	SELECT *
	FROM artikel
	WHERE kategori = 'nyhet'
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

		
		//encode gör att datum visas med svenska tecken
		utf8_encode($date = strftime("%A %#d %B %Y", $date));
		
		$artikelid = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$artikelmessage = $row->ArtikelMessage;
		$artikelsubtext = substr($artikelmessage, 0, 75);
		$artikelpic = $row->ArtikelPic;
		$artikelpic_thumb = $row->ArtikelPicThumb;
		$artikeltimestamp = $row->ArtikelTimeStamp;

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
		group by year, month DESC;
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
			$archive = "";
			   // Get data
   			$year = $row['year'];
   			$month = $row['month'];
   			

   			// Structure it
   			$archive[$year][] = $month;

			/*$choosenarticletimestamp = $row->ArtikelTimeStamp;*/
		}

		// Display data
	foreach($archive as $year => $months) {
   	// Show year

   	echo "<ul class='year'><li><a>{$year}</a>";

   // Month container
   echo "<ul class='months'>";
	}
   // Get months
   foreach($months as $month) {
     echo("<li><a>{$month}</a></li>"); 
   

   // Close Month/Year containers
   echo("</ul></li></ul>");
	}
}
	
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
							
				<!-- Rad högre -->
				<div class="col-md-3 pull-right">
					<div class="panel panel-blue">
						<div class="panel-heading">
							<h3 class="panel-title">Sponsorer</h3>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<p>DORTES PRIMA FLÄSKESVÅL
							</p>
							<p class="divider"></p>
							<p>Köp nu och vi slänger med en påse regnbågsfärg så du kan färga dina fläskesvål om du vill. Power to the rainbow svål. Ring på nummer: Nöff Nöff Oink
							</p>
						</div><!-- panel-body -->
					</div><!-- panel panel-blue-->

					<!-- kolumn höger rad 2 nyhetsarkiv -->

					<div class="panel panel-blue">
						<div class="panel-heading">
							<h3 class="panel-title">Nyhetsarkiv</h3>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<p class="divider"></p>
							
							<p>månad 9</p>
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
