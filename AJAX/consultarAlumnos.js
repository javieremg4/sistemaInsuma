function checkAlumnos(info){
    var ajax;
    if(window.XMLHttpRequest){
        ajax = new XMLHttpRequest();
    }else{
        ajax = ActiveXObject("Microsoft.XMLHTTP")
    }
    ajax.onreadystatechange = function (){
        if(ajax.readyState===4 || ajax.status===200){
            document.getElementById('verAlumnos').innerHTML = ajax.responseText;
        }
    }
    ajax.open("POST","../PHP/consultarAlumnos.php",true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send(info);
}
