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
$artikeltime = "";
$artikeltime_aakare = "";
$artikelnames = "";
$artikelnames_aakare = "";
$kategori = "";

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

<div class="panel panel-yellow">
	<div class="panel-heading">
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

		<!-- Själva artikeln -->			
		<p>{$artikelmessage}</p>

	</div><!-- panel body -->
</div><!-- panel panel yellow -->
	

END;
		}
	}
}

// Om inte det finns nån artikel som skickats i adressfältet så görs detta
else {

	$query = <<<END

		SELECT *
		FROM artikel
		WHERE kategori = 'Arrangörer'
		ORDER BY Artikeltimestamp
END;


	$res = $mysqli->query($query) or die();

		if($res->num_rows > 0) {

			while($row = $res->fetch_object()) {

			$artikelname = $row->ArtikelName;
			$artikelmessage = $row->ArtikelMessage;
			$artikelpic = $row->ArtikelPic;
			$artikelpic_thumb = $row->ArtikelPicThumb;
			$artikeltimestamp = $row->ArtikelTimeStamp;
			$artikelskribent= $row->ArtikelSkribent;
			$artikelfotograf = $row->ArtikelFotograf;
			$kategori = $row->Kategori;

			$artikeltime = <<<END

<div class="panel panel-yellow">
	<div class="panel-heading">
		<h3 class="panel-title blue bold">{$artikelname}</h3>
	</div><!-- panel-heading -->

	<div class="panel-body">
		{$artikelmessage}
	</div><!-- panel-body -->
</div><!-- panel panel-yellow -->
			

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

// <a href="info.php?ArtikelId={$artikelId}">
//	   					<li>{$artikelname}</li>
//	   				</a>
// 

$res = $mysqli->query($query) or die();

if($res->num_rows > 0) {

	while($row = $res->fetch_object()) {

		$artikelId = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$kategori = $row->Kategori;

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

$content = <<<END

			
<div id="content">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-yellow">

				<div class="panel-heading">
						
					<h3 class="panel-title blue bold">Tävla / Tävlingsinformation</h3>
				</div><!-- panel heading -->
				
				<div class="panel-body">
					<div class="collapse-in" id="dokument">
								
						<ul class="meny">
          					<li class="dropdown-left">
	   							<a data-toggle="collapse" href="#arrangorer" aria-expanded="false"
								aria-controls="collapseExample">
	   								<li>Arrangörer <b class="caret"></b></li>
	   							</a>

	   							<!-- Arrangorer -->
	   							
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
	   							</div>
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

				<div class="col-xs-12 col-md-6">

					{$artikeltime}	
				</div><!-- mitten -->	
							
							
		<!-- Rad högre m sponsorkarusell-->

		{$sponsorer}

		</div><!-- col xs 6 col md 3 -->
	</div><!-- row -->
</div><!-- content -->

END;

echo $header;
echo $content;
echo $footer;

?>
