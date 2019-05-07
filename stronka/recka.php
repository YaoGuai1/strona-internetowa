<?php

	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		if(!isset($_SESSION['dana_gra'])){
			header('Location:index.php');		
		}else {
			header('Location:index.php?tak='. $_SESSION['dana_gra']);
			exit();
		}
	}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>

	<meta charset="utf-8" />
	<title>Najlepsze gry!</title>
	<meta name="description" content="Recenzje najlepszych gier, dla prawdziwnych graczy!"/>
	<meta name="keywords" content="gra, gry, recenzje, najlepsze gry"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<link rel="stylesheet" href="main.css" type="text/css">
	<link rel="stylesheet" href="w3.css" type="text/css"> 
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latina-ext" rel="stylesheet">
	<script src="jquery-1.11.3.min.js"></script>
	<script src="main.js"></script>
		
	
</head>

<body id="body" onload="openRec()">


	<!-- -------ładowanie------- -->

	<div id="preloader">
		<div id="image"></div>
	</div>

	<!-- ----------------------menu------------------------ -->

	<header id="header">
		<h1 id="logo" class="logo"><a style="text-decoration: none" href="recka.php" >dla graczy</a></h1>
		
		<nav>
		   <ol class="menu">
    			<li><a href="#">Strzelanki</a>
      			<ul>
        				<li><a  href="tresc_recki/Gears.php" >Gears of War 3</a></li>
        				<li><a href="tresc_recki/Halo.php">Halo 3</a></li>
      			</ul>    			
    			</li>
    			<li><a href="#">RPG</a>
      			<ul>
        				<li><a href="tresc_recki/Fable.php">Fable 2</a></li>
        				<li><a href="tresc_recki/Baldur.php">Baldur's Gate</a></li>
      			</ul>    			
    			</li>
    			<li><a href="#">Strategie</a>
      			<ul>
        				<li><a href="tresc_recki/Cywilizacja.php">Cywilizacja 3</a></li>
        				<li><a href="tresc_recki/Heroes.php">Heroes 3</a></li>
      			</ul>        			
    			</li>
    			<li><a href="#">MMO</a>
      			<ul>
        				<li><a href="tresc_recki/GW2.php">Guild Wars 2</a></li>
        				<li><a href="tresc_recki/Hearthstone.php">Hearthstone</a></li>
      			</ul>        			
    			</li>
    			<li><a href="#">Sportowe</a>
      			<ul>
        				<li><a href="tresc_recki/Forza.php">Forza 5</a></li>
        				<li><a href="tresc_recki/Fifa.php">Fifa 18</a></li>
      			</ul>        			
    			</li>
    		</ol>

		</nav>
		
		<!-- ------- błędy dodawania ocen i komentarzy ----------- -->		
		
		<?php
			if(isset($_SESSION['e_ocena'])){
				echo $_SESSION['e_ocena'];
				unset($_SESSION['e_ocena']);
			}
			
			if (isset($_SESSION['udane_dodanie_komentarza'])){
				echo $_SESSION['udane_dodanie_komentarza'];
				unset($_SESSION['udane_dodanie_komentarza']);
			}	
			
			if (isset($_SESSION['udane_oddanie_oceny'])){
				echo $_SESSION['udane_oddanie_oceny'];
				unset($_SESSION['udane_oddanie_oceny']);
			}								
			if(isset($_GET['tak'])) {
					$tak = $_GET['tak'];
				} else{
					$tak="slider";
				}	
		?>	
	</header>

<!-- ----------------------Slider------------------------ -->

	<div id="slider" class="w3-content w3-display-container sort">
		<a href="tresc_recki/Gears.php"> <img class="mySlides w3-animate-right"  src="GOW3.jpg"> </a>
  		<a href="tresc_recki/Halo.php"><img class="mySlides w3-animate-right" src="halo.jpg"></a>
	  	<a href="tresc_recki/Fable.php"><img class="mySlides w3-animate-right" src="fable3.jpg"></a>
  		<a href="tresc_recki/GW2.php"><img class="mySlides w3-animate-right" src="GW2.jpg"></a>
  		<div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
    		<div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
    		<div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
    		<span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
    		<span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
    		<span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
    		<span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(4)"></span>
  		</div>
	</div>
	

