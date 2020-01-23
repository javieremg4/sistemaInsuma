<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(isset($_GET['del'])){
        $delBaja = $_GET['del'];
        include("conexion.php");
        require 'basicWarning.php';
        $delBaja = mysqli_query($conexion,"DELETE FROM bajas WHERE clave='$delBaja'");
        if($delBaja){
            warning('ok',"La Baja se Eliminó con Éxito");
        }else{
            warning("error","No se Eliminó la Baja. Inténtelo de Nuevo");
        }
    }else{
        header("location:../HTML/error.html");
    }
?>
