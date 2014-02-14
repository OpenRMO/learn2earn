<!DOCTYPE HTML> 
<html>
<head>
<meta charset="UTF-8">
<title>Layout</title>
<script src="../scripts/jquery-1.11.0.min.js" type="text/javascript" />
<script src="../scripts/main.js" type="text/javascript" />
<link href="styles/reset.css"rel="stylesheet" type="text/css" >
<link href="styles/stylesheet.css"rel="stylesheet" type="text/css" >
</head>
<body>
<header>
	<p> HENKI is ingelogd </p>
</header>

<div id="wrapper">
	<div id="left" class="kolom">
		<p> left </p><br>
		
		<form action="login.php" method="post"> 
			<label>Username:</label> 
			<input type="text" name="username" id="username" /> <br> 
			
			<label for="password">Password:</label> 
			<input type="password" name="password" id="password" /> <br>
		
			<input type="submit" value="log in" /> 
		</form> 
		
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
		
		<p> <a href="register.php">Registreren</a></p>
		
				
	</div>
	
	<div id="leftmiddle" class="kolom">
		<p> lefmiddle </p>
	</div>
	
	<div id="middle" class="kolom">
		<p> middle </p>
	</div>
	
	<div id="rightmiddle" class="kolom">
		<p> rightmiddle </p>
	</div>
	
	<div id="right" class="kolom">
		<p> right </p>
	</div>
</div>

<footer>
	<p> copyright HENK </p>
</footer>
</body>
</html>