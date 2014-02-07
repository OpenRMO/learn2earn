<!DOCTYPE HTML> 
<html>
<head>
<meta charset="UTF-8">
<title>Layout</title>
<link href="../styles/reset.css"rel="stylesheet" type="text/css" >
<link href="../styles/stylesheet.css"rel="stylesheet" type="text/css" >
</head>
<body>
<header>
	<h1> Pagina om te registreren </h1><br>
</header>

<div id="wrapper">
	<div id="left" class="kolom">
		<p> left </p><br>
		
		<form action="register_next.php" method="post"> 
			<label for="username">Username:</label><br> 
			<input type="text" name="username" data-id="username" /> <br>

			<label for="password">Password:</label><br> 
			<input type="password" name="password1" data-id="password1" /> <br>
			<label for="password">Confirm Password:</label><br> 
			<input type="password" name="password2" data-id="password2" /> <br>
			
			<label for="firstname">First Name:</label><br>
			<input type="text" name="firstname" data-id="firstname"/><br>
			
			<label for="lastname">Last Name:</label><br>
			<input type="text" name="lastname" data-id="lastname"/><br>
			
			<label for="studentnumber">Student Number:</label><br>
			<input type="text" name="studentnumber" data-id="studentnumber"/><br>
			
			<label for="birthdate">Birth Date:</label><br>
			<input type="date" name="birthdate" data-id="birthdate"/><br>
			
			<label for="email">E-Mail:</label><br>
			<input type="text" name="email" data-id="email"/><br>
		
			<input type="submit" value="Registreren" /> 
		</form> 
		
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
	<p> &#169; learn2earn </p>
</footer>
</body>
</html>