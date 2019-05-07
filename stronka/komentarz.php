<?php

	session_start();
	
	$gra = $_GET['gra'];
	$_SESSION['gra'] = $gra;
	$uzytkownik=$_SESSION['nick'];
	$komentarz=$_GET['text'];
	$dzisiaj = date("Y-m-d G:i:s");
	
	$wszystko_OK = true;
	
	require_once"connect.php";
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		
		
		try{
			$poloczenie = new mysqli($host, $db_user,$db_password, $db_name);
			if($poloczenie->connect_errno!=0){
				$wszystko_OK = false;
				throw new Exception(mysqli_connect_errno());
			}else{
				if($wszystko_OK==true){
					if($poloczenie->query("INSERT INTO komentarze VALUES(NULL, '$gra', '$uzytkownik', '$komentarz', '$dzisiaj')")){
						$_SESSION['udane_dodanie_komentarza']='<span style="color:yellow;font-size: 30px;"
						>Dodałeś komentarz!</span>';
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