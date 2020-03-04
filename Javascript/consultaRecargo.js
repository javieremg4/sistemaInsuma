function consultaRecargo(){
    var grado = document.getElementById('grado').value;
    var turno = document.getElementById('turno').value;
    var monto = document.getElementById('monto').value;
    var cantidad = document.getElementById('cantidad').value;
    var bajasNo = document.getElementById('no');
    if(grado==='0' && monto==='0' && turno==='0' && (cantidad==="" || cantidad===null || cantidad.length===0)){
        alert("Seleccione una Opcion para Filtrar los Alumnos");
        return false;
    }
    if(cantidad!=="" && cantidad!==null && cantidad.length>0){
        if(cantidad<0){
            alert("Error: Saldo incorrecto");
        }
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
    if(turno != '0'){
        if(grado != '0' || monto!= '0'){
            info += "&turno="+(turno-1);
        }else{
            info += "turno="+(turno-1);
        }
    }
    if(cantidad!="" && cantidad!=null && cantidad.length>0){
        if(grado != '0' || monto!= '0' || turno!='0'){
            info += "&cantidad="+cantidad;
        }else{
            info += "cantidad="+cantidad;
        }
    }
    if(bajasNo.checked){
        info += "&bajas=false";
    }else{
        info += "&bajas=true";
    }
    consultaRecargoAjax(info);
}

function recSaldo(clave){
    var row = document.getElementById('al-'+clave);
    var grado = row.children[1].children[0];
    var monto = row.children[3].children[0];
    var msg = "Se Actualizarán los Datos del Alumno "+row.children[0].innerHTML+
          "\nGrado: "+grado.children[grado.selectedIndex].text+
          "\nMontos: "+monto.children[monto.selectedIndex].text+
          "\nLos Datos anteriores No se Pueden Recuperar\n¿Desea Continuar?";
    msg = confirm(msg);
    if(!msg){
        return false;
    }
    var info = "clave="+clave+"&grado="+grado.value+"&monto="+monto.value;
    recSaldoAjax(info);
}

function limpiarTodo(){
    document.getElementById('grado').selectedIndex = 0;
    document.getElementById('monto').selectedIndex = 0;
    document.getElementById('cantidad').value = "";
    document.getElementById('si').checked = true;
    document.getElementById('no').checked = false;
    document.getElementById('alumnos').innerHTML = "";
}
