<?php
	session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }else{
    	if(isset($_POST["usuario"],$_POST["clave"])){
    		$usuario = $_POST["usuario"];
			$clave = $_POST["clave"];
			include("conexion.php");
			$buscarUsuario = mysqli_query($conexion,"select usuario from usuarios where usuario='$usuario'");
			if(mysqli_num_rows($buscarUsuario)>0){
				$_SESSION['error']=1;
				header("location:../HTML/registroUsuario.html");
			}else{
				$registroUsuario = mysqli_query($conexion,"insert into usuarios (usuario,clave) values ('$usuario','$clave')");
				if($registroUsuario){
					$_SESSION['reg']=1;
				}else{
					$_SESSION['error']=1;
				}
			}
		}
		header("location:../HTML/registroUsuario.html");
	}
?>

