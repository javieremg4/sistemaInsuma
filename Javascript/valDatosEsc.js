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
	var fregistro = document.getElementById('fregistro').value;
	if(fregistro==="" || fregistro===null){
		alert("Seleccione la Fecha de Registro");
		return false;
	}
	if(!validarFormatoFecha(fregistro) || !existeFecha(fregistro)){
        alert("Error: Revise la Fecha de Registro");
		return false;
    }
    var monto  = document.getElementById('monto').value;
    if(monto === '0'){
        alert('Seleccione los Montos de Inscripción y Colegiatura');
        return false;
    }    
    //Aquí se elige el mensaje que irá en el confirm
    var expWhite = /^\s*$/;
    var msg="¿Está seguro de Actualizar los Datos";
    if(nctrl!="" && nctrl!=null && (noControl==="" || noControl===null || noControl.length===0 || !noControl.search(expWhite))){
        msg = "¿Está seguro de eliminar el No. Control "+nctrl;
    }else if(nctrl!="" && nctrl!=null && noControl!=nctrl){
        msg = "¿Está seguro de cambiar el No. Control "+nctrl+" por "+noControl;
    }
    msg += "?\nNo se podrán recuperar los datos anteriores";
    msg=confirm(msg);
    if(!msg){ 
        document.getElementById('nocontrol').value=nctrl;
        verDatosEsc();
        alert('No se Cambió Ningún Dato');
        return false;
    }else{
        var turno = document.getElementById('turno').value;
        var grupo = document.getElementById('grupo').value;
        var info = "nocontrol="+noControl+"&fregistro="+fregistro+"&grado="+grado+"&grupo="+grupo+"&turno="+turno+"&monto="+monto;
        actDatosEsc(info);
    }
}
