 <?php
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: login.php');
		exit();
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
										<a href="#">Podstrona1</a>
									</li>
								</ul>
								<ul>
									<li>
										<a href="#">Podstrona2</a>
									</li>
								</ul>
								<ul>
									<li>
										<a href="#">Podstrona3</a>
									</li>
								</ul>
								<ul>
									<li>
										<a href="#">Podstrona4</a>
									</li>
								</ul>
						</li>
						<li><a href="rejestracja.php">Rejestracja</a></li>
						<li><a href="#">Login</a></li>
						<li><a href="ranking.php">Ranking</a></li>
					</ol>
				</div>
				<div class="content">
				<?php
				echo "Witaj ".$_SESSION['$user']."!";
				echo '<a href="logout.php">Wyloguj się</a>';
				?>
				<br/>
				<br/>
				<br/>
				<canvas id="example" width="800" height="600" style="background-color:#555555">
					Twoja przeglądarka nie obsługuje elementu Canvas.
				</canvas>
										
					<script>
					
						//gra					</script>
					
					
				<p>Zostałes zalogowny do Gry</p>
				
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
	 
	var stickyNav = function()
	{
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