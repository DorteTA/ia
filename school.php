<?php
/*---------------------------------
school.php
Traena
Skridskoskola
---------------------------------*/

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");
$artikeltime = "";

$query = <<<END

	SELECT ArtikelId, ArtikelName, ArtikelMessage, ArtikelTimeStamp, kategori
	FROM artikel
	WHERE kategori = 'skola'
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

		$artikeltime .= <<<END

		<div class="panel panel-yellow">
			<div class="panel-heading">
				<h3 class="panel-title">{$artikelname}</h3>
			</div><!-- panel-heading -->
				<div class="panel-body">
					{$artikelmessage}<br><br>	
					{$artikeltimestamp}<br><br>		
				</div><!-- panel-body -->
		</div><!-- panel panel-yellow -->
	

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
						
							<h3 class="panel-title yellow">Skridskoskola</h3>
						</div><!-- panel heading -->
						</a>
					
							
						<div class="panel-body">
							<div class="collapse-in" id="dokument">
								
									<ul class="">
          								<li class="dropdown-left">
	   									<a data-toggle="collapse" href="#blanketter" aria-expanded="false"
										aria-controls="collapseExample">
	   										<li>Så börjar du med konståkning <b class="caret"></b></li>
	   									</a>

	   									<!-- blanketter och brochurer -->
	   									<div class="collapse" id="blanketter">
	   										Piruetter<br>
	   										Hopp
	   									</div>
	   									<a href="#">
	   										<li>Hoppskola <b class="caret"></b></li>
	   									</a>
	   									<a href="#">
	   										<li>Bli konståkare i  7 steg <b class="caret"></b></li>
	   									</a>	   									
	   								</ul>
								</div><!-- collapse -->
						</div><!-- panel body -->
					</div><!-- panel panel blue -->									
				</div><!-- col md 3 -->
				
				<div class="col-xs-12 col-md-6">
					{$artikeltime}

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
