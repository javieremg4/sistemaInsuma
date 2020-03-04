<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(isset($_POST['view'],$_POST['idAlumno'])){
        /*if($_POST['idAlumno']!=$_SESSION['idAlumno']){
            echo "No se Mostró el Historial de Pagos porque abrió Otra Ventana del Sistema.";
            exit;
        }*/
        if(isset($_SESSION['idAlumno'])){
            require "conexion.php";
            $idAlumno = $_SESSION['idAlumno'];
            $query = mysqli_query($conexion,"SELECT * FROM pagos WHERE clave='$idAlumno' ORDER BY fpago DESC");
            if(mysqli_num_rows($query)>0){
                echo "<span class='span-msg'>HISTORIAL DE PAGOS DEL ALUMNO</span><hr>";
                echo "<table class='w80'>";
                echo "<tr>
                        <th class='w10'>No. RECIBO</th>
                        <th class='w10'>FECHA</th>
                        <th class='w10'>GRADO</th>
                        <th class='w20'>CONCEPTO</th>
                        <th class='w10'>DEBE</th>
                        <th class='w10'>PAGO</th>
                        <th class='w10'>OBSERVACIONES</th>
                        <th class='w20'>OPCIONES</th>
                    </tr>";
                while($info=mysqli_fetch_array($query)){
                    $resultado = "";
                    $resultado .= "<tr>";
                    $resultado .= "<td class='w10'>".$info['num']."</td>"
                                ."<td class='w10'>".$info['fpago']."</td>"
                                ."<td class='w10'>".$info['cuatri']."</td>"
                                ."<td class='w20'>".$info['concepto']."</td>"
                                ."<td class='w10'>".$info['debe']."</td>"
                                ."<td class='w10'>".$info['pago']."</td>"
                                ."<td class='w10'>".$info['obs']."</td>";
                    $resultado .= "<td class='w20'>";
                    switch($info['tipo']){
                        case '0':
                            $resultado .= "<button onclick='delRecibo(".$idAlumno.",".$info['tipo'].",\"".$info['num']."\",".$info['pago'].")'>"
                                        ."Eliminar"
                                        ."</button>";
                            break;
                        case '1':
                            $resultado .= "<button onclick='delRecibo(".$idAlumno.",".$info['tipo'].",\"".$info['num']."\",".$info['pago'].")'>"
                                        ."Eliminar y Actualizar Saldo"
                                        ."</button>";
                            break;
                        default:
                            $resultado .= "N/A";
                    }
                    $resultado .= "</tr>";
                    echo $resultado;
                }
                echo "</table>";
            }else{
                echo "No hay Recibos Registrados de Este Alumno";
            } 
        }
    }else{
        header("location:../HTML/error.html");
    }
?>
