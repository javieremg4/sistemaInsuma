<?php
    if(!isset($_POST['grade'])){
        echo "error";
        exit;
    }
    require_once 'conexion.php';
    $grade = trim($_POST['grade']);
    $query = "SELECT idMateria,materia FROM materias WHERE grado='$grade'";
    $result = mysqli_query($conexion,$query);
    if(mysqli_num_rows($result)>0){
        echo "<select id='materia'>";
        echo "<option value='0' selected>--Materia--</option>";
        while($info = mysqli_fetch_array($result)){
            echo "<option value='".$info['idMateria']."'>".$info['materia']."</option>";
        }
        echo "</select>";
    }else{
        echo "<select id='materia'>
        <option value='0' selected>--Materia--</option>
    </select>";
    }
?>
