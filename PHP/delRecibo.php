<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(!isset($_POST['idAlumno'],$_POST['tipo'],$_POST['num'],$_POST['pago'])){
        header("location:../HTML/error.html");
    }
    if(!isset($_SESSION['operacion'],$_SESSION['idAlumno'])){
        warning('error','No se pudo Eliminar el Recibo. Favor de Intentarlo de Nuevo');
        exit;
    }
    if($_SESSION['operacion']!=="pago"){
        header("location:../HTML/error.html");
    }
    require_once "conexion.php";
    require_once "basicWarning.php";
    if($_POST['idAlumno']!=$_SESSION['idAlumno']){
        warning('error','El Recibo no se Eliminó porque abrió Otra Ventana del Sistema.');
        exit;
    }
    $num = $_POST['num'];
    if($_POST['tipo']==="0"){
        $query = "DELETE FROM pagos WHERE num='$num'";
        $result = mysqli_query($conexion,$query);
        if($result){
            warning('ok','El Recibo se Eliminó con Éxito');
        }else{
            warning('error','No se Eliminó el Recibo. Favor de Intentarlo de Nuevo.');
        }
    }else{
        $idAlumno = $_POST['idAlumno'];
        $pago = $_POST['pago'];
        $query = "SELECT saldo FROM altas WHERE clave='$idAlumno'";
        $saldo = mysqli_query($conexion,$query);
        if($saldo){
            $saldo = mysqli_fetch_array($saldo);
            $saldo = $saldo['saldo'];
            $saldo += $pago;
            $query = "UPDATE altas SET saldo='$saldo' WHERE clave='$idAlumno'";
            $result = mysqli_query($conexion,$query);
            if($result){
                $query = "DELETE FROM pagos WHERE num='$num'";
                $result = mysqli_query($conexion,$query);
                if($result){
                    warning('ok','El Saldo se Actualizó y el Recibo se Eliminó');
                }
            }else{
                warning('error','eNo se Eliminó el Recibo. Favor de Intentarlo de Nuevo.');      
            }
        }else{
            warning('error','No se Eliminó el Recibo. Favor de Intentarlo de Nuevo.');
        }
    }
?>
