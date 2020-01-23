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
        if($_SESSION['operacion']==="pago"){
            if(isset($_SESSION['idAlumno'],$_POST['num'],$_POST['fpago'],$_POST['concepto'],$_POST['pago'],$_POST['debe'],$_POST['obs'])) {
                if($_POST['idAlumno']!=$_SESSION['idAlumno']){
                    warning('error','El Pago no se Registró porque abrió Otra Ventana del Sistema.');
                    exit;
                }
                $clave = $_SESSION['idAlumno'];
                include("conexion.php");
                $concepto=trim($_POST['concepto']);
                $query = mysqli_query($conexion,"SELECT saldo FROM altas WHERE clave='$clave'");
                if($saldo = mysqli_fetch_array($query)){
                    $saldo = $saldo['saldo'];
                    $num=trim($_POST['num']);
                    $pago=trim($_POST['pago']);
                    $debe=trim($_POST['debe']);
                    $fpago=trim($_POST['fpago']);     
                    $obs=trim($_POST['obs']);
                    $continue = true;
                    if($concepto==="Inscripción" || $concepto==="Colegiatura" || $concepto==="Inscripción y Colegiatura"){
                        if($saldo>0){
                            if($pago>$saldo || $debe>$saldo){
                                warning('error','Las Cantidades del Recibo no Deben ser Mayores al Saldo del Cuatrimeste');
                                $continue = false;
                            }
                        }else{
                            warning('error','El Alumno no Debe Nada. Si es Necesario, Actualize el Saldo del Cuatrimestre');
                            $continue = false;
                        }
                    }
                    if($continue){
                        $query = mysqli_query($conexion,"SELECT num FROM pagos WHERE num='$num'");
                        if($query){
                            if(mysqli_num_rows($query)!=0){
                                warning('error','Ya Existe un Recibo con ese Número');
                            }else{
                                $query = mysqli_query($conexion,"INSERT INTO pagos (num,clave,fpago,concepto,pago,debe,obs) VALUES ('$num','$clave','$fpago','$concepto','$pago','$debe','$obs')");
                                if(!$query){
                                    warning('error','Hubo un Error al Registrar el Recibo. Inténtelo de nuevo');
                                }else{
                                    if($concepto==="Inscripción" || $concepto==="Colegiatura" || $concepto==="Inscripción y Colegiatura"){
                                        $saldo -= $pago;
                                        $query = mysqli_query($conexion,"UPDATE altas SET saldo='$saldo' WHERE clave='$clave'");
                                        if($query){
                                            warning('ok','El Recibo se Registro con Éxito');
                                        }else{
                                            $query = mysqli_query($conexion,"DELETE FROM pagos WHERE num='$num'");
                                            warning('error','Hubo un Error al Registrar el Recibo. Inténtelo de nuevo');
                                        }
                                    }else{
                                        warning('ok','El Recibo se Registro con Éxito');
                                    }
                                }
                            }
                        }else{
                            warning('error','Hubo un Error al Registrar el Recibo');
                        }
                    }
                }else{
                    warning('error','Hubo un Error al Registrar el Recibo');
                }
            }else{
                header("location:../HTML/error.html");
            }
        }else{
            header("location:../HTML/error.html");
        }
    }else{
        warning('error','No se pudo registrar el recibo. Vuelva a Principal e Inténtelo de Nuevo');
    }
?>
