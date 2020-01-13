window.onload = verSaldo();
function verSaldo(){
    var varajax;
    if(window.XMLHttpRequest){
        varajax = new XMLHttpRequest()
    }else{
        varajax = new ActiveXObject("Microsoft.XMLHTTP");
    }
    varajax.onreadystatechange = function(){
        if(varajax.status === 200 && varajax.readyState === 4){
            document.getElementById('saldo').innerHTML = varajax.responseText;
        }
    }
    varajax.open("GET","../PHP/verSaldo.php?view=1",true);
    varajax.send();
}
