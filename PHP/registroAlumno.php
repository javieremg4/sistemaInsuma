<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header("location:../HTML/inicioUsuario.html");
	}
	if(!isset($_POST['genero'],$_POST['fnac'],$_POST['nombre'],$_POST['direccion'],$_POST['grado'],$_POST['grupo'],$_POST['turno'],$_POST['finscrip'])){
		header("location:../HTML/registroAlumno.html");
	}
	$regAlumno = true;
	$uploadedfileload=true;
	//Aquí se obtiene la extensión del archivo
	$path = $_FILES['foto']['name']; 
	$ext = pathinfo($path, PATHINFO_EXTENSION); 
	//Fin
	//Aquí se valida si se subio una foto
	if ($_FILES['foto']["error"] > 0){
		//echo "<h3 style='color:red;'>Error: " . $_FILES['foto']['error']."<h3>";
		$uploadedfileload=false;
	}
	if($ext==""){
		$uploadedfileload=false;
		echo "<h3 style='color: red;'>No agrego foto</h3>";
	//Fin
	}else{
		//Aquí se valida que la imagen/foto tenga las caracteristicas correspondientes (fomato: jpg o png, peso<=200KB)
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
			$regAlumno = false;
			echo "<h3 style='color: red;'>".$msg."</h3>";
			echo "<a href='../HTML/registroAlumno.html'>Volver al registro</a>";
		}
		//Fin
	}
	//Fin
	if($regAlumno){
		$curp = $_POST['curp'];
		$nombre = $_POST['nombre'];
		$apepat = $_POST['apepat'];
		$apemat = $_POST['apemat'];
		include("conexion.php");
		//Aqui se revisa si el alumno ya estaba registrado
		if($curp == ""){
			$consultaAlumno=mysqli_query($conexion,"SELECT clave FROM datospersonales WHERE nombre='$nombre' AND apepat='$apepat' AND apemat='$apemat'");
		}else{
			$consultaAlumno=mysqli_query($conexion,"SELECT clave FROM datospersonales WHERE curp='$curp' OR (nombre='$nombre' AND apepat='$apepat' AND apemat='$apemat')");
		}
		if(mysqli_num_rows($consultaAlumno)>0){
			echo "<h3 style='color: red;'>El Alumno ya Existe</h3>";
			echo "<a href='../HTML/registroAlumno.html'>Volver al registro</a>";
		//Fin
		}else{
			//Aquí se insertan los datos personales del alumno
			$genero = $_POST['genero'];
			$fnac = $_POST['fnac'];
			$direccion = $_POST['direccion'];
			$telalumno = $_POST['telcel'];
			$telcasa = $_POST['telcasa'];
			$msg="";
			($genero==0 ? $genero="M" : $genero="F");
			if($telalumno==""){ $telalumno="S/N"; }
			if($telcasa==""){ $telcasa="S/N"; }
			$registroAlumno=mysqli_query($conexion,"INSERT INTO datospersonales (curp,genero,apepat,apemat,nombre,fnac,direccion,telalumno,telcasa) VALUES ('$curp','$genero','$apepat','$apemat','$nombre','$fnac','$direccion','$telalumno','$telcasa')");
			//Fin
			if($registroAlumno){
				//Aquí se revisa si el directorio de Fotos existe, sí no se crea
				if (!is_dir('../Fotos')) {
	    			if(!mkdir('./../Fotos', 0777)){
	    				$uploadedfileload=false;
	    			}
				}
				//Fin
				//Aquí se sube la foto al directorio y se inserta la foto en el registro del alumno
				if($uploadedfileload){
					//Aquí se pone la extensión en el nuevo nombre
					$file_name=$apepat." ".$apemat." ".$nombre.".".$ext;	
					//Fin
					$path="./../Fotos/".$file_name;
					echo "Ruta del archivo:".$path;
					if(move_uploaded_file ($_FILES['foto']['tmp_name'], $path)){
						$subirFoto=mysqli_query($conexion,"UPDATE datospersonales SET foto='$path' WHERE (nombre='$nombre' AND apepat='$apepat' AND apemat='$apemat')");
						if($subirFoto){
							echo "<h3 style='color: green;'>La Foto se Ha Subido Satisfactoriamente</h3>";
						}else{
							echo "<h3 style='color: red;'>No se pudo Subir la Foto</h3>";
							echo "<h3>Favor de Subir la Foto en el Apartado de Actualización de Datos</h3>";
						}
					}else{
						echo "<h3 style='color: red;'>No se pudo Subir la Foto</h3>";
						echo "<h3>Favor de Subir la Foto en el Apartado de Actualización de Datos</h3>";
					}
				}
				//Fin
				//Aquí se busca la clave del alumno para asociarlo al resto de los datos
				$buscarAlumno=mysqli_query($conexion,"SELECT clave FROM datospersonales WHERE nombre='$nombre' AND apepat='$apepat' AND apemat='$apemat'");
				if($buscarAlumno){
					$grado = $_POST['grado'];
					$finscrip = $_POST['finscrip'];
					$turno = $_POST['turno'];
					$grupo = $_POST['grupo'];
					switch($grupo){
						case 0: $grupo='A'; break;
						case 1: $grupo='B'; break;
						case 2: $grupo='C'; break;
						case 3: $grupo='D'; break;
					}
					$info = mysqli_fetch_array($buscarAlumno);
					$clave = $info['clave'];
					$darDeAlta = mysqli_query($conexion,"INSERT INTO altas (clave,finscrip,grado,grupo,turno) VALUES ('$clave','$finscrip','$grado','$grupo','$turno')");
					if(!$darDeAlta){
						echo "<h3>Favor de subir el Grado, Grupo, Turno y Fecha de Inscripcion en el Apartado de Actualización de Datos</h3>";
					}
				}else{
					echo "<h3>Favor de subir el Grado y la Fecha de Inscripcion en el Apartado de Actualización de Datos</h3>";
				}
				//Fin
				echo "<h3 style='color: green;'>Alumno Registrado con exito</h3>";
				echo "<a href='../HTML/registroAlumno.html'>Volver al registro</a>";
			}else{
				echo "<h3 style='color: red;'>Alumno No Registrado</h3>";
				echo "<a href='../HTML/registroAlumno.html'>Volver al registro</a>";
			}
		}
	}
	
?>