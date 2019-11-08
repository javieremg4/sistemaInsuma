function valBaja(){
    var tipo = document.getElementById("tipo");
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
        return false;
    }
    return true;
}