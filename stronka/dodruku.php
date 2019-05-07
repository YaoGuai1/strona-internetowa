<?php

	session_start();
	

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

<body id="body" onload="DoDruku()">

	<div id="preloader">
		<div id="image"></div>
	</div>

	<div class="game">
		
		<!-- ---------Wyświetlanie recenzji ----------- -->	
	
		<?php 
			if (isset($_SESSION['rrr'])){
				echo $_SESSION['rrr'];
			}								
		 ?>

	</div>	

	
	<?php
		if(isset($_GET['tak'])) {
			$tak = $_GET['tak'];
		} else{
			$tak="slider";
		}	
	?>
	
	<script type="text/javascript">
	 
		$(window).load(function() { // Czekamy na załadowanie całej zawartości strony
			$("#preloader #image").fadeOut(); // Usuwamy grafikę ładowania
			$("#preloader").delay(50).fadeOut("slow"); // Usuwamy diva przysłaniającego stronę
			showDivs(1);
		})
	</script>

</body>

</html>
