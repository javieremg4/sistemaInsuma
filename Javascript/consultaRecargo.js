function consultaRecargo(){
    var grado = document.getElementById('grado').value;
    var monto = document.getElementById('monto').value;
    var nada = document.getElementById('nada');
    var algo = document.getElementById('algo');
    var bajasSi = document.getElementById('si');
    var bajasNo = document.getElementById('no');
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
    var monto = row.children[2].children[0];
    var msg = "Se Actualizarán los Datos del Alumno "+row.children[0].innerHTML+
          "\nGrado: "+grado.children[grado.selectedIndex].text+
          "\nGrupo: "+monto.children[monto.selectedIndex].text+
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
    document.getElementById('algo').checked = false;
    document.getElementById('nada').checked = false;
    document.getElementById('si').checked = true;
    document.getElementById('no').checked = false;
    document.getElementById('alumnos').innerHTML = "";
}
