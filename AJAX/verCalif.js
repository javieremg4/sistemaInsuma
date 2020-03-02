window.onload = verCalif('1');
function verCalif(grado){
    var varajax;
    if(window.XMLHttpRequest){
        varajax = new XMLHttpRequest;
    }else{
        varajax = new ActiveXObjetc("Microsoft.XMLHTTP");
    }
    var info = "grado="+grado;
    varajax.onreadystatechange = function (){
        if(varajax.status === 200 && varajax.readyState === 4){
            document.getElementById('calif').innerHTML = varajax.responseText;
        }
    }
    varajax.open("POST","../PHP/verCalif.php",true);
    varajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    varajax.send(info);
}
