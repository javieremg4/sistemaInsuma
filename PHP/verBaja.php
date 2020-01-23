<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(isset($_GET['view'])){
        require 'basicWarning.php';
        if(isset($_SESSION['operacion'],$_SESSION['idAlumno'])){
            if($_SESSION['operacion']==="ddb"){
                $idAlumno=$_SESSION['idAlumno'];
                include("../PHP/conexion.php");
                $checkBaja=mysqli_query($conexion,"SELECT * FROM bajas WHERE clave='$idAlumno'");
                if($checkBaja){
                    if(mysqli_num_rows($checkBaja)>0){
                        $info=mysqli_fetch_array($checkBaja);
                        echo "<div class='msg-baja' id='msgBaja'>
                            <span class='text-red'>Este Alumno ya está dado de Baja</span>
                            <span class='text-red'>";
                        echo ($info['tipo']==='0') ?  'Baja temporal' : 'Baja definitiva';
                        echo "</span>
                            <span>
                            Fecha: ".$info['fbaja']."</span>
                            <span>";
                        echo ($info['causa']==null || $info['causa']=='') ? 'Causa: Sin descripción' : 'Causa: '.$info['causa'];
                        echo "</span>
                            <div class='del-baja' onclick='delBaja(".$idAlumno.")'>Eliminar esta Baja</div>
                            </div>";
                    }else{
                        echo "<div class='content col-lg-4'>
                                <div class='text-form col-lg-12'>Baja</div>
                                <div class='form'>
                                    <div class='div-style'>
                                        Tipo de Baja: 
                                        <input type='radio' name='tipo' id='tipo1' value='temp'>Temporal
                                        <input type='radio' name='tipo' id='tipo2' value='def'>Definitiva
                                    </div>
                                    <div class='div-style'>					
                                        Fecha de baja
                                        <input class='campo' type='date' id='fbaja' name='fbaja' value='".date('Y-m-d')."'>
                                    </div>
                                    <div class='div-style'>
                                        Describa la causa (opcional). <b style='font-size: 12px;'>Max. 50 caracteres</b>
                                        <textarea style='width: 100%;' maxlength='50' id='causa' name='causa'></textarea>
                                    </div>
                                    <div class='div-btn'>
                                        <button class='boton col-lg-4' type='submit' name='btnRegistro' onclick='valBaja(".$idAlumno.");'>Dar de Baja</button>
                                    </div>
                                </div>
                            </div>";
                    }
                    $checkSaldo = mysqli_query($conexion,"SELECT saldo FROM altas WHERE clave='$idAlumno'");
                    if(mysqli_num_rows($checkSaldo)===1){
                        $info=mysqli_fetch_array($checkSaldo);
                        if($info['saldo']>0){
                            echo "<section class='sec-info mt16'>
                                <div class='div-info attention'>
                                <div class='w10 part-info'><img src='../Imagenes/warning.png'></div>
                                <div class='w80 part-info'>Considere que el Alumno tiene un Adeudo de $".$info['saldo']."</div>
                                </div>
                                </section>";
                        }
                    }else{
                        echo "<section class='sec-info mt16'>
                                <div class='div-info attention'>
                                <div class='w10 part-info'><img src='../Imagenes/warning.png'></div>
                                <div class='w80 part-info'>Considere si el Alumno aún Tiene que Pagar algo</div>
                                </div>
                                </section>";
                    }
                }else{
                    echo "<h3 style='color: red;'>No se puede Mostrar la información del Alumno</h3><br>";	
                }
            }
        }
    }else{
        header("location:../HTML/error.html");
    }
?>
