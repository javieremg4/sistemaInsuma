<?php
    if(isset($_GET['adp']) || isset($_GET['ade']) || isset($_GET['ddb']) || isset($_GET['pago'])){
        session_start();
        if(isset($_GET['adp'])){ 
            $id=$_GET['adp'];
            $_SESSION['idAlumno']=$id;
            header("location:../HTML/actDatosPer.html"); 
        }elseif(isset($_GET['ade'])){
            $id=$_GET['ade'];
            $_SESSION['idAlumno']=$id;
            header("location:../HTML/actDatosEsc.html"); 
        }elseif (isset($_GET['ddb'])) {
            $id=$_GET['ddb'];
            $_SESSION['idAlumno']=$id;
            header("location:../HTML/darDeBaja.html");
        }elseif(isset($_GET['pago'])){
            $id=$_GET['pago'];
            $_SESSION['idAlumno']=$id;
            header("location:../HTML/registroPago.html");
        }else{
            header("location:../HTML/error.html");
        }
    }else{
        header("location:../HTML/error.html");
    }
?>
