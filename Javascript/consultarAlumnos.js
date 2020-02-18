function consultarAlumnos(){
    var grado = document.getElementById('grado').value;
    var grupo = document.getElementById('grupo').value;
    var turno = document.getElementById('turno').value;
    if(grado === '0'){
        alert("Seleccione un grado");
        return false;
    }
    if(grupo === '0'){
        alert("Seleccione un grupo");
        return false;
    }
    if(turno === '0'){
        alert("Seleccione un turno");
        return false;
    }
    var info = "grado="+grado+"&grupo="+grupo+"&turno="+turno;
    checkAlumnos(info);
}
