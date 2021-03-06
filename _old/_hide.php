<?php
/*---------------------------------
arkiv_nytt.php
Hämtar innehållet från artiklar
---------------------------------*/

// Uppkoblingen till databasen
include_once("inc/Connstring.php");

// Använder HTML-mallen där CSS och javascript ingår,
// så detta inte behövs tastas in på varje sida
include_once("inc/HTMLTemplate.php");

// Variabler
$maanad ="";
$januari ="";
$januari_datum ="";
$feb ="";
$februari_datum ="";

// Hämtar ut artiklar från januari månad och
// visar senaste artikel först
$query = <<<END

	SELECT * FROM artikel
	ORDER BY ArtikelTimeStamp DESC;

END;

// ORDER BY ArtikelTimeStamp DESC;
// WHERE ArtikelTimeStamp LIKE '%2015-01%'

// Hämta resultat
$res = $mysqli->query($query) or die();

// Sätter tidszonen till europäisk/svensk tidszon
date_default_timezone_set("Europe/Stockholm");

// Om artiklar finns
if($res->num_rows > 0)
{
	// Kör igenom resultatet
	while($row = $res->fetch_object())
	{
		// Sätter tid till svenska
		setlocale(LC_TIME, "sv_SE", "sv_SE.65001", "swedish");   
		$date = strtotime($row->ArtikelTimeStamp);

		
		//encode gör att datum från DB visas på svenska
		utf8_encode($date = strftime("%#d %B", $date));
		
		$artikelid = $row->ArtikelId;
		$artikelname = $row->ArtikelName;

		// substr visar max antal ord anvisad här som 28
		$artikelsubtext = substr($artikelname, 0, 28);	
		$artikeltimestamp = $row->ArtikelTimeStamp;

		$januari_datum = $date[0];
		$feb_datum = $row->$artikeltimestamp('%2015-02%');		

		// Strängen som innehåller HTML samt resultatet från databasen
		$maanad .= <<<END

<!-- kolumn m bredd 12 -->
<div class="col-md-12 sans-padding-left pull-left">

	<!-- sätter in datum från artikel i DB -->         				
	{$date}&nbsp; 
	<a href="index.php?ArtikelId={$artikelid}">

		<!-- visar förkortat namn på artikel -->							
		{$artikelsubtext}...
	</a>
</div><!-- end col md 12 -->		
END;


		$januari .= <<<END

<!-- kolumn m bredd 12 -->
<div class="col-md-12 sans-padding-left pull-left">

	<!-- sätter in datum från artikel i DB -->         				
	{$januari_datum}&nbsp; 
	<a href="index.php?ArtikelId={$artikelid}">

		<!-- visar förkortat namn på artikel -->							
		{$artikelsubtext}...
	</a>
</div><!-- end col md 12 -->

END;

	}

	
		

		$feb .= <<<END

<!-- kolumn m bredd 12 -->
<div class="col-md-12 sans-padding-left pull-left">

	<!-- sätter in datum från artikel i DB -->         				
	{$feb_datum}&nbsp; 
	<a href="index.php?ArtikelId={$artikelid}">

		<!-- visar förkortat namn på artikel -->							
		{$artikelsubtext}...
	</a>
</div><!-- end col md 12 -->		


END;

		
}

// Visar databas-innehållet hämtad in i strängen $januari
$content .= <<<END

$maanad

<h3>Januari</h3>

$januari

<h3>Februari</h3>

$feb
$feb_datum

								
END;


// Stänger resultaten
//$res->close();

// Stänger ned uppkoblingen med databasen
//$mysqli->close();

// Visar innehållet av sidans content
echo $content;

?>