function valDatosEsc(){
    var expNoControl = /^\d{8}$/;
    var noControl = document.getElementById('nocontrol').value;
    if(noControl!=""){
        if(noControl.search(expNoControl)){
            alert("El No. Control debe Contener 8 Dígitos");
            return false;
        }
    }
    var expGrado = /^[1-6]{1}$/;
    var grado = document.getElementById('grado').value;
    if(grado.search(expGrado)){
        alert("Error: Grado Incorrecto");
        return false;
    }
    var finscrip = document.getElementById('finscrip').value;
	if(!validarFormatoFecha(finscrip) || !existeFecha(finscrip) || !validarFechaMenorActual(finscrip)){
		alert("Error: Revise la Fecha de Inscripcion");
		return false;
	}
    return true;
}
