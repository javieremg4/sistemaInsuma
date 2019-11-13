function valDatosEsc(nctrl){
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
	if(finscrip==="" || finscrip===null){
		alert("Seleccione la Fecha de Inscripción");
		return false;
	}
	if(!validarFormatoFecha(finscrip) || !existeFecha(finscrip) || !validarFechaMenorActual(finscrip)){
		alert("Error: Revise la Fecha de Inscripcion");
		return false;
	}
    //Aquí se elige el mensaje que irá en el confirm
    var msg="¿Está seguro de Actualizar los Datos?\nNo se podrán recuperar los datos anteriores";
    if(nctrl!="" && noControl!=nctrl){
        var msg= "¿Está seguro de cambiar el No. Control "+nctrl+" por "+noControl+"?\nNo se podrán recuperar los datos anteriores";
    }
    msg=confirm(msg);
    if(!msg){ 
        document.getElementById('nocontrol').value=nctrl;
        return false; 
    }
    return true;
}
