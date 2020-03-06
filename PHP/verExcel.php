<?php
    if(empty($_FILES['archivo']['tmp_name']) || empty($_POST['nalumnos'])){
        echo "<h4 class='text-red' style='style='text-align: center;'>Hubo un error al consultar el archivo. Inténtelo de nuevo</h4>";
        exit;
    }
    $path = $_FILES['archivo']['name']; 
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    if($ext!='xlsx' && $ext!='xls'){
        echo "<h4 class='text-red' style='text-align: center;'>El archivo no es excel: xlsx ó xls</h4>";
        exit;
    }
    if($_FILES['archivo']['size']/1024>2048){
        echo "<h4 class='text-red' style='text-align: center;'>Solo se permiten archivos de hasta 2MB</h4>";
        exit;
    }
    require_once "../vendor/autoload.php";
    $limit = 0;
    if(!empty($_POST['nalumnos'])){
        $limit = $_POST['nalumnos']+7;
    }else{
        echo "<h4 class='text-red' style='style='text-align: center;''>Hubo un error al consultar el archivo. Inténtelo de nuevo</h4>";
        exit;
    }
    use PhpOffice\PhpSpreadsheet\IOFactory;
    if(move_uploaded_file ($_FILES['archivo']['tmp_name'], "../Archivos Excel/archivo.xlsx")){
        $file_path = "../Archivos Excel/archivo.xlsx";
        $document = IOFactory::load($file_path);
        $totSheets = $document->getSheetCount();
        if($totSheets >= 3){
            $sheet = $document->getSheet(3);
            $contador = 1;
            echo "<span style='text-align: center;'><h3>Calificaciones del Excel</h3>";
            $cell = $sheet->getCellByColumnAndRow(3,3);
            $value = $cell->getFormattedValue();
            echo "<h4>Materia: ".$value."</h4>";
            $cell = $sheet->getCellByColumnAndRow(6,3);
            $value = $cell->getFormattedValue();  
            echo "<h4>Cuatrimestre: ".$value."</h4></span>";
            echo "<table class='w90' id='tabCalif' style='margin-top: 16px;'>";
            echo "<tr><th class='w5'>N°<th class='w50'>NOMBRE ALUMNO (A)<th class='w10'>1er PARCIAL<th class='w10'>2do PARCIAL<th class='w10'>3er PARCIAL<th class='w15'>CALIFICACION FINAL";
            for($i=8; $i<=$limit; $i++){
                echo "<tr>";
                echo "<td>".$contador;
                for($j=2; $j<=6; $j++){
                    if($j===2){
                        echo "<td class='tdleft'>";
                    }else{
                        echo "<td>";
                    }
                    $cell = $sheet->getCellByColumnAndRow($j, $i);
                    $value = $cell->getFormattedValue();
                    if(strlen($value)===0){
                        echo "<span class='text-red'>###";
                    }else if($j===2){
                        if(is_string($value) && !is_numeric($value)){
                            if(strlen($value)>150){
                                echo "<span class='text-red'>{Max. 150 caracteres}";
                            }else{
                                echo $value;
                            }
                        }else{
                            echo "<span class='text-red'>{error}";
                        }
                    }else if(is_numeric($value)){
                        echo $value;
                    }else{
                        echo "<span class='text-red'>{error}";
                    }
                }
                $contador++;
            }
            echo "</table>";
            echo "<div class='div-btn'>
                    <button class='font15 mb15' onclick='subirCalif();'>Subir calificaciones</button>
                 </div>";
        }else{
            echo "<h4 style='color: red;'>Error: El Archivo No Tiene el Formato Adecuado</h4>";
        }

    }else{
        echo "<h4 style='color: red;'>Hubo un error al consultar el archivo. Inténtelo de nuevo</h4>";
    }
?>
