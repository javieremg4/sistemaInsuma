<?php
    session_start();
    $idAlumno=$_SESSION['idAlumno'];
    include("conexion.php");
    $actAlumno=true;
    $msg=true;
    $noControl=$_POST['nocontrol'];
    if($noControl!=""){
        $conAlumno = mysqli_query($conexion,"SELECT clave FROM altas WHERE numControl='$noControl'");
        if($conAlumno){
            if(mysqli_num_rows($conAlumno)>0){
                while($info=mysqli_fetch_array($conAlumno)){
					if($idAlumno!=$info['clave']){
                        $actAlumno=false;
						break;
					}
                }
            }
        }else{
            $msg=false;
            $actAlumno=false;
            echo "<h3 style='color: red;'>No se pudieron actualizar los datos. Inténtelo de Nuevo</h3>";
            echo "<a href='../HTML/actDatosEsc.html'>Volver a los Datos del Alumno</a>";
        }
    }
    if($actAlumno){
        $finscrip=$_POST['finscrip'];
        $grado=$_POST['grado'];
        $grupo=$_POST['grupo'];
        $turno=$_POST['turno'];
        $grupo = $_POST['grupo'];
        switch($grupo){
            case 0: $grupo='A'; break;
            case 1: $grupo='B'; break;
            case 2: $grupo='C'; break;
            case 3: $grupo='D'; break;
        }
        $conAlumno = mysqli_query($conexion,"UPDATE altas SET numControl='$noControl',finscrip='$finscrip',
        grado='$grado',grupo='$grupo',turno='$turno' WHERE clave='$idAlumno'");
        if($conAlumno){
            echo "<h3 style='color: green;'>DATOS ACTUALIZADOS CORRECTAMENTE</h3>";
            echo "<a href='../HTML/actDatosEsc.html'>Ver los Datos del Alumno</a>";
        }else{
            echo "<h3 style='color: red;'>No se pudieron actualizar los datos. Inténtelo de Nuevo</h3>";
            echo "<a href='../HTML/actDatosEsc.html'>Volver a los Datos del Alumno</a>";
        }
    }else{
        if($msg){
            echo "<h3 style='color: red;'>Ya Existe un Alumno con ese No. Control</h3>";
            echo "<a href='../HTML/actDatosEsc.html'>Volver a los Datos del Alumno</a>";
        }
    }
?>