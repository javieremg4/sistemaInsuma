<?php
    if(!isset($_POST['grado']) && !isset($_POST['monto']) && !isset($_POST['debe'])){
        echo "error";
        exit;
    }
    require_once "conexion.php";
    $query = "SELECT d.clave,d.apepat,d.apemat,d.nombre,a.grado,a.monto,a.saldo FROM datos d INNER JOIN altas a ON d.clave=a.clave WHERE ";
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
    if(isset($_POST['debe'])){
        if(isset($_POST['grado']) || isset($_POST['monto'])){
            $query .= " AND ";
        }
        if($_POST['debe'] === 'true'){
            $query .= " a.saldo>0";
        }else if($_POST['debe'] === 'false'){
            $query .= " a.saldo=0";
        }else{
            $query .= " a.saldo>=0";
        }
    }
    //echo $query;
    $result = mysqli_query($conexion,$query);
    if($result){
        if(mysqli_num_rows($result)>0){
            echo "<table border='1'>
                    <tr><th>Nombre<th>Grado<th>Monto<th>Saldo<th>Opciones";
            while($info = mysqli_fetch_array($result)){
                echo "<tr>";
                $clave = $info['clave'];
                $baja = mysqli_query($conexion,"SELECT clave FROM bajas WHERE clave='$clave'");
                if($baja){
                    //if(mysqli_num_rows($baja)===0){
                        echo "<td>".$info['apepat']." ".$info['apemat']." ".$info['nombre'];
                        echo "<td>";
                        if($info['saldo']>0){
                            echo "<select disabled>";
                        }else{
                            echo "<select>";
                        }
                        switch ($info['grado']) {
                            case '1':
                                echo "
                                        <option value='0'>--Grado--</option>
                                        <option value='1' selected>1°</option>
                                        <option value='2'>2°</option>
                                        <option value='3'>3°</option>
                                        <option value='4'>4°</option>
                                        <option value='5'>5°</option>
                                        <option value='6'>6°</option>
                                    ";	
                                break;
                            case '2':
                                echo "
                                        <option value='0'>--Grado--</option>
                                        <option value='1'>1°</option>
                                        <option value='2' selected>2°</option>
                                        <option value='3'>3°</option>
                                        <option value='4'>4°</option>
                                        <option value='5'>5°</option>
                                        <option value='6'>6°</option>
                                    ";	
                                break;
                            case '3':
                                echo "
                                        <option value='0'>--Grado--</option>
                                        <option value='1'>1°</option>
                                        <option value='2'>2°</option>
                                        <option value='3' selected>3°</option>
                                        <option value='4'>4°</option>
                                        <option value='5'>5°</option>
                                        <option value='6'>6°</option>
                                    ";	
                                break;
                            case '4':
                                echo "
                                        <option value='0'>--Grado--</option>
                                        <option value='1'>1°</option>
                                        <option value='2'>2°</option>
                                        <option value='3'>3°</option>
                                        <option value='4' selected>4°</option>
                                        <option value='5'>5°</option>
                                        <option value='6'>6°</option>
                                    ";	
                                break;
                            case '5':
                                echo "
                                        <option value='0'>--Grado--</option>
                                        <option value='1'>1°</option>
                                        <option value='2'>2°</option>
                                        <option value='3'>3°</option>
                                        <option value='4'>4°</option>
                                        <option value='5' selected>5°</option>
                                        <option value='6'>6°</option>
                                    ";	
                                break;
                            case '6':
                                echo "
                                        <option value='0'>--Grado--</option>
                                        <option value='1'>1°</option>
                                        <option value='2'>2°</option>
                                        <option value='3'>3°</option>
                                        <option value='4'>4°</option>
                                        <option value='5'>5°</option>
                                        <option value='6' selected>6°</option>
                                    ";	
                                break;
                            default:
                                echo "--";
                                break;
                        }
                        echo "</select>";
                        echo "<td>";
                        if($info['saldo']>0){
                            echo "<select disabled>";
                        }else{
                            echo "<select>";
                        }
                        switch ($info['monto']) {
                            case '1':
                                echo "<option value='0'>Eliga los montos de inscripción y colegiatura</option>
                                <option selected value='1'>Inscripción: 1000 y Colegiatura: 800</option>
                                <option value='2'>Inscripción: 1100 y Colegiatura: 880</option>
                                <option value='3'>Inscripción: 1500 y Colegiatura: 1500</option>";
                                break;
                            case '2':
                                echo "<option value='0'>Eliga los montos de inscripción y colegiatura</option>
                                <option value='1'>Inscripción: 1000 y Colegiatura: 800</option>
                                <option selected value='2'>Inscripción: 1100 y Colegiatura: 880</option>
                                <option value='3'>Inscripción: 1500 y Colegiatura: 1500</option>";
                                break;
                            case '3':
                                echo "<option value='0'>Eliga los montos de inscripción y colegiatura</option>
                                <option value='1'>Inscripción: 1000 y Colegiatura: 800</option>
                                <option value='2'>Inscripción: 1100 y Colegiatura: 880</option>
                                <option selected value='3'>Inscripción: 1500 y Colegiatura: 1500</option>";
                                break;
                            default:
                                echo "<option selected value='0'>Eliga los montos de inscripción y colegiatura</option>
                                <option value='1'>Inscripción: 1000 y Colegiatura: 800</option>
                                <option value='2'>Inscripción: 1100 y Colegiatura: 880</option>
                                <option value='3'>Inscripción: 1500 y Colegiatura: 1500</option>";
                                break;
                        }
                        echo "</select>";
                        echo "<td>$".$info['saldo'];
                        echo "<td>";
                        if($info['saldo']>0){
                            echo "N/A";
                        }else{
                            echo "<button onclick='recSaldo(".$info['clave'].");'>Guardar y Actualizar Saldo</button>";
                        }
                    //}
                }else{
                    echo "<td>".$info['apepat']." ".$info['apemat']." ".$info['nombre'];
                    echo "<td colspan='4'>Error: No se pudieron mostrar los datos";
                }
            }
            echo "</table>";
        }else{
            echo "No se encontró Ningún Alumno";
        }
    }else{
        echo "Hubo un error al Consultar los Alumnos. Inténtelo de Nuevo.";
    }
    
?>
