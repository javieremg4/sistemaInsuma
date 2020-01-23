<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(!isset($_POST['idAlumno'])){
        header("location:../HTML/error.html");
    }
    require 'basicWarning.php';
    if(isset($_SESSION['operacion'],$_SESSION['idAlumno'])){
        if($_SESSION['operacion']==="ddb"){
            if(isset($_SESSION['idAlumno'],$_POST['tipo'],$_POST['fbaja'],$_POST['causa'])){
                if($_POST['idAlumno']!=$_SESSION['idAlumno']){
                    warning('error','El Alumno no se dio de Baja porque abrió Otra Ventana del Sistema.');
                    exit;
                }
                $idAlumno=$_SESSION['idAlumno'];
                include("conexion.php");
                $conAlumno=mysqli_query($conexion,"SELECT clave FROM bajas WHERE clave='$idAlumno'");
                if($conAlumno){
                    $tipo=$_POST['tipo'];
                    $fbaja=$_POST['fbaja'];
                    $causa=$_POST['causa'];
                    if(mysqli_num_rows($conAlumno)>0){
                        $baja=mysqli_query($conexion,"UPDATE bajas SET fbaja='$fbaja',tipo='$tipo',causa='$causa' WHERE clave='$idAlumno'");
                    }else{
                        $baja=mysqli_query($conexion,"INSERT INTO bajas (clave,fbaja,tipo,causa) VALUES ('$idAlumno','$fbaja','$tipo','$causa')");
                    }
                    if($baja){
                    warning("alert","El Alumno se Dio de Baja");
                    }else{
                        warning("error","No se pudo Dar de Baja al Alumno. Inténtelo de Nuevo");
                    }
                }else{
                    warning("error","No se pudo Dar de Baja al Alumno. Inténtelo de Nuevo");
                } 
            }else{
               header("location:../HTML/error.html");
            }
        }else{
            header("location:../HTML/error.html");
        }
    }else{
        warning('error','No se pudo Dar De Baja al Alumno. Vuelva a Principal e Inténtelo de Nuevo');
    }
  
?>
