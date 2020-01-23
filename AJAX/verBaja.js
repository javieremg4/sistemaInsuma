window.onload = verBaja();
function verBaja(){
    var varajax;
    if(window.XMLHttpRequest){
        varajax = new XMLHttpRequest();
    }else{
        varajax = new ActiveXObject("Microsoft.XMLHTTP");
    }
    varajax.onreadystatechange = function(){
        if(varajax.readyState===4 && varajax.status===200){
            document.getElementById('sec-baja').innerHTML = varajax.responseText;
        }
    }
    varajax.open("GET","../PHP/verBaja.php?view=1",true);
    varajax.send();
}
