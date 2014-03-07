<!DOCTYPE HTML> 
<html>
<?php include('parts/')?>
<head>
	<meta charset="UTF-8">
	<title>Layout</title>
	<link href="styles/reset.css"rel="stylesheet" type="text/css" >
	<link href="styles/main.css"rel="stylesheet" type="text/css" >
	<script src="http://code.jquery.com/jquery-1.11.0.min.js" type="text/javascript" language="javascript"></script>
	<script language="javascript" type="text/javascript" >
		$("input[type='submit']").click(function(e){
			e.preventDefault();
		});
		$(document).ready(function(){
			$("#courseFormBurron").click(function(e){
			alert();
			e.preventDefault();
				$("#courseForm").submit();
			});
		});
	</script>
</head>
<body>
<header>
	<h1> Hier kun je: registreren, cluster toevoegen, les toevoegen</h1><br>
</header>

<div id="wrapper">
	<div id="left" class="kolom">
		<br><h1> leerling registreren </h1><br>
		
		<form action="add_user.php" method="post"> 
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
			
			<label for="cluster_leerling">Cluster:</label>
			<select name="cluster">
				<?php
				include_once "../config/config.inc.php";
				
				$test = $db->select("clusters", array("name"));
				$clusters = count($test);
				
				for($i=0;$i<$clusters;$i++)
				{
					$name = $test[$i]['name'];
					echo "<option name='cluster' value='$name'>$name</option>";
				}
				?>
			</select><br>
		
			<input type="submit" id="studentFormButton" value="Opslaan" /> 
		</form> 
                <div id="registreer_error">
                    <?php
                    $error = $_GET["error"];
                    switch($error)
                    {
                        case 1:
                            echo "De registratie ging goed!";
                            break;
                        case 2:
                            echo "Uw gebruikersnaam moet minder dan 20 tekens bevatten...";
                            break;
                        case 3:
                            echo "Uw wachtwoord moet meer dan 8 tekens bevatten...";
                            break;
                        case 4:
                            echo "Uw wachtwoorden komen niet overeen...";
                            break;
                        case 5:
                            echo "Uw voornaam kan niet meer dan 20 tekens bevatten...";
                            break;
                        case 6:
                            echo "Uw achternaam kan niet meer dan 20 tekens bevatten...";
                            break;
                        case 7:
                            echo "Uw e-mailadres is ongeldig...";
                            break;
                        case 8:
                            echo "Uw e-mailadres bevat meer dan 50 tekens...";
                            break;
                        case 9:
                            echo "Er is iets fout gegaan met de verwerking van uw gegevens...";
                            break;
                    }
                    ?>
                </div>
	</div>
	
	<div id="leftmiddle" class="kolom">
		<br><h1> cluster toevoegen </h1><br>
		
		<form action="add_cluster.php" method="post"> 
			<!-- cluster name -->
				<label for="username">Naam cluster:</label><br> 
				<input type="text" name="cluster_name" data-id="cluster_name" /> <br><br>
			
			<!-- Leerlingen toevoegen aan cluster -->
				<label for="Cluster">Leerlingen toekennen:</label>
				<div class="scroll_leerling">
					<?php
						include_once "../config/config.inc.php";
						$names = $db->select("users", array("id", "first_name", "last_name"));
						
						$tmp = count($names);
						$full_name = array();
						$user_id = array();
						for($i=0;$i<$tmp;$i++)
						{
							$name = $names[$i]["last_name"]." ".$names[$i]["first_name"];
							array_push($full_name, $names[$i]["last_name"]." ".$names[$i]["first_name"]);
							array_push($user_id, $names[$i]["id"]);
						}
						array_multisort($full_name, $user_id);
						
						for($i=0;$i<count($full_name);$i++)
						{
							echo "<input type='checkbox' name='users[]' value='$user_id[$i]' />$full_name[$i]<br/>";
						}
					?>
				</div>
				<br><br>
			
			<!-- projecten toevoegen per periode -->
				<label for="Project_1">Project periode 1:</label>
				<select name="periode_1">
					<?php
					include_once "../config/config.inc.php";
					
					$test = $db->select("projects", array("id", "name"));
					$projects = count($test);
					
					for($i=0;$i<$projects;$i++)
					{
						$name = $test[$i]['name'];
						$project_id = $test[$i]['id'];
						echo "<option name='project1' value='$project_id'>$name</option>";
					}
					?>
				</select><br>
				
				<label for="Project_2">Project periode 2:</label>
				<select name="periode_2">
					<?php
					include_once "../config/config.inc.php";
					
					$test = $db->select("projects", array("id", "name"));
					$projects = count($test);
					
					for($i=0;$i<$projects;$i++)
					{
						$name = $test[$i]['name'];
						$project_id = $test[$i]['id'];
						echo "<option name='project2' value='test'>$name</option>";
					}
					?>
				</select><br>
				
				<label for="Project_3">Project periode 3:</label>
				<select name="periode_3">
					<?php
					include_once "../config/config.inc.php";
					
					$test = $db->select("projects", array("id", "name"));
					$projects = count($test);
					
					for($i=0;$i<$projects;$i++)
					{
						$name = $test[$i]['name'];
						$project_id = $test[$i]['id'];
						echo "<option name='project3' value='$project_id'>$name</option>";
					}
					?>
				</select><br>
				
				<label for="Project_4">Project periode 4:</label>
				<select name="periode_4">
					<?php
					include_once "../config/config.inc.php";
					
					$test = $db->select("projects", array("id", "name"));
					$projects = count($test);
					
					for($i=0;$i<$projects;$i++)
					{
						$name = $test[$i]['name'];
						$project_id = $test[$i]['id'];
						echo "<option name='project4' value='$project_id'>$name</option>";
					}
					?>
				</select><br><br>
			
			<input type="submit" id="clusterFormButton" value="Opslaan" /> 
		</form> 
		
	</div>
	
	<div id="middle" class="kolom">
		<br><h1> les toevoegen </h1> <br>
		
		<form action="add_course.php" id="courseForm" method="post"> 
			<!-- cluster kiezen bij les -->	
				<label for="cluster">De les is deel van project:</label><br> 
				<select name="project">
					<?php
					include "../config/config.inc.php";
					
					$test = $db->select("clusters", array("name"));
					$clusters = count($test);
					
					for($i=0;$i<$clusters;$i++)
					{
						$name = $test[$i]['name'];
						echo "<option name='cluster' value='$i'>$name</option>";
					}
					?>
				</select><br><br>
				
			<!-- beschrijving toekennen aan les -->	
				<label for="beschrijving">Beschrijving van de les:</label><br> 
				<textarea type="text" name="beschrijving" data-id="beschrijving les" rows="10" cols="30" /></textarea> <br><br>
				
			<!-- word bestanden toevoegen, voor meer info: http://www.ehow.com/how_7238702_upload-doc-files-php.html  -->
					<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
					<input name="filename" type="file" /><br />
				
			<!-- url youtube filmpje -->
				<label for="youtube_link">Youtube link:</label><br> 
				<input type="text" name="youtube" data-id="youtube_link" size="35"/> <br><br>

			<input type="submit" id="courseFormButton" value="Opslaan" /> 
		</form> 
		<div id="add_course_error">
                    <?php
                    $error = $_GET["error"];
                    switch($error)
                    {
                        case 10:
                            echo "Het toevoegen van een nieuwe les is voltooid.";
                            break;
						case 11:
							echo "Niet alle verplichte velden zijn ingevuld!";
							break;
                        case 12:
                            echo "De naam van de les moet minimaal vijf tekens lang zijn.";
                            break;
                        case 13:
                            echo "De les moet een beschrijving hebben.";
                            break;
                        case 14:
                            echo "Er ging iets fout tijdens het uploaden van het bestand.";
                            break;
                        case 15:
                            echo "Er ging iets fout bij het verwerken van uw data in de database";
                            break;
                    }
                    ?>
                </div>	
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