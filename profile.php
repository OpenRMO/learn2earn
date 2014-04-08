<?php
include('prepare.php');
$user = new User($db, $_SESSION["id"]);
?>

	<div id="profilewrapper">
		<div id="profileData" class="width-50 float-left">
			
			<img id="profielfoto" class="displayed" src="<?php print $user->getAvatar(); ?>" alt="profiel foto" width="300px" height="300px">
			
			
		<h2> profiel van: <?php print $user->toString();?></h2><br><br>
			
		<table id="profile_data">
			<colgroup>
				<col id="left-colum" />
				<col span="2" id="right-colum"/>
			</colgroup>	
			
			<tr>
				<td> gebruikersnaam:</td>
				<td> <?php print $user->getusername(); ?> </td>
			</tr>
			
			<tr>
				<td> Naam:</td>
				<td> <?php print $user->toString(); ?> </td>
			</tr>
			
			<tr>
				<td> geboortedatum:</td>
				<td> <?php print $user->getBirthDate(); ?> </td>
			</tr>
			
			<tr>
				<td> leerlingennummer:</td>
				<td> <?php print $user->getStudentNumber(); ?> </td>
			</tr>
			
			<tr>
				<td> Email:</td>
				<td> <?php print $user->getEmail(); ?> </td>
			</tr>
		</table>
		</div>
		<div id="profileProgress" class="width-50 float-right">
			<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Badges</a></li>
					<li><a href="#tabs-2">Voortgang</a></li>
					<li><a href="#tabs-3">Resultaten</a></li>
				</ul>

				<div id="tabs-1">
					<h1> Badges </h1>
						<?php foreach($user->getBadges() as $badge) {
							echo '<img id="badge" src="'.$badge->getImage().'" alt="badge" width="200px" height="200px">';
						} ?>
				</div>

				<div id="tabs-2">
					<h1>Voortgang</h1>
				</div>

				<div id="tabs-3">
					<h1>Resultaten</h1>
				</div>

			</div>

			<div class="float-clear"></div>
		</div>
	</div>
