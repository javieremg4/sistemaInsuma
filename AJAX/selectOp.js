function selectOp(operation){
    var varajax;
    if(window.XMLHttpRequest){
        varajax = new XMLHttpRequest();
    }else{
        varajax = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var info = "operation="+operation;
    varajax.onreadystatechange = function (){
        if(varajax.readyState === 4 && varajax.status === 200){
            window.location = "../HTML/buscarAlumno.html";
        }
    }
    varajax.open("POST","../PHP/selectOp.php",true);
    varajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    varajax.send(info);
}