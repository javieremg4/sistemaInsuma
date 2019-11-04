function validarRegistro(){
	var expCurp = /^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/;
	var curp = document.getElementById('curp').value;
	if(curp.length!=""){
		if(curp.search(expCurp)){
			alert("Error: Revise la CURP");
			return false;
		}
	}
	var grado = document.getElementById('grado').value;
	if(grado<1 || grado>6){
		alert("Error: Grado Incorrecto");
		return false;
	}
	var apepat = document.getElementById('apepat').value;
	var apemat = document.getElementById('apemat').value;
	var nombre = document.getElementById('nombre').value;
	var expLetras = /^[(á,é,í,ó,ú,Á,É,Í,Ó,Ú,\ñ,\Ñ)a-zA-Z\s]*$/g;
	var expEsp = /^\s/;
	if(apepat.search(expLetras) || apemat.search(expLetras) || nombre.search(expLetras) || !apepat.search(expEsp) || !apemat.search(expEsp) || !nombre.search(expEsp) || nombre==="" || (apepat==="" && apemat==="")){
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
	var finscrip = document.getElementById('finscrip').value;
	if(!validarFormatoFecha(finscrip) || !existeFecha(finscrip) || !validarFechaMenorActual(finscrip)){
		alert("Error: Revise la Fecha de Inscripcion");
		return false;
	}
	var direccion = document.getElementById('direccion').value;
	if(direccion===""){
		alert("Agregue una Dirección");
		return false;
	}
	var expNumeros = /^\d*$/;
	var telcel = document.getElementById('telcel').value;
	var telcasa = document.getElementById('telcasa').value;
	if(telcel.search(expNumeros) || telcasa.search(expNumeros) || telcel.length>15 || telcasa.length>15){
		alert("Error: Revise los telefonos");
		return false;
	}
	return true;
}
