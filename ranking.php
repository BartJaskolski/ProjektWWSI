<!DOCTYPE HTML>
<html lang="pl">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="css/fontello.css" rel="stylesheet" type="text/css" />
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
		<script src="halo.js"></script>
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
										<a href="#">Oceń Grę</a>
									</li>
								</ul>
						</li>
						<li><a href="rejestracja.php">Rejestracja</a></li>
						<li><a href="login.php">Login</a></li>
						<li>
						<a href="ranking.php">Top wyniki</a>
						<ul>
									<li>
										<a href="statystykiGracza.php">Historia Gier</a>
									</li>
								</ul>
						</li>
					</ol>
				</div>
				<div style="text-align:center;" class="content">
				<p> TOP 10 wyników !</p>
				</br>
				
				</br>
					<table id="TabelaRank">
						<tr>
							<th>Miejsce</th>
							<th>Nick</th>	
							<th>Wynik</th>
							<th>Czas Gry</th>
						</tr>
							<?php
							session_start();
							require_once "phpc.php";
							
							$con = mysqli_connect($host,$user,$pass,$baza);
							
							$result = $con->query("SELECT * FROM ranking JOIN users ON Gracz=users.id ORDER BY ranking.Wynik DESC");
							$counter =0;
							if($result ->num_rows>0)
							{
								
								while($row =$result->fetch_assoc())
								{
									$counter++;									
								echo "<tr>"
										."<th>".$counter."</th>"
										."<th>".$row["login"]."</th>"
										."<th>".$row["Wynik"]."</th>"
										."<th>".$row["CzasGry"]."</th>"
									."</tr>";
								}
							}
							?>
						
					 </table>
				
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