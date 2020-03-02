<?php
    if(!isset($_POST['grado'])){
        echo "error";
        exit;
    }
    session_start();
    $idAlumno = $_SESSION['idAlumno'];
    $grado = $_POST['grado'];
    require_once "conexion.php";
    $query = "SELECT materias.idMateria,materias.materia,q.par1,q.par2,q.par3,q.prom from materias left join (select m.idMateria,c.par1,c.par2,c.par3,c.prom from materias m inner join calificaciones c on m.idMateria=c.idMateria where c.clave='$idAlumno') as q on materias.idMateria = q.idMateria where materias.grado='$grado' and materias.status='1'";
    $result = mysqli_query($conexion,$query);
    $table = "";
    if(mysqli_num_rows($result)>0){
        $table = "<table id='califTable' class='w50'>";
        $table .= "<tr><th class='w50'>MATERIA (A)<th class='w10'>1er PARCIAL<th class='w10'>2do PARCIAL<th class='w10'>3er PARCIAL<th class='w15'>CALIFICACION FINAL";
        while($info = mysqli_fetch_array($result)){
            $table .= "<tr id='".$info['idMateria']."'><td class='tdleft'>".$info['materia'];
            $table .= "<td><input type='text'";
            $table .= (empty($info['par1'])) ? ">" : "value='".$info['par1']."'>";
            $table .= "<td><input type='text'";
            $table .= (empty($info['par2'])) ? ">" : "value='".$info['par2']."'>";
            $table .= "<td><input type='text'";
            $table .= (empty($info['par3'])) ? ">" : "value='".$info['par3']."'>";
            $table .= (empty($info['prom'])) ? "<td>"."--" : "<td>".$info['prom'];
        }
        $table .= "</table>";
    }
    $table .= "<div class='div-btn'><button class='font15' onclick='valCalif(".$grado.",".$idAlumno.")'>Guardar cambios</button></div>";
    echo $table;
    $num = "<div class='mt16' style='text-align: center;'>";
    $num .= "Cuatrimestres";
    for($i=1; $i<=6; $i++){
        $num .= "<a class='";
        if($grado == $i){
            $num .= "text-red";
        }else{
            $num .= "text-blue";
        }
        $num .= " num' onclick='verCalif(".$i.")'>".$i."</a>";
    }
    $num .= "</div>";
    echo $num;
?>
