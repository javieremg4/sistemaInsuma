<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(isset($_GET['view'])){
        require 'basicWarning.php';
        if(isset($_SESSION['operacion'],$_SESSION['idAlumno'])){
            if($_SESSION['operacion']==="ade"){
                $idAlumno=$_SESSION['idAlumno'];
                require 'conexion.php';
                $conAlumno = mysqli_query($conexion,"SELECT datos.apepat,datos.apemat,datos.nombre,altas.* FROM datos INNER JOIN altas ON datos.clave = altas.clave WHERE datos.clave='$idAlumno'");
                if($info=mysqli_fetch_array($conAlumno)){
                    echo "Nombre del Alumno: ".$info['nombre']." ".$info['apepat']." ".$info['apemat'];
                    $resultado = "";
                    $resultado .= "<div class='content col-lg-4'>
                    <div class='text-form col-lg-12'>Datos Escolares</div>
                    <div class='form'>
                    <div class='row div-style'>";
                    if($info['numControl']!=null || $info['numControl']!=''){
                        $resultado .= "<div class='col-lg-6'>
                        No.Control
                        <input class='campo col-lg-7' type='text' name='nocontrol' id='nocontrol' value='".$info['numControl']."'> 
                        </div>";
                    }else{
                        $resultado .= "<div class='col-lg-6'>
                        No.Control
                        <input class='campo col-lg-7' type='text' name='nocontrol' id='nocontrol'> 
                        </div>
                        <div class='col-lg-6' style='color:red;'>Sin Número de Control</div>";
                    }
                    $resultado .= "</div>
                    <div class='row div-style'>
                    <div class='col-lg-3'>
                    Grado 
                    <input class='campo col-lg-5' type='number' id='grado' name='grado' value='".$info['grado']."'>
                    </div>
                    <div class='col-lg-4'>
                    <div class='col-lg-12' style='margin: 0 auto;'>
                    Grupo 					
                    <select name='grupo' id='grupo'>";
                    switch($info['grupo']){
                        case 'A': 
                            $resultado .= "<option selected value='0'>A</option>
                            <option value='1'>B</option>
                            <option value='2'>C</option>
                            <option value='3'>D</option>";
                        break;
                        case 'B':
                            $resultado .= "<option value='0'>A</option>
                            <option selected value='1'>B</option>
                            <option value='2'>C</option>
                            <option value='3'>D</option>";
                        break;
                        case 'C':
                            $resultado .= "<option value='0'>A</option>
                            <option value='1'>B</option>
                            <option selected value='2'>C</option>
                            <option value='3'>D</option>";
                        break;
                        case 'D':
                            $resultado .= "<option value='0'>A</option>
                            <option value='1'>B</option>
                            <option value='2'>C</option>
                            <option selected value='3'>D</option>";
                        break;
                    }
                    $resultado .= "</select>
                    </div>
                    </div>
                    <div class='col-lg-5'>	
                    Turno						
                    <select class='campo' name='turno' id='turno'>";
                    if($info['turno']==0){
                        $resultado .= "<option selected value='0'>Matutino</option>
                        <option value='1'>Mixto</option>";
                    }else{
                        $resultado .= "<option value='0'>Matutino</option>
                        <option selected value='1'>Mixto</option>";
                    }
                    $resultado .= "</select>					
                    </div>
                    </div>
                    <div class='div-style'>					
                    Fecha de 
                    <input class='campo' type='date' id='fregistro' name='fregistro' value='".$info['fregistro']."'>
                    </div>
                    <div class='div-style'>
                    <span>Montos de pago</span>";
                    if($info['saldo']>0){
                        $resultado .= "<select name='monto' id='monto' disabled>";
                    }else{
                        $resultado .= "<select name='monto' id='monto'>";
                    }
                    switch ($info['monto']) {
                        case '1':
                            $resultado .= "<option value='0'>Eliga los montos de inscripción y colegiatura</option>
                            <option selected value='1'>Inscripción: 1000 y Colegiatura: 800</option>
                            <option value='2'>Inscripción: 1100 y Colegiatura: 880</option>
                            <option value='3'>Inscripción: 1500 y Colegiatura: 1500</option>";
                            break;
                        case '2':
                            $resultado .= "<option value='0'>Eliga los montos de inscripción y colegiatura</option>
                            <option value='1'>Inscripción: 1000 y Colegiatura: 800</option>
                            <option selected value='2'>Inscripción: 1100 y Colegiatura: 880</option>
                            <option value='3'>Inscripción: 1500 y Colegiatura: 1500</option>";
                            break;
                        case '3':
                            $resultado .= "<option value='0'>Eliga los montos de inscripción y colegiatura</option>
                            <option value='1'>Inscripción: 1000 y Colegiatura: 800</option>
                            <option value='2'>Inscripción: 1100 y Colegiatura: 880</option>
                            <option selected value='3'>Inscripción: 1500 y Colegiatura: 1500</option>";
                            break;
                        default:
                            $resultado .= "<option selected value='0'>Eliga los montos de inscripción y colegiatura</option>
                            <option value='1'>Inscripción: 1000 y Colegiatura: 800</option>
                            <option value='2'>Inscripción: 1100 y Colegiatura: 880</option>
                            <option value='3'>Inscripción: 1500 y Colegiatura: 1500</option>";
                            break;
                    }
                    $resultado .= "
                    </select>
                    </div>
                    <div class='div-btn'>
                    <input class='boton col-lg-4' type='submit' name='btnRegistro' value='Actualizar'  onclick='valDatosEsc(\"";
                    $resultado .= $info['numControl'];
                    $resultado .= "\",\"";
                    $resultado .= $info['clave'];
                    $resultado .= "\");'>
                    </div>
                    </div>
                    </div>";
                    $resultado .= "<section class='sec-info mt16'>
                    <div class='div-info attention'>
                    <div class='w10 part-info'><img src='../Imagenes/warning.png'></div>
                    <div class='w80 part-info'>Para actualizar los Montos de Pago el Saldo del Cuatrimestre del Alumno debe ser $0.00</div>
                    </div>
                    </section>";
                    echo $resultado;
                }else{
                   warning('error',"Hubo un Error al Intentar Mostrar los Datos");
                }
            }
        } 
    }else{
        header("location:../HTML/error.html");
    }
?>
