<?php
/*---------------------------------
arkiv_januari.php
Hämtar innehållet från januari månad
---------------------------------*/

/*---------------------------------------------------
Använder HTML-mallen där CSS och javascript ingår,
så detta inte behövs tastas in på varje sida
---------------------------------------------------*/
include_once("inc/HTMLTemplate.php");

// Uppkoblingen till databasen
include_once("inc/Connstring.php");

// Variabler
$januari ="";

// Hämtar ut artiklar från januari månad och
// visar senaste artikel först
$query = <<<END

	SELECT *
	FROM artikel
	WHERE ArtikelTimeStamp LIKE '%2015-01%'
	ORDER BY ArtikelTimeStamp DESC;

END;

// Hämta resultat
$res = $mysqli->query($query) or die();

// Sätter tidszonen till europäisk/svensk tidszon
date_default_timezone_set("Europe/Stockholm");

// Om artiklar finns
if($res->num_rows > 0) {

	// Kör igenom resultatet
	while($row = $res->fetch_object()) {

// Sätter tid till svenska
		setlocale(LC_TIME, "sv_SE", "sv_SE.65001", "swedish");   
		$date = strtotime($row->ArtikelTimeStamp);
		
		// Encode gör att datum från DB visas på svenska
		utf8_encode($date = strftime("%#d %B", $date));
		
		// Sträng med artikelns id-nummer
		$artikelid = $row->ArtikelId;

		// Sträng med artikelns rubrik
		$artikelname = $row->ArtikelName;

		// Substr visar max antal ord anvisad här som 28
		$artikelsubtext = substr($artikelname, 0, 28);
		
		// Sträng med artikelns tid och datum
		$artikeltimestamp = $row->ArtikelTimeStamp;
			
		// Strängen som innehåller HTML samt resultatet från databasen
		$januari .= <<<END

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
	}
}

// Visar databas-innehållet hämtad in i strängen $januari
$content .= <<<END

{$januari}	
								
END;

// Stänger resultaten
$res->close();

// Stänger ned uppkoblingen med databasen
$mysqli->close();

// Visar innehållet av sidans content
echo $content;

?>