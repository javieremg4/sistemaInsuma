function validar(){
	var fnac = document.getElementById('fnac').value;
	if(fnac===""){
		alert("Seleccione la Fecha de Nacimiento");
		return false;
	}
	var direccion = document.getElementById('direccion').value;
	if(direccion===""){
		alert("Agregue una Dirección");
		return false;
	}
	var curp = document.getElementById('curp').value;
	if(!(curp.length===18 || curp==="")){
		alert("Error: Revise la CURP");
		return false;
	}
	var grado = document.getElementById('grado').value;
	if(grado<1 || grado>6){
		alert("Error: Grado incorrecto");
		return false;
	}
	var apepat = document.getElementById('apepat').value;
	var apemat = document.getElementById('apemat').value;
	var nombre = document.getElementById('nombre').value;
	var expLetras = /^[(á,é,í,ó,ú,Á,É,Í,Ó,Ú)a-zA-Z\s]*$/;
	if(apepat.search(expLetras) || apemat.search(expLetras) || nombre.search(expLetras) || nombre===""){
		alert("Error: Revise el Nombre Completo");
		return false;
	}
	/*if(!apepat.search(expLetras) && !apemat.search(expLetras) && !nombre.search(expLetras) && nombre!=""){
		alert("Nombre correcto");
	}*/
	var expNumeros = /^\d*$/;
	var telcel = document.getElementById('telcel').value;
	var telcasa = document.getElementById('telcasa').value;
	if(telcel.search(expNumeros) || telcasa.search(expNumeros) || telcel.length>15 || telcel.length>15){
		alert("Error: Revise los telefonos");
		return false;
	}
	return true;
}