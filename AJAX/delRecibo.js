function delRecibo(idAlumno,tipo,idRecibo,cantidad){
    var msg = "¿Dese Eliminar el Recibo "+idRecibo+"? \n Esta Acción no se podrá Deshacer";
    msg = confirm(msg);
    if(!msg){
        return false;
    }
    var varajax;
    if(window.XMLHttpRequest){
        varajax = new XMLHttpRequest();
    }else{
        varajax = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var info = "idAlumno="+idAlumno+"&tipo="+tipo+"&num="+idRecibo+"&pago="+cantidad;
    varajax.onreadystatechange = function(){
        if(varajax.readyState===4 && varajax.status===200){
            document.getElementById('info').innerHTML = varajax.responseText;
            verSaldo();
            buscarPagos(); 
        }
    }
    varajax.open("POST","../PHP/delRecibo.php",true);
    varajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    varajax.send(info);
}
