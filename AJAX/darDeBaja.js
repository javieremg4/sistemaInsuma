function darDeBaja(info){
    var varajax;
    document.getElementById("");
    if(window.XMLHttpRequest){
        varajax = new XMLHttpRequest();
    }else{
        varajax = new ActiveXObject("Microsoft.XMLHTTP");
    }
    varajax.onreadystatechange = function(){
        if(varajax.readyState===4 && varajax.status===200){
            document.getElementById("info").innerHTML = varajax.responseText;
            verSaldo();
            verBaja();
        }
    }
    varajax.open("POST","../PHP/darDeBaja.php",true);
    varajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    varajax.send(info);
}
