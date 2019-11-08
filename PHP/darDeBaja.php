<?php
    session_start();
    $idAlumno=$_SESSION['idAlumno'];
    include("conexion.php");
    $conAlumno=mysqli_query($conexion,"SELECT clave FROM bajas WHERE clave='$idAlumno'");
    if($conAlumno){
        $tipo=$_POST['tipo'];
        $fbaja=$_POST['fbaja'];
        $causa=$_POST['causa'];
        ($tipo==="def") ? $tipo=1 : $tipo=0;
        if(mysqli_num_rows($conAlumno)>0){
            $baja=mysqli_query($conexion,"UPDATE bajas SET fbaja='$fbaja',tipo='$tipo',causa='$causa' WHERE clave='$idAlumno'");
        }else{
            $baja=mysqli_query($conexion,"INSERT INTO bajas (clave,fbaja,tipo,causa) VALUES ('$idAlumno','$fbaja','$tipo','$causa')");
        }
        if($baja){
           echo "<h3>El Alumno se Dio de Baja</h3>";
           echo "<a href='../HTML/buscarAlumno.html'>Regresar al Buscador</a>";
        }else{
            echo "<h3 style='color: red;'>No se pudo Dar de Baja al Alumno. Inténtelo de Nuevo</h3>";
            echo "<a href='../HTML/darDeBaja.html'>Regresar</a>";
        }
    }else{
        echo "<h3 style='color: red;'>No se pudo Dar de Baja al Alumno. Inténtelo de Nuevo</h3>";
        echo "<a href='../HTML/darDeBaja.html'>Regresar</a>";
    }
    
?>
