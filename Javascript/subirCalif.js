function subirCalif(){
    var grado = document.getElementById('grado').value;
    var grupo = document.getElementById('grupo');
    var turno = document.getElementById('turno');
    var materia = document.getElementById('materia');
    if(grado==='0'){
        alert("Seleccione un grado");
        return false;
    }
    if(grupo.value==='0'){
        alert("Seleccione un grupo");
        return false;
    }
    if(turno.value==='0'){
        alert("Seleccione un turno");
        return false;
    }
    if(materia.value==='0'){
        alert("Seleccione una materia");
        return false;
    }
    var msg = "Está a punto de Registrar las Calificaciones de "+materia.children[materia.selectedIndex].text+" a los Alumnos de "+grado+"°"+grupo.children[grupo.selectedIndex].text+
    " turno "+turno.children[turno.selectedIndex].text+"\n¿Desea continuar?";
    msg = confirm(msg);
    if(!msg){
        return false;
    }
    var info = "grado="+grado+"&grupo="+grupo.value+"&turno="+turno.value+"&materia="+materia.value;
    subirCalifAjax(info);
}
function validarExcel(){
    if(document.getElementById('archivo').files.length === 0){
        alert('Error: Seleccione un archivo');
        return false;
    }
    var nalumnos = document.getElementById('nalumnos').value;
    if(nalumnos===null || nalumnos==="" || nalumnos<1){
        alert('Error: No. de alumnos invalido');
        return false;
    }
    if(nalumnos>100){
        alert('Max. 100 alumnos');
        return false;
    }
    return true;
}
function limpiarForms(){
    document.getElementById('archivo').value = "";
    document.getElementById('nalumnos').value = "";
    document.getElementById('grado').selectedIndex = 0;
    document.getElementById('grupo').selectedIndex = 0;
    document.getElementById('turno').selectedIndex = 0;
    cleanSubjects();
    document.getElementById('display').innerHTML = "<div id='verExcel' class='w60 div-part'></div><div id='verAlumnos' class='w40 div-part'></div>";
}
function cleanSubjects(){
    var option = document.createElement('option');
    option.value='0';
    option.textContent = '--Materia--';
    option.selected = true;
    var list = document.getElementById('materia');
    removeChilds(list);
    list.appendChild(option);
}
function removeChilds(list){
    while(list.hasChildNodes()){
        list.removeChild(list.firstChild);
    }
}
