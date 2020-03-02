<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(isset($_GET['view'])){
        if(isset($_SESSION['idAlumno'])){
            require 'conexion.php';
            $idAlumno = $_SESSION['idAlumno'];
            $query = mysqli_query($conexion,"SELECT datos.nombre,datos.apepat,datos.apemat,altas.grado,altas.grupo FROM datos INNER JOIN altas ON datos.clave=altas.clave WHERE datos.clave='$idAlumno'");
            if($query){
                $info = mysqli_fetch_array($query);
                echo "<b>Nombre del Alumno:</b> ".$info['nombre']." ".$info['apepat']." ".$info['apemat']."<br>";
                echo "<b>Grado: </b>".$info['grado']."<b>   Grupo: </b>".$info['grupo'];
            }
        }
    }else{
        header("location:../HTML/error.html");
    }
?>