<!-- -----------------------------------Recki ----------------------------------- -->


	
	<div class="game">
		
		<!-- ---------Wyświetlanie recenzji ----------- -->	
		
		<?php if (isset($_SESSION['rrr'])){
				echo $_SESSION['rrr'];
			}								
		 ?>

		<!-- ---------Wyświetlanie oceny ----------- -->

		<div id="ocena1" class="ocena">
			<h1>OCENA <br /> <?php echo $_SESSION['ocenka']; ?> /10</h1>
			<br />
			Ocena od użytkowników:
				<?php
					require_once"connect.php";
					mysqli_report(MYSQLI_REPORT_STRICT);
					try{
						$poloczenie = new mysqli($host, $db_user,$db_password, $db_name);
						if($poloczenie->connect_errno!=0){
							throw new Exception(mysqli_connect_errno());
						}else {
							$rezultat = $poloczenie->query("SELECT ocena FROM oceny WHERE gra='$tak'");
							$ile_takich_ocen = $rezultat->num_rows;
							$suma_ocen = 0;
							for($i=0;$i<$ile_takich_ocen;$i++) {
								$row = $rezultat->fetch_assoc();
								$suma_ocen = $suma_ocen + $row['ocena'];
							}
							if($ile_takich_ocen>0) {
								echo round($suma_ocen/$ile_takich_ocen, 1);
								echo "<br> <br>  Ilość oddanych ocen: ". $ile_takich_ocen;
							}else {
								echo "Nie ma jeszcze ocen od użytkowników, bądź pierwszy!";
							}
							
							$rezultatCWTZ = $poloczenie->query("SELECT gra FROM CWTZ WHERE gra='$tak'");
							$ile_klikniec = $rezultatCWTZ->num_rows;
							$rezultat_polecam = $poloczenie->query("SELECT gra FROM polecam WHERE gra='$tak' AND polecam='tak'");
							$ile_klikniec_p = $rezultat_polecam->num_rows;
							$rezultat_nie_polecam = $poloczenie->query("SELECT gra FROM polecam WHERE gra='$tak' AND polecam='nie'");
							$ile_klikniec_n = $rezultat_nie_polecam->num_rows;							
						}
					}catch(Exception $e){
						echo '<span style="color:red">Błąd serwera! Przepraszamy i prosimy o przesłąnie oceny w innym terminie :)</span>';
					}
				?>
			
			<!-- ----------- przycisk i modal dodawania oceny--------------- -->
			
			<br><br><button style="width:100%" onclick="document.getElementById('Ocena').style.display='block'"
  		 		class="w3-button w3-xlarge">Dodaj Ocenę</button> <br><br>
  		 		
  		 	<a href="CWTZ.php"> <button style="width:100%; margin-bottom:5px;" class="w3-black w3-button w3-large">Chcę w to zagrać</button> </a>
  		 	
  		 	<?php 		
  		 		if($ile_klikniec>0) {
					echo "<br>Ilość kliknięć w <br> &quot;Chcę w to zagrać&quot;: ". $ile_klikniec;
				}else {
					echo "<br><br>Na razie nikt nie chce w to zagrać";
				}
			?>
  		 	<br><br><a href="polecam.php"> <button style="width:100%; margin-bottom:5px;" class="w3-green w3-button w3-large">Polecam :)</button> </a>
  		 	<a href="niepolecam.php"> <button style="width:100%; margin-bottom:5px;" class="w3-red w3-button w3-large">Nie polecam :(</button> </a>
  		 	
  		 	<?php 		
				echo "<br><br>Ilość kliknięć w 	<br> &quot;Polecam!&quot;:". $ile_klikniec_p;
				echo "<br><br>Ilość kliknięć w <br>  &quot;Nie polecam!&quot;:". $ile_klikniec_n;
			?>

  			<div id="Ocena" class="w3-modal">
    			<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
      			
      			<div class="w3-center"><br>
       				<span onclick="document.getElementById('Ocena').style.display='none'" 
        				class="w3-button w3-xlarge  w3-hover-red w3-display-topright"
        				title="Zamknij okienko dodawania Ocen">&times;</span>
      			</div>

		      	<form class="w3-container" action="ocena.php" method="get">
		        		<div class="w3-section">
		        			<label><b>Wybierz ocenę</b></label>
		        			<br><br>
							<select name="ile">
		  						<option value="1">1</option>
		  						<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							</select>
		          		<input class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="gra" value="<?php echo $tak; ?>">
		        		</div> 
		      	</form>

    			</div>
  			</div>		
		</div>
		
		<!-- ---------Wyświetlanie komentarzy ----------- -->
		
		<div id="komentarze1" class="komentarze">
			<h1>KOMENTARZE:</h1>
			<?php
				require_once"connect.php";
				mysqli_report(MYSQLI_REPORT_STRICT);	
				try{
					$poloczenie = new mysqli($host, $db_user,$db_password, $db_name);
					if($poloczenie->connect_errno!=0){
						throw new Exception(mysqli_connect_errno());
					}else {
						$rezultat = $poloczenie->query("SELECT * FROM komentarze WHERE gra='$tak'");
						$ile_takich_komentarzy = $rezultat->num_rows;
						if($ile_takich_komentarzy>0) {
							while($row = $rezultat->fetch_assoc()){
								echo '<div class="nick_w_kom">';
								echo "<br> Użytkownik: ". $row["uzytkownik"]. "<br>";
								echo '</div>';
								echo '<div class="data_w_komentarzu">';
								echo "Data: ". $row["Data"]. "<br>";
								echo '</div>';
								echo '<div class="wypisywanie_komentarzy">';
								echo $row["komentarz"]. "<br>";
								echo '</div>';
							}
						}else{
							echo "Nie ma komentarzy do tej recenzji";
						}
						$poloczenie->close();
					}
				}catch(Exception $e){
					echo '<span style="color:red">Błąd serwera! Przepraszamy i prosimy o przesłąnie oceny w innym terminie :)</span>';
				}
			?>
			
		<!-- -----------przycisk i modal dodawania komentarzy--------------- -->
			
			<button onclick="document.getElementById('Komentarz').style.display='block'"
  		 		class="w3-button w3-xlarge">Dodaj Komentarz</button>

  			<div id="Komentarz" class="w3-modal">
    			<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      			<div class="w3-center"><br>
       				<span onclick="document.getElementById('Komentarz').style.display='none'" 
        				class="w3-button w3-xlarge  w3-hover-red w3-display-topright"
        				title="Zamknij okienko dodawania Ocen">&times;</span>
      			</div>

		      	<form class="w3-container" action="komentarz.php" method="get">
		        		<div class="w3-section">
		        			<label><b>Wpisz komentarz</b></label>
		        			<br />
		        			<textarea name="text" rows="4" cols="52" wrap="physical" ></textarea>
		          		<input class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="gra" value= "<?php echo $tak; ?>" >
		        		</div> 		
		      	</form>
    			</div>
  			</div>
		</div>
	</div>	

	<!-- --------- przycisk wyloguj -------------- -->
	
	<a style="text-decoration:none" href="logout.php"><p id="wyloguj" class="w3-button w3-block w3-green w3-section w3-padding"> Wyloguj się! </p></a>
	
	<!-- --------- pomocniczy div do danej z php ------------- -->	
	
	<?php
		echo '<button id="pomoc" value='. $tak. ' style="display:none;"></button>';
	?>
	
	<!-- ---------- stopka ----------- -->
	
	<footer id="footer">
		&copy Dla Graczy - Wszelkie prawa zastrzeżone! <a href="chat.php">Przejdź do chatu online<a>
		<br> Zmień Styl: <button class="w3-button w3-large" type="button" onclick="Dzien()">Dzień</button>
		<button class="w3-button w3-large" onclick="Noc()">Noc</button> 
		
		<?php 
		if(isset($_SESSION['dana_gra'])){		
			echo "<a href='dodruku.php?tak=". $_SESSION['dana_gra']. "'>Wersja do druku</a>";
		}
		 ?>
	</footer>
	


	
	<!-- ---------- skrypt do ładowania stony i pokazania pierwszego slidu ------- -->
	
	 <script type="text/javascript">
	 
	$(window).load(function() { // Czekamy na załadowanie całej zawartości strony
		$("#preloader #image").fadeOut(); // Usuwamy grafikę ładowania
		$("#preloader").delay(50).fadeOut("slow"); // Usuwamy diva przysłaniającego stronę
		showDivs(1);
	})
	</script>

</body>

</html>

