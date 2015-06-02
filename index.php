<?php
/*---------------------------------
index.php
Start page with welcome
The first page the visitor sees
---------------------------------*/

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$choosenarticlename = "";
$choosenarticlemessage = "";

if(!empty($_GET))
{
	$getartikelid = isset($_GET['ArtikelId']) ? $_GET['ArtikelId'] : '';

	$query = <<<END

		SELECT ArtikelId, ArtikelName, ArtikelMessage
		FROM artikel
		WHERE ArtikelId = "{$getartikelid}";
END;

	$res = $mysqli->query($query) or die();

	if($res->num_rows == 1)
	{
		while($row = $res->fetch_object())
		{
			$choosenarticlename = $row->ArtikelName;
			$choosenarticlemessage = $row->ArtikelMessage;
			/*$choosenarticletimestamp = $row->ArtikelTimeStamp;*/
		}
	}
}

$artikelnews = "";

$query = <<<END

	SELECT *
	FROM artikel
	WHERE kategori = 'nyhet'
	ORDER BY Artikeltimestamp
END;

$res = $mysqli->query($query) or die();

if($res->num_rows > 0)
{
	while($row = $res->fetch_object())
	{
		$artikelid = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$artikelmessage = $row->ArtikelMessage;
		$artikelsubtext = substr($artikelmessage, 0, 160);
		$artikeltimestamp = $row->ArtikelTimeStamp;

		$artikelnews .= <<<END

		
						<div class="panel-body">
							<div class="media">
								<a class="pull-left" href="#">
								<img class="media-object img-rounded" src="http://placehold.it/64x64" alt="...">
								</a>
								<div class="media-body">
								<h4 class="media-heading"><a href="index.php?ArtikelId={$artikelid}">{$artikelname}</a></h4>
								{$artikelsubtext}...<br>
								</div><!-- media body -->
							</div><!-- media -->	
						</div><!-- panel-body -->
	

END;
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
							<h3 class="panel-title">{$choosenarticlename}</h3>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<img src="http://placehold.it/600x300" class="img-responsive img-rounded img-100x">					
							{$choosenarticlemessage}
														
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
				</div><!-- col-xs-6 col-md-3 -->
			</div> <!-- row -->
       </div><!-- AVsluta content DIV -->

END;

echo $header;
echo $content;
echo $footer;

?>
