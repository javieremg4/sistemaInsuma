<?php
	$uploadedfileload=true;
	$uploadedfile_size=$_FILES['uploadedfile']['size'];
	$msg="";
	if ($_FILES['uploadedfile']['size']>200000)
	{
		$msg="El archivo es mayor que 200KB <br>";
		$uploadedfileload=false;
	}
	if (!($_FILES['uploadedfile']['type'] =="image/jpeg" OR $_FILES['uploadedfile']['type'] =="image/png"))
	{
		$msg=$msg."El archivo tiene que ser JPG o PNG";
		$uploadedfileload=false;
	}
	if(!$uploadedfileload){
		echo "<h4 style='color: red;'>".$msg."</h4>";
		echo "<a href='../HTML/registroAlumno.html'>Volver al registro</a>";
	}	
?>