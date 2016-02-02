<?php

/*---------------------------------------------------
Använder HTML-mallen där CSS och javascript ingår,
så detta inte behövs tastas in på varje sida
---------------------------------------------------*/
include_once("inc/HTMLTemplate.php");

// Uppkoblingen till databasen
include_once("inc/Connstring.php");

$feedback = "";

if(!empty($_POST))
{
	if(isset($_POST['submit']))
	{
			$username = $_POST['username'];
			$mail = $_POST['mail'];
			$name = $_POST['name'];
			$surname = $_POST['surname'];
			$address = $_POST['address'];
			$zipcode = $_POST['zipcode'];
			$city = $_POST['city'];
			$pass = $_POST['password'];

			if($username == '' || $mail == "" || $name == "" || $surname == "" || $address == "" || $zipcode == ""
			|| $city == "" || $pass == "")
			{
				$feedback = "<p>Fyll i alla fält.</p>";
			}
			else
			{
				$password = md5($pass);
				$query = <<<END

					INSERT INTO user (username, mail, name, surname, address, zipcode, city, password)
					VALUES ('{$username}', '{$mail}', '{$name}', '{$surname}', '{$address}', '{$zipcode}', '{$city}', '{$password}');
END;
				$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
				        " : " . $mysqli->error);

				header("Location: login.php");
			}
		

	}
}
$content = <<<END

       	<div id="content">
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-blue">
						<div class="panel-heading">
							<h3 class="panel-title">Registrera dig</h3>
						</div><!-- panel-heading -->
						
						<div class="panel-body">
							{$feedback}
							<form action="register.php" method="POST" class="blue" id="register-form">
							
								<label for="username">Användarnamn</label>
								<input type="text" class="form-control" id="username" name="username" placeholder="Användarnamn">
								
								<label for="mail">E-post</label>
								<input type="varchar" class="form-control" id="mail" name="mail" placeholder="din e-post @ adress">
								
								<label for="name">Namn</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Ditt förnamn">
								
								<label for="surname">Efternamn</label>
								<input type="text" class="form-control" id="surname" name="surname" placeholder="Ditt efternamn">
								
								<label for="address">Adress</label>
								<input type="text" class="form-control" id="adress" name="address" placeholder="Din post-adress">
								
								<label for="zipcode">Postnummer</label>
								<input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Ditt postnummer">
								
								<label for="city">Ort</label>
								<input type="text" class="form-control" id="city" name="city" placeholder="Din ort">
								
								<label for="password">Lösenord</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Ditt lösenord">
								
								<input class="btn btn-blue btn-xs" type="submit" value="Skapa konto" name="submit" />
							</form>
						</div><!-- panel-body -->
					</div><!-- panel panel-blue -->						
				</div><!-- col-md-3 -->
		</div> <!-- row -->
    </div><!-- AVsluta content DIV -->
END;

echo $header;
echo $content;
echo $footer;
?>