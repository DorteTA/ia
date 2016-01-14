<?php

/*------------------------------------
HTMLTemplate.php
IA projekt
Innehåller HTML, Länkar till ia CSS,
Bootstrap, javascript och jQuery så
dessa inte behövs intastas manuellt
på alla sidor
------------------------------------*/

include_once("inc/Connstring.php");

session_start();

$userHTML = "";

if(isset($_SESSION["username"])) {

  // Användare-meny visar namn på den inloggade
  $userHTML = <<<END

    <div class="col-xs-4 col-md-3">
      <ul class="list-inline padding">
        <li class="yellow">Inloggad som:        
          <strong>{$_SESSION["username"]}</strong>
        </a> &middot; <a class="li yellow" href="logout.php">
          Logga ut
        </a>
        </li>
      </ul>
    </div><!-- col xs 6 col md3 -->

END;
}

else
{
  // Användare-meny där användare kan registrera sig och logga in
  $userHTML = <<<END

    <div class="col-xs-4 col-md-3">
      <ul class="list-inline padding">
        <li class="yellow"><a class="li yellow" href="login.php">Logga in</a> &middot;
         <a class="li yellow" href="register.php">Registrera dig</a></li>
      </ul>
    </div><!-- end col xs 4 col md 4-->
END;
}

$header = <<<END
<!doctype html>
<html>
	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1"><!-- Responsiv -->
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		
    <!-- IA stilmall -->
    <link href="css/ia.css" rel="stylesheet">
		
		<!-- Bootstrap core JavaScript börjar
			================================================== -->

      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
			
      <script src="js/docs.min.js"></script>
      <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>   
      
		<title>IA webbplats | Konståkning</title>

	</head>

	<body>

	<div id="container"><!-- Börja container DIV -->

		<div class="fixed" id="header">
	
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			
      <div class="container-fluid">
    
        <!-- Brand and toggle get grouped for better mobile display -->

        <div class="navbar-header fixed">
          <button type="button" class="navbar-toggle" data-toggle="collapse"
           data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <!-- Hem -->

        <ul class="nav navbar-nav">
            <li class="dropdown pull-left">
    	        <a href="index.php"><span class="glyphicon glyphicon-home"></span></a>
            </li>
        </ul>

        <!-- dropdown meny Om oss -->

          <ul class="nav navbar-nav">
              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Om oss <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="historia.php">Historia</a></li>
                <li><a href="om.php">Organisation</a></li>
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
              <li><a href="em2015.php">EM 2015</a></li>
              <li><a href="sm.php">Svenska mästerskapen 2014</a></li>
              <li><a href="resultat.php">Tävlingar och resultat</a></li>
              <li><a href="medaljer.php">Medaljörer 1984-2014</a></li>
              <li><a href="info.php">Tävlingsinformation</a></li>
            </ul>
          </li>
        </ul>
    	   
        <!-- högre delen av navbar med 3 dropdown menyer -->     
   	  
    	  <!-- dropdown meny Kontakt -->
    	
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Kontakt <b class="caret"></b>
          </a>
  
            <ul class="dropdown-menu">
              <li><a href="press.php">Press</a></li>
              <li><a href="faq.php">FAQ</a></li>
              <li><a href="ledigajobb.php">Lediga Jobb</a></li>
              <li><a href="avdelningar.php">Avdelningar</a></li>
              <li><a href="distrikt.php">Distrikt och föreningar</a></li>              
            </ul><!-- dropdown menu -->



          </li><!-- dropdown -->
        </ul><!-- nav navbar nav navbar right -->
    	  
        <!-- dropdown meny Förening -->
        
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Förening <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="starta.php">Starta förening</a></li>
              <li><a href="arrangera.php">Arrangera tävling</a></li>
              <li><a href="http://iof2.idrottonline.se/SvenskaKonstakningsforbundet/Drivaforening/Ansokomnamnbyte/"
               target="_blank">Ansöka om namnbyte</a></li>
              <li><a href="riktlinjer.php">Riktlinjer vid istidsförhandlingar</a></li>
            </ul>
          </li>
        </ul>

        <!-- dropdown meny Engagera dig -->
      
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Engagera dig <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="utvecklings.php">Utvecklingskommiten</a></li>
              <li><a href="utbildning.php">Utbildning</a></li>
            </ul>
          </li>
        </ul>

        </div><!-- /.navbar collapse -->
      </div><!-- /.container fluid -->
    </nav>

