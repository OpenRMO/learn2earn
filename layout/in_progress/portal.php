<!DOCTYPE HTML> 
<html>
<head>
<meta charset="UTF-8">
<title>Layout</title>
<link href="../styles/reset.css"rel="stylesheet" type="text/css" >
<link href="styles/stylesheet_portal4.css"rel="stylesheet" type="text/css" >

<?php
include "logincheck.php";
?>
</head>
<body>
<header>
<br>
	<h2> Je bent ingelogd als: <?php 
	require_once "../../config/config.inc.php";
	$user = new User($db, $_SESSION["id"]);
	echo $user->getFirstName()." ".$user->getLastName();?></h2><br>
</header>

<div id="wrapper">
	<div id="left" class="kolom"> 
		<?php include("load_projects.php");?>
		<h1><?php 
			$p = new Project($db, $projects[0]);
			echo $p->getName();
		?></h1>
		
		<div id="photoshop" class="icons">
			<img src="../images/icons/<?php echo $p->getIcon();?>" alt="Photoshop" width="50%" height="50%">
		</div>
		
		<div id="scrollbar_photoshop" class="scrollbar">
			<table>
				<?php
				$periode = 1;
				include "portal_phptest.php";
				?>
			</table>
		</div>
		
		<div id="photoshop_updates" class="updates">
			<p>Updates</p>
		</div>
		
	</div>

	<div id="leftmiddle" class="kolom">
	
		<?php include("load_projects.php");?>
		<h1><?php 
			$p = new Project($db, $projects[1]);
			echo $p->getName();
		?></h1>
		
		<div id="html_css" class="icons">
			<img src="../images/icons/<?php echo $p->getIcon();?>" alt="html_css" width="50%" height="50%">
		</div>
		
		<div id="scrollbar_html_css" class="scrollbar">
			<table>
			<?php
				$periode = 2;
				include "portal_phptest.php";
				?>
			</table>
		</div>
		
		
		<div id="html_css_updates" class="updates">
			<p>Updates</p>
		</div>
		
	</div>
	
	<div id="middle" class="kolom">
	
		<?php include("load_projects.php");?>
		<h1><?php 
			$p = new Project($db, $projects[2]);
			echo $p->getName();
		?></h1>
		
		<div id="flash" class="icons">
			<img src="../images/icons/<?php echo $p->getIcon();?>" alt="flash" width="50%" height="50%">
		</div>

		<div id="scrollbar_flash" class="scrollbar">
			<table>
			<?php
				$periode = 3;
				include "portal_phptest.php";
				?>
			</table>
		</div>

		<div id="flash_updates" class="updates">
			<p>Updates</p>
		</div>
		
	</div>
	
	<div id="rightmiddle" class="kolom">
	
		<?php include("load_projects.php");?>
		<h1><?php 
			$p = new Project($db, $projects[3]);
			echo $p->getName();
		?></h1>
		
		<div id="premiere_pro" class="icons">
			<img src="../images/icons/<?php echo $p->getIcon();?>" alt="premiere_pro" width="50%" height="50%">
		</div>

		<div id="scrollbar_flash" class="scrollbar">
			<table>
			<?php
				$periode = 4;
				include "portal_phptest.php";
				?>
			</table>
		</div>
		
		<div id="premiere_pro_updates" class="updates">
			<p>Updates</p>
		</div>
		
	</div>
	
	<div id="right" class="kolom">
		<h1>Agenda</h1>
		<p> Het is vandaag: <?php echo date('d-m-20y'); ?></p>
	</div>
</div>

</body>
</html>