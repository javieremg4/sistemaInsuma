<?php 
	$conexion = mysqli_connect("localhost","root","","backup");
	if(!$conexion){
		header("location:../HTML/error.html");
	}
?>
