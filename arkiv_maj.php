<?php
/*---------------------------------
arkiv_maj.php
Hämtar innehållet från maj månad
---------------------------------*/

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");

//Variabler
$maj ="";

// Hämtar ut artiklar från maj månad
$query = <<<END

	SELECT * FROM artikel
	WHERE ArtikelTimeStamp LIKE '%2015-05%'
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

		
		//encode gör att datum från DB visas med svenska tecken
		utf8_encode($date = strftime("%#d %B", $date));
		
		$artikelid = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$artikelsubtext = substr($artikelname, 0, 24);
		$artikeltimestamp = $row->ArtikelTimeStamp;
	
		
		$maj .= <<<END

		
				
         			<div class="col-md-12 sans-padding-right">			
          				
						<p class="pull-left tid-nyheter-arkiv sans-padding-left">{$date}</p>
							<a href="index.php?ArtikelId={$artikelid}">
								<p>{$artikelsubtext} ...</p>
							</a>
						
					</div>

END;
	}
}

$content .= <<<END

								
											
											{$maj}	
								

END;

//Stänger resultaten
$res->close();

//Stänger ned uppkoblingen med databasen
$mysqli->close();

//Visar innehållet av sidans header, content och footer

echo $content;

?>
