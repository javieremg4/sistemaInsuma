function agregarMateria(info){
    var varajax;
    if(window.XMLHttpRequest){
        varajax = new XMLHttpRequest();
    }else{
        varajax = new ActiveXObject("Microsoft:XMLHTTP");
    }
    varajax.onreadystatechange = function(){
        if(varajax.readyState===4 && varajax.status===200){
            document.getElementById('info').innerHTML = varajax.responseText;
            var nuevo = document.getElementsByClassName('nuevo');
            for(i=0; i<nuevo.length; i++){
                nuevo[i].className = "";
            }
            verMaterias();
        }
    }
    varajax.open("POST","../PHP/agregarMateria.php",true);
    varajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    varajax.send(info);
}
