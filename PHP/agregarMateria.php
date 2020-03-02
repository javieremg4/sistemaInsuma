<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(!isset($_POST['materia'],$_POST['grado'],$_POST['calif'])){
        header("location:../HTML/error.html");
    }
    require "conexion.php";
    require "basicWarning.php";
    $materia = trim($_POST['materia']);
    if(stripos($materia,'ñ') !== false){
        $materia = str_replace('ñ','Ñ',$materia);
    }
    $grado = trim($_POST['grado']);
    $buscarMateria  = mysqli_query($conexion,"SELECT idMateria FROM materias WHERE grado='$grado' AND materia LIKE '%$materia%'");
    if($buscarMateria){
        if(mysqli_num_rows($buscarMateria) > 0){
            warning('error','No se pudo Agregar la Materia porque Ya Existe');
            exit;
        }
        $calif = trim($_POST['calif']);
        $calif = ($calif === "num") ? '0' : '1';
        $addMateria = mysqli_query($conexion,"INSERT INTO materias (materia,grado,calif,status) VALUES ('$materia','$grado','$calif','1')");
        if($addMateria){
            warning('ok','La Materia se Agrego con Éxito');
        }else{
            warning('error','Ocurrió un Error. Favor de intentarlo De Nuevo.');
        }
    }else{
        warning('error','Ocurrió un Error. Favor de intentarlo De Nuevo.');
    }
?>
