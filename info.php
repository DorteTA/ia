<?php
/*---------------------------------
info.php
Tävla / Tävlingsinformation
---------------------------------*/

/*---------------------------------------------------
Använder HTML-mallen där CSS och javascript ingår,
så detta inte behövs tastas in på varje sida
---------------------------------------------------*/
include_once("inc/HTMLTemplate.php");

// Uppkoblingen till databasen
include_once("inc/Connstring.php");

// Variabler
$artikelnames = "";
$kategori = "";
$visa_artikel = "";

// Hämtar ut allt från den specifika artikeln
if(!empty($_GET)) {

	$getartikelid = isset($_GET['ArtikelId']) ? $_GET['ArtikelId'] : '';

	$query = <<<END

		SELECT *
		FROM artikel
		WHERE ArtikelId = "{$getartikelid}"
		ORDER by ArtikelTimeStamp DESC;

END;

/*---------------------------------------------------
Ger felmeddelande om databasen inte kan köras och
hänvisar till felnummer, annars körs den
---------------------------------------------------*/
$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);

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
	
	// Visar innehållet från artikeln i strängen $visa_artikel
	$visa_artikel = <<<END

<!-- gult panel -->
<div class="panel panel-yellow">

	<div class="panel-heading">

		<!-- Rubrik där kategori och artikelname visar resp kategori och rubriknamn -->
		<h3 class="panel-title blue bold">{$kategori} / {$artikelname}</h3>
	</div><!-- panel heading -->

	<div class="panel-body">

		<!-- Artikelbild -->
		
		<div class="col-lg-12 col-md-12 center-block img-responsive img-rounded
		sans-padding img-artikel pull-left">
			{$artikelpic}
		</div>
					
		<!-- Div som innehåller skribentnamn och fotografnamn -->
		
		<div class="col-lg-12 sans-padding pull-left">					
			<p class="col-md-6 sans-padding-left text-muted text-left pull-left">
				Publicerad: {$date} av <i>{$artikelskribent}</i> 
			</p>
			<p class="col-md-6 text-muted text-right sans-padding-right pull-right">
				{$artikelfotograf}
			</p>			
		</div>

		<!-- Själva artikeln m allt innehåll -->
		<p>{$artikelmessage}</p>

	</div><!-- panel body -->
</div><!-- panel panel yellow -->

END;
		}
	}
}

// Om inte det finns nån artikel som skickats i adressfältet så görs detta
else {

	// Välja allt från artiklar med kategori Arrangörer, visa aktuella först
	$query = <<<END

		SELECT *
		FROM artikel
		WHERE kategori = 'Arrangörer'
		ORDER BY ArtikelTimeStamp DESC;
END;

/*---------------------------------------------------
Ger felmeddelande om databasen inte kan köras och
hänvisar till felnummer, annars körs den
---------------------------------------------------*/
$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);

	if($res->num_rows > 0) {

		// Kör resultat
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

		$visa_artikel = <<<END

<div class="panel panel-yellow">

	<!-- Rubrik -->
	<div class="panel-heading">
		<h3 class="panel-title blue bold">{$artikelname}</h3>
	</div><!-- panel heading -->

	<!-- Artikel -->		
	<div class="panel-body">

		<!-- Artikelbild -->
		<div class="col-lg-12 col-md-12 center-block img-responsive
			 img-rounded sans-padding img-artikel pull-left">
			{$artikelpic}
		</div>
					
		<!-- Div som innehåller skribentnamn och fotografnamn -->
		<div class="col-lg-12 sans-padding pull-left">
						
			<p class="col-md-6 sans-padding-left text-muted text-left pull-left">
				Publicerad: {$date} av <i>{$artikelskribent}</i> 
			</p>

			<p class="col-md-6 text-muted text-right sans-padding-right pull-right">
				{$artikelfotograf}
			</p>
					
		</div><!-- skribent och fotograf -->

		<!-- Själva artikeln -->			
		<p>{$artikelmessage}</p>
	</div><!-- panel body -->
</div><!-- panel panel yellow -->

END;
			}
		}
}

// Hämtar ut undermenyn när användaren klickat på en länk
$query = <<<END

	SELECT ArtikelId, ArtikelName, Kategori
	FROM artikel
	WHERE kategori = 'Arrangörer'
	ORDER BY ArtikelTimeStamp ASC;
	
