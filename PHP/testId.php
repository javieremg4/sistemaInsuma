<?php
    if(isset($_GET['adp']) || isset($_GET['ade']) || isset($_GET['ddb'])){
        echo "Si funciona";
        session_start();
        if(isset($_GET['adp'])){ 
            $id=$_GET['adp'];
            $_SESSION['idAlumno']=$id;
            header("location:../HTML/actDatosPer.html"); 
        }else{
            if(isset($_GET['ade'])){ 
                $id=$_GET['ade'];
                $_SESSION['idAlumno']=$id;
                header("location:../HTML/actDatosEsc.html"); 
            }else{
                if(isset($_GET['ddb'])){ 
                    $id=$_GET['ddb'];
                    $_SESSION['idAlumno']=$id;
                    header("location:../HTML/darDeBaja.html"); 
                }else{
                    header("location:../HTML/error.html");
                }
            }
        }
        echo "Id Alumno".$_SESSION['idAlumno'];
    }else{
        header("location:../HTML/error.html");
    }
?>