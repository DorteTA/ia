<?php
/*---------------------------------
arrangera.php
elit
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
$kategori = "";

// Hämtar ut den specifika artikeln 
if(!empty($_GET))
{
	$getartikelid = isset($_GET['ArtikelId']) ? $_GET['ArtikelId'] : '';

	$query = <<<END

		SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelTimeStamp, Kategori
		FROM artikel
		WHERE ArtikelId = "{$getartikelid}";
END;

	$res = $mysqli->query($query) or die();

	if($res->num_rows > 0)
	{
		while($row = $res->fetch_object())
		{
			$artikelname = $row->ArtikelName;
			$artikelmessage = $row->ArtikelMessage;
			$artikeltimestamp = $row->ArtikelTimeStamp;
			$kategori = $row->Kategori;

			$artikeltime = <<<END

<div class="panel panel-yellow">
	<div class="panel-heading">

	<h3 class="panel-title">
	{$artikelname}
	</h3>

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
// Om inte det finns nån artikel som skickats i adressfältet så görs detta
else
{
	$query = <<<END

		SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelTimeStamp, Kategori
		FROM artikel
		WHERE kategori = 'arrangera'
		ORDER BY ArtikelTimeStamp DESC;
END;

	$res = $mysqli->query($query) or die();

		if($res->num_rows > 0)
		{
			while($row = $res->fetch_object())
			{
				$artikelname = $row->ArtikelName;
				$artikelmessage = $row->ArtikelMessage;
				$artikeltimestamp = $row->ArtikelTimeStamp;

				$artikeltime = <<<END

<div class="panel panel-yellow">
	<div class="panel-heading">
	<h3 class="panel-title">
		{$artikelname}
	</h3>
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

	SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelTimeStamp, Kategori
	FROM artikel
	WHERE kategori = 'arrangera'
	ORDER BY ArtikelTimeStamp;

END;

$res = $mysqli->query($query) or die();

if($res->num_rows > 0)
{
	while($row = $res->fetch_object())
	{
		$artikelId = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$artikelmessage = $row->ArtikelMessage;
		$artikeltimestamp = $row->ArtikelTimeStamp;

		$artikelnames .= <<<END

<div class="collapse-in" id="dokument">				
	<ul class="">     								
	<a href="arrangera.php?ArtikelId={$artikelId}">
		<li>{$artikelname}</li>
	</a>
	</ul>
	
	<div class="collapse-in" id="dokument">
	  <a href="arkiv_juni.php?maanad='Juni'">
	  	Juni
	  </a>						
	</div><!-- collapse -->	   									
	   			
</div><!-- collapse -->
					
END;
	}
}
$content = <<<END
			
<div id="content">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-blue">

				<div class="panel-heading">
					<!-- Om oss undermeny -->		
					<h3 class="panel-title yellow">Förening / Arrangera tävling</h3>
				</div><!-- panel heading -->					
							
				<div class="panel-body">
					{$artikelnames}
				</div><!-- panel body -->
			</div><!-- panel panel blue -->									
		</div><!-- col md 3 -->
				
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
