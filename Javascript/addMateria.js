function addMateria(){
    var tabM = document.getElementById('tabM');
    var rowCount = tabM.rows.length-1;
    var row = tabM.insertRow(rowCount);
    var element;
    for(i=0; i<4; i++){
        var cell = row.insertCell(i);
        element = document.createElement('input');
        switch (i) {
            case 0:
                element.type = "text";
                element.className = "nuevo mayus";
                element.placeholder = "Nombre de la materia";
                element.style.width = "98%";
                break;
            case 1:
                element.type = "number";
                element.className = "nuevo mayus";
                element.placeholder = "Grado";
                element.style.width = "98%";
                break;
            case 2:
                element.type = "radio";
                element.className = "nuevo";
                element.name = "calif";
                element.value = "num";
                cell.appendChild(element);
                element = document.createElement('span');
                element.textContent = "0-10";
                cell.appendChild(element);
                element = document.createElement('input');
                element.type = "radio";
                element.className = "nuevo";
                element.name = "calif";
                element.value = "snum";
                cell.appendChild(element);
                element = document.createElement('span');
                element.textContent = "A/NA";
                break;
            case 3:
                element = document.createElement('button');
                element.className = "nuevo";
                element.textContent = "Guardar";
                element.addEventListener('click',function(){
                    valMat();
                })
                cell.appendChild(element);
                element = document.createElement('button');
                element.textContent = "Cancelar";
                element.className = "nuevo";
                element.addEventListener('click',function(){
                    canMat();
                })
                break;
            default:
                element = null;
                break;
        }
        cell.appendChild(element);
    }
    document.getElementById('btnAdd').disabled = true;
}
function canMat(){
    var tabM = document.getElementById('tabM');
    tabM.firstChild.removeChild(tabM.firstChild.lastChild.previousSibling);
    document.getElementById('btnAdd').disabled = false;
}
function valMat(){
    var nuevo = document.getElementsByClassName('nuevo');
    var expEsp = /^\s+$/;
    var materia = nuevo[0].value;
	if(!materia.search(expEsp) || materia==="" || materia===null || materia.length===0){
		alert("Agregue el Nombre de la Materia");
		return false;
    }
    if(materia.length>50){
        alert("Error: El Nombre de la Materia es Muy Grande");
        return false;
    }
    var expGrado = /^[1-6]{1}$/;
    var grado = nuevo[1].value;
    if(grado.search(expGrado)){
        alert("Error: Grado Incorrecto");
        return false;
    }
    if(!nuevo[2].checked && !nuevo[3].checked){
        alert("Error: Seleccione la forma de calificar");
        return false;
    }
    nuevo[0].value = nuevo[0].value.toUpperCase();
    var materia = nuevo[0].value;
    var grado = nuevo[1].value;
    var calif;
    if(nuevo[2].checked){
        calif = "num";
    }else{
        calif = "snum";
    }
    var info = "materia="+materia+"&grado="+grado+"&calif="+calif;
    agregarMateria(info);
}
