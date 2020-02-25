<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(!isset($_POST['clave'],$_POST['del']) && !isset($_POST['clave'],$_POST['act'])){
        header("location:error.html");
    }
    require "conexion.php";
    require "basicWarning.php";
    $clave = $_POST['clave'];
    $nameMat = mysqli_query($conexion,"SELECT materia FROM materias WHERE idMateria='$clave'");
    if($nameMat){
        $info = mysqli_fetch_array($nameMat);
    }
    if(isset($_POST['del'])){
        $delMateria = mysqli_query($conexion,"UPDATE materias SET status='0' WHERE idMateria='$clave'");
        if($delMateria){
            if($nameMat){
                warning('alert','Se inactivó la materia '.$info['materia']);
            }else{
                warning('alert','Se inactivó la materia');
            }
        }else{
            if($nameMat){
                warning('error','No se inactivó la materia '.$info['materia']);
            }else{
                warning('error','No se inactivó la materia ');
            }
        }
    }else{
        $delMateria = mysqli_query($conexion,"UPDATE materias SET status='1' WHERE idMateria='$clave'");
        if($delMateria){
            if($nameMat){
                warning('alert','Se activó la materia '.$info['materia']);
            }else{
                warning('alert','Se activó la materia');
            }
        }else{
            if($nameMat){
                warning('error','No se activó la materia '.$info['materia']);                   
            }else{
                warning('error','No se activó la materia');
            }
        }
    }
?>
