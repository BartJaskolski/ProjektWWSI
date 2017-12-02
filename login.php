<?php
	session_start();
	
	if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: gra.php');
		exit();
	}
	/*if(!isset($_SESSION['udanaR']))
	{
		header('location:rejestracja.php');
		exit();
	}
	*/
	else
	{
		unset($_SESSION['udanaR']);
	}
?>
<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
							<a href="#">Graj !</a>
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
					<form action="log.php" method="post">
						
						Login: <br/> <input type="text" name="login"/> 
							   <br/>
						Hasło: <br/> <input type="password" name="haslo"/>
							<br/>
							<input class="button" type="submit" value="Logowanie" />
					</form>
				<?php
				if(isset($_SESSION['blad']))
				{
					echo $_SESSION['blad'];
				}
				echo "<p>Witaj, oto strona logowania</p>";
				?>
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