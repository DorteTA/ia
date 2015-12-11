<?php
/*---------------------------------
login.php
Inlogningssidan där användare och
editörer kan logga in
---------------------------------*/

include_once("inc/HTMLTemplate.php");

// Variabler
$feedback = "";
$content = "";
$table = "";
$editor ="";

if(!empty($_POST)) {

	// Kontakter DB med info från Connstring.php
	include_once("inc/Connstring.php");

	// Tabellens namn
	$table = "user";	
	
	$username =	isset($_POST['username']) ? $_POST['username'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	$spamTest =	isset($_POST['address']) ? $_POST['address'] : '';

	//Om fältet address INTE är tomt (som det bör vara) ges feedback om att man har upptäckt en spam-bot
	if($spamTest != '') {
		die("Jag tror du är en robot. Om jag har fel, gå tillbaka och prova igen.");
	}
	
	if($username == '' || $password == '') {
		$feedback = "<p class=\"text-yellow\">Fyll i alla uppgifter.</p>";
	}
	else {
	
		$username	= $mysqli->real_escape_string($username);
		$password	= $mysqli->real_escape_string($password);
		
		
		$query = <<<END
		
		SELECT username, password, userId
		FROM {$table}
		WHERE username = "{$username}";
		
END;

		
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error); 
		
		if($res->num_rows == 1) {
			$pswmd5 = md5($password);
			$row = $res->fetch_object();
			if($row->password == $pswmd5) {
				session_start();
				session_regenerate_id();
				
				$_SESSION["username"] = 	$username;
				$_SESSION["userId"]	=		$row->userId;				
				
				header("Location: index.php");
			}
			else {
				$feedback = "<p class=\"text-red\">Fel lösenord.</p>";
			}
			$res->close();
		}
		else {
			$feedback = "<p class=\"text-red\">Fel användarnamn.</p>";
		}
		
	}
}


//adm meny
//Kollar att posterna inte är tomma

// Variabler
$username = "";
$password = "";

if(!empty($_POST)) {
	include_once("inc/Connstring.php");
	$editor ="admin";

	$username =		isset($_POST['username']) ? $_POST['username'] : '';
	$password =		isset($_POST['password']) ? $_POST['password'] : '';
	$spamTest =		isset($_POST['address']) ? $_POST['address'] : '';

	//Om fältet address INTE är tomt (som det bör vara) ges feedback om att man har upptäckt en spam-bot
	if($spamTest != '') {
		die("Jag tror du är en robot. Om jag har fel, gå tillbaka och prova igen.");
	}
	//Om fält m namn eller besked inte har fyllts i, får användaren en feedback att fylla i alla fält
	if($username == '' || $password == '') {
		$feedback = "<p class=\"text-yellow\">Var god fyll i alla fält.</p>";
	
	} else {
		//SQL injections åtgärd
		$username	= utf8_encode($mysqli->real_escape_string($username));
		$password	= utf8_encode($mysqli->real_escape_string($password));
	
		date_default_timezone_set("Europe/Stockholm");
	
		//MySQL query som lägger in nya beskeder i databasen
		$query = <<<END
		--
		-- Gets username and password based on user input
		--
		SELECT adminId, adminName, adminPassword
		FROM {$editor}
		WHERE adminName = "{$username}";
		
		
END;

		//Ger felmeddelande om databasen inte kan köras och hänvisar till felnummer, annars körs den
		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);

		if($res->num_rows == 1) {
		$pswmd5 = md5($password);
		$row = $res->fetch_object();
		if($row->adminPassword == $pswmd5) {
				session_start();
				session_regenerate_id();
				
				$_SESSION["username"] = $username;
				$_SESSION["userId"] = 	$row->adminId;
				
				header("Location:index.php");
				
			}
			//Här kan olika feedback givas om användaren har skrivit fel användarnamn, men har valt att inte göra så, eftersom det ger evt hackare tips
			//om att de har hittat rätt password eller anvädarenamn.
			else {
				$feedback = "<p class\"text-red\"Fel lösenord eller användarnamn.</p>";
			}
			$res->close();
		}
		else {
			$feedback = "<p class=\"text-red\">Fel lösenord eller användarnamn</p>";
		}
		
		$mysqli->close();
	}

}

//Hindrar XSS-attack
$username	= htmlspecialchars($username);
$password	= htmlspecialchars($password);

$content = <<<END

			
       	<div id="content">
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-blue">
						<div class="panel-heading">
							<h3 class="panel-title">Logga in</h3>
								<p>{$feedback}</p>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<form action="login.php" method="post" class="blue" id="login-form pull-right">
							<label for="username">Användarnamn</label>
							<input type="text" class="form-control" id="username" name="username" value="" />
							<label for="password">Lösenord</label>
							<input type="password" class="form-control" id="password" name="password" value="" />
							<input type="submit" class="btn btn-blue btn-xs" id="submit" value="logga in" />
							<p><a href="register.php">Registrera dig</a></p>
							</form>
							
						</div><!-- panel-body -->
					</div><!-- panel panel-blue -->								
				</div><!-- col-md-3 -->
			</div><!-- row -->
		</div><!-- content -->


END;


echo $header;
echo $content;
echo $footer;

?>
