<?php
/*---------------------------------
aakare.php
info
---------------------------------*/

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$artikeltime = "";
$artikelnames = "";
$artikelnames_aakare = "";

// Hämtar ut den specifika artikeln 
if(!empty($_GET))
{
	$getartikelid = isset($_GET['ArtikelId']) ? $_GET['ArtikelId'] : '';

	$query = <<<END

		SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelPic, ArtikelPicThumb, ArtikelTimeStamp,
		 ArtikelSkribent, ArtikelFotograf
		FROM artikel
		WHERE ArtikelId = "{$getartikelid}";
END;

	$res = $mysqli->query($query) or die();

	if($res->num_rows > 0) {

		
		while($row = $res->fetch_object())
		{
			$artikelname = $row->ArtikelName;
			$artikelmessage = $row->ArtikelMessage;
			$artikeltimestamp = $row->ArtikelTimeStamp;
			
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

// Om inte det finns nån artikel som skickats i adressfältet så görs detta
else
{
	$query = <<<END

		SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelTimeStamp, kategori
		FROM artikel
		WHERE kategori = 'aakare'
		ORDER BY Artikeltimestamp
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

	SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelTimeStamp, kategori
	FROM artikel
	WHERE kategori = 'aakare'
	ORDER BY Artikeltimestamp
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


			<div class="collapse-in">
								
				<ul class="">
          								
	   				<a href="aakare.php?ArtikelId={$artikelId}">
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
					<div class="panel panel-blue">

						<div class="panel-heading">
						
						<!-- Om oss undermeny -->
						
							<h3 class="panel-title yellow">Information / För Åkare</h3>
						</div><!-- panel heading -->
						</a>
					
							
						<div class="panel-body">
							{$artikelnames}
						</div><!-- panel body -->
					</div><!-- panel panel blue -->									
				</div><!-- col md 3 -->
				
				<div class="col-xs-12 col-md-6">
					{$artikeltime}	
				</div><!-- mitten -->	
							
			<!-- Rad högre m sponsorkarusell-->

			<div class="col-md-3 pull-right">
				<div class="panel panel-grey">
					<div class="panel-heading">
						<h3 class="panel-title">Sponsorer</h3>
					</div><!-- panel-heading -->
					
					<div class="panel-body">
						
						<!-- Sponsor karusell -->
						<div id="myCarousel" class="carousel">
			  				<div id="my-carousel" class="carousel slide" data-ride="carousel">
				       			<div class="carousel-inner">
									<div class="item active">
										<a href="http://www.sporrong.se/" target="_blank">
			   								<img src="sponsor/sporrong.png" class="karusell-bild" alt="Sporrong">
		  	      						</a>
									</div><!-- item active -->

		               				<div class="item">
		               					<a href="http://nofall.se/" target="_blank">
			   								<img src="sponsor/no_fall.png" class="karusell-bild" alt="No Fall">
			   							</a>
									</div><!-- item -->

		               				<div class="item">
		               					<a href="http://www.mpskating.com/" target="_blank">
									   		<img src="sponsor/mp_skating.png" class="karusell-bild" alt="MP Skating">
									   	</a>
									</div><!-- item -->

		           				</div><!-- carousel inner -->
		           			</div><!-- carousel slide -->			
		     			</div><!-- myCarousel -->
			     	</div><!-- panel body -->
				</div><!-- panel panel-blue-->
				</div> <!-- row -->
	       </div><!-- AVsluta content DIV -->

END;

echo $header;
echo $content;
echo $footer;

?>
