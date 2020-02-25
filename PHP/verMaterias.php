<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(!isset($_GET['view'])){
        header("location:../HTML/error.html");
    }
    require "conexion.php";
    $buscarMaterias = mysqli_query($conexion,"SELECT * FROM materias ORDER BY grado ASC");
    $resultado = "<table class='w60' id='tabM'>";
    $resultado .= "<tr>
                    <th>MATERIA
                    <th>GRADO
                    <th>CALIFICACIÓN
                    <th>OPCIONES
                </tr>";
    while($info = mysqli_fetch_array($buscarMaterias)){
        $resultado .= "<tr class='trhov'>";
        $resultado .= "<td class='tdleft'>".$info['materia'];
        $resultado .= "<td>".$info['grado'];
        $resultado .= ($info['calif']==='0') ? "<td>0-10" : "<td>A/NA";
        if($info['status']==='0'){
            $resultado .= "<td><button onclick='actMateria(".$info['idMateria'].");'>Activar</button>";
        }else{
            $resultado .= "<td><button onclick='delMateria(".$info['idMateria'].");'>Inactivar</button>";
        }
        $resultado .= "</tr>";
    }
    $resultado .= "<tr><td colspan='4'><button id='btnAdd' onclick='addMateria();'>Agregar una materia</button></td></tr>";
    $resultado .= "</table>";
    echo $resultado;
?>
