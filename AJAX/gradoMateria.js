function gradoMateria(){
    var grade = document.getElementById('grado').value;
    var list = document.getElementById('materia');
    var ajax;
    if(window.XMLHttpRequest){
        ajax = new XMLHttpRequest();
    }else{
        ajax= new ActiveXObject("Microsoft.XMLHTTP");
    }
    grade = "grade="+grade;
    ajax.onreadystatechange = function(){
        if(ajax.readyState === 4 && ajax.status === 200){
            list.innerHTML = ajax.responseText;
        }
    }
    ajax.open("POST","../PHP/gradoMateria.php",true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send(grade);
}