<!-- undermeny m logga i, shoppa, se varukorg -->

<div class="undermeny">
  <div class="row">
    {$userHTML}

    <!-- undermeny tom -->
    <div class="col-xs-6 col-sm-4 col-sx-4 col-md-4 pull-left">

      <ul class="list-inline padding pull-left">
        <li class="yellow">
          <a class="li yellow" href="http://skatesweden.sporrongshop.com/Startpage/Startpage.aspx?MenuID=3121" alt="Till Shopen" 
          target="_blank">
            Butik <span class="glyphicon glyphicon-shopping-cart"></span>
          </a>
        </li>
      </ul>

    </div><!-- col md 4 col sx 4 pull left -->

    <!-- Sök form -->

    <div class="col-xs-4 col-sm-4 pull-right undermeny-search border-none">
    
      <form class="navbar-form navbar-right border-none" role="search" action="search.php" method="GET">
        <div class="input-group border-none pull-right">
          <input type="text" id="search-size" class="form-control col-md-4 border-none" placeholder="Sök..." name="search" required>
            <span class="input-group-btn">
              <button type="submit" class="btn btn-search btn-warning">
                <span class="glyphicon glyphicon-search black"></span>
              </button>
            </span>
        </div><!-- input group pull right -->
      </form><!-- navbar form navbar left navbar search -->
    </div><!-- col md 4 pull right undermny search -->
  </div><!-- row -->
</div><!-- undermeny -->	
</div><!-- header -->

END;

$sponsorer = <<<END

<!-- Rad högre m sponsorkarusell-->

<div class="col-md-3 pull-right">
  <div class="panel panel-grey">

    <div class="panel-heading">
      <h3 class="panel-title">Sponsorer</h3>
    </div><!-- panel heading -->
        
    <div class="panel-body">
          
    <!-- Sponsor karusell -->
      <div id="myCarousel" class="carousel">
        <div id="my-carousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            
            <div class="item active">
              <a href="http://www.sporrong.se/" target="_blank">
                <img src="sponsor/sporrong.png" class="karusell-bild" alt="Sporrong">
              </a>
            </div><!-- item active -->

            <div class="item">
              <a href="http://nofall.se/" target="_blank">
                <img src="sponsor/no_fall.png" class="karusell-bild" alt="No Fall">
              </a>
            </div><!-- item -->

            <div class="item">
             <a href="http://www.mpskating.com/" target="_blank">
               <img src="sponsor/mp_skating.png" class="karusell-bild" alt="MP Skating">
             </a>
            </div><!-- item -->

          </div><!-- carousel inner -->
        </div><!-- carousel slide -->     
      </div><!-- myCarousel -->
    </div><!-- panel body -->
  </div><!-- panel panel grey -->

END;

// Läser in sidans innehåll i $content
$content = <<<END

END;

// Läser in sidans nederste innehåll i $footer
$footer = <<<END
	    <div class="footer border-bottom-radius navbar-fixed-bottom">
  			<div class="container">
  				<div class="row">
  					<div class="col-md-12 text-center">
  						<ul class="list-inline">
  							<li class="yellow">
                <a class="li yellow" href="avdelningar.php">Kontakta oss</a> &middot;
                <a class="li yellow" href="faq.php">FAQ</a> &middot;
                <a class="li white" href="samarbetspartners.php">Samarbetspartner</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <a href="https://www.facebook.com/konstakningsforbundet/">
                  <img src="img/facebook.png">
                </a> &nbsp;
                <a href="https://twitter.com/skatesweden/">
                  <img src="img/twitter.png">
                </a> &nbsp;
                <a href="https://www.youtube.com/results?search_query=svenska+konst%C3%A5kningsf%C3%B6rbundet">
                  <img src="img/youtube.png">
                </a>
                </li>
  						</ul>
              <br>
              <br>
              <br>
  						<p class="text-center white text-10px">Copyright &copy; 2014-2015 Svenska Konståkningsförbundet.</p>
  					</div><!-- col med 12 text center -->
				  </div><!-- row -->
			 </div><!-- container -->
		  </div><!-- footer -->
	</div><!-- container class DIV -->

</body>
</html>

END;
?>