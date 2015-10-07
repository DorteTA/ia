<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$feedback = "";
$article = "";
$month_6 = "";

if(isset($_GET['month_6']))
{

	$month_6 = $_GET['month_6'];

	$query = <<<END
		SELECT * FROM artikel
		WHERE ArtikelTimeStamp LIKE '%2015-06%'
		GROUP BY maanad DESC;
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
							{$month_6}
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
		$feedback .= "<p class=\"text-yellow\">Det finns ingen artikel i databasen med det namnet.</p>";
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
					Månad			
					{$month_6}
				
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