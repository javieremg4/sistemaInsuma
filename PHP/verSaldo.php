<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(isset($_GET['view'])){
        if(isset($_SESSION['idAlumno'])){
            require 'conexion.php';
            $idAlumno = $_SESSION['idAlumno'];
            $query = mysqli_query($conexion,"SELECT datos.nombre,datos.apepat,datos.apemat,altas.monto,altas.saldo FROM datos INNER JOIN altas ON datos.clave=altas.clave WHERE datos.clave='$idAlumno'");
            if($query){
                $info = mysqli_fetch_array($query);
                echo "<b>Nombre del Alumno:</b> ".$info['nombre']." ".$info['apepat']." ".$info['apemat']."<br>";
                switch ($info['monto']){
                    case '1':
                        echo "<b>Montos de pago:</b> Inscripción: 1000 y Colegiatura: 800";
                        break;
                    case '2':
                        echo "<b>Montos de pago:</b> Inscripción: 1100 y Colegiatura: 880";
                        break;
                    case '3':
                        echo "<b>Montos de pago:</b> Inscripción: 1500 y Colegiatura: 1500";
                        break;
                    default:
                        echo "<b>Es Necesario Asignar un Monto de pago Actualizando los Datos Escolares</b>";
                        break;
                }
                echo "<br><b>Saldo del Cuatrimestre:</b> $".$info['saldo'];
            }
            
        }
    }else{
        header("location:../HTML/error.html");
    }
?>
