<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$feedback = "";

if(isset($_GET['search']))
{
// Hämtar ut från guidereviewinfo där titlar liknar sökordet
	$query = <<<END
		SELECT * FROM artikel
		WHERE artikelName LIKE '%{$search}%';
END;
	$result = $mysqli->query($query) or die();

	if($result->num_rows > 0)
	{
		while($row = $result->fetch_object())
		{
			$artikelid = $row->artikelid;
			$artikelname = $row->artikelName;
			$artikeltext = $row->artikelMessage;
			$artikeltimestamp = $row->artikelTimeStamp;
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
					<div class="panel panel-blue">
						
						<!-- Skridskoskola undermeny -->
						<div class="panel-body">
							<div class="media">
								
								<div class="media-body">
									Skridskoskola
								</div><!-- media body -->
							</div><!-- media -->	
						</div><!-- panel-body -->
						
					</div><!-- panel panel-blue -->								
				</div><!-- col-md-3 -->
				
				<div class="col-xs-12 col-md-6">
					{$article}

					<div class="panel panel-yellow">
						<div class="panel-heading">
							<h3 class="panel-title">Rubrik 2</h1>
						</div><!-- panel-heading -->
							<div class="panel-body">
								<p>Lucas ipsum dolor sit amet wedge mace kessel skywalker palpatine ackbar skywalker mustafar
								coruscant lobot. Darth yavin yoda obi-wan windu solo. Organa jinn dooku twi'lek solo amidala yoda
								jade moff. Hutt fett yoda solo ventress k-3po hutt binks solo. Ahsoka bothan anakin owen. Leia amidala
								skywalker organa luke jinn organa kit hutt. Yavin jinn lobot solo darth moff jabba ponda naboo. Boba moff
								jawa solo padmé calamari. Wookiee dagobah jabba skywalker moff tatooine. Fett antilles sidious antilles
								calrissian fisto naboo.
								</p>
					
							</div><!-- panel-body -->
					</div><!-- panel panel-yellow -->
			
				<!-- rad center, 2 kolumner layout-->
				
				<div class="col-xs-12 col-md-6 sans-padding-left pull-left">
					<div class="panel panel-yellow">
						<div class="panel-heading">
							<h3 class="panel-title">Rubrik 3</h3>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<p>Ipsum lapsum tralalla lal
							al laaa!
							asfa ssdfaj sdf ksadfj asdf asdf asdf asdf asdfasdf asdf sadf asdf
							as adfsfgsfgsdfgsdfg dfg dfg df gsdfg sdfg sdfg sdf gsdfg sdfg sdf
							sdf asfa ssdfaj sdf ksadfj asdf asdf asdf asdf asdfasdf asdf sadf 
							asdf as adfsfgsfgsdfgsdfg dfg dfg df gsdfg sdfg sdfg sdf gsdfg sdfg
							</p>
									
						</div><!-- panel-body -->
					</div><!-- panel panel-yellow -->
				</div><!-- col-md-6 -->
				
				<!-- rad center, andra kolumn layout -->

				<div class="col-md-6 sans-padding-right pull-left">
					<div class="panel panel-yellow">
						<div class="panel-heading">
							<h3 class="panel-title">Rubrik 4</h3>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<p>Ipsum lapsum tralalla lal
							al laaa!
							asfa ssdfaj sdf ksadfj asdf asdf asdf asdf asdfasdf asdf sadf asdf
							as adfsfgsfgsdfgsdfg dfg dfg df gsdfg sdfg sdfg sdf gsdfg sdfg sdf
							sdf asfa ssdfaj sdf ksadfj asdf asdf asdf asdf asdfasdf asdf sadf 
							asdf as adfsfgsfgsdfgsdfg dfg dfg df gsdfg sdfg sdfg sdf gsdfg sdfg
							</p>
									
						</div><!-- panel-body -->
					</div><!-- panel panel-yellow -->
				</div><!-- col-xs-6 col-md-3 -->				
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