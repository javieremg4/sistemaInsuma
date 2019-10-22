function validarRegistro(){
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
	var expLetras = /^[(á,é,í,ó,ú,Á,É,Í,Ó,Ú,\ñ,\Ñ)a-zA-Z\s]*$/g;
	var expEsp = /^\s/;
	if(apepat.search(expLetras) || apemat.search(expLetras) || nombre.search(expLetras) || !apepat.search(expEsp) || !apemat.search(expEsp) || !nombre.search(expEsp) || nombre==="" || (apepat==="" && apemat==="")){
		alert("Error: Revise el Nombre Completo");
		return false;
	}
	/*if(!apepat.search(expLetras) && !apemat.search(expLetras) && !nombre.search(expLetras) && nombre!=""){
		alert("Nombre correcto");
	}
	var expNumeros = /^\d*$/;
	var telcel = document.getElementById('telcel').value;
	var telcasa = document.getElementById('telcasa').value;
	if(telcel.search(expNumeros) || telcasa.search(expNumeros) || telcel.length>15 || telcel.length>15){
		alert("Error: Revise los telefonos");
		return false;
	}*/
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
	return true;
}
function validarFormatoFecha(campo) {
	var RegExPattern = /^\d{2,4}\-\d{1,2}\-\d{1,2}$/;
	if ((campo.match(RegExPattern)) && (campo!='')) {
	      return true;
	} else {
	      return false;
	}
}
function existeFecha (fecha) {
        var fechaf = fecha.split("-");
        var d = fechaf[2];
        var m = fechaf[1];
        var y = fechaf[0];
        return m > 0 && m < 13 && y > 0 && y < 32768 && d > 0 && d <= (new Date(y, m, 0)).getDate();
}
function validarFechaMenorActual(date){
	var x=new Date();
	var fecha = date.split("-");
	x.setFullYear(fecha[0],fecha[1]-1,fecha[2]);
	var today = new Date();
	if (x > today)
		return false;
	else
		return true;
}
