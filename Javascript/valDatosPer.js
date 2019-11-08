function valDatosPer(){
	var expCurp = /^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/;
	var curp = document.getElementById('curp').value;
	if(curp.length!=""){
		if(curp.search(expCurp)){
			alert("Error: Revise la CURP");
			return false;
		}
	}
    var apepat = document.getElementById('apepat').value;
	var apemat = document.getElementById('apemat').value;
	var nombre = document.getElementById('nombre').value;
	var expLetras = /^[(á,é,í,ó,ú,Á,É,Í,Ó,Ú,\ñ,\Ñ)a-zA-Z\s]*$/g;
	var expEsp1 = /^\s/;
	if(apepat.search(expLetras) || apemat.search(expLetras) || nombre.search(expLetras) 
	|| !apepat.search(expEsp1) || !apemat.search(expEsp1) || !nombre.search(expEsp1)
	|| nombre==="" || (apepat==="" && apemat==="")){
		alert("Error: Revise el Nombre Completo");
		return false;
    }
    var fnac = document.getElementById('fnac').value;
	if(fnac===""){
		alert("Seleccione la Fecha de Nacimiento");
		return false;
	}
	if(!validarFormatoFecha(fnac) || !existeFecha(fnac) || !validarFechaMenorActual(fnac)){
		alert("Error: Revise la Fecha de Nacimiento");
		return false;
    }
    var direccion = document.getElementById('direccion').value;
	if(direccion===""){
		alert("Agregue una Dirección");
		return false;
    }
	var expNumeros = /^\d*$/;
	var telcel = document.getElementById('telalumno').value;
	var telcasa = document.getElementById('telcasa').value;
	if(telcel.search(expNumeros) || telcasa.search(expNumeros) || telcel.length>15 || telcasa.length>15){
		alert("Error: Revise los telefonos");
		return false;
	}
	var msg = "¿Está seguro de Actualizar los Datos?\nNo se podrán recuperar los datos anteriores";
	msg = confirm(msg);
	if(msg){ return true; }else{ return false; }
}
