<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(isset($_GET['view'])){
        if(isset($_SESSION['idAlumno'])){
            require 'conexion.php';
            $idAlumno = $_SESSION['idAlumno'];
            $query = mysqli_query($conexion,"SELECT saldo FROM altas WHERE clave='$idAlumno'");
            if($query){
                $info = mysqli_fetch_array($query);
                echo "Saldo del Cuatrimestre: $".$info['saldo'];
            }
        }
    }else{
        header("location:../HTML/error.html");
    }
?>
