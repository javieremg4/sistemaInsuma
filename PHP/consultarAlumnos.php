<?php
    if(!isset($_POST['grado'],$_POST['grupo'],$_POST['turno'])){
        echo "error";
        exit;
    }
    switch($_POST['grupo']){
        case '1': 
            $grupo = 'A';
            break;
        case '2': 
            $grupo = 'B';
            break;
        case '3': 
            $grupo = 'C';
            break;
        case '4': 
            $grupo = 'D';
            break;
        default:
            echo "error";
            exit;
    }
    switch($_POST['turno']){
        case '1': 
            $turno = '0';
            break;
        case '2': 
            $turno = '1';
            break;
        default:
            echo "error";
            exit;
    }
    $grado = $_POST['grado'];
    require_once 'conexion.php';
    $result = mysqli_query($conexion,"SELECT datos.apepat,datos.apemat,datos.nombre FROM datos INNER JOIN altas ON datos.clave
    =altas.clave WHERE altas.grado='$grado' AND altas.grupo='$grupo' AND altas.turno='$turno' ORDER BY datos.apepat ASC");
    $cont = 1;
    if(mysqli_num_rows($result)>0){
        echo "<table class='w80'>";
        echo "<tr><th class='w10'>N°<th class='w90'>Nombre";
        while($info=mysqli_fetch_array($result)){
            echo "<tr><td>".$cont."<td class='tdleft'>";
            echo $info['apepat']." ".$info['apemat']." ".$info['nombre'];
            $cont ++;
        } 
        echo "</table>";
    }else{
        echo "<span style='text-align: center; width: 100%;'><h4>No se encontró ningún alumno</span>";
    }
?>
