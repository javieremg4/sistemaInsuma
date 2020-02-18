function validarRegistro(){
	var expCurp = /^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/;
	var curp = document.getElementById('curp').value.toUpperCase();
	if(curp!="" && curp!=null && curp.length>0){
		if(curp.search(expCurp)){
			alert("Error: Revise la CURP");
			return false;
		}
	}
	var fnac = document.getElementById('fnac').value;
	if(fnac==="" || fnac===null){
		alert("Seleccione la Fecha de Nacimiento");
		return false;
	}
	if(!validarFormatoFecha(fnac) || !existeFecha(fnac)){
		alert("Error: Revise la Fecha de Nacimiento");
		return false;
	}
	var apepat = document.getElementById('apepat').value.toUpperCase();
	var apemat = document.getElementById('apemat').value.toUpperCase();
	var nombre = document.getElementById('nombre').value.toUpperCase();
	var expLetras = /^[\ÑA-Z\s]*$/g;
	var expEsp = /^\s+$/;
	if(apepat.search(expLetras) || apemat.search(expLetras) || nombre.search(expLetras) ||
	!apepat.search(expEsp) || !apemat.search(expEsp) || !nombre.search(expEsp) ||
	nombre==="" || (apepat==="" && apemat==="") || nombre===null || (apepat===null && apemat===null) || 
	nombre.length===0 || (apepat.length===0 && apemat.length===0)){
		alert("Error: Revise el Nombre Completo");
		return false;
	}
	var direccion = document.getElementById('direccion').value.toUpperCase();
	if(!direccion.search(expEsp) || direccion==="" || direccion===null || direccion.length===0){
		alert("Agregue una Dirección");
		return false;
	}
	var expNumeros = /^\d+(\s\d+|-\d+)*$/;
	var telcel = document.getElementById('telcel').value;
	var telcasa = document.getElementById('telcasa').value;
	if(telcel!="" && telcel!=null && telcel.length>0 && telcel.search(expEsp)){
		if(telcel.search(expNumeros) || telcel.length>20){
			alert("Error: Revise el telefono celular");
			return false;
		}
	}
	if(telcasa!="" && telcasa!=null && telcasa.length>0 && telcasa.search(expEsp)){
		if(telcasa.search(expNumeros) || telcasa.search(expNumeros) || telcasa.length>20 || telcasa.length>20){
			alert("Error: Revise el telefono de casa");
			return false;
		}	
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
	var expGrado = /^[1-6]{1}$/;
    var grado = document.getElementById('grado').value;
    if(grado.search(expGrado)){
        alert("Error: Grado Incorrecto");
        return false;
    }
	var monto = document.getElementById('monto').value;
	if(monto === '0'){
		alert("Seleccione los Montos de Pago");
		return false;
	}
	msg = "¿Está seguro de que los Datos son Correctos?";
	msg = confirm(msg);
	if(!msg){ return false; }
	return true;
}
