function buscarPagos(){
    var varajax;
    if(window.XMLHttpRequest){
        varajax = new XMLHttpRequest();
    }else{
        varajax = new ActiveXObject("Microsoft.XMLHTTP");
    }
    varajax.onreadystatechange = function(){
        if(varajax.readyState===4 && varajax.status===200){
            document.getElementById('historial').innerHTML = varajax.responseText; 
        }
    }
    varajax.open("GET","../PHP/buscarPagos.php",true);
    varajax.send();
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
