<?php 
	$conexion = mysqli_connect("localhost","root","","sistemainsuma");
	if(!$conexion){
		header("location:../HTML/error.html");
	}
?>

