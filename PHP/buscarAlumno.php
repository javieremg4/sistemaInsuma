<?php
    $apepat = $_POST["apepat"];
    $apemat = $_POST["apemat"];
    $nombre = $_POST["nombre"];
    include("conexion.php");
    if($apepat=="" && $apemat=="" && $nombre!=""){
        echo "Entra aquí";
        $buscarAlumno = mysqli_query($conexion,"SELECT clave FROM datospersonales WHERE nombre='$nombre'");
        if(mysqli_num_rows($buscarAlumno)>0){
            while($info=mysqli_fetch_array($buscarAlumno)){
                $bag=$info['clave'];
            }
        }else{
            echo "No se encontró nada";
        }
    }
?>
