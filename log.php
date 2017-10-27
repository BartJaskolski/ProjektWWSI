<?php
	session_start();
	
	if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location : login.php');
		exit();
	}
	
	require_once "phpc.php";

	$con = @new mysqli($host,$user,$pass,$baza);
	
	if($con->connect_errno!=0)
	{
		echo "error: ".$con->connect_errno." Opis: ".$con->connect_error;
	}
	else
	{
		//przypisanie wartosci z login.php ( formularz )
	$login =$_POST['login'];
	$h =$_POST['haslo'];
	
	// ochrona przed SQL injections!! zmiana  <    &lt; i innych
	$login = htmlentities($login,ENT_QUOTES,"UTF-8");
	
	//sprintf pilnuje typów danych
	// ochrona przed SQL injections!!
	//mysqli_real-escape_string metoda wykrywanie wpywania na zapytanie za pomoca dwoch -- lub ''
	if($rezultat = @$con->query
				(sprintf("SELECT * FROM users WHERE login='%s'",
					mysqli_real_escape_string($con,$login))))
	{
		$ilu = $rezultat->num_rows;
		if($ilu>0)
		{
			//tablica asocjacyjna ( wartosc -> nazwa kolumny w tabelu )
			$row = $rezultat->fetch_assoc();
	
			IF (password_verify($h,$row['haslo']))
			{
				$_SESSION['zalogowany'] = true;			
				$_SESSION['id'] = $row['id'];
				$_SESSION['$user'] = $row['login'];
				
				unset($_SESSION['blad']);
				$rezultat->free_result();
				header('Location: gra.php');
			}
			else
			{
				$_SESSION['blad'] ='<span style="color:red">Niepoprawny login i hasło !</span>';
				header("Location: login.php");
			}
		}
		else
		{
			$_SESSION['blad'] ='<span style="color:red">Nie poprawny login lub hasło !</span>';
			header("Location: login.php");	
		}
	}


	$con->close();
	}

?>
