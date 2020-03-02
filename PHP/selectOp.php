<?php
    if(isset($_POST['operation']) && !empty($_POST['operation'])){
        session_start();
        switch ($_POST['operation']) {
            case 'upDP':
                $_SESSION['operacion']="adp";
                break;
            case 'upDE':
                $_SESSION['operacion']="ade";
                break;
            case 'pay':
                $_SESSION['operacion']="pago";
                break;
            case 'dDB':
                $_SESSION['operacion']="ddb";
                break;
            case 'cal':
                $_SESSION['operacion']="cal";
                break;
            default:
                $_SESSION['operacion']='error';
                break;
        }
    }else{
        header("location:../HTML/error.html");
    }
?>
