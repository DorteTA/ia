<?php
/*---------------------------------
bedom.php
Träna / Bedömning
---------------------------------*/

/*---------------------------------------------------
Använder HTML-mallen där CSS och javascript ingår,
så detta inte behövs tastas in på varje sida
---------------------------------------------------*/
include_once("inc/HTMLTemplate.php");

// Uppkoblingen till databasen
include_once("inc/Connstring.php");

// Variabler
$artikeltime = "";
$artikelnames = "";

// Hämtar ut den specifika artikeln 

if(!empty($_GET))
{
	$getartikelid = isset($_GET['ArtikelId']) ? $_GET['ArtikelId'] : '';

	$query = <<<END

		SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelTimeStamp
		FROM artikel
		WHERE ArtikelId = "{$getartikelid}";
END;

	$res = $mysqli->query($query) or die();

	if($res->num_rows > 0) {

		while($row = $res->fetch_object()) {
		
			$artikelname = $row->ArtikelName;
			$artikelmessage = $row->ArtikelMessage;
			$artikeltimestamp = $row->ArtikelTimeStamp;
			
			$artikeltime = <<<END

<div class="panel panel-yellow">

	<!-- Rubrik -->
	<div class="panel-heading">
		<h3 class="panel-title blue bold">{$artikelname}</h3>
	</div><!-- panel heading -->
	
	<!-- Innehåll under rubrik -->
	<div class="panel-body">
		{$artikelmessage}	
		{$artikeltimestamp}		
	</div><!-- panel body -->
</div><!-- panel panel-yellow -->

END;
		}
	}
}

// Om inte det finns nån artikel som skickats i adressfältet så görs detta
else {

	$query = <<<END

		SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelTimeStamp, Kategori
		FROM artikel
		WHERE kategori = 'bedom'
		ORDER BY Artikeltimestamp
END;

	$res = $mysqli->query($query) or die();

		if($res->num_rows > 0) {

			while($row = $res->fetch_object()) {

				$artikelname = $row->ArtikelName;
				$artikelmessage = $row->ArtikelMessage;
				$artikeltimestamp = $row->ArtikelTimeStamp;

				$artikeltime = <<<END

<div class="panel panel-yellow">
	<div class="panel-heading">
		<h3 class="panel-title blue bold">{$artikelname}</h3>
	</div><!-- panel-heading -->

	<div class="panel-body">
		{$artikelmessage}<br><br>	
		{$artikeltimestamp}<br><br>
	</div><!-- panel body -->
</div><!-- panel panel yellow -->	

END;
			}
		}
}

// Hämtar ut undermenyn när användaren klickat på en länk
$query = <<<END

	SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelTimeStamp, Kategori
	FROM artikel
	WHERE kategori = 'bedom'
	ORDER BY Artikeltimestamp
END;

$res = $mysqli->query($query) or die();

if($res->num_rows > 0) {

	while($row = $res->fetch_object()) {

		$artikelId = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$artikelmessage = $row->ArtikelMessage;
		$artikeltimestamp = $row->ArtikelTimeStamp;

		$artikelnames .= <<<END

<div class="collapse-in" id="dokument">
								
	<ul class="">
          								
		<a href="bedom.php?ArtikelId={$artikelId}">
	  	<li>{$artikelname}</li>
	  </a>
	</ul>
</div><!-- collapse in -->

END;
	}
}

$content = <<<END
			
<div id="content">
	<div class="row">

		<!-- vänster kolumn -->
	
		<div class="col-md-3">
			<div class="panel panel-yellow">

				<div class="panel-heading">
					<!-- Träna undermeny -->					
					<h3 class="panel-title blue bold">Träna / Bedömning</h3>
				</div><!-- panel heading -->					
							
				<div class="panel-body">
					{$artikelnames}
				</div><!-- panel body -->
			</div><!-- panel panel blue -->

		</div><!-- col md 3 -->
				
		<div class="col-xs-12 col-md-6">
			{$artikeltime}	
		</div><!-- mitten -->	
							
		<!-- Rad högre -->
		{$sponsorer}
		</div><!-- col md 3 -->

	</div> <!-- row -->
</div><!-- content -->

END;

echo $header;
echo $content;
echo $footer;

?>
