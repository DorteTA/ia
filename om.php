<?php
/*---------------------------------
om.php
Om oss
Dokument
---------------------------------*/

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$content = <<<END

			
       	<div id="content">
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-blue">
						
						<!-- Om oss undermeny -->
						<div class="panel-body">
							

							<!-- dropdown meny Om oss -->
							<ul class="nav navbar-nav">
								<li class="dropdown">
									Om oss <b class="caret"></b>
									
									<ul class="dropdown-menu-left">
										<li><a href="#">Dokument <b class="caret"></b></a></li>
										<li><a href="#">Historia <b class="caret"></b></a></li>
										<li><a href="#">Skate Sweden <b class="caret"></b></a></li>
									</ul>
								</li>
							</ul>

						</div><!-- panel-body -->
						
					</div><!-- panel panel-blue -->								
				</div><!-- col-md-3 -->
				
				<div class="col-xs-12 col-md-6">
					<div class="panel panel-yellow">
						<div class="panel-heading">
							<h3 class="panel-title">Svenska landslaget</h3>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<p><img src="http://placehold.it/600x300" class="img-responsive img-rounded img-100x">					
							Lucas ipsum dolor sit amet owen darth skywalker r2-d2 calamari jango darth calamari leia hutt.
							Skywalker hutt grievous dagobah obi-wan yoda luke calamari antilles. Mustafar anakin kit fett
							<strong>wookiee</strong> mon cade darth. Obi-wan kamino kessel naboo ponda organa mustafar.
							Boba hutt solo ackbar. Wedge jinn skywalker mothma greedo antilles. Mustafar organa r2-d2
							antilles moff antilles ponda darth.
							</p>
							<p>
							Wicket anakin skywalker mara calamari kessel. Fisto jawa
							cade c-3po naboo. Moff moff moff vader grievous c-3p0 organa.Lobot organa tusken raider kit
							wedge mon bespin darth fett. Darth leia obi-wan organa. Mace sidious windu sidious cade moff
							secura. R2-d2 wedge lobot jango jango ewok darth antilles anakin. Baba han jabba mara utapau.
							Darth mandalore yoda darth qui-gon luke jango skywalker skywalker. Organa mace organa dantooine
							ventress padmé.
							</p>
														
						</div><!-- panel-body -->
					</div><!-- panel panel-yellow -->
					
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
