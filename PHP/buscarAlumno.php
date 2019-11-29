<?php
    if(isset($_POST['indicio'])){
        include("../PHP/conexion.php");
        session_start();
        echo  "Operacion actual: ".$_SESSION['operacion']."<hr>";
        //Valoración de los parámetros para realizar la búsqueda
        $indicio = trim($_POST['indicio']);
        
        if($_SESSION['operacion'] === "adp"){
            $consulta = "SELECT altas.numControl,datos.* FROM datos INNER JOIN altas ON datos.clave = altas.clave WHERE datos.nombre LIKE '%$indicio%' OR datos.apepat LIKE '%$indicio%' OR datos.apemat LIKE '%$indicio%'";
            $buscarAlumnos = mysqli_query($conexion,$consulta);
            if(mysqli_num_rows($buscarAlumnos)<1){
                echo "No se encontraron resultados<hr>";
            }else{
                $resultado = "Se encontraron ".mysqli_num_rows($buscarAlumnos)." resultados<hr>";
                echo $resultado;
                $cont_div = 0;
                while($info = mysqli_fetch_array($buscarAlumnos)){
                    $resultado = "";
                    if($cont_div === 0 || $cont_div%2 === 0){
                        $resultado .= "<div class='div-content'>";
                    }
                    $resultado .= "<div class='div-datos' onclick='sesionId("."\"adp\",".$info['clave'].")'>";
                if(!empty($info['foto']) && !file_exists($info['foto'])){
                        $idAl=$info['clave'];
                        mysqli_query($conexion,"UPDATE datos SET foto=null WHERE clave='$idAl'");
                        $info['foto']=null;
                    }
                    if(empty($info['foto'])){
                        $resultado .= "<img class='foto' src='../Imagenes/sinFoto.jpg'>";
                    }else{
                        $foto = $info['foto'];
                        $resultado .= "<img class='foto' src='".$foto."'>";
                    }
                    $resultado .= "<div class='datos'>";
                    $resultado .= "<div class='div-union'>";
                    $resultado .= "<div class='div-part'>";
                    $resultado .= 'No. Control: ';
                    if(empty($info['clave'])){
                        $resultado .= $info['clave'];
                    }else{
                        $resultado .= "S/N";  
                    }
                    $resultado .= "</div>";
                    $resultado .= "<div class='div-part'>"."CURP: ".$info['curp']."</div>";
                    $resultado .= "</div>";
                    $resultado .= "<div class='div-union'>";
                    $resultado .= "<div class='div-part'>"."Género: ".$info['genero']."</div>";
                    $resultado .= "<div class='div-part'>"."Fec. Nacimiento: ".$info['fnac']."</div>";
                    $resultado .= "</div>";
                    $resultado .= "Nombre: ".$info['apepat']." ".$info['apemat']." ".$info['nombre']."<br>";
                    $resultado .= "Dirección: ".$info['direccion'];
                    $resultado .= "<div class='div-union'>";
                    $resultado .= "<div class='div-part'>"."Tel. Alumno: ".$info['telalumno']."</div>";
                    $resultado .= "<div class='div-part'>"."Tel. Casa: ".$info['telcasa']."</div>";
                    $resultado .= "</div>";
                    $resultado .= "</div>";
                    $resultado .= "</div>";
                    if($cont_div != 0){
                        if($cont_div%2 != 0){
                            $resultado .= "</div>";
                        }
                    }
                    $cont_div += 1;
                    echo $resultado;
                }
            }
        }else if($_SESSION['operacion'] === "pago"){
            $consulta = "SELECT datos.clave,datos.foto,altas.numControl,datos.apepat,datos.apemat,datos.nombre,altas.grado,altas.grupo,altas.turno,altas.monto FROM datos INNER JOIN altas ON datos.clave=altas.clave";
            $buscarAlumnos = mysqli_query($conexion,$consulta);
            if(mysqli_num_rows($buscarAlumnos)<1){
                echo "No se encontraron resultados<hr>";
            }else{
                $resultado = "Se encontraron ".mysqli_num_rows($buscarAlumnos)." resultados<hr>";
                echo $resultado;
                $cont_div = 0;
                while($info = mysqli_fetch_array($buscarAlumnos)){
                    $resultado = "";
                    if($cont_div === 0 || $cont_div%2 === 0){
                        $resultado .= "<div class='div-content'>";
                    }
                    $resultado .= "<div class='div-datos' onclick='sesionId("."\"pago\",".$info['clave'].")'>";
                    if(!empty($info['foto']) && !file_exists($info['foto'])){
                        $idAl=$info['clave'];
                        mysqli_query($conexion,"UPDATE datos SET foto=null WHERE clave='$idAl'");
                        $info['foto']=null;
                    }
                    if(empty($info['foto'])){
                        $resultado .= "<img class='foto' src='../Imagenes/sinFoto.jpg'>";
                    }else{
                        $foto = $info['foto'];
                        $resultado .= "<img class='foto' src='".$foto."'>";
                    }
                    $resultado .= "<div class='datos'>";
                    $resultado .= 'No. Control: ';
                    if(empty($info['clave'])){
                        $resultado .= $info['clave'];
                    }else{
                        $resultado .= "S/N";  
                    }
                    $resultado .= "<br>";
                    $resultado .= "Nombre: ".$info['apepat']." ".$info['apemat']." ".$info['nombre']."<br>";
                $resultado .= $info['grado']." \"".$info['grupo']."\"<br>";
                    switch ($info['monto']) {
                        case '1':
                            $resultado .= "Inscripción: 1000 y Colegiatura: 800";
                            break;
                        case '2':
                            $resultado .= "Inscripción: 1100 y Colegiatura: 880";
                            break;
                        case '3':
                            $resultado .= "Inscripción: 1500 y Colegiatura: 1500";
                            break;
                        default:
                            $resultado .= "Es Necesario Asignar un Monto";
                            break;
                    }
                    $resultado .= "</div>";
                    $resultado .= "</div>";
                    if($cont_div != 0){
                        if($cont_div%2 != 0){
                            $resultado .= "</div>";
                        }
                    }
                    $cont_div += 1;
                    echo $resultado;
                }
            } 
        }
    }else{
        echo "No se pudo buscar";
    }
?>