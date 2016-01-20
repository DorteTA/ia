<?php
/*---------------------------------
skatesweden.php
Om oss
Skatesweden
---------------------------------*/

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$artikeltime = "";
$artikelnames = "";
$artikelpic = "";
$artikelpic_thumb = "";
$artikelskribent = "";
$artikelnews = "";
$artikelfotograf = "";

// Hämtar ut den specifika artikeln
if(!empty($_GET))
{
	$getartikelid = isset($_GET['ArtikelId']) ? $_GET['ArtikelId'] : '';

	$query = <<<END

		SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelTimeStamp, ArtikelPic, ArtikelPicThumb,
		 ArtikelSkribent, ArtikelFotograf, kategori
		FROM artikel
		WHERE ArtikelId = "{$getartikelid}";
END;

	$res = $mysqli->query($query) or die();

	if($res->num_rows > 0)
	{
	//Loops through results
	while($row = $res->fetch_object()) {

		// Sätter tid till svenska
		setlocale(LC_TIME, "sv_SE", "sv_SE.65001", "swedish");   
		$date = strtotime($row->ArtikelTimeStamp);

		//encode gör att datum från DB visas på svenska
		utf8_encode($date = strftime("%#d %B %Y", $date));
		
		$artikelid = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$artikelmessage = $row->ArtikelMessage;
		$artikelsubtext = substr($artikelmessage, 0, 75);
		$artikelpic = $row->ArtikelPic;
		$artikelpic_thumb = $row->ArtikelPicThumb;
		$artikeltimestamp = $row->ArtikelTimeStamp;
		$artikelskribent = $row->ArtikelSkribent;
		$artikelfotograf = $row->ArtikelFotograf;
		$kategori = $row->kategori;

		$artikeltime = <<<END

		<div class="panel panel-yellow">
			<div class="panel-heading">
				<h3 class="panel-title">{$artikelname}</h3>
			</div><!-- panel-heading -->
				<div class="panel-body">
					<p class="text-muted">
						Publicerad {$date} av {$artikelskribent}
					</p>
					{$artikelmessage}
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

		SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelTimeStamp, ArtikelPic, ArtikelPicThumb,
		 ArtikelSkribent, ArtikelFotograf, kategori
		FROM artikel
		WHERE kategori = 'skatesweden'
		ORDER BY ArtikelTimeStamp DESC;
END;

	$res = $mysqli->query($query) or die();

		if($res->num_rows > 0)
		{
			while($row = $res->fetch_object())
			{
				//Sätter tid till svenska
				setlocale(LC_TIME, "sv_SE", "sv_SE.65001", "swedish");   
				$date = strtotime($row->ArtikelTimeStamp);

				//encode gör att datum från DB visas på svenska
				utf8_encode($date = strftime("%#d %B %Y", $date));
				
				$artikelid = $row->ArtikelId;
				$artikelname = $row->ArtikelName;
				$artikelmessage = $row->ArtikelMessage;
				$artikelsubtext = substr($artikelmessage, 0, 75);
				$artikelpic = $row->ArtikelPic;
				$artikelpic_thumb = $row->ArtikelPicThumb;
				$artikeltimestamp = $row->ArtikelTimeStamp;
				$artikelskribent = $row->ArtikelSkribent;
				$artikelfotograf = $row->ArtikelFotograf;
				$kategori = $row->kategori;

				$artikeltime = <<<END


				<div class="panel panel-yellow">
					
					<div class="panel-heading">
					
						<h3 class="panel-title">{$artikelname}</h3>
					</div><!-- panel-heading -->
						<div class="panel-body">
							{$artikelpic}
					
							<p class="text-muted">
							Publicerad: {$date} av ...
							</p>

							<p>				
							{$artikelmessage}
							</p>	
						</div><!-- panel-body -->
				</div><!-- panel panel-yellow -->
			

END;
			}
		}
}
// Hämtar ut undermenyn när användaren klickat på en länk
$query = <<<END

	SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelTimeStamp, ArtikelPic, ArtikelPicThumb,
	 AtikelSkribent, ArtikelFotograf, kategori
	FROM artikel
	WHERE kategori = 'skatesweden'
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
		$artikelpic = $row->ArtikelPic;
		$artikelskribent= $row->ArtikelSkribent;
		$artikelfotograf= $row->ArtikelFotograf;

		$artikelnames .= <<<END


			<div class="collapse-in" id="dokument">
								
				<ul class="">
	
	   				<a href="om.php?ArtikelId={$artikelId}">
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
						
							<h3 class="panel-title yellow">Om oss / Skatesweden</h3>
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

							
				<!-- Rad högre -->
				<div class="col-md-3 pull-right">
					<div class="panel panel-blue">
						<div class="panel-heading">
							<h3 class="panel-title">Sponsorer</h3>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<p>På index-sidan ska här ligga en carousel m sponsorer och samarbetspartnare.
							</p>
							<p class="divider"></p>
							<p>asdf as adfsfgsfgsdfgsdfg dfg dfg df gsdfg sdfg sdfg sdf gsdfg sdfg
							sdf sdf asfa ssdfaj sdf. 
							ksadfj asdf asdf asdf... asdf asdfasdf asdf sadf asdf as adfsfgsfg
							sdfgsdfg dfg dfg df.
							</p>
						</div><!-- panel-body -->
					</div><!-- panel panel-blue -->								
				</div><!-- col-xs-6 col-md-3 -->
			</div> <!-- row -->
       </div><!-- AVsluta content DIV -->

END;

echo $header;
echo $content;
echo $footer;

?>
