<!DOCTYPE HTML> 
<html>
<head>
<meta charset="UTF-8">
<title>Layout</title>
<link href="../styles/reset.css"rel="stylesheet" type="text/css" >
<link href="styles/stylesheet_portal.css"rel="stylesheet" type="text/css" >

<?php
include "logincheck.php";
?>
</head>
<body>
<header>
	<h1> Pagina om te registreren </h1><br>
</header>

<div id="wrapper">
	<div id="left" class="kolom"> 
	
		<p> left </p>
		
		<div id="photoshop" class="icons">
			<img src="../images/icons/Photoshop.png" alt="Photoshop" width="50%" height="50%">
		</div>
		
		<div id="scrollbar_photoshop" class="scrollbar">
			<table>
			<!--<col id="column_lesson_photoshop"/>
			<col span="2" id="column_progress_photoshop"/>
				<tr>
					<td> les 1 </td>
					<td> voortgang</td>
				</tr>
				<tr>
					<td> les 2 </td>
					<td> voortgang</td>
				</tr>
				<tr>
					<td> les 3 </td>
					<td> voortgang</td>
				</tr>
				<tr>
					<td> les 4 </td>
					<td> voortgang</td>
				</tr>
				<tr>
					<td> les 5 </td>
					<td> voortgang</td>
				</tr>
				<tr>
					<td> les 6 </td>
					<td> voortgang</td>
				</tr>-->
				
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
	
		<p> lefmiddle </p>
		
		<div id="html_css" class="icons">
			<img src="../images/icons/html_css.png" alt="html_css" width="50%" height="50%">
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
	
		<p> middle </p>
		
		<div id="flash" class="icons">
			<img src="../images/icons/Flash.png" alt="flash" width="50%" height="50%">
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
	
		<p> rightmiddle </p>
		
		<div id="premiere_pro" class="icons">
			<img src="../images/icons/premiere_pro.png" alt="premiere_pro" width="50%" height="50%">
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
		<p> right </p>
	</div>
</div>

</body>
</html>