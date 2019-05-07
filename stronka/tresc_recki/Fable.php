<?php

session_start();

$_SESSION['rrr'] = '<div id="Fable" class="recka sort">
			<h2>Fable 2</h2>
			Fable 2 jest kontynuacją słynnej gry z gatunku cRPG, stworzonej przez elektroniczno-rozrywkowego mistrza w osobie Petera Molyneuxa. Demiurg ów przygotował sequel specjalnie z myślą o stacjonarnej konsoli Xbox 360. Scenariusz ponownie przenosi nas do fantastycznego Albionu, przypominającego nieco Anglię. Tym razem jednak akcja toczy się mniej więcej pięćset lat później. Upływ czasu widać przede wszystkim w budownictwie, ubiorach i uzbrojeniu (w użyciu jest np. broń palna), chociaż zmianie uległo również chociażby prawo. Generalnie wirtualne uniwersum nie przypomina już europejskiego średniowiecza, lecz raczej epokę podbojów kolonialnych. Rozgrywkę rozpoczynamy jako mieszkaniec ulicy, ale dzięki wykonywanym zadaniom i odrobinie szczęścia pniemy się coraz wyżej w społecznej hierarchii. Nasza postać (kobieta lub mężczyzna) starzeje się wraz z upływem lat, może wstąpić w związek małżeński i dochować się licznego potomstwa etc. Jeśli protagonista posiada dzieci, to spoczywa na nim obowiązek ich wychowania – oczywiście prawy bohater ma inne oddziaływanie pedagogiczne, niż przesiąknięty złem awanturnik. Ważnym elementem gry jest towarzyszący bohaterowi pies, zastępujący mapę i HUD-a. Podąża on przed nami i jest przewodnikiem – szczeka, gdy coś znajdzie albo wyczuje zagrożenie. Innym ciekawym rozwiązaniem jest całkowita rezygnacja ze śmierci – w Fable 2 nie można zginąć: po przegranej walce na twarzy postaci pojawiają się blizny, które mają potem wpływ na to, jak postrzegają nas inni. Gra na Xbox 360.
			<br><iframe width="560" height="315" src="https://www.youtube.com/embed/5pouqKKjh_M" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
		</div>';
		
$_SESSION['ocenka'] = 10;
$_SESSION['dana_gra'] = "Fable";
		
		header('Location:../recka.php?tak=Fable');

?>