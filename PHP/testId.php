<?php
    if(isset($_GET['adp']) || isset($_GET['ade']) || isset($_GET['ddb'])){
        $id=$_GET['del'];
        session_start();
        $_SESSION['idAlumno']=$id;
        if(isset($_GET['adp'])){ header("location:../HTML/actDatosPer.html"); }else{
            if(isset($_GET['ade'])){ header("location:../HTML/actDatosEsc.html"); }else{
                if(isset($_GET['ddb'])){ header("location:../HTML/darDeBaja.html"); }else{
                    header("location:../HTML/error.html");
                }
            }
        }
    }
    header("location:../HTML/error.html");
?>