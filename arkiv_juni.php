<?php
/*---------------------------------
arkiv_juni.php
Hämtar innehållet från juni månad
---------------------------------*/

// Uppkoblingen till databasen
include_once("inc/Connstring.php");

// Använder HTML-mallen där CSS och javascript ingår,
// så detta inte behövs tastas in på varje sida
include_once("inc/HTMLTemplate.php");

// Variabler
$juni ="";

// Hämtar ut artiklar från juni månad
$query = <<<END

	SELECT * FROM artikel
	WHERE ArtikelTimeStamp LIKE '%2015-06%'
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

		
		//encode gör att datum från DB visas på svenska
		utf8_encode($date = strftime("%#d %B", $date));
		
		$artikelid = $row->ArtikelId;
		$artikelname = $row->ArtikelName;

		// substr visar max antal ord anvisad här som 24
		$artikelsubtext = substr($artikelname, 0, 24);
		
		$artikeltimestamp = $row->ArtikelTimeStamp;
	
		// Strängen som innehåller HTML samt resultatet från databasen
		$juni .= <<<END

			
	       			<div class="col-md-12 sans-padding-right">			
          				
						<p class="pull-left tid-nyheter-arkiv sans-padding-left">
							{$date}
						
							<a href="index.php?ArtikelId={$artikelid}">							
								{$artikelsubtext} ...
							</a>
						</p>
						
					</div><!-- col md 12 -->

END;
	}
}

// Visar databas-innehållet hämtad in i strängen $juni
$content .= <<<END

					{$juni}	
								
END;

// Stänger resultaten
$res->close();

// Stänger ned uppkoblingen med databasen
$mysqli->close();

// Visar innehållet av sidans content
echo $content;

?>