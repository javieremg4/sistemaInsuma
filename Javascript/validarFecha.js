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