END;

/*------------------------------------------------
Ger felmeddelande om databasen inte kan köras och
hänvisar till felnummer, annars körs den
------------------------------------------------*/
$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);

// Om det finns några artiklar
if($res->num_rows > 0) {

	// Kör resultat
	while($row = $res->fetch_object()) {

		$artikelId = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$kategori = $row->Kategori;

		// Visar artikelnamn på länkar
		$artikelnames .= <<<END

<div class="collapse-in" id="dokument">
	<ul class="meny">		
		<a href="info.php?ArtikelId={$artikelId}">
			<li>{$artikelname}</li>
	   	</a>	   									
	</ul>
</div><!-- collapse -->
					
END;

	}
}

// innehållet med alla kolumner 3 x 6 x 3
$content = <<<END
		
<div id="content">
	<div class="row">

		<!-- Vänster kolumn -->
		<div class="col-md-3">
	
			<!-- gult panel -->
			<div class="panel panel-yellow">

				<div class="panel-heading">
						
					<h3 class="panel-title blue bold">Tävla / Tävlingsinformation</h3>
				</div><!-- panel heading -->
				
				<div class="panel-body">
					<div id="dokument" class="collapse-in">				
						<ul class="meny">
          					<li class="dropdown-left">
		   						<a data-toggle="collapse" href="#arrangorer" aria-expanded="false"
									aria-controls="collapseExample">
		   							<li>Arrangörer <b class="caret"></b></li>
		   						</a>

	   							<!-- Arrangörer -->
	   							
		   						<div class="collapse" id="arrangorer">
		   							{$artikelnames}
		   						</div>
		   						<a data-toggle="collapse" href="#akare" aria-expanded="false"
									aria-controls="collapseExample">
		   							<li>Åkare <b class="caret"></b></li>
		   						</a>

		   						<!-- åkare -->

		   						<div class="collapse" id="akare">
		   							<ul class="meny">
			   							<li><a href="info.php?ArtikelId=79">För åkare</a></li>
			   							<li><a href="info.php?ArtikelId=72">Åkarlicens</a></li>
										<li><a href="info.php?ArtikelId=80">Föreningsövergång</a></li>
										<li><a href="info.php?ArtikelId=81">Internationella
										tävlingar på egen bekostnad</a></li>
									</ul>
		   						</div><!-- akare -->
	   						
		   						<a data-toggle="collapse" href="#foraldrar" aria-expanded="false"
									aria-controls="collapseExample">
		   							<li>Föräldrar <b class="caret"></b></li>
		   						</a>
		   							
		   						<!-- föräldrar -->
		   							
		   						<div class="collapse" id="foraldrar">
		   							<ul class="meny">
			   							<li><a href="info.php?ArtikelId=82">För Föräldrar</a></li>
										<li><a href="info.php?ArtikelId=83">Konståkningen Vill</a></li>
										<li><a href="info.php?ArtikelId=84">Vanliga frågor</a></li>
									</ul>
		   						</div>
		   										   									
		   						<a data-toggle="collapse" href="#funktionarer" aria-expanded="false"
									aria-controls="collapseExample">
		   							<li>Funktionärer <b class="caret"></b></li>
		   						</a>
		   							
		   						<!-- funktionarer -->
		   							
		   						<div class="collapse" id="funktionarer">
		   							<ul class="meny">
			   							<li><a href="info.php?ArtikelId=85">För Funktionärer</a></li>
									</ul>
		   						</div>
		   					</li>					
	   					</ul>
					</div><!-- collapse -->	
				</div><!-- panel body -->
			</div><!-- panel panel blue -->									
		</div><!-- col md 3 -->
				
		<!-- mitten -->

		<!-- Centrerad kolumn -->

		<div class="col-md-6">
			{$visa_artikel}		
		</div><!-- Centrerad kolumn -->
							
							
		<!-- Högre  kolumn m sponsorkarusell-->

			{$sponsorer}

		</div><!-- col xs 6 col md 3 -->
	</div><!-- row -->
</div><!-- content -->

END;

// Stänger resultaten
$res->close();

// Stänger ned uppkoblingen med databasen
$mysqli->close();

// Visar innehållet av sidans header, content och footer
echo $header;
echo $content;
echo $footer;

?>
