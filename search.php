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
			$article .= <<<END
				<div class="panel panel-yellow">
			<div class="panel-heading">
				<h3 class="panel-title">{$artikelname}</h3><br><br>
			</div><!-- panel-heading -->
				<div class="panel-body">
					{$artikeltext}<br><br>	
					{$artikeltimestamp}<br><br>		
				</div><!-- panel-body -->
		</div><!-- panel panel-yellow -->
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
				<div class="col-md-3">
											
				</div><!-- col-md-3 -->
				
				<div class="col-xs-12 col-md-6">
					{$article}
				
				</div><!-- mitten -->	
							
				<!-- Rad högre -->
				<div class="col-md-3 pull-right">
				</div>	
			</div> <!-- row -->
       </div><!-- AVsluta content DIV -->

END;

echo $header;
echo $content;
echo $footer;
?>