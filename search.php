<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

// Variabler
$feedback = "";
$article = "";
$search = "";
$searchResult = "";
$artikelpic = "";
$artikelpic_thumb = "";

if(isset($_GET['search']))
{

	$search = $_GET['search'];

	$query = <<<END
		SELECT * FROM artikel
		WHERE artikelName
		OR artikelMessage
		LIKE '%{$search}%'
		ORDER by ArtikelTimeStamp DESC;
END;
	$result = $mysqli->query($query) or die();

	if($result->num_rows > 0)
	{
		while($row = $result->fetch_object())
		{
					// Sätter tid till svenska
		setlocale(LC_TIME, "sv_SE", "sv_SE.65001", "swedish");   
		$date = strtotime($row->ArtikelTimeStamp);
		
		//encode gör att datum från DB visas på svenska
		utf8_encode($date = strftime("%#d %B %Y", $date));
		
		$artikelid = $row->ArtikelId;
		$artikelname = $row->ArtikelName;
		$artikelmessage = $row->ArtikelMessage;
		$artikelsubtext = substr($artikelmessage, 0, 80);
		$artikelpic = $row->ArtikelPic;
		$artikelpic_thumb = $row->ArtikelPicThumb;
		$artikeltimestamp = $row->ArtikelTimeStamp;
//		$userid = $row->userId;
//		$adminId = $row->adminId;


			$searchResult .= <<<END
							<div class="media">
								<a class="pull-left" href="index.php?ArtikelId={$artikelid}">
									{$artikelpic_thumb}
								</a>
								
								<div class="tid-nyheter">
									{$date}
								</div>
								
								<div class="media-body">
									<h4 class="media-heading">
										<a href="index.php?ArtikelId={$artikelid}">
											{$artikelname}
										</a>
									</h4>
									{$artikelsubtext} ...

								</div><!-- media body -->
							</div><!-- media -->
END;

		}
	}
	else
	{
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
					<h3 class="panel-title">Sökresultat</h3>
				</div><!-- panel-heading -->
				
				<div class="panel-body">

					{$feedback}
					{$searchResult}

				</div><!-- panel body -->
			
			</div><!-- panel panel yellow -->

								
		</div><!-- col xs 6 col md 6 -->
		

		{$sponsorer}

		</div><!-- sponsorer -->


	</div><!-- row -->
</div><! -- content -->
END;

echo $header;
echo $content;
echo $footer;
?>