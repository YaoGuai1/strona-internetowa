<?php

	session_start();
	
	$gra = $_SESSION['dana_gra'];
	$uzytkownik=$_SESSION['login'];
	
	$wszystko_OK = true;
	
	require_once"connect.php";
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		
		
		try{
			$poloczenie = new mysqli($host, $db_user,$db_password, $db_name);
			if($poloczenie->connect_errno!=0){
				$wszystko_OK = false;
				throw new Exception(mysqli_connect_errno());
			}else{
				$rezultat = $poloczenie->query("SELECT uzytkownik FROM polecam WHERE gra='$gra' AND uzytkownik='$uzytkownik'");
				if(!$rezultat) throw new Exceptation($poloczenie->error);
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0){
					$wszystko_OK=false;
					$poloczenie->query("UPDATE  polecam SET polecam = 'tak' WHERE gra='$gra' AND uzytkownik='$uzytkownik'");
					$_SESSION['udane_oddanie_oceny']='<span style="color:yellow;font-size: 30px;">Polecasz tą grę!</span>';
					header('Location:recka.php?tak='. $gra);
					exit();
				}					

				if($wszystko_OK==true){
					if($poloczenie->query("INSERT INTO polecam VALUES(NULL, '$gra', '$uzytkownik', 'tak')")){
						$_SESSION['udane_oddanie_oceny']='<span style="color:yellow;font-size: 30px;"
						>Polecasz tą grę!</span>';
						header('Location:recka.php?tak='. $gra);
					}else{
						if(!$rezultat) throw new Exceptation($poloczenie->error);
						header('Location:recka.php?tak='. $gra);
					}		 
				}
			
				$poloczenie->close();
			}
		}catch(Exception $e){
			echo '<span style="color:red">Błąd serwera! Przepraszamy :)</span>';
		}
		

?>