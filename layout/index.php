<!DOCTYPE HTML> 
<html>
<head>
<meta charset="UTF-8">
<title>Layout</title>
<link href="styles/stylesheet.css"rel="stylesheet" type="text/css" >
<link href="styles/reset.css"rel="stylesheet" type="text/css" >
</head>
<body>
<header>
	<p> HENKI is ingelogd </p>
</header>



<div id="wrapper">
	<div id="left" class="kolom">
		<p> left </p><br>
		
		<form action="../classes/user.class.php" method="post"> 
			<label for="voornaam">Username:</label> 
			<input type="text" name="username" id="username" /> <br>

			<label for="achternaam">Password:</label> 
			<input type="password" name="password" id="password" /> <br>
		
			<input type="submit" value="log in" /> 
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
	<p> copyright HENK </p>
</footer>
</body>
</html>