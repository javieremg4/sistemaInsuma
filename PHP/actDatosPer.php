<?php
    $actAlumno = true;
	$uploadedfileload=true;
	//Aquí se obtiene la extensión del archivo
	$path = $_FILES['foto']['name']; 
	$ext = pathinfo($path, PATHINFO_EXTENSION); 
	//Fin
	//Aquí se valida si se selecciono una foto
	if ($_FILES['foto']["error"] > 0){
		//echo "<h3 style='color:red;'>Error: " . $_FILES['foto']['error']."<h3>";
		$uploadedfileload=false;
	}
	if($ext==""){
		$uploadedfileload=false;
		echo "<h3 style='color: red;'>No agrego foto</h3>";
	//Fin
	}else{
		//Aquí se valida que la imagen/foto tenga las caracteristicas correspondientes (fomato: jpg y peso<=200KB)
		$msg="";
		if ($_FILES['foto']['size']>200000){
			$msg="El archivo es mayor que 200KB <br>";
			$uploadedfileload=false;
		}
		if ($ext!="jpeg" && $ext!="JPEG" && $ext!="jpg" && $ext!="JPG"){
			$msg=$msg."El archivo tiene que ser jpg";
			$uploadedfileload=false;
		}
		if(!$uploadedfileload){
			$actAlumno = false;
			echo "<h3 style='color: red;'>".$msg."</h3>";
			echo "<a href='../HTML/registroAlumno.html'>Volver a los datos</a>";
		}
        //Fin
    }
    if($actAlumno){
		include("conexion.php");
		//La funcion trim quita el carácter especificado del inicio y del final de la cadena
		$curp = trim($_POST['curp']);
		$apepat=trim($_POST['apepat']);
		$apemat=trim($_POST['apemat']);
		$nombre=trim($_POST['nombre']);
		//Aqui se revisa si no existe un alumno registrado con esa curp o ese nombre
		/*echo "CURP a buscar".":".$curp."<br>";
		echo "Nombre a buscar".$apepat.$apemat.$nombre."<br>";*/
		$consultaAlumno=mysqli_query($conexion,"SELECT clave FROM datospersonales WHERE curp='$curp' OR (nombre='$nombre' AND apepat='$apepat' AND apemat='$apemat')");
		session_start();
		$idAlumno=$_SESSION['idAlumno'];
		if($consultaAlumno){
			if(mysqli_num_rows($consultaAlumno)>0){
				while($info=mysqli_fetch_array($consultaAlumno)){
					if($idAlumno!=$info['clave']){
						$actAlumno=false;
						break;
					}
				}
			}
		}else{
			echo "<h3 style='color: red;'>No se pudieron actualizar los datos. Inténtelo de nuevo.</h3>";
			echo "<a href='../HTML/principalUsuario.html'>Volver a principal</a>";
		}
		if($actAlumno){
			echo "Se pueden actualizar los datos";
			$consultaAlumno=mysqli_query($conexion,"SELECT apepat,apemat,nombre,foto FROM datospersonales WHERE clave='$idAlumno'");
			if(mysqli_num_rows($consultaAlumno)){
				$info=mysqli_fetch_array($consultaAlumno);
				$nombreBD=$info['apepat'].$info['apemat'].$info['nombre'];
				$nombreAct=$apepat.$apemat.$nombre;
				echo "<hr>";
				echo $nombreBD."<br>";
				echo $nombreAct."<br>";
				(strcmp($nombreBD,$nombreAct)==0) ? $nomIgual=true : $nomIgual=false;
				if($uploadedfileload){
					//Aquí se pone la extensión en el nombre de la Foto
					$file_name=$apepat." ".$apemat." ".$nombre.".".$ext;	
					//Fin
					$path="./../Fotos/".$file_name;
					echo "Ruta del archivo:".$path;
					if(move_uploaded_file ($_FILES['foto']['tmp_name'], $path)){
						$subirFoto=mysqli_query($conexion,"UPDATE datospersonales SET foto='$path' WHERE clave='$idAlumno'");
						if($subirFoto){
							if($info['foto']!=null && !$nomIgual){
								$foto_anterior=$info['apepat']." ".$info['apemat']." ".$info['nombre'].".".$ext;
									if(file_exists("./../Fotos/".$foto_anterior)){
										if(unlink("./../Fotos/".$foto_anterior)){
											echo "<h3>La Foto Anterior se Ha Eliminado</h3>";
										}else{
											echo "<h3>Favor de Eliminar la Foto Anterior</h3>";
										}
									}
							}
							echo "<h3 style='color: green;'>La Foto se Ha Subido Satisfactoriamente</h3>";
						}else{
							echo "<h3 style='color: red;'>No se pudo Subir la Foto</h3>";
							echo "<h3>Favor de Intentarlo de Nuevo</h3>";
						}
					}else{
						echo "<h3 style='color: red;'>No se pudo Subir la Foto</h3>";
						echo "<h3>Favor de Intentarlo de Nuevo</h3>";
					}
				}
			}else{
				echo "<h3 style='color: red;'>No se pudo Subir la Foto. Inténtelo de Nuevo</h3><br>
						<a href='../HTML/principalUsuario.html>Volver a principal</a>'";
			}
			$genero = $_POST['genero'];
			$fnac = $_POST['fnac'];
			$direccion = trim($_POST['direccion']);
			$telalumno = trim($_POST['telalumno']);
			$telcasa = trim($_POST['telcasa']);
			($genero==0 ? $genero="M" : $genero="F");
			if($telalumno==""){ $telalumno="S/N"; }
			if($telcasa==""){ $telcasa="S/N"; }
			$actualizarAlumno = mysqli_query($conexion,"UPDATE datospersonales SET curp='$curp',genero='$genero',fnac='$fnac',
			apepat='$apepat',apemat='$apemat',nombre='$nombre',direccion='$direccion',telalumno='$telalumno',telcasa='$telcasa' 
			WHERE clave='$idAlumno'");
			if($actualizarAlumno){
				echo "<h3 style='color: green;'>DATOS ACTUALIZADOS CORRECTAMENTE</h3>";
			}else{
				echo "<h3 style='color: red;'>No se pudieron actualizar los datos</h3>";
			}
		}else{
			echo "<h3 style='color: red;'>Ya existe un Alumno con esa CURP y/o Nombre</h3>";
			echo "<a href='../HTML/principalUsuario.html'>Volver a principal</a>";
		}
    }
?>