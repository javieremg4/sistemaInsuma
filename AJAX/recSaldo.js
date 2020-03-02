function recSaldoAjax(info){
    var varajax;
    if(window.XMLHttpRequest){
        varajax = new XMLHttpRequest();
    }else{
        varajax = new ActiveXObject("Microsoft.XMLHTTP");
    }
    varajax.onreadystatechange = function(){
        if(varajax.status === 200 && varajax.readyState === 4){
            document.getElementById('info').innerHTML = varajax.responseText;
            if(document.getElementById('grado').value==='0' && document.getElementById('monto').value==='0' && 
            document.getElementById('algo').checked===false && document.getElementById('nada').checked===false){
                limpiarTodo();
            }else{
                consultaRecargo();
            }
        }
    }
    varajax.open("POST","../PHP/recSaldo.php",true);
    varajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    varajax.send(info);
}
