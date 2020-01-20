<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(!isset($_POST['actAlumno'])){
        header("location:../HTML/error.html");
    }
    require 'basicWarning.php';
    if(isset($_SESSION['operacion'],$_SESSION['idAlumno'],$_POST['clave'])){
        if($_SESSION['operacion']==="ade"){
            if($_POST['clave']!=$_SESSION['idAlumno']){
                warning('error','Los Datos no se Actualizaron porque abrió Otra Ventana del Sistema');
            }else{
                $idAlumno=$_SESSION['idAlumno'];
                include("conexion.php");
                $actAlumno=true;
                $msg=true;
                $noControl=$_POST['nocontrol'];
                if(!empty($noControl)){
                    $conAlumno = mysqli_query($conexion,"SELECT clave FROM altas WHERE numControl='$noControl'");
                    if($conAlumno){
                        if(mysqli_num_rows($conAlumno)>0){
                            while($info=mysqli_fetch_array($conAlumno)){
                                if($idAlumno!=$info['clave']){
                                    $actAlumno=false;
                                    break;
                                }
                            }
                        }
                    }else{
                        $msg=false;
                        $actAlumno=false;
                        warning('error','No se pudieron actualizar los datos. Inténtelo de Nuevo');
                    }
                }
                if($actAlumno){
                    $fregistro=$_POST['fregistro'];
                    $grado=$_POST['grado'];
                    $grupo=$_POST['grupo'];
                    $turno=$_POST['turno'];
                    $monto = $_POST['monto'];
                    switch($grupo){
                        case 0: $grupo='A'; break;
                        case 1: $grupo='B'; break;
                        case 2: $grupo='C'; break;
                        case 3: $grupo='D'; break;
                    }
                    $conAlumno = mysqli_query($conexion,"UPDATE altas SET numControl='$noControl',fregistro='$fregistro',
                    grado='$grado',grupo='$grupo',turno='$turno',monto='$monto' WHERE clave='$idAlumno'");
                    if($conAlumno){
                        warning('ok','Datos Actualizados Correctamente');
                    }else{
                        warning('error','No se pudieron actualizar los datos. Inténtelo de Nuevo');
                    }
                }else{
                    if($msg){
                        warning('error','Ya Existe un Alumno con ese No. Control. No se Cambió Ningún Dato');
                    }
                }
            }
        }else{
            header("location:../HTML/error.html");
        }
    }else{
        warning('error','No se pudieron actualizar los datos. Inténtelo de Nuevo');
    }
?>
