<?php
    session_start();
    if (isset($_SESSION['idAlumno'],$_POST['num'],$_POST['fpago'],$_POST['concepto'],$_POST['pago'],$_POST['debe'],$_POST['obs'])) {
        $clave = $_SESSION['idAlumno'];
        $concepto=trim($_POST['concepto']);
        include("conexion.php");
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
                        payWarning('error','Las Cantidades del Recibo no Deben ser Mayores al Saldo del Cuatrimeste');
                        $continue = false;
                    }
                }else{
                    payWarning('error','El Alumno no Debe Nada. Si es Necesario, Actualize el Saldo del Cuatrimestre');
                    $continue = false;
                }
            }
            if($continue){
                $query = mysqli_query($conexion,"SELECT num FROM pagos WHERE num='$num'");
                if($query){
                    if(mysqli_num_rows($query)!=0){
                        payWarning('error','Ya Existe un Recibo con ese Número');
                    }else{
                        $query = mysqli_query($conexion,"INSERT INTO pagos (num,clave,fpago,concepto,pago,debe,obs) VALUES ('$num','$clave','$fpago','$concepto','$pago','$debe','$obs')");
                        if(!$query){
                            payWarning('error','Hubo un Error al Registrar el Recibo. Inténtelo de nuevo');
                        }else{
                            if($concepto==="Inscripción" || $concepto==="Colegiatura" || $concepto==="Inscripción y Colegiatura"){
                                $saldo -= $pago;
                                $query = mysqli_query($conexion,"UPDATE altas SET saldo='$saldo' WHERE clave='$clave'");
                                if($query){
                                    payWarning('ok','El Recibo se Registro con Éxito');
                                }else{
                                    $query = mysqli_query($conexion,"DELETE FROM pagos WHERE num='$num'");
                                    payWarning('error','Hubo un Error al Registrar el Recibo. Inténtelo de nuevo');
                                }
                            }else{
                                payWarning('ok','El Recibo se Registro con Éxito');
                            }
                        }
                    }
                }else{
                    payWarning('error','Hubo un Error al Registrar el Recibo');
                }
            }
        }else{
            payWarning('error','Hubo un Error al Registrar el Recibo');
        }
    }else{
        header("location:../HTML/error.html");
    }
    function payWarning($type,$msg){
        switch ($type) {
            case 'ok':
                echo "<div class='div-info green'>
                        <div class='w10 part-info'><img src='../Imagenes/done.png'></div>
                        <div class='w80 part-info'>".$msg."</div>
                        <div class='w10 part-info x' onclick='quitDivInfo();'>&times;</div>
                        </div>";
                break;
            case 'error':
                echo "<div class='div-info red'>
                        <div class='w10 part-info'><img src='../Imagenes/error.png'></div>
                        <div class='w80 part-info'>".$msg."</div>
                        <div class='w10 part-info x' onclick='quitDivInfo();'>&times;</div>
                        </div>";
                break;
            default:
                # No se muestra nada
                break;
        }
    }
?>
