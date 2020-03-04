<?php
    if(!isset($_POST['grado']) && !isset($_POST['turno']) && !isset($_POST['monto']) && !isset($_POST['cantidad']) && !isset($_POST['bajas'])){
        echo "error";
        exit;
    }
    require_once "conexion.php";
    $query = "SELECT d.clave,d.apepat,d.apemat,d.nombre,a.grado,a.turno,a.monto,a.saldo FROM datos d INNER JOIN altas a ON d.clave=a.clave WHERE ";
    if(isset($_POST['grado'])){
        $grado = $_POST['grado'];
        $query .= "a.grado='$grado'";
    }
    if(isset($_POST['monto'])){
        $monto = $_POST['monto'];
        if(isset($_POST['grado'])){
            $query .= " AND ";
        }
        $query .= "a.monto='$monto'";
    }
    if(isset($_POST['cantidad'])){
        $cantidad = $_POST['cantidad'];
        if(isset($_POST['grado']) || isset($_POST['monto'])){
            $query .= " AND ";
        }
        $query .= " a.saldo>='$cantidad'";
    }
    if(isset($_POST['turno'])){
        $turno = $_POST['turno'];
        if(isset($_POST['grado']) || isset($_POST['monto']) || isset($_POST['cantidad'])){
            $query .= " AND ";
        }
        $query .= "a.turno='$turno'";
    }
    $query .= " ORDER BY d.apepat ASC";
    //echo $query;
    $bajas = $_POST['bajas'];
    $arrayBajas = null;
    $index = 0;
    $queryBajas = "SELECT clave FROM bajas";
    $queryBajas = mysqli_query($conexion,$queryBajas);
    if(mysqli_num_rows($queryBajas)>0){
        while($info = mysqli_fetch_array($queryBajas)){
            $arrayBajas[$index] = $info['clave'];
            $index += 1;
        }
    }
    $result = mysqli_query($conexion,$query);
    $tabla = "";
    if($result){
        if(mysqli_num_rows($result)>0){
            $tot = mysqli_num_rows($result);
            $tabla .= "<table class='w80'>
                <tr><th>Nombre<th>Grado<th>Turno<th>Monto<th>Saldo<th>Situación<th>Opciones";
            while($info = mysqli_fetch_array($result)){
                if($bajas === 'false'){
                    if(!empty($arrayBajas)){
                        if(!in_array($info['clave'],$arrayBajas)){
                           $tabla .= generateRow($info,$arrayBajas);
                        }else{
                            $tot -= 1;
                        }
                    }else{
                        $tabla .= generateRow($info,$arrayBajas);
                    }
                }else{
                    $tabla .= generateRow($info,$arrayBajas);
                }
            }
            $tabla .= "</table>";
            if($tot > 0){
                echo $tabla;
            }else{
                echo "<span style='text-align: center; width: 100%;'><h4>No se encontró ningún alumno</span>";    
            } 
        }else{
            echo "<span style='text-align: center; width: 100%;'><h4>No se encontró ningún alumno</span>";
        }
    }else{
        echo "<span class='text-red w100' style='text-align: center;'>
                Hubo un error al Consultar los Alumnos. Inténtelo de Nuevo
            </span>";
    }

    function generateRow($info,$arrayBajas){
        $tabla = "";
        $tabla .= "<tr class='trhov' id='al-".$info['clave']."'>";
        $tabla .= "<td class='tdleft'>".$info['apepat']." ".$info['apemat']." ".$info['nombre'];
        $tabla .= "<td>";
        if(!empty($arrayBajas)){
            if(in_array($info['clave'],$arrayBajas)){
                $tabla .= "<select disabled>";
            }else{
                if($info['saldo']>0){
                    $tabla .= "<select disabled>";
                }else{
                    $tabla .= "<select>";
                }
            }
        }else{
            if($info['saldo']>0){
                $tabla .= "<select disabled>";
            }else{
                $tabla .= "<select>";
            }
        }
        switch ($info['grado']) {
            case '1':
                $tabla .= "<option value='1' selected>1°</option>
                    <option value='2'>2°</option>
                    <option value='3'>3°</option>
                    <option value='4'>4°</option>
                    <option value='5'>5°</option>
                    <option value='6'>6°</option>";	
                break;
            case '2':
                $tabla .= "<option value='1'>1°</option>
                    <option value='2' selected>2°</option>
                    <option value='3'>3°</option>
                    <option value='4'>4°</option>
                    <option value='5'>5°</option>
                    <option value='6'>6°</option>";	
                break;
            case '3':
                $tabla .= "<option value='1'>1°</option>
                    <option value='2'>2°</option>
                    <option value='3' selected>3°</option>
                    <option value='4'>4°</option>
                    <option value='5'>5°</option>
                    <option value='6'>6°</option>";	
                break;
            case '4':
                $tabla .= "<option value='1'>1°</option>
                    <option value='2'>2°</option>
                    <option value='3'>3°</option>
                    <option value='4' selected>4°</option>
                    <option value='5'>5°</option>
                    <option value='6'>6°</option>";	
                break;
            case '5':
                $tabla .= "<option value='1'>1°</option>
                    <option value='2'>2°</option>
                    <option value='3'>3°</option>
                    <option value='4'>4°</option>
                    <option value='5' selected>5°</option>
                    <option value='6'>6°</option>";	
                break;
            case '6':
                $tabla .= "<option value='1'>1°</option>
                    <option value='2'>2°</option>
                    <option value='3'>3°</option>
                    <option value='4'>4°</option>
                    <option value='5'>5°</option>
                    <option value='6' selected>6°</option>";	
                break;
            default:
                $tabla .= "--";
                break;
        }
        $tabla .= "</select>";
        $tabla .= "<td>";
        $tabla .= ($info['turno']==='0') ? "Matutino":"Mixto";
        $tabla .= "<td>";
        if(!empty($arrayBajas)){
            if(in_array($info['clave'],$arrayBajas)){
                $tabla .= "<select disabled>";
            }else{
                if($info['saldo']>0){
                    $tabla .= "<select disabled>";
                }else{
                    $tabla .= "<select>";
                }
            }
        }else{
            if($info['saldo']>0){
                $tabla .= "<select disabled>";
            }else{
                $tabla .= "<select>";
            }
        }
        switch ($info['monto']) {
            case '1':
                $tabla .= "<option selected value='1'>Inscripción: 1000 y Colegiatura: 800</option>
                <option value='2'>Inscripción: 1100 y Colegiatura: 880</option>
                <option value='3'>Inscripción: 1500 y Colegiatura: 1500</option>";
                break;
            case '2':
                $tabla .= "<option value='1'>Inscripción: 1000 y Colegiatura: 800</option>
                <option selected value='2'>Inscripción: 1100 y Colegiatura: 880</option>
                <option value='3'>Inscripción: 1500 y Colegiatura: 1500</option>";
                break;
            case '3':
                $tabla .= " <option value='1'>Inscripción: 1000 y Colegiatura: 800</option>
                <option value='2'>Inscripción: 1100 y Colegiatura: 880</option>
                <option selected value='3'>Inscripción: 1500 y Colegiatura: 1500</option>";
                break;
            default:
                $tabla .= "<option value='1'>Inscripción: 1000 y Colegiatura: 800</option>
                <option value='2'>Inscripción: 1100 y Colegiatura: 880</option>
                <option value='3'>Inscripción: 1500 y Colegiatura: 1500</option>";
                break;
        }
        $tabla .= "</select>";
        $tabla .= "<td>$".$info['saldo'];
        $tabla .= "<td>";
        if(!empty($arrayBajas)){
            if(in_array($info['clave'],$arrayBajas)){
                $tabla .= "<span style='color:red; font-weight:bold;'>BAJA</span>";;
                $tabla .= "<td>N/A";
            }else{
                $tabla .= "Registrado";
                $tabla .= "<td>";
                if($info['saldo']>0){
                    $tabla .= "N/A";
                }else{
                    $tabla .= "<button onclick='recSaldo(".$info['clave'].");'>Guardar y Actualizar Saldo</button>";
                }
            }
        }else{
            $tabla .= "Registrado";
            $tabla .= "<td>";
            if($info['saldo']>0){
                $tabla .= "N/A";
            }else{
                $tabla .= "<button onclick='recSaldo(".$info['clave'].");'>Guardar y Actualizar Saldo</button>";
            }
        }
        return $tabla;
    }
?>
