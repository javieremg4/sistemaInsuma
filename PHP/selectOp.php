<?php
    if(isset($_POST['operation']) && !empty($_POST['operation'])){
        session_start();
        switch ($_POST['operation']) {
            case 'upDP':
                $_SESSION['operacion']="adp";
                break;
            case 'pay':
                $_SESSION['operacion']="pago";
                break;
            default:
                $_SESSION['operacion']='error';
                break;
        }
    }else{
        $_SESSION['operacion']='error';
    }
?>