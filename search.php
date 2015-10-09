<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$feedback = "";
$article = "";
$search = "";

if(isset($_GET['search']))
{

	$search = $_GET['search'];

	$query = <<<END
		SELECT * FROM artikel
		WHERE artikelName LIKE '%{$search}%';
END;
	$result = $mysqli->query($query) or die();

	if($result->num_rows > 0)
	{
		while($row = $result->fetch_object())
		{
			$artikelname = $row->ArtikelName;
			$artikeltext = $row->ArtikelMessage;
			$artikeltimestamp = $row->ArtikelTimeStamp;
			$artikelpic = $row->ArtikelPic;

			$article .= <<<END
				<div class="panel panel-yellow">
					<div class="panel-heading">
						<h3 class="panel-title">{$artikelname}</h3>
					</div><!-- panel-heading -->
						<div class="panel-body">
							
							{$artikelpic}
							{$artikeltext}
							<br>	
							{$artikeltimestamp}

						</div><!-- panel-body -->
				</div><!-- panel panel yellow -->
END;
		}
	}
	else
	{
		$feedback .= "<p class=\"feedback-warning\">Det finns ingen artikel i databasen med det ordet.</p>";

	}
}
$content = <<<END

			
       	<div id="content">
			<div class="row">
				<!-- vänster -->
				<div class="col-md-3">	
				</div><!-- col md 3 -->
				
				<!-- kolumn mitten -->
				<div class="col-xs-12 col-md-6">
					{$article}
					{$feedback}
				
				</div><!-- mitten -->	
							
				<!-- Rad högre -->
				<div class="col-md-3 pull-right">
				</div><!-- högre -->

			</div> <!-- row -->
       </div><!-- AVsluta content DIV -->

END;

echo $header;
echo $content;
echo $footer;
?>