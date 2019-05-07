<?php

	session_start();
	
	if(isset($_POST['email'])){
		//udana walidacja
		$wszystko_OK = true;
		
		//-----------------------Poprawność loginu------------------------------------------
		$login = $_POST['login'];
		
		//sprawdzenie długości loginu
		
		if(strlen($login)<3||(strlen($login)>20)){
			$wszystko_OK = false;
			$_SESSION['e_login']= '<span style="color:red">Login musi posiadać od 3 do 20 znaków</span>';
			header('Location:index.php');
		}
		
		// sprawdzenie poprawności znaków w loginie
		
		if(ctype_alnum($login)==false){
			$wszystko_OK = false;
			$_SESSION['e_login']= '<span style="color:red">Login może składać się tylko z liter i cyfr (bez polskich znaków)</span>';
			header('Location:index.php');
		}
		
		//-------------------Poprawność maila------------------------
		$email = $_POST['email'];
		$emailB = filter_var($email,FILTER_SANITIZE_EMAIL);
		if ((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false)||($emailB!=$email)){
			$wszystko_OK=false;
			$_SESSION['e_email']='<span style="color:red">Podaj poprawny email!</span>';
			header('Location:index.php');
		}
		//----------------------Poprawność Nicka---------------
		$nick = $_POST['nick'];
		
		//sprawdzenie długości nicku
		
		if(strlen($nick)<3||(strlen($nick)>20)){
			$wszystko_OK = false;
			$_SESSION['e_nick']= '<span style="color:red">Nick musi posiadać od 3 do 20 znaków</span>';
			header('Location:index.php');
		}
		
		// sprawdzenie poprawności znaków w nicku
		
		if(ctype_alnum($nick)==false){
			$wszystko_OK = false;
			$_SESSION['e_nick']= '<span style="color:red">Nick może składać się tylko z liter i cyfr (bez polskich znaków)</span>';
			header('Location:index.php');
		}
		
		//-----------------------Sprawdzanie poprawności hasłą-------------------------
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if((strlen($haslo1)<8)||(strlen($haslo1)>30)){
			$wszystko_OK=false;
			$_SESSION['e_haslo']= '<span style="color:red">Hasło musi posiadać od 8 do 30 znaków</span>';
			header('Location:index.php');
		}
		
		if($haslo1!=$haslo2){
			$wszystko_OK=false;
			$_SESSION['e_haslo']= '<span style="color:red">Oba hasłą muszą być takie same!</span>';
			header('Location:index.php');
		}
		
		//--------------------------hashowanie hasła---------------------------
		
		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
		//---------------------sprawdzanie CAPTCHY----------------------
		
		$sekret = '6LfCKz4UAAAAAMp4T240nTWMYSX7KD1Emxb5TuBk';
		
		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.
		'&response='.$_POST['g-recaptcha-response']);
		
		$odpowiedz = json_decode($sprawdz);
		
		if($odpowiedz->success==false){
			$wszystko_OK=false;
			$_SESSION['e_bot']= '<span style="color:red">Potwierdź że nie niejsteś botem!</span>';
			header('Location:index.php');
		}
		
		//------------------łączenie z bazą danych------------------------
		
		require_once"connect.php";
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try{
			$poloczenie = new mysqli($host, $db_user,$db_password, $db_name);
			if($poloczenie->connect_errno!=0){
				$wszystko_OK=false;
				throw new Exception(mysqli_connect_errno());
			}else {
				///Czy email już istnieje
				$rezultat = $poloczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");
				
				if(!$rezultat) throw new Exceptation($poloczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0){
					$wszystko_OK=false;
					$_SESSION['e_email']= '<span style="color:red">Istnieje już konto o takim emailu</span>';
					header('Location:index.php');
				}
				//Czy login już istnieje
				$rezultat = $poloczenie->query("SELECT id FROM uzytkownicy WHERE login='$login'");
				
				if(!$rezultat) throw new Exceptation($poloczenie->error);
				
				$ile_takich_loginow = $rezultat->num_rows;
				if($ile_takich_loginow>0){
					$wszystko_OK=false;
					$_SESSION['e_login']= '<span style="color:red">Istnieje już konto o takim loginie</span>';
					header('Location:index.php');
				}
				
				//Czy nick już istnieje
				$rezultat = $poloczenie->query("SELECT id FROM uzytkownicy WHERE nick='$nick'");
				
				if(!$rezultat) throw new Exceptation($poloczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0){
					$wszystko_OK=false;
					$_SESSION['e_nick']= '<span style="color:red">Użytkownik o takim nicku już istnieje, wybierz inny!</span>';
					header('Location:index.php');
				}
				
				//-------------jeżeli wszystko ok------------------
				if($wszystko_OK==true){
					if($poloczenie->query("INSERT INTO uzytkownicy VALUES(NULL, '$login', '$haslo_hash', '$nick', '$email')")){
						$_SESSION['udanarejestracja']='<span style="color:yellow;font-size: 30px;"
						>Gratulacje! Jesteś teraz nowym użytkownikiem!</span>';
						header('Location:index.php');
						exit();
					}else{
						if(!$rezultat) throw new Exceptation($poloczenie->error);
						header('Location:index.php');
					}		 
				}
			
				$poloczenie->close();
			}
		}catch(Exception $e){
			echo '<span style="color:red">Błąd serwera! Przepraszamy i prosimy o rejestrację w innym terminie :)</span>';
		}
		
	}

?>