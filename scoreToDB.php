<?php
	session_start();
	require_once "phpc.php";
	
	$con = mysqli_connect($host,$user,$pass,$baza);
	
	
	
	$id =$_POST['id'];
	$score = $_POST['sc'];
	$timeSurvived = $_POST['ti'];
	$sql="INSERT INTO ranking (Gracz, Wynik, CzasGry) VALUES('$id','$score','$timeSurvived')";
	$con->query($sql);
	
	header('location:gra.php'); 
?>
