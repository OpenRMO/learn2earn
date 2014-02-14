<!DOCTYPE HTML> 
<html>
<head>
<meta charset="UTF-8">
<title>Layout</title>
<script src="../scripts/jquery-1.11.0.min.js" type="text/javascript" />
<script src="../scripts/main.js" type="text/javascript" />
<link href="styles/reset.css"rel="stylesheet" type="text/css" >
<link href="styles/stylesheet_inlog.css"rel="stylesheet" type="text/css" >
</head>
<body>
		
 <div id="background">
	<div id="medal">
		<div id="form">
			<form action="login.php" method="post"> 
			
				<img src="images/learn2earn.png" alt="Learn2earn" width="225px" height="30px">
			
				<label>Username:</label> 
				<input type="text" name="username" id="username" class="input" /> <br> 
				
				<label for="password">Password:</label> 
				<input type="password" name="password" id="password" class="input" /> <br>
			
				<input type="submit" value="log in" /> <a href="register.php">Registreren</a>
				
					<div id="inlog_error">
		
						<?php
						$error = $_GET["error"];
						switch($error)
						{
							case 1:
								echo "U bent succesvol ingelogd!";
								break;
							case 2:
								echo "Uw inloggegevens komen niet voor in onze database...";
								break;
							case 3:
								echo "Vul alstublieft een gebruikersnaam en een wachtwoord in...";
								break;
						}
						?>
					</div>
		
			</form>
              </div> 
	</div>	
</div>
		
<footer>
	<p> &#169; learn2earn </p>
</footer>
</body>
</html>
