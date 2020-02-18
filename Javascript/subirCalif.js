function subirCalif(){
    var grado = document.getElementById('grado').value;
    var grupo = document.getElementById('grupo').value;
    var turno = document.getElementById('turno').value;
    var materia = document.getElementById('materia').value;
    if(grado==='0'){
        alert("Seleccione un grado");
        return false;
    }
    if(grupo==='0'){
        alert("Seleccione un grupo");
        return false;
    }
    if(turno==='0'){
        alert("Seleccione un turno");
        return false;
    }
    if(materia==='0'){
        alert("Seleccione una materia");
        return false;
    }
    subirCalifAjax();
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
