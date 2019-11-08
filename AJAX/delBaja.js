function eliminarBaja(id){
    msg = "¿Está seguro que desea Eliminar la Baja?";
    msg = confirm(msg);
    if(msg){
        var msg = document.getElementById("msgBaja");
        var delBaja;
        if(window.XMLHttpRequest){
        var delBaja = new XMLHttpRequest();
        }else{
            delBaja =  new ActiveXObject("Microsoft.XMLHTTP");
        }
        delBaja.onreadystatechange = function(){
            if(delBaja.readyState == 4 && delBaja.status == 200){
                msg.innerHTML = delBaja.responseText;
            }
        }
        delBaja.open("GET","../PHP/eliminarBaja.php?del="+id,true);
        delBaja.send();
    }else{
        return false;
    }
}
