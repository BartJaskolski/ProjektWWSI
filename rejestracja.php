<?php
	session_start();
	
	if(isset($_POST['email']))
	{
		//Udana walidacja? tak
		$OK =true;
		
		//sprawdzenie loginu
		$nick =$_POST['login'];
		
		//sprawdzenie dlugosci nicku
		if((strlen($nick)<3 || strlen($nick)>20))
		{
			$OK= false;
			$_SESSION['e_login']= "Login musi posiadać od 3 do 20 znaków";
		}
		
		if(ctype_alnum($nick)==false)
		{
			$OK=false;
			$_SESSION['e_login']="Login może składać się tylko z lister i cyfr";
		}
		
		//sprawdzanie e-mailu
		$mail= $_POST['email'];
		//sanizytacja * wyczeszczenie źródła z potencalnie groźnych zapisów
		$mailB= filter_var($mail,FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($mailB,FILTER_VALIDATE_EMAIL)==false) || ($mailB!=$mail))
		{
			$OK=false;
			$_SESSION['e_email']="podaj poprawny e-mail!";
		}
		
		//SPRAWDZANIE HASLA
		
		$haslo1= $_POST['Haslo'];
		$haslo2= $_POST['Haslo2'];
		
		if((strlen($haslo1)<8 || (strlen($haslo1)>20)))
		{
				$OK= false;
			    $_SESSION['e_haslo']= "Hasło musi posiadać od 8 do 20 znaków";	
		}
		if ($haslo1!=$haslo2)
		{
			
				$OK= false;
			    $_SESSION['e_haslo']= "Hasła nie są jednakowe";
			
		}
		
		if(!isset($_POST['regulamin']))
		{
			$OK=false;
			$_SESSION['e_regulamin']="Potwierdz akceptacje regulaminu";
			
		}
		//hasowanie kasla
		$haslo_hash= password_hash($haslo1,PASSWORD_DEFAULT);
		
		//Insert do tabeli
		require_once "phpc.php";
		
		// zamiwast warningow rzucamy wyjatki ( Exception ) 
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try
		{
			$con = new mysqli($host,$user,$pass,$baza);
			if($con->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy juz jest taki email?
				$rezultat= $con->query("SELECT id FROM users WHERE mail='$mail'");
				if(!$rezultat)
				{			
					throw new Exception($con->error);
				}
				$ileM =$rezultat->num_rows;
				
				if($ileM>0)
				{
					$OK=false;
					$_SESSION['e_email']="Istnieje juz konto przypisane do tego e-maila";
				}
				
				//Czy juz jest taki nick
				$rezultat= $con->query("SELECT id FROM users WHERE login='$nick'");
				if(!$rezultat)
				{			
					throw new Exception($con->error);
				}
				$ileN =$rezultat->num_rows;
				
				if($ileN>0)
				{
					$OK=false;
					$_SESSION['e_login']="Istnieje juz taki login";
				}
				
				
				if($OK)
				{
					if($con->query("INSERT INTO users VALUES(NULL,'$nick','$haslo_hash','$mail')"))
					{
						$_SESSION['udanaR']=true;
						header('location:login.php');
					}
					else
					{
						throw new Exception($con->error);
					}
				}	
			
			$con->close();
				
			}
		}
		catch(Exception $e)
		{
			echo 'Błąd serwera';
			echo '<br />'.$e;
		}
		

		
	}
	
	
?>
<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<meta charset="utf-8" />
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="css/fontello.css" rel="stylesheet" type="text/css" />
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	</head>

	<body>
			<div class="container">
				<div class="header">
					<div class="logo">
					<span style="color:#c34f4f">Bartek</span>Jaskolski
					</div>
				</div>
				<div class="nav">
					<ol>
						<li>
							<a href="index.php">Strona Głowna</a>
						</li>
						<li>
							<a href="gra.php">Graj !</a>
							<ul>
								<li>
									<a href="#">Kup grę</a>
								</li>
							</ul>
						</li>
						<li><a href="rejestracja.php">Rejestracja</a></li>
						<li><a href="login.php">Login</a></li>
						<li><a href="ranking.php">Ranking</a></li>
					</ol>
				</div>
				<div class="content">
				<p> Witaj, oto strona rejestracyjna </p>
					<form method="post">
						
						Login: <br/> <input type="text" name="login"/>  <br/>
						
						<?php
								if(isset($_SESSION['e_login']))
								{
									echo '<div id="er">'.$_SESSION['e_login'].'</div>';
									unset($_SESSION['e_login']);
								}
						?>
						
						Hasło: <br/> <input type="password" name="Haslo"/><br/>
							<?php
								if(isset($_SESSION['e_haslo']))
								{
									echo '<div id="er">'.$_SESSION['e_haslo'].'</div>';
									unset($_SESSION['e_haslo']);
								}
						?>
						
						Powtórz Hasło: <br/> <input type="password" name="Haslo2"/><br/>
							
						E-mail: <br/> <input type="text" name="email"/><br/>
							
						<?php
								if(isset($_SESSION['e_email']))
								{
									echo '<div id="er">'.$_SESSION['e_email'].'</div>';
									unset($_SESSION['e_email']);
								}
						?>
						
						<br/>
						<label>
							<input type="checkbox" name="regulamin" /> Akceptuję regulamin
						</label>
						<br/>
							<?php
								if(isset($_SESSION['e_regulamin']))
								{
									echo '<div id="er">'.$_SESSION['e_regulamin'].'</div>';
									unset($_SESSION['e_regulamin']);
								}
						?>
						
							<br />
						<input class="button" type="submit" value="Rejestracja" />
							
						
					</form>
				
				
				
				</div>
				<div class="socials">
					<div class="socialdivs">
						<a href="https://www.facebook.com/bartosz.jaskolski.54" target="_blank">
						<div class="fb">
							<i class="icon-facebook-squared"></i>
						</div>
						</a>
						
						<div class="yt">
							<i class="icon-youtube"></i>
						</div>
						<a href="https://github.com/BartJaskolski" target="_blank">
						<div class="gh">
							<i class="icon-github"></i>
						</div>
						</a>
						<a href="https://www.linkedin.com/in/bartosz-jask%C3%B3lski-544615124/" target="_blank">
						<div class="ln">
							<i class="icon-linkedin-squared"></i>
						</div>
						</a>
						<div style="clear:both"></div>
					</div>
				</div>
				<div class="footer">BartoszJaskolski.com &copy;</div>
			</div>
			
			<script src="halo.js"></script>
			
				
<script>

	$(document).ready(function() {
	var NavY = $('.nav').offset().top;
	 
	var stickyNav = function(){
	var ScrollY = $(window).scrollTop();
		  
	if (ScrollY > NavY) { 
		$('.nav').addClass('sticky');
	} else {
		$('.nav').removeClass('sticky'); 
	}
	};
	 
	stickyNav();
	 
	$(window).scroll(function() {
		stickyNav();
	});
	});
	
</script>

			
			
			
			
	</body>
</html>