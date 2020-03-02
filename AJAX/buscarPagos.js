function buscarPagos(idAlumno){
    var varajax;
    if(window.XMLHttpRequest){
        varajax = new XMLHttpRequest();
    }else{
        varajax = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var info = "view=1&idAlumno="+idAlumno;
    varajax.onreadystatechange = function(){
        if(varajax.readyState===4 && varajax.status===200){
            document.getElementById('historial').innerHTML = varajax.responseText; 
        }
    }
    varajax.open("POST","../PHP/buscarPagos.php",true);
    varajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    varajax.send(info);
}
var show=true;
function showHistorial(){
    if(show){
        document.getElementById('historial').style.display = "block";
        document.getElementById('ver-historial').innerHTML = "Ocultar Historial de Pagos";
        show = false;
    }else{
        document.getElementById('historial').style.display = "none";
        document.getElementById('ver-historial').innerHTML = "Ver Historial de Pagos";
        show = true;
    }
}
