<?php
/*---------------------------------
aakare.php
information / Åkare
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
$artikelnames_aakare = "";
$kategori = "";

// Hämtar ut den specifika artikeln 
if(!empty($_GET)) {

	$getartikelid = isset($_GET['ArtikelId']) ? $_GET['ArtikelId'] : '';

	$query = <<<END

		SELECT *
		FROM artikel
		WHERE ArtikelId = "{$getartikelid}"
		ORDER by ArtikelTimeStamp DESC;
END;

	$res = $mysqli->query($query) or die();

	if($res->num_rows > 0) {

		
		while($row = $res->fetch_object()) {

			$artikelname = $row->ArtikelName;
			$artikelmessage = $row->ArtikelMessage;
			$artikeltimestamp = $row->ArtikelTimeStamp;
			$kategori = $row->Kategori;
			
			$artikeltime = <<<END

<div class="panel panel-yellow">
	<div class="panel-heading">
		<h3 class="panel-title blue bold">{$kategori} / {$artikelname}</h3>
	</div><!-- panel heading -->

	<div class="panel-body">
		{$artikelmessage}	
		{$artikeltimestamp}		
	</div><!-- panel body -->

</div><!-- panel panel yellow -->	

END;
		}
	}
}

// Om inte det finns nån artikel som skickats i adressfältet så görs detta
else
{
	$query = <<<END

		SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelTimeStamp, Kategori
		FROM artikel
		WHERE kategori = 'Åkare'
		ORDER BY Artikeltimestamp ASC;
END;

	$res = $mysqli->query($query) or die();

		if($res->num_rows > 0)
		{
			while($row = $res->fetch_object())
			{
				$artikelname = $row->ArtikelName;
				// substr visar max antal bokstaver anvisad här som 20
				$artikelname_rubrik = substr($artikelname, 0, 20);
				$artikelmessage = $row->ArtikelMessage;
				$artikeltimestamp = $row->ArtikelTimeStamp;
				$kategori = $row->Kategori;

				$artikeltime = <<<END

<div class="panel panel-yellow">
	<div class="panel-heading">
	<h3 class="panel-title blue bold">{$kategori} / {$artikelname}</h3>
	</div><!-- panel heading -->

	<div class="panel-body">
		{$artikelmessage}
		{$artikeltimestamp}
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
	WHERE kategori = 'Åkare'
	ORDER BY ArtikelTimestamp ASC;

END;

// ORDER BY Artikeltimestamp

$res = $mysqli->query($query) or die();

if($res->num_rows > 0) {

	while($row = $res->fetch_object()) {

		$artikelId = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		
		// substr visar max antal ord anvisad här som 20
		$artikelname_rubrik = substr($artikelname, 0, 20);
		$artikelmessage = $row->ArtikelMessage;
		$artikeltimestamp = $row->ArtikelTimeStamp;
		$kategori = $row->Kategori;

		$artikelnames .= <<<END

			<div class="collapse-in">
								
				<ul class="meny">
					<a href="aakare.php?ArtikelId={$artikelId}">
						<li>{$artikelname}</li>
					</a>	   									
				</ul>
			</div><!-- collapse -->
					
END;

	}
}

$content = <<<END

<div id="content">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-yellow">

				<div class="panel-heading">						
					<h3 class="panel-title blue bold">{$kategori} / {$artikelname}</h3>
				</div><!-- panel heading -->
				
				<div class="panel-body">
					{$artikelnames}
				</div><!-- panel body -->
			</div><!-- panel panel blue -->

		</div><!-- col md 3 -->
				
		<div class="col-xs-12 col-md-6">
			{$artikeltime}	
		</div><!-- col xs 12 col md 6 -->	
							
		<!-- Rad högre m sponsorkarusell-->

		{$sponsorer}

		</div><!-- col md 3 -->
	</div><!-- row -->
</div><!-- content -->

END;

// Stänger resultaten
$res->close();

// Stänger ned uppkoblingen med databasen
$mysqli->close();

echo $header;
echo $content;
echo $footer;

?>
