function buscarAlumno(){
    var content = document.getElementById('info');
    var varajax;
    if(window.XMLHttpRequest){
        varajax = new XMLHttpRequest();
    }else{
        varajax = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var indicio = document.getElementById('indicio').value;
    var info = "indicio="+indicio;
    varajax.onreadystatechange = function (){
        if(varajax.readyState === 4 && varajax.status === 200){
            var msg = varajax.responseText;
            content.innerHTML = msg;
        }
    }
    varajax.open("POST","../PHP/buscarAlumno.php",true);
    varajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    varajax.send(info);
}
 