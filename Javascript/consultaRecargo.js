function consultaRecargo(){
    var grado = document.getElementById('grado').value;
    var monto = document.getElementById('monto').value;
    var nada = document.getElementById('nada');
    var algo = document.getElementById('algo');
    if(!nada.checked && !algo.checked && grado==='0' && monto==='0'){
        alert("Seleccione una Opcion para Filtrar los Alumnos");
        return false;
    }
    var info = "";
    if(grado != '0'){
        info += "grado="+grado;
    }
    if(monto != '0'){
        if(grado != '0'){
            info += "&monto="+monto;
        }else{
            info += "monto="+monto;
        }
    }
    if(nada.checked || algo.checked){
        if(grado != '0' || monto!= '0'){
            info += "&";
        }
        if(nada.checked){
            info += "debe=false";
        }else{
            info += "debe=true";
        }
    }
    consultaRecargoAjax(info);
}

function recSaldo(clave){
    alert("Actualizar Saldo de alumno"+clave);
}
