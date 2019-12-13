<?php
    if (isset($_POST['num'],$_POST['fpago'],$_POST['concepto'],$_POST['pago'],$_POST['debe'],$_POST['obs'])) {
        include("conexion.php");
        session_start();
        $clave = $_SESSION['idAlumno'];
        $num=trim($_POST['num']);
        $query = mysqli_query($conexion,"SELECT num FROM pagos WHERE num='$num'");
        if(mysqli_num_rows($query)!=0){
            echo "<div class='div-info red'>
            <div class='w10 part-info'><img src='../Imagenes/error.png'></div>
            <div class='w80 part-info'>Ya Existe un Recibo con ese Número</div>
            <div class='w10 part-info x' onclick='quitDivInfo();'>&times;</div>
            </div>";
        }else{
            $fpago=trim($_POST['fpago']);
            $concepto=trim($_POST['concepto']);
            $pago=trim($_POST['pago']);
            $debe=trim($_POST['debe']);
            $obs=trim($_POST['obs']);
            $query = mysqli_query($conexion,"INSERT INTO pagos (num,clave,fpago,concepto,pago,debe,obs) VALUES ('$num','$clave','$fpago','$concepto','$pago','$debe','$obs')");
            if(!$query){
                echo "<div class='div-info red'>
                <div class='w10 part-info'><img src='../Imagenes/error.png'></div>
                <div class='w80 part-info'>Hubo un Error al Registrar el Recibo. Inténtelo de nuevo</div>
                <div class='w10 part-info x' onclick='quitDivInfo();'>&times;</div>
                </div>";
            }else{
                echo "<div class='div-info green'>
                <div class='w10 part-info'><img src='../Imagenes/done.png'></div>
                <div class='w80 part-info'>El Recibo se Registro con Éxito</div>
                <div class='w10 part-info x' onclick='quitDivInfo();'>&times;</div>
                </div>";
            }
        }
    }else{
        header("location:../HTML/error.html");
    }
?>
