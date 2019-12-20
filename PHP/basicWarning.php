<?php
    function warning($type,$msg){
        switch ($type) {
            case 'ok':
                echo "<div class='div-info green'>
                        <div class='w10 part-info'><img src='../Imagenes/done.png'></div>
                        <div class='w80 part-info'>".$msg."</div>
                        <div class='w10 part-info x' onclick='quitDivInfo();'>&times;</div>
                        </div>";
                break;
            case 'error':
                echo "<div class='div-info red'>
                        <div class='w10 part-info'><img src='../Imagenes/error.png'></div>
                        <div class='w80 part-info'>".$msg."</div>
                        <div class='w10 part-info x' onclick='quitDivInfo();'>&times;</div>
                        </div>";
                break;
            case 'alert':
                echo "<div class='div-info red'>
                        <div class='w10 part-info'><img src='../Imagenes/warning.png'></div>
                        <div class='w80 part-info'>".$msg."</div>
                        </div>";
                break;
            default:
                # No se muestra nada
                break;
        }
    }
?>
