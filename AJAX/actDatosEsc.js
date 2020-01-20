function actDatosEsc(info){
    var varajax;
    if(window.XMLHttpRequest){
        varajax = new XMLHttpRequest();
    }else{
        varajax = new ActiveXObject("Microsoft.XMLHTTP");
    }
    varajax.onreadystatechange = function(){
        if(varajax.status === 200 && varajax.readyState === 4){
            document.getElementById('info').innerHTML = varajax.responseText;
            verSaldo();
            verDatosEsc();
        }
    }
    varajax.open("POST","../PHP/actDatosEsc.php",true);
    varajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    varajax.send(info);
}
