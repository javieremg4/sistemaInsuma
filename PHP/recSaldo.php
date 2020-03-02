<?php
    if(!isset($_POST['clave'],$_POST['grado'],$_POST['monto'])){
        echo "error";
        exit;
    }
    $clave = $_POST['clave'];
    $grado = $_POST['grado'];
    $monto = $_POST['monto'];
    switch ($monto) {
        case '1':
            $saldo=4200;
            break;
        case '2':
            $saldo=4620;
            break;
        case '3':
            $saldo=7500;
            break;
        default:
            $saldo=null;
            break;
    }
    require_once "conexion.php";
    require_once "basicWarning.php";
    $query = "UPDATE altas SET grado='$grado',monto='$monto',saldo='$saldo' WHERE clave='$clave'";
    $result = mysqli_query($conexion,$query);
    if($result){
        warning('ok','Los Datos se Actualizaron Correctamente');
    }else{
        warning('error','No se Actualizaron los Datos. Inténtelo de Nuevo');
    }
?>