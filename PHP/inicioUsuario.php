<?php
	if($_POST["usuario"]==null OR $_POST["clave"]==null){
		header("location:../HTML/inicioUsuario.html");
	}else{
		$usuario = $_POST["usuario"];
		$clave = $_POST["clave"];
		include("conexion.php");
		$inicioUsuario = mysqli_query($conexion,"select * from usuarios where usuario='$usuario' and clave='$clave'");
		if(mysqli_num_rows($inicioUsuario)== 1){
			session_start();
			$info = mysqli_fetch_array($inicioUsuario);
	        $_SESSION['usuario'] = $info['usuario'];
	        $_SESSION['error']=0;
	        $_SESSION['reg']=0;
	        header("location:../HTML/principalUsuario.html");
		}else{
			echo "<link rel='shortcut icon' href='../Imagenes/favicon.ico'>";
			echo "<script type='text/javascript'>alert('Error: No se pudo iniciar sesión'); window.location.href='../HTML/inicioUsuario.html';</script>";
		}
	}
?>
