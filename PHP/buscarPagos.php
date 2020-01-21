<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
    }
    if(isset($_GET['view'])){
        if(isset($_SESSION['idAlumno'])){
            require "conexion.php";
            $idAlumno = $_SESSION['idAlumno'];
            $query = mysqli_query($conexion,"SELECT * FROM pagos WHERE clave='$idAlumno' ORDER BY fpago DESC");
            if(mysqli_num_rows($query)>0){
                echo "<span class='span-msg'>HISTORIAL DE PAGOS DEL ALUMNO</span><hr>";
                echo "<table>";
                echo "<tr>
                        <th class='w10'>No. RECIBO</th>
                        <th class='w10'>FECHA</th>
                        <th class='w30'>CONCEPTO</th>
                        <th class='w10'>DEBE</th>
                        <th class='w10'>PAGO</th>
                        <th class='w30'>OBSERVACIONES</th>
                    </tr>";
                while($info=mysqli_fetch_array($query)){
                    $resultado = "";
                    $resultado .= "<tr>";
                    $resultado .= "<td class='w10'>".$info['num']."</td>"
                                ."<td class='w10'>".$info['fpago']."</td>"
                                ."<td class='w30'>".$info['concepto']."</td>"
                                ."<td class='w10'>".$info['debe']."</td>"
                                ."<td class='w10'>".$info['pago']."</td>"
                                ."<td class='w30'>".$info['obs']."</td>";
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
