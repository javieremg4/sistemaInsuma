<?php
    if(isset($_GET['del'])){
        $delBaja = $_GET['del'];
        include("conexion.php");
        $delBaja = mysqli_query($conexion,"DELETE FROM bajas WHERE clave='$delBaja'");
        if($delBaja){
            echo "<b>La Baja se Eliminó con Éxito";
        }else{
            echo "<b>No se Eliminó la Baja. Inténtelo de Nuevo</b>";
        }
    }else{
        echo "<b>No se Eliminó la Baja. Inténtelo de Nuevo</b>";
    }
?>
