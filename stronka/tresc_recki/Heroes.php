<?php

session_start();

$_SESSION['rrr'] = '<div id= "Heroes" class="recka sort">
			<h2>Heroes of Might and Magic III</h2>
			Heroes of Might & Magic III: HD Edition to odświeżone wydanie jednej z najsłynniejszych turowych strategii fantasy w dziejach elektronicznej rozrywki, stworzonej przez New World Computing w 1999 roku. Za reedycję odpowiada francuskie studio DotEmu, które otrzymało zlecenie na jej realizację od firmy Ubisoft, chcącej uczcić w ten sposób 20-lecie istnienia serii Heroes of Might & Magic i 15-lecie wydania trzeciej odsłony tegoż cyklu. Tytuł ukazał się zarówno na macierzystych pecetach, jak i urządzeniach mobilnych z systemem Android i iOS. W ogólnych założeniach HD Edition jest identyczne ze swoim pierwowzorem. Nadal eksplorujemy magiczne krainy, kierując bohaterami prowadzącymi do boju armie złożone z różnorodnych mitologicznych stworzeń. Gromadzimy zasoby, zbieramy artefakty, uczymy się zaklęć, rozwijamy umiejętności i – nade wszystko – zdobywamy oraz rozbudowujemy miasta, by ostatecznie odnieść zbrojne zwycięstwo nad rywalami lub zrealizować inne cele. Zawartość odświeżonej wersji pokrywa się z podstawowym wydaniem Heroes of Might & Magic III: The Restoration of Erathia (nie zawiera dodatków Armageddon’s Blade i The Shadow of Death). Mamy tu więc 7 kampanii fabularnych, tryb potyczek i edytor map. Nie brakuje też zabawy wieloosobowej, na jednym komputerze (hotseat) lub obsługiwanej sieciowo przez platformę Steam. Jedyna zmiana względem oryginału, którą można (choć wcale nie trzeba, bo jest w sumie kosmetyczna) dostrzec na pierwszy rzut oka, to odświeżona oprawa graficzna. Tworząc wersję pecetową, studio DotEmu zadbało o obsługę szerokoekranowych rozdzielczości obrazu, a także podniosło jakość tekstur, w taki sposób, by były bardziej wyraziste.
			<br /><iframe width="560" height="315" src="https://www.youtube.com/embed/9O9ek0Fvykc" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>

		</div>';
		
$_SESSION['ocenka'] = 9.2;
$_SESSION['dana_gra'] = "Heroes";
		
		header('Location:../recka.php?tak=Heroes');

?>