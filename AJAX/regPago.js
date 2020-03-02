function regPago(idAlumno){
    var varajax;
    var num = document.getElementById('noRec').value;
    var fpago = document.getElementById('fpago').value;
    var concepto = "";
    var tipo = "1";
    if(document.getElementById('inscrip').checked && !document.getElementById('coleg').checked){
        concepto = "Inscripción";
    }else if(!document.getElementById('inscrip').checked && document.getElementById('coleg').checked){
        concepto = "Colegiatura";
    }else if(document.getElementById('inscrip').checked && document.getElementById('coleg').checked){
        concepto = "Inscripción y Colegiatura";
    }else if(document.getElementById('otro')){
        concepto = document.getElementById('text-esp').value;
        tipo = "0";
    }else{
        alert('Hubo un error al Registrar el Pago. Inténtelo de Nuevo');
    }
    var pago = document.getElementById('pago').value;
    var debe = document.getElementById('totsaldo').value;
    var obs = document.getElementById('obs').value;
    if(concepto!="" && concepto!=null && concepto.length>0){
        if(window.XMLHttpRequest){
            varajax = new XMLHttpRequest();
        }else{
            varajax = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var info = "idAlumno="+idAlumno+"&num="+num+"&fpago="+fpago+"&concepto="+concepto+"&pago="+pago+"&debe="+debe+"&obs="+obs+"&tipo="+tipo;
        varajax.onreadystatechange = function(){
            if(varajax.readyState===4 && varajax.status===200){
                document.getElementById('info').innerHTML = varajax.responseText;
                verSaldo();
                buscarPagos();
            }
        }
        varajax.open("POST","../PHP/regPago.php",true);
        varajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        varajax.send(info);
    }
}
