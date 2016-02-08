<?php

/*---------------------------------------------------
Använder HTML-mallen där CSS och javascript ingår,
så detta inte behövs tastas in på varje sida
---------------------------------------------------*/
include_once("inc/HTMLTemplate.php");

// Uppkoblingen till databasen
include_once("inc/Connstring.php");

// Variabler
$feedback = "";
$article = "";
$search = "";
$searchResult = "";
$artikelpic = "";
$artikelpic_thumb = "";

// Sökfunktion
if(isset($_GET['search'])) {

	$search = $_GET['search'];

	/*---------------------------------------------------
	Välja allt från de artiklarna där artikelnamn eller
	artikel-innehåll matcher sökord, visa senaste först.
	---------------------------------------------------*/
	$query = <<<END
		SELECT * FROM artikel
		WHERE artikelName
		OR artikelMessage
		LIKE '%{$search}%'
		ORDER by ArtikelTimeStamp DESC;
END;
	$result = $mysqli->query($query) or die();

	if($result->num_rows > 0) {

		while($row = $result->fetch_object()) {
		
		// Sätter tid till svenska
		setlocale(LC_TIME, "sv_SE", "sv_SE.65001", "swedish");   
		$date = strtotime($row->ArtikelTimeStamp);
		
		//encode gör att datum från DB visas på svenska
		utf8_encode($date = strftime("%#d %B %Y", $date));
		
		$artikelid = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$artikelmessage = $row->ArtikelMessage;
		$artikelsubtext = substr($artikelmessage, 0, 76);
		$artikelpic = $row->ArtikelPic;
		$artikelpic_thumb = $row->ArtikelPicThumb;
		$artikeltimestamp = $row->ArtikelTimeStamp;

			$searchResult .= <<<END

						<div class="media media-height search-result">

							<div class="media-height media-left media-top search-result">
								<a href="index.php?ArtikelId={$artikelid}">
									{$artikelpic_thumb}
								</a>
								
								<div class="tid-nyheter">
									{$date}
								</div>
							</div><!-- media -->

							<div class="media-body search-result">
								<h4 class="media-heading">
									<p class="search-result">
										<a href="index.php?ArtikelId={$artikelid}">
											{$artikelname}
										</a>
									</p>
								</h4>
								<p class="search-result">{$artikelsubtext} ...
								
								</p>			

							</div><!-- media body -->

						</div><!-- media -->
						<hr>



END;

		}
	}

	else {
		
		$feedback .= "<p class=\"feedback-warning\">Det finns ingen artikel i databasen med det ordet.</p>";
	}
}
$content .= <<<END

<div id="content">
	<div class="row">
		<div class="col-md-3">

		</div><!-- col md 3 -->
				
		<div class="col-md-6">
			<div class="panel panel-yellow">
				
				<div class="panel-heading">
					<h3 class="panel-title blue bold">Sökresultat för {$search}</h3>
				</div><!-- panel-heading -->
				
				<div class="panel-body search-result">

					<p class="search-result">
					{$feedback}
					{$searchResult}
					</p>
				</div><!-- panel body -->
			
			</div><!-- panel panel yellow -->

								
		</div><!-- col xs 6 col md 6 -->
		

		{$sponsorer}

		</div>
	</div><!-- row -->
</div><! -- content -->
END;

echo $header;
echo $content;
echo $footer;
?>