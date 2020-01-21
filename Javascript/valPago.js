function valPago(idAlumno){
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
    var expPago = /^(\d*|\d+\.)\d+$/;
    if(pago.search(expPago)){
        alert("Error: Revise la Cantidad de Pago");
        return false;
    }
    if(pago > 99999.99){
        alert("Error: La Cantidad de Pago es Muy Grande");
        return false;
    }
    var totsaldo = document.getElementById('totsaldo').value;
    if(totsaldo!=null && totsaldo!="" && totsaldo.length!=0 && totsaldo.search(expSpace)){
        if(pago.search(expPago)){
            alert("Error: Revise el Saldo");
            return false;
        }
        if(pago > 99999.99){
            alert("Error: El Saldo es Muy Grande");
            return false;
        }
    }
    regPago(idAlumno);
}
function showEsp(){
    if(document.getElementById('inscrip').checked || document.getElementById('coleg').checked){
        alert('No se puede registrar la Inscripción o la Colegiatura junto a otro tipo de pagos');
        document.getElementById('otro').checked = 0;
        document.getElementById('esp').style.display = "none";
    }else if(document.getElementById('otro').checked){
        document.getElementById('esp').style.display = "block";
    }else{
        document.getElementById('esp').style.display = "none";
    }
}
function valConcepto(){
    if(document.getElementById('otro').checked && 
    (document.getElementById('inscrip').checked || document.getElementById('coleg').checked)){
        alert('No se puede registrar la Inscripción o la Colegiatura junto a otro tipo de pagos');
        document.getElementById('inscrip').checked=0;
        document.getElementById('coleg').checked=0;
        document.getElementById('esp').style.display = "block";
    }
}
