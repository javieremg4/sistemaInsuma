window.onload = verDatosEsc();
function verDatosEsc(){
    var varajax;
    if(window.XMLHttpRequest){
        varajax = new XMLHttpRequest;
    }else{
        varajax = new ActiveXObjetc("Microsoft.XMLHTTP");
    }
    varajax.onreadystatechange = function (){
        if(varajax.status === 200 && varajax.readyState === 4){
            document.getElementById('datos').innerHTML = varajax.responseText;
        }
    }
    varajax.open("GET","../PHP/verDatosEsc.php",true);
    varajax.send();
}
