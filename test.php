<?php
/*---------------------------------
historia.php
Om oss / Historia / Förbundets historia
---------------------------------*/

/*---------------------------------------------------
Använder HTML-mallen där CSS och javascript ingår,
så detta inte behövs tastas in på varje sida
---------------------------------------------------*/
include_once("inc/HTMLTemplate.php");

// Uppkoblingen till databasen
include_once("inc/Connstring.php");

include_once("inc/Artiklar.php");

// Variabler
$artikeltime = "";
$artikelnames = "";
$kategori = "";
//$visa_artikel = "";

// Hämtar ut allt från den specifika artikeln
if(!empty($_GET)) {

	$getartikelid = isset($_GET['ArtikelId']) ? $_GET['ArtikelId'] : '';

	$query = <<<END

		SELECT *
		FROM artikel
		WHERE ArtikelId = "{$getartikelid}";
END;

	$res = $mysqli->query($query) or die();

	if($res->num_rows > 0) {

		while($row = $res->fetch_object()) {
			
		// Sätter tid till svenska
		setlocale(LC_TIME, "sv_SE", "sv_SE.65001", "swedish");   
		$date = strtotime($row->ArtikelTimeStamp);

		// encode gör att datum från DB visas på svenska
		utf8_encode($date = strftime("%#d %B %Y", $date));
		
		// Sträng med artikelns id-nummer
		$artikelid = $row->ArtikelId;

		// Sträng med artikelns rubrik
		$artikelname = $row->ArtikelName;

		// Sträng med artikelns innehåll
		$artikelmessage = $row->ArtikelMessage;

		// substr visar max antal ord anvisad här som 75
		//$artikelsubtext = substr($artikelmessage, 0, 75);
		
		// sträng med artikelbild
		$artikelpic = $row->ArtikelPic;

		// Sträng med artikelbild förminskad
		$artikelpic_thumb = $row->ArtikelPicThumb;

		// Sträng med artikelns tid och datum
		$artikeltimestamp = $row->ArtikelTimeStamp;

		// Sträng med namn på artikelns skribent(er)
		$artikelskribent = $row->ArtikelSkribent;

		// Sträng med namn på artikelns fotograf(er)
		$artikelfotograf = $row->ArtikelFotograf;

		// Sträng med artikelns kategori
		$kategori = $row->Kategori;
	
		$artikeltime = <<<END

{$visa_artikel}	

END;

		}
	}
}

// Om inte det finns nån artikel som skickats i adressfältet så görs detta
else {

	$query = <<<END

		SELECT *
		FROM artikel
		WHERE kategori = 'Historia'
		ORDER BY ArtikelTimestamp ASC;

END;

	$res = $mysqli->query($query) or die();

		// Sätter tidszonen till europäisk/svensk tidszon
		date_default_timezone_set("Europe/Stockholm");

		// Om det finns några artiklar
		if($res->num_rows > 0) {

			while($row = $res->fetch_object()) {

				// Sätter tid till svenska
				setlocale(LC_TIME, "sv_SE", "sv_SE.65001", "swedish");   
				$date = strtotime($row->ArtikelTimeStamp);

				// encode gör att datum från DB visas på svenska
				utf8_encode($date = strftime("%#d %B %Y", $date));
				
				// Sträng med artikelns id-nummer
				$artikelid = $row->ArtikelId;

				// Sträng med artikelns rubrik
				$artikelname = $row->ArtikelName;

				// Sträng med artikelns innehåll
				$artikelmessage = $row->ArtikelMessage;

				// substr visar max antal ord anvisad här som 75
				$artikelsubtext = substr($artikelmessage, 0, 75);
				
				// sträng med artikelbild
				$artikelpic = $row->ArtikelPic;

				// Sträng med artikelbild förminskad
				$artikelpic_thumb = $row->ArtikelPicThumb;

				// Sträng med artikelns tid och datum
				$artikeltimestamp = $row->ArtikelTimeStamp;

				// Sträng med namn på artikelns skribent(er)
				$artikelskribent = $row->ArtikelSkribent;

				// Sträng med namn på artikelns fotograf(er)
				$artikelfotograf = $row->ArtikelFotograf;

				// Sträng med artikelns kategori
				$kategori = $row->Kategori;

				$artikeltime = <<<END

<div class="panel panel-yellow">

	<div class="panel-heading">
		<h3 class="panel-title">{$artikelname}</h3>
	</div><!-- panel-heading -->

	<div class="panel-body">
		{$artikelmessage}	
	{$artikeltimestamp}		

	</div><!-- panel-body -->
</div><!-- panel panel-yellow -->			

END;
		}
	}
}

// Hämtar ut undermenyn när användaren klickat på en länk
$query = <<<END

	SELECT ArtikelId, ArtikelName, ArtikelTimeStamp, Kategori
	FROM artikel
	WHERE kategori = 'Historia'
	ORDER BY Artikeltimestamp;

END;

$res = $mysqli->query($query) or die();

if($res->num_rows > 0) {

	while($row = $res->fetch_object()) {

		$artikelId = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$kategori = $row->Kategori;

		$artikelnames .= <<<END

<div class="collapse-in" id="dokument">								
	<ul class="meny">          								
		<a href="historia.php?ArtikelId={$artikelId}">
			<li>{$artikelname}</li>
		</a>
	</ul>
</div><!-- collapse in -->

END;
	}
}

$content = <<<END
			
{$visa_artikel}

END;

echo $header;
echo $content;
echo $footer;

?>
