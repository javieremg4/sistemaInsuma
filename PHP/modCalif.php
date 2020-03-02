<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(!isset($_POST['calif'],$_POST['idAlumno'])){
        header("location:../HTML/error.html");
    }
    if(!isset($_SESSION['operacion'],$_SESSION['idAlumno'])){
        warning('error','No se pudieron Actualizar las Calificaciones. Vuelva a Principal e Inténtelo de Nuevo');
        exit;
    }
    if($_SESSION['operacion']!=="cal"){
        header("location:../HTML/error.html");
    }
    require_once "conexion.php";
    require_once "basicWarning.php";
    $idAlumno = $_SESSION['idAlumno'];
    if($_POST['idAlumno']!=$_SESSION['idAlumno']){
        warning('error','Las Calificaciones no se Actualizaron porque abrió Otra Ventana del Sistema.');
        exit;
    }
    $califArray = json_decode($_POST['calif'],true);
    $size = count($califArray);
    for($i=0; $i<$size; $i++){
        $subArray = $califArray[$i];
        $idMateria = $subArray[0];
        $par1 = 0;
        $par2 = 0;
        $par3 = 0;
        $prom = 0;
        if(!empty($subArray[1])){
            $par1 = $subArray[1];
        }
        if(!empty($subArray[2])){
            $par2 = $subArray[2];
        }
        if(!empty($subArray[3])){
            $par3 = $subArray[3];
        }
        $prom = ($par1+$par2+$par3)/3;
        $idCalif = $idMateria."-".$idAlumno;
        $query = "INSERT INTO calificaciones (idCalif,clave,idMateria,par1,par2,par3,prom) VALUES ('$idCalif','$idAlumno','$idMateria','$par1','$par2','$par3','$prom')";
        $result = mysqli_query($conexion,$query);
        if(!$result){
            $query = "UPDATE calificaciones SET par1='$par1',par2='$par2',par3='$par3',prom='$prom' WHERE idCalif='$idCalif'";
            $result = mysqli_query($conexion,$query);
            if(!$result){
                warning('error','Error: No se pudieron Actualizar las Calificaciones. Inténtelo de Nuevo');
                exit;
            }
        }
    }
    warning('ok',"Calificaciones Actualizadas con Éxito")
?>
