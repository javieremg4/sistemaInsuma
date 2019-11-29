function valPago(){
    var expNoRec = /^[a-zA-Z\d]*$/;
    var expSpace = /^\s*$/;
    var noRec = document.getElementById('noRec').value;
    if(noRec === null || noRec === "" || noRec.length === 0 || !noRec.search(expSpace)){
        alert("Debe ingresar el No. de Recibo");
        return false;
    }
    if(noRec.length > 10){
        alert("Error: El No. de Recibo es Muy Largo");
        return false;
    }
    if(noRec.search(expNoRec)){
        alert("Error: Revise el No. de Recibo");
        return false;
    }
    var fpago = document.getElementById('fpago').value;
	if(fpago==="" || fpago===null){
		alert("Seleccione la Fecha de Pago");
		return false;
	}
	if(!validarFormatoFecha(fpago) || !existeFecha(fpago)){
		alert("Error: Revise la Fecha de Pago");
		return false;
    }
    if(!document.getElementById('inscrip').checked && !document.getElementById('coleg').checked && !document.getElementById('otro').checked){
        alert("Debe seleccionar un concepto de pago");
        return false;
    }
    if(document.getElementById('otro').checked){
        var esp = document.getElementById('text-esp').value;
        if(esp === null || esp === "" || esp.length === 0 || !esp.search(expSpace)){
            alert("Debe especificar a que pago se refiere");
            return false;
        }
    }
    var pago = document.getElementById('pago').value;
    if(pago === null || pago === "" || pago.length === 0 || !pago.search(expSpace)){
        alert("Debe especificar una cantidad de pago");
        return false;
    }
    var expPago = /^\d*$/;
    if(pago.search(expPago)){
        alert("Error: Revise la Cantidad de Pago");
        return false;
    }
    if(pago.length > 4){
        var msg = "¿La cantidad de pago es correcta?";
        msg = confirm(msg);
        if(!msg){
            return false; 
        }
    }
    var totsaldo = document.getElementById('totsaldo').value;
    if(totsaldo!=null && totsaldo!="" && totsaldo.length!=0 && totsaldo.search(expSpace)){
        if(totsaldo.search(expPago)){
            alert("Error: Revise el Saldo");
            return false;
        }
        if(totsaldo.length > 4){
            var msg = "¿El Saldo es Correcto?";
            msg = confirm(msg);
            if(!msg){
                return false; 
            }
        }
    }
}
var show = true;
function showEsp(){
    if(document.getElementById('inscrip').checked || document.getElementById('coleg').checked){
        alert('No se puede registrar la Inscripción o la Colegiatura junto a otro tipo de pagos');
        document.getElementById('otro').checked = 0;
    }else{
        if(show){
            document.getElementById('esp').style.display = "block";
            show = false;
        }else{
            document.getElementById('esp').style.display = "none";
            show = true;
        }
    }
}
