function delBaja(id){
    msg = "¿Está seguro que desea Eliminar la Baja?";
    msg = confirm(msg);
    if(msg){
        var msg = document.getElementById("info");
        var delBaja;
        if(window.XMLHttpRequest){
        var delBaja = new XMLHttpRequest();
        }else{
            delBaja =  new ActiveXObject("Microsoft.XMLHTTP");
        }
        delBaja.onreadystatechange = function(){
            if(delBaja.readyState == 4 && delBaja.status == 200){
                msg.innerHTML = delBaja.responseText;
                document.getElementById("saldo").innerHTML = null;
                document.getElementById("sec-baja").innerHTML = null;
            }
        }
        delBaja.open("GET","../PHP/eliminarBaja.php?del="+id,true);
        delBaja.send();
    }else{
        return false;
    }
}
