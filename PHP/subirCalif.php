<?php
    if(!isset($_POST['grado'],$_POST['grupo'],$_POST['turno'],$_POST['materia'],$_POST['students'])){
        echo "Error";
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
    $materia = $_POST['materia'];
    require_once 'conexion.php';
    $result = mysqli_query($conexion,"SELECT datos.clave,datos.apepat,datos.apemat,datos.nombre FROM datos INNER JOIN altas ON datos.clave
    =altas.clave WHERE altas.grado='$grado' AND altas.grupo='$grupo' AND altas.turno='$turno' ORDER BY datos.apepat ASC");
    $index=0;
    if(mysqli_num_rows($result)>0){
        while($info=mysqli_fetch_array($result)){
            if(!empty($info['apepat']) && !empty($info['apemat'])){
                $name = $info['apepat']." ".$info['apemat']." ".$info['nombre'];
            }elseif(empty($info['apepat'])) {
                $name = $info['apemat']." ".$info['nombre'];
            }else{
                $name = $info['apepat']." ".$info['nombre'];
            }
            $names[0]=$name;
            $names[1]=$info['clave'];
            $arrayInfo[$index] = $names;
            $index++;
        }
    }else{
        echo "<span class='text-red' style='text-align: center'>
            <h3>No se registró nada
            <h4>No se encontró ningún alumno 
            </span>";
        exit;
    }
    echo "<span style='text-align: center;'><h3>Resultados del Registro de Calificaciones";
    echo "<h4>Grado: ".$grado." Grupo: ".$grupo." Turno: ";
    echo ($turno===0) ? "Matutino":"Mixto";
    $query = "SELECT materia FROM materias WHERE idMateria='$materia'";
    $result = mysqli_query($conexion,$query);
    echo "<h4 class='mb15'>Materia: ";
    echo ($info = mysqli_fetch_array($result)) ? $info['materia'] : $materia;
    echo "</h4></span>";
    $studentsArray = json_decode($_POST['students'],true);
    $size = count($studentsArray);
    echo "<table class='w80'><th class='w10'>N°<th class='w60'>Alumno<th class='w30'>Estado";
    for($i=0; $i<$size; $i++){
        $student = $studentsArray[$i];
        $size2 = count($student);
        $error = false;
        echo "<tr><td>".($i+1);
        for($j=0; $j<$size2; $j++){
            if(strpos($student[$j],'#') || strpos($student[$j],'{')){
                echo "<td colspan='2' class='text-red'>Error en el Excel";
                $error = true;
                break;
            }
        }
        if(!$error){
            echo "<td class='tdleft'>".$student[0];
            for($index=0; $index<sizeof($arrayInfo); $index++){
                $names = $arrayInfo[$index];
                if(strcmp(trim($student[0]),$names[0])===0){
                    $clave = $names[1];
                    $par1 = $student[1];
                    $par2 = $student[2];
                    $par3 = $student[3];
                    $prom = $student[4];
                    //El id de la calificación está formado por el id de la materia y el id del alumno
                    $idCalif = $materia."-".$names[1];
                    $query = "INSERT INTO calificaciones (idCalif,clave,idMateria,par1,par2,par3,prom) values ('$idCalif','$clave','$materia','$par1','$par2','$par3','$prom')";
                    $result = mysqli_query($conexion,$query);
                    if($result){
                        array_splice($arrayInfo,$index,1);
                        echo "<td class='text-green'>registrado";
                    }else{
                        echo "<td>ya estaba registrado";
                    }
                    $error = true;
                    break;
                }
            }
            if(!$error){
                echo "<td class='text-red'>no se encontró";
            }
        }
    }
    echo "</table>";
?>
