<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php?tak='. $gra);
		exit();
	}
	
	require_once "connect.php";
	
	$poloczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
		$gra = $_SESSION['dana_gra'];
	
	if($poloczenie->connect_errno!=0){
		echo"Error: ".$poloczenie->connect_errno;
	}else{
	$login = $_POST['login'];
	$haslo = $_POST['haslo'];
	
	$login = htmlentities($login, ENT_QUOTES,"UTF-8");
	
	if ($rezultat = @$poloczenie->query(sprintf("SELECT * FROM uzytkownicy WHERE login='%s'",
	mysqli_real_escape_string($poloczenie,$login))))
	{
		$ilu_userow = $rezultat->num_rows;
		if($ilu_userow>0){
			
			$wiersz=$rezultat->fetch_assoc();
			
			if(password_verify($haslo,$wiersz['haslo'])){
			
				$_SESSION['zalogowany']=true;
				$_SESSION['nick']=$wiersz['nick'];

				$_SESSION['login']=$wiersz['login']; //ustawiamy zmienną sesyjną login jako wartość kolumny login w bazie danych
			
				unset($_SESSION['blad']);
				$rezultat->free_result();
				if(isset($_SESSION['dana_gra'])){
					header('Location:recka.php?tak='. $gra);
				}else{
					header('Location:recka.php');
				}
			}else{
				$_SESSION['blad'] = '<span style="color:red">Błędne Hasło!</span>';
				header('Location:index.php');
			}
		}else{
			$_SESSION['blad'] = '<span style="color:red">Błędny Login!</span>';
			header('Location:index.php');
		}
	}
	
	$poloczenie->close();
	}


?>
