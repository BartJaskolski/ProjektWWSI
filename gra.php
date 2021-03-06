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
									<a href="#">Oceń grę</a>
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
					<br/><br/><br/>
					
					
				
					<canvas id="EX" width="800" height="600" style="background-color:#555555" ></canvas>
				
					<script id="game" src="scripts/gra.js" type="text/javascript"></script>	
				
					<button id="but" onclick="start('<?php echo $_SESSION['id'] ?>')">Start</button> 
				
					<form id="rank" action="rank.php" method="post">
						<input id="nick"  type="hidden" name="nickname" value="<?php $_SESSION['$user']?>"/>
						<input  type="hidden" name="wynik" value=""/>
						<input  type="hidden" name="Czas" value=""/>
					</form>
				
					<p>Zostałes zalogowny do Gry :)</p>			
				
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