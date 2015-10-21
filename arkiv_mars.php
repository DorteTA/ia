<?php
/*---------------------------------
arkiv_april.php
Hämtar innehållet från april månad
---------------------------------*/

// Uppkoblingen till databasen
include_once("inc/Connstring.php");

// Använder HTML-mallen där CSS och javascript ingår,
// så detta inte behövs tastas in på varje sida
include_once("inc/HTMLTemplate.php");

// Variabler
$april ="";

// Hämtar ut artiklar från april månad och
// visar senaste artikel först
$query = <<<END

	SELECT * FROM artikel
	WHERE ArtikelTimeStamp LIKE '%2015-04%'
	ORDER BY ArtikelTimeStamp DESC;

END;

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
		//Sätter tid till svenska
		setlocale(LC_TIME, "sv_SE", "sv_SE.65001", "swedish");   
		$date = strtotime($row->ArtikelTimeStamp);

		
		//encode gör att datum från DB visas med svenska tecken
		utf8_encode($date = strftime("%#d %B", $date));
		
		$artikelid = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$artikelsubtext = substr($artikelname, 0, 24);
		$artikeltimestamp = $row->ArtikelTimeStamp;
	
		// Strängen som innehåller HTML samt resultatet från databasen
		$april .= <<<END

			
	       			<div class="col-md-12 sans-padding-right">			
          				
						<p class="pull-left tid-nyheter-arkiv sans-padding-left">
							{$date}
						</p>
						<a href="index.php?ArtikelId={$artikelid}">
							<p>
								{$artikelsubtext} ...
							</p>
						</a>
						
					</div><!-- col md 12 -->

END;
	}
}

// Visar databas-innehållet hämtad in i strängen $april
$content .= <<<END

					{$april}	
								
END;

// Stänger resultaten
$res->close();

// Stänger ned uppkoblingen med databasen
$mysqli->close();

// Visar innehållet av sidans content
echo $content;

?>
