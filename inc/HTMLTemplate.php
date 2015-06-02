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

    <div class="col-xs-6 col-md-3">
      <ul class="list-inline padding">
       <li class="yellow">Inloggad som: <a class="li yellow" href="profile.php"><strong>{$_SESSION["username"]}</strong></a> &middot; <a class="li yellow" href="logout.php">Logga ut</a> &middot;</li>
      </ul>
    </div><!-- col-xs-6 col-md-3 -->


END;
}
else
{
  $adminHTML = <<<END

    <div class="col-xs-6 col-md-3">
      <ul class="list-inline padding">
        <li class="yellow"><a class="li yellow" href="login.php">Logga in</a> &middot; <a class="li yellow" href="register.php">Registrera dig</a></li>
      </ul>
    </div><!-- col-xs-6 col-md-3 -->
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

    <!-- home -->
    <ul class="nav navbar-nav">
        <li class="dropdown">
	        <a href="index.php">Hem </a>
        </li>
    </ul>

    <!-- dropdown meny Om oss -->
      <ul class="nav navbar-nav">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Om oss <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="om.php">Dokument</a></li>
            <li><a href="historia.php">Historia</a></li>
            <li><a href="om.php">Skate Sweden</a></li>
          </ul>
        </li>
      </ul>

      <!-- dropdown meny Träna -->
	  <ul class="nav navbar-nav">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Träna <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="school.php">Skridskoskola</a></li>
            <li><a href="elit.php">Elitnivåträning</a></li>
            <li><a href="bedom.php">Så bedöms konståkning</a></li>
            <li><a href="elitsatsning.php">Elitsatsning</a></li>
          </ul>
        </li>
      </ul>

	  <!-- Dropdown meny Tävla -->
	  <ul class="nav navbar-nav">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tävla <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="elitserien.php">Elitserien 2014-2015</a></li>
            <li><a href="regler.php">Regler</a></li>
            <li><a href="#">EM 2015</a></li>
            <li><a href="#">Svenska mästerskapen 2014</a></li>
            <li><a href="#">Tävlingar och resultat</a></li>
            <li><a href="#">Medaljer 1984-2014</a></li>
            <li><a href="#">Information</a></li>
          </ul>
        </li>
      </ul>
	  
	   
      <!-- högre delen av navbar med 3 dropdown menyer -->
	 
	  <!-- dropdown meny Driva Förening -->
	  <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Driva Förening <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Starta förening</a></li>
            <li><a href="#">Arrangera tävling</a></li>
            <li><a href="#">Ansöka om namnbyte</a></li>
            <li><a href="#">Riktlinjer vid istidsförhandlingar</a></li>
          </ul>
        </li>
      </ul>

	  <!-- dropdown meny Engagera dig -->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Engagera dig <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Utvecklingskommiten</a></li>
            <li><a href="#">Utbildning</a></li>
          </ul>
        </li>
      </ul>
	  
	  <!-- dropdown meny Kontakta oss -->
	  <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kontakta oss <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Press</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Lediga Jobb</a></li>
            <li><a href="#">Avdelningar</a></li>
            <li><a href="#">Distrikt och föreningar</a></li>
            
          </ul>
        </li>
      </ul>
	  
	 
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- undermeny m logga i, shoppa, se varukorg -->
<div class="undermeny">
	<div class="row">
		{$adminHTML}

		<!-- undermeny tom -->
		<div class="col-xs-12 col-md-6">
			<ul class="list-inline padding">
				<li class="yellow"><a class="li yellow" href="http://skatesweden.sporrongshop.com/Startpage/Startpage.aspx?MenuID=3121">Butik</a></li>
			</ul>
		</div><!-- col-xs-6 col-md-3 -->

		<!-- undermeny m sök form -->
		<div class="col-xs-6 col-md-3">
			<div class="col-xs-12 pull-left">
				<form action="search.php" method="GET" class="navbar-form navbar-left" role="search">
					<div class="form-group">
					 
                <input type="text" class="form-control-search pull-right" id="searchfield" name="search" placeholder="Sök..." required>
                <input type="submit" value="sök">
               
					</div><!-- form-group -->
				</form>	
			</div>
		</div><!-- col-xs-6 col-md-3 -->
	</div><!-- row -->
</div><!-- undermeny -->

		
</div><!-- header -->
	

END;

$content = <<<END

			
  

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