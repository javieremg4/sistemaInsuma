<?php
    if(!isset($_POST['students'])){
        echo "Error";
        exit;
    }
    $studentsArray = json_decode($_POST['students'],true);
    $size = count($studentsArray);
    for($i=0; $i<$size; $i++){
        $student = $studentsArray[$i];
        $size2 = count($student);
        for($j=1; $j<$size2; $j++){
            echo $student[$j]." => ";
        }
        echo "<hr>";
    }
?>
