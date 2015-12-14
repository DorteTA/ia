<?php
/*---------------------------------
login.php
Inlogning with welcome
The first page the visitor sees
---------------------------------*/


include_once("inc/HTMLTemplate.php");

$feedback = "";
$content = "";


if(!empty($_POST)) {
	include_once("inc/Connstring.php");
	$table = "user";
	
	
	$username =	isset($_POST['username']) ? $_POST['username'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	
	if($username == '' || $password == '') {
		$feedback = "<p class=\"feedback-yellow\">Fyll i alla uppgifter.</p>";
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
				$feedback = "<p class=\"feedback-red\">Fel lösenord.</p>";
			}
			$res->close();
		}
		else {
			$feedback = "<p class=\"feedback-red\">Fel användarnamn.</p>";
		}
		$mysqli->close();
	
	}

}

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
							<form action="login.php" method="post" id="login-form pull-right">
							<label for="username">Användarnamn:</label>
							<input type="text" id="username" name="username" value="" /><br><br>
							<label for="password">Lösenord:</label>
							<input type="password" id="password" name="password" value="" /><br><br>
							<input type="submit" id="submit" value="logga in" />
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
