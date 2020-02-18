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

function cleanSubjects(){
    var option = document.createElement('option');
    option.value='0';
    option.textContent = '--Materias--';
    option.selected = true;
    var list = document.getElementById('subject-list');
    removeChilds(list);
    list.appendChild(option);
}

function removeChilds(list){
    while(list.hasChildNodes()){
        list.removeChild(list.firstChild);
    }
}
