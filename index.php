<!DOCTYPE HTML> 
<html>
<head>
<meta charset="UTF-8">
<title>Layout</title>
<link href="layout/styles/reset.css"rel="stylesheet" type="text/css" >
<link href="layout/styles/stylesheet_inlog.css"rel="stylesheet" type="text/css" >
</head>
<body>
		
 <div id="background">
	<div id="medal">
		<div id="form">
			<form action="layout/login.php" method="post"> 
			
				<img src="layout/images/learn2earn.png" alt="Learn2earn" width="225px" height="30px">
			
				<label>Username:</label> 
				<input type="text" name="username" id="username" class="input" /> <br> 
				
				<label for="password">Password:</label> 
				<input type="password" name="password" id="password" class="input" /> <br>
			
				<input type="submit" value="log in" /> <a href="layout/register.php">Registreren</a>
				
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