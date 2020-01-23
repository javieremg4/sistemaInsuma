function valBaja(clave){
    if(!document.getElementById("tipo1").checked && !document.getElementById("tipo2").checked){
        alert("Error: Debe seleccionar un tipo de baja");
        return false;
    }
    var fnac = document.getElementById('fbaja').value;
	if(fnac===""){
		alert("Seleccione una Fecha");
		return false;
	}
	if(!validarFormatoFecha(fnac) || !existeFecha(fnac) || !validarFechaMenorActual(fnac)){
		alert("Error: Revise la Fecha");
		return false;
    };
    msg = "¿Está seguro que desea dar de Baja al Alumno?"
    msg = confirm(msg);
    if(!msg){
        return false;""
    }
    var tipo = null;
    if(document.getElementById('tipo1').checked){
        tipo = 0;
    }else{
        tipo = 1;
    }
    var causa = document.getElementById('causa').value;
    var info = "idAlumno="+clave+"&tipo="+tipo+"&fbaja="+fnac+"&causa="+causa;
    darDeBaja(info);
}
