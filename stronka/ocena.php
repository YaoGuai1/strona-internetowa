<?php

	session_start();
	
	$gra = $_GET['gra'];
	$_SESSION['gra'] = $gra;
	$uzytkownik=$_SESSION['login'];
	$ile=$_GET['ile'];
	
	$wszystko_OK = true;
	
	require_once"connect.php";
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		
		
		try{
			$poloczenie = new mysqli($host, $db_user,$db_password, $db_name);
			if($poloczenie->connect_errno!=0){
				$wszystko_OK = false;
				throw new Exception(mysqli_connect_errno());
			}else{
				
//-----------------------------Sprawdzanie czy dany użytkownik już dodał ocenę --------------------
				$rezultat = $poloczenie->query("SELECT uzytkownik FROM oceny WHERE gra='$gra' AND uzytkownik='$uzytkownik'");
				if(!$rezultat) throw new Exceptation($poloczenie->error);
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0){
					$wszystko_OK=false;
					$poloczenie->query("UPDATE  oceny SET ocena = '$ile' WHERE gra='$gra' AND uzytkownik='$uzytkownik'");
					$_SESSION['e_ocena']= '<span style="color:red;">Zmieniłeś ocenę tej grze!</span>';
					header('Location:recka.php?tak='. $gra);
				}					

				if($wszystko_OK==true){
					if($poloczenie->query("INSERT INTO oceny VALUES(NULL, '$gra', '$uzytkownik', '$ile')")){
						$_SESSION['udane_oddanie_oceny']='<span style="color:yellow;font-size: 30px;"
						>Oddałeś ocenę!</span>';
						header('Location:recka.php?tak='. $gra);
					}else{
						if(!$rezultat) throw new Exceptation($poloczenie->error);
						header('Location:recka.php?tak='. $gra);
					}		 
				}
			
				$poloczenie->close();
			}
		}catch(Exception $e){
			echo '<span style="color:red">Błąd serwera! Przepraszamy o oddanie oceny w innym terminie :)</span>';
		}
		

?>