<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(!isset($_POST['clave'],$_POST['del'])){
        header("location:error.html");
    }
    require "conexion.php";
    require "basicWarning.php";
    $clave = $_POST['clave'];
    $delMateria = mysqli_query($conexion,"DELETE FROM materias WHERE idMateria='$clave'");
    if($delMateria){
        warning('alert','Se eliminó la materia');
    }else{
        warning('error','No se eliminó la materia. Favor de Intentarlo De Nuevo');
    }
?>
