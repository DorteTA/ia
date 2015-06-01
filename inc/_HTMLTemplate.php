<?php
/*------------------------------------
HTMLTemplate.php
IA projekt
Contains HTML code that is the same
over several pages
------------------------------------*/

session_start();

$adminHTML = "";

if(isset($_SESSION["username"])) {

 $adminHTML = <<<END
				<li class="yellow">Inloggat som: <a class="li yellow" href="profile.php"><strong>{$_SESSION["username"]}</strong></a> &middot; <a class="li yellow" href="logout.php">Logga ut</a> &middot;</li>

END;
}

$header = <<<END
<!doctype html>
<html>
	<head>
	<!---------------------------------
	index.html
	Start page with welcome
	The first page the visitor sees
	HTML template for IA webbplats
	----------------------------------->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1"><!-- Responsiv -->

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/ia4.css" rel="stylesheet">
		
		<!-- Bootstrap core JavaScript börjar
			================================================== -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
			<script src="js/docs.min.js"></script>
	
		<title>IA webbplats | Konståkning</title>

	</head>

	<body>
		<div id="container"><!-- Börja container DIV -->
			<div class="fixed" id="header">
	
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header fixed">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Om oss <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Förbundsnyheter</a></li>
            <li><a href="#">Förbundsinformation</b></a></li>
			<li><a href="#">Partners & Sponsorer</a></li>
			<li><a href="#">Stipendium & Utmärkelse</a></li>
			<li><a href="#">Dokument</a></li>
            <li class="divider"></li>
            <li><a href="#">Kontakta oss</a></li>
            <li class="divider"></li>
            <li><a href="#">Länkar</a></li>
          </ul>
        </li>
      </ul>
	  <ul class="nav navbar-nav">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Konståkning <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Grenar inom konståkning</a></li>
            <li><a href="#">så här bedöms konståkning</a></li>
            <li><a href="#">Börja med konståkning</a></li>
            <li class="divider"></li>
            <li><a href="#">Sök förening</a></li>
          </ul>
        </li>
      </ul>
	  
	  <ul class="nav navbar-nav">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Föreningar <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Information</a></li>
            <li><a href="#">Skridskoskola</a></li>
            <li><a href="#">Starta Förening</a></li>
            <li class="divider"></li>
            <li><a href="#">Dokument & Blanketter</a></li>
          </ul>
        </li>
      </ul>
	  
	  <ul class="nav navbar-nav">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Elit <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Landslag</a></li>
            <li><a href="#">Elitserie</a></li>
            <li><a href="#">Ranking</a></li>
			<li class="divider"></li>
            <li><a href="#">Antidoping</a></li>
          </ul>
        </li>
      </ul>
	  
      <!-- högre delen av navbar med 3 dropdown menyer -->
	  
	  <!-- dropdown meny utbildning -->
      <ul class="nav navbar-nav navbar-right padding-form">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Utbildning <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Anmälan</a></li>
            <li><a href="#">Nationella Idrottsgymnasiet</a></li>
            <li><a href="#">SISU-utbildarna</a></li>
          </ul>
        </li>
      </ul>
	  
	  <!-- dropdown meny Tävling -->
	  <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tävling &amp; Evenemang <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Kalender</a></li>
            <li><a href="#">Information</a></li>
            <li><a href="#">Resultat</a></li>
          </ul>
        </li>
      </ul>
	  
	  <!-- dropdown meny Media -->
	  <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Media <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Nyheter</a></li>
			<li><a href="#">Arkiv</a></li>
            <li><a href="#">Kontakt</a></li>
          </ul>
        </li>
      </ul> 
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- undermeny m logga i, shoppa, se varukorg -->
<div class="undermeny">
	<div class="row">
		<div class="col-xs-6 col-md-3">
			<ul class="list-inline padding">
				<li class="yellow"><a class="li yellow" href="login.php">Logga in</a> &middot; <a class="li yellow" href="register.php">Registrera dig</a></li>
			</ul>
		</div><!-- col-xs-6 col-md-3 -->

		<!-- undermeny tom -->
		<div class="col-xs-12 col-md-6">
			<ul class="list-inline padding">
				<li class="yellow">{$adminHTML}<a class="li yellow" href="shoppa.php">Shoppa</a> &middot; <a class="li yellow" href="#">Varukorg <b class="caret"></b></a></li>
			</ul>
		</div><!-- col-xs-6 col-md-3 -->

		<!-- undermeny m sök form -->
		<div class="col-xs-6 col-md-3">
			<div class="col-xs-12 pull-left">
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Sök"><button type="submit" class="btn-search pull-right"><span class="glyphicon glyphicon-search"></span></button>
					</div><!-- form-group -->
				</form>	
			</div>
		</div><!-- col-xs-6 col-md-3 -->
	</div><!-- row -->
</div><!-- undermeny -->

		
</div><!-- header -->
	

END;

$content = <<<END

			
       	<div id="content">
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-blue">
						<div class="panel-heading">
							<h3 class="panel-title">Nyheter</h3>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<div class="media">
								<a class="pull-left" href="#">
								<img class="media-object img-rounded" src="http://placehold.it/64x64" alt="...">
								</a>
								<div class="media-body">
								<h4 class="media-heading">Se film om projektet Jämlik Ishall</h4>
								<small>2014-04-30</small>
								<p>"Förbundets utvecklingsprojekt "Jämlik Ishall" engagerar allt fler föreningar och kommuner runt om i landet.
								 <p><a class="btn btn-blue btn-xs" role="button">Läs mer</a></p>
								</div><!-- media body -->
							</div><!-- media -->	
						</div><!-- panel-body -->
						
						<div class="panel-body">
							<div class="media">
								<a class="pull-left" href="#">
								<img class="media-object img-rounded" src="http://placehold.it/64x64" alt="...">
								</a>
								<div class="media-body">
								<h4 class="media-heading">Se film om projektet Jämlik Ishall</h4>
								<small>2014-04-30</small>
								<p>"Förbundets utvecklingsprojekt "Jämlik Ishall" engagerar allt fler föreningar och kommuner runt om i landet.
								 <p><a class="btn btn-blue btn-xs" role="button">Läs mer</a></p>
								</div><!-- media body -->
							</div><!-- media -->	
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

$footer = <<<END
	    <div class="footer border-bottom-radius">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<ul class="list-inline">
							<li class="yellow"><a class="li yellow" href="#">Kontakta oss</a> &middot; <a class="li yellow" href="#">FAQ</a> &middot; <a class="li yellow" href="#">Media</a> &middot; <a class="li white" href="#">Samarbetspartnare</a> &middot; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="#"><img src="img/facebook.png"></a> &nbsp; <a href="#"><img src="img/twitter.png"></a> &nbsp; <a href="#"><img src="img/youtube.png"></a></li>
						</ul>
					</div><!-- col-md-12 -->
					<div class="col-md-12">
						<p class="text-center white">Copyright &copy; 2014 Svenska Konståkningsförbundet.</p>
					</div>
				</div><!-- row -->
			</div><!-- container -->
		</div><!-- footer -->
	</div><!-- container class DIV -->

</body>
</html>


END;
?>