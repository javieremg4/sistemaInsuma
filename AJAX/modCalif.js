function modCalif(info,grado){
    var varajax;
    if(window.XMLHttpRequest){
        varajax = new XMLHttpRequest;
    }else{
        varajax = new ActiveXObjetc("Microsoft.XMLHTTP");
    }
    varajax.onreadystatechange = function (){
        if(varajax.status === 200 && varajax.readyState === 4){
            document.getElementById('info').innerHTML = varajax.responseText;
            verInfo();
            verCalif(grado);
        }
    }
    varajax.open("POST","../PHP/modCalif.php",true);
    varajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    varajax.send(info);
}
