<!DOCTYPE HTML> 
<html>
<head>
	<meta charset="UTF-8">
	<title>Lespagina</title>
        <link href="styles/reset.css" rel="stylesheet" type="text/css" >
        <link href="styles/main.css" rel="stylesheet" type="text/css" >
        <link href="styles/lessons.css" rel="stylesheet" type="text/css" >
	<?php
	include "../config/config.inc.php";
	include "logincheck.php";
	?>
</head>
<body>
		
<header>	
	<div id="left_header" class="kolom">
	<a href="../index.php"><img src="../images/learn2earn.png" alt="Learn2earn" width="50%" height="50px"></a>
	</div>
	
	<div id="right_header" class="kolom">
	<nav>
		<ul class="navigatie">
			<a href="../index.php"><li>Home</li></a>
			<a href="portal.php"><li>Jaar</li></a>
			<a href=""><li>Badges</li></a>
		</ul>
	</nav>
	</div>
</header>

<div id="scrollbar_body" class="scrollbar1">
<div id="wrapper">
	<div id="left" class="kolom">		
		<div id="scrollbar_uitleg" class="scrollbar">
			<table>
				<tr>
					<td>
						<b>Les: Geschiedenis van de informatica.</b><br><br>
						De moderne informatica stoelt op inzichten die deels van lang voor het begin van onze jaartelling stammen. In India en Mesopotamië stond rond 1500 voor Christus de rekenkunde, de kennis over hoe systematisch berekeningen uit te voeren met optelling en vermenigvuldiging, al op een hoog niveau: veel inzichten die gewoonlijk aan de oude Grieken worden toeschreven waren al bekend, zoals de stelling van Pythagoras en het systematisch oplossen van vierkantsvergelijkingen. De Grieken beschouwden het redeneren zelf als een soort spel dat aan bepaalde regels beantwoordt, zoals het syllogisme of het principe van de uitgesloten derde. Een grote invloed was Aristoteles, die ook nadacht over hoe werkelijkheid en de concepten die we gebruiken om deze te beschrijven systematisch te beschrijven.<br>
						Deze benadering en veel van de opgedane kennis raakten vergeten in Europa, maar ondergingen een renaissance vanaf de 10e eeuw in het Arabische rijk; een belangrijke bijdrage daarbij leverde de waarschijnlijk uit de buurt van het Aral-meer afkomstige Al-Chwarizmi, wiens leerboeken over het rekenen ook in Europa doordrongen en daarbij het rekenen met 0 en het idee van rekenen (algebra) als het uitvoeren van systematische procedures (algoritmen) introduceerden. De renaissance en verlichting in Europa gingen hierop door en brachten de wiskunde en logica heel veel verder. Daarbij kwam steeds duidelijker de vraag op de voorgrond in hoeverre rekenen en wiskundig redeneren te mechaniseren en automatiseren zijn. Rond 1840 beschreven wiskundigen als George Boole de basis van het logisch redeneren als wiskundige bewerkingen (Boolese algebra). Ook ontstonden er machines waarvan de werking mechanisch te configureren was, zoals het Jacquard-weefgetouw (vanaf 1790), de mechanische rekenmachines van Charles Babbage (tussen 1834-1870), en de machines voor gemechaniseerde volkstellingsverwerking van Herman Hollerith (1880).<br>
						Begin 20e eeuw werd de wiskunde zozeer geformaliseerd dat vragen over de aard en betekenis van het wiskundige redeneren wiskundig konden worden geformuleerd en beantwoord. Kurt Gödel ontdekte (1930) dat je het logisch redeneren over rekenproblemen inderdaad als een vorm van mechanisch uitvoerbaar rekenen op kunt vatten, maar dat de consequentie is dat er dan onbeslisbare eigenschappen bestaan: eigenschappen van getallen, of andere wiskundig gedefinieerde objecten, waarvoor ondubbelzinnig gedefinieerd is of ze voor een bepaald object gelden of niet, maar waarvoor desondanks geen mechanische methode bestaat om gegeven een willekeurig object te bepalen of de eigenschap ervoor geldt of niet. Alan Turing introduceerde de Turingmachine (1936), een wiskundig model van een zo simpel mogelijke gegevensverwerkende machine, om dit nog duidelijker te maken en ook te laten zien dat het er daarbij in wezen niet toe doet of de machine werkt op getallen of op andersoortige gegevens.<br>
						Deze twee ontwikkelingen samen, de praktische ontwikkeling van programmeerbare machines en de theoretische inzichten omtrent de mogelijkheden van zulke mechanische programmering, leidden uiteindelijk eind jaren 30 tot de eerste grote programmeerbare elektronische rekenmachines (digitale computers), met mensen als Konrad Zuse, Alan Turing en John von Neumann als pioniers. Zo werd het mechaniseren van het rekenen en redeneren langzamerhand praktische werkelijkheid.<br>
						Oorspronkelijk was computer de Engelse benaming voor een persoon die voor haar beroep berekeningen uitvoerde. (Vrouwen waren hierin aanzienlijk beter dan mannen.) Menselijke computers werden bijvoorbeeld ingezet om tabellen voor de scheepvaart en astronomie op te stellen. Van het grootste belang was correctheid: een fout in een tabel is nu eenmaal niet direct zichtbaar en kan voor de gebruiker van de tabel grote gevolgen hebben.<br>
						In de jaren 50 werd de mechanische computer een commercieel product: verschillende firma's bouwden en verkochten computers, met IBM (begonnen als bouwer van de Hollerith-machines) als marktleider. In plaats van aan menselijke computers ontstond er behoefte aan programmeurs en andere deskundigen in het omgaan met de nieuwe mechanische computers; zij richtten een vakorganisatie op, de ACM, en maakten zich sterk voor algemene opleidingen van hoog academisch niveau, om mensen op te leiden die met grote deskundigheid en onafhankelijkheid de nieuwe machines tegemoet zouden kunnen treden. Voor deze nieuw op te richten opleidingen werden namen voorgesteld als computer science (Louis Fein, in Communications of the ACM, 1959) en (in Europa) informatica. Deze opleidingen zouden zich niet zozeer moeten richten op de computer als apparaat en hoe deze te construeren, maar op het programmeren ervan en het gebruik ervan bij de wiskundige modellering en analyse van problemen. Dit is nog steeds het geval.<br>
						Wat de theorie betreft bestaat de informatica vooral uit wiskunde: deels het toepassen van al eerder bestaande wiskunde, en deels specifiek voor de informatica ontwikkelde gespecialiseerde wiskunde, de theoretische informatica. Belangrijke onderdelen daarvan zijn algoritmiek, datamodellering, formeletalentheorie, en veel meer. Het praktische werk in de informatica en de theorie gaan hand in hand.<br>
					</td>
				</tr>
			</table>
		</div>
	</div>
	
	<div id="right" class="kolom">
		<div id="scrollbar_film" class="scrollbar">
			<table>
				<tr>
					<td class="right">		
						
						<p class="text">
						<b>Lesdoelen:</b><br>
						<?php
							$currentCourse = $_GET['l'];
							$course = new Course($db, $currentCourse);
							echo $course->getDescription();
						?>
						</p>
						
						<p class="text">
						<b>Badges:</b>
						</p>
						
						<p class="text">
						<b>Bestanden:</b>
						<?php
							$documents_info = $db->select("documents_courses", "*", array("course_id"=>$currentCourse));
							$i=1;
							if($documents_info != null)
							{
								foreach($documents_info as $key )
								{
									$document_id = $key["document_id"];
									$document_name = $key["document_name"];
									$document_link = $key["document_link"];
									
									echo "<br> <a href='../../files/$document_link'>".$document_name."</a><br>";
									
								}
							}
						?>
						</p>
						
						<div id="updates" class="updates">
							<table class="updates_table">
								<tr class="updates_tr">
									<th>
										UPDATES
									</th>
								</tr>
								<tr class="updates_tr">
									<td class="updates_td">
										Wijziging
									</td>
								</tr>
								<tr class="updates_tr">
									<td class="updates_td">
										Wijziging
									</td>
								</tr>
								<tr class="updates_tr">
									<td class="updates_td">
										Wijziging
									</td>
								</tr>
								<tr class="updates_tr">
									<td class="updates_td">
										Wijziging
									</td>
								</tr>
								<tr class="updates_tr">
									<td class="updates_td">
										Wijziging
									</td>
								</tr>
								<tr class="updates_tr">
									<td class="updates_td">
										Wijziging
									</td>
								</tr>
								<tr class="updates_tr">
									<td class="updates_td">
										Wijziging
									</td>
								</tr>
								<tr class="updates_tr">
									<td class="updates_td">
										Wijziging
									</td>
								</tr>
								<tr class="updates_tr" style="border-bottom: 0em">
									<td class="updates_td">
										Wijziging
									</td>
								</tr>								
							</table>
						</div>
						
						<div id="agenda" class="agenda">
							<table class="agenda_table">
								<tr class="agenda_tr">
									<th>
										AGENDA
									</th>
								</tr>
								<tr class="agenda_tr">
									<td class="agenda_td">
										Datum
									</td>
								</tr>
								<tr class="agenda_tr">
									<td class="agenda_td">
										Datum
									</td>
								</tr>
								<tr class="agenda_tr">
									<td class="agenda_td">
										Datum
									</td>
								</tr>
								<tr class="agenda_tr">
									<td class="agenda_td">
										Datum
									</td>
								</tr>
								<tr class="agenda_tr">
									<td class="agenda_td">
										Datum
									</td>
								</tr>
								<tr class="agenda_tr">
									<td class="agenda_td">
										Datum
									</td>
								</tr>
								<tr class="agenda_tr">
									<td class="agenda_td">
										Datum
									</td>
								</tr>
								<tr class="agenda_tr">
									<td class="agenda_td">
										Datum
									</td>
								</tr>
								<tr class="agenda_tr" style="border-bottom: 0em">
									<td class="agenda_td">
										Datum
									</td>
								</tr>								
							</table>
						</div>
							
						<nav>
							<ul class="navigatie" style="float: left; margin-left: 3%;">
								<li><a href="*">Inleveren</a></li>
							</ul>
						</nav>
						
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
</div>
		
<footer>
	<p> &#169; learn2earn </p>
</footer>
</body>
</html>