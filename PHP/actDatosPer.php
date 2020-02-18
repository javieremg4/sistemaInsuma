<?php
	session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:../HTML/inicioUsuario.html");
	}
	if(isset($_SESSION['operacion'],$_SESSION['idAlumno'])){
        if($_SESSION['operacion']==="adp"){
			if(!isset($_POST['claveAlumno'],$_FILES['foto']['name'],$_POST['curp'],$_POST['apepat'],$_POST['apemat'],$_POST['genero'],$_POST['fnac'],$_POST['direccion'],$_POST['telalumno'],$_POST['telcasa'])){
				$_SESSION['error']=1;
				header("location:../HTML/actDatosPer.html");
			}else{
				if($_POST['claveAlumno']!=$_SESSION['idAlumno']){
					echo "<div style='text-align:center;'>
							ERROR: Tiene más de una ventana del sistema abierta<br>
							Cierre las demás ventanas para actualizar los datos del alumno<br>
							<a href='../HTML/actDatosPer.html'>Volver a los Datos del Alumno</a>
						</div>";
					exit;
				}
				$idAlumno=$_SESSION['idAlumno'];
				$actAlumno = true;
				$uploadedfileload=true;
				//Aquí se obtiene la extensión del archivo
				$path = $_FILES['foto']['name']; 
				$ext = pathinfo($path, PATHINFO_EXTENSION); 
				//Fin
				//Aquí se valida si se selecciono una foto
				if ($_FILES['foto']['error'] > 0){
					//echo "<h3 style='color:red;'>Error: " . $_FILES['foto']['error']."</h3>";
					$uploadedfileload=false;
				}
				if($ext==""){
					$uploadedfileload=false;
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
						echo "<a href='../HTML/actDatosPer.html'>Regresar a los Datos</a>";
					}
					//Fin
				}
				if($actAlumno){
					include("conexion.php");
					//La funcion trim quita el carácter especificado del inicio y del final de la cadena
					$curp = strtoupper(trim($_POST['curp']));
					$nombre = strtoupper(trim($_POST['nombre']));
					if(strpos($nombre,'ñ')){
						$nombre = str_replace('ñ','Ñ',$nombre);
					}
					$apepat = strtoupper(trim($_POST['apepat']));
					if(strpos($apepat,'ñ')){
						$apepat = str_replace('ñ','Ñ',$apepat);
					}
					$apemat = strtoupper(trim($_POST['apemat']));
					if(strpos($apemat,'ñ')){
						$apemat = str_replace('ñ','Ñ',$apemat);
					}
					//Aqui se revisa si no existe un alumno registrado con esa curp o ese nombre
					/*echo "CURP a buscar".":".$curp."<br>";
					echo "Nombre a buscar".$apepat.$apemat.$nombre."<br>";*/
					$consultaAlumno=mysqli_query($conexion,"SELECT clave FROM datos WHERE curp='$curp' OR (nombre='$nombre' AND apepat='$apepat' AND apemat='$apemat')");					$msg = true;
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
						$actAlumno = false;
						$msg = false;
						echo "<h3 style='color: red;'>No se pudieron actualizar los datos. Inténtelo de nuevo.</h3>";
						echo "<a href='../HTML/actDatosPer.html'>Volver a los Datos del Alumno</a>";
					}
					if($actAlumno){
						$consultaAlumno=mysqli_query($conexion,"SELECT apepat,apemat,nombre,foto FROM datos WHERE clave='$idAlumno'");
						if(mysqli_num_rows($consultaAlumno)){
							$info=mysqli_fetch_array($consultaAlumno);
							if(strcmp($info['apepat'],$apepat)===0 && strcmp($info['apemat'],$apemat)===0 && strcmp($info['nombre'],$nombre)===0){
								$nomIgual=true;
							}else{
								$nomIgual=false;
							}
		
							if($_FILES['foto']['error']<=0){
									if($uploadedfileload){
										//Aquí se pone la extensión en el nombre de la Foto
										$file_name=$apepat." ".$apemat." ".$nombre.".".$ext;	
										//Fin
										$path="./../Fotos/".$file_name;
										if(move_uploaded_file($_FILES['foto']['tmp_name'], $path)){
											$subirFoto=mysqli_query($conexion,"UPDATE datos SET foto='$path' WHERE clave='$idAlumno'");
											if($subirFoto){
												if($info['foto']!=null && !$nomIgual){
													$foto_anterior=$info['apepat']." ".$info['apemat']." ".$info['nombre'].".".$ext;
														if(file_exists("./../Fotos/".$foto_anterior)){
															if(unlink("./../Fotos/".$foto_anterior)){
																echo "<h3>La Foto Anterior se Ha Eliminado</h3>";
															}else{
																echo "<h3>Favor de Eliminar la Foto Anterior</h3>";
															}
														}else{
															echo "<h3 style='color: red;'>No se encontró la Foto</h3>";
														}
												}
												echo "<h3 style='color: green;'>La Foto se Ha Subido Satisfactoriamente</h3>";
											}else{
												echo "<h3 style='color: red;'>No se pudo Subir la Foto. Favor de Intentarlo de Nuevo</h3>";
											}
										}else{
											echo "<h3 style='color: red;'>No se pudo Subir la Foto. Favor de Intentarlo de Nuevo.</h3>";
										}
									}
							}
							if(!$uploadedfileload && !$nomIgual){
								$file_name=$apepat." ".$apemat." ".$nombre.".jpg";
								$path="./../Fotos/".$file_name;
								if(file_exists($info['foto'])){
									if(rename($info['foto'],"./../Fotos/".$file_name)){
										$camNomFoto = mysqli_query($conexion,"UPDATE datos SET foto='$path' WHERE clave='$idAlumno'");
										if($camNomFoto){
											echo "<h3 style='color: green;'>La Foto fue Renombrada con Éxito</h3>";
										}else{
											echo "<h3 style='color: red;'>La Foto no Cambio su Nombre</h3>";
										}
									}else{
										echo "<h3 style='color: red;'>La Foto no Cambio su Nombre</h3>";
									}
								}else{
									echo "<h3 style='color: red;'>No se encontró la Foto</h3>";
								}
							}
						}else{
							if($_FILES['foto']['error']<=0){
								echo "<h3 style='color: red;'>No se pudo Actualizar la Foto. Inténtelo de Nuevo</h3>";
							}
						}
						$genero = $_POST['genero'];
						$fnac = $_POST['fnac'];
						$direccion = trim($_POST['direccion']);
						$telalumno = trim($_POST['telalumno']);
						$telcasa = trim($_POST['telcasa']);
						($genero==0 ? $genero="M" : $genero="F");
						if($telalumno==""){ $telalumno="S/N"; }
						if($telcasa==""){ $telcasa="S/N"; }
						$actualizarAlumno = mysqli_query($conexion,"UPDATE datos SET curp='$curp',genero='$genero',fnac='$fnac',
						apepat='$apepat',apemat='$apemat',nombre='$nombre',direccion='$direccion',telalumno='$telalumno',telcasa='$telcasa' 
						WHERE clave='$idAlumno'");
						if($actualizarAlumno){
							echo "<h3 style='color: green;'>DATOS ACTUALIZADOS CORRECTAMENTE</h3>";
							echo "<a href='../HTML/actDatosPer.html'>Ver los Datos del Alumno</a>";
						}else{
							echo "<h3 style='color: red;'>No se pudieron actualizar los datos. Inténtelo de Nuevo</h3>";
							echo "<a href='../HTML/actDatosPer.html'>Volver a los Datos del Alumno</a>";
						}
					}else{
						if($msg){
							echo "<h3 style='color: red;'>Ya existe un Alumno con esa CURP y/o Nombre</h3>";
							echo "<a href='../HTML/actDatosPer.html'>Volver a los Datos del Alumno</a>";
						}
					}
				}
			}
		}else{
			header("location:../HTML/error.html");	
		}
	}else{
		header("location:../HTML/error.html");
	}
?>
