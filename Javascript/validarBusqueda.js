function validarBusqueda(){
    var apepat = document.getElementById('apepat').value;
    var apemat = document.getElementById('apemat').value;
    var nombre = document.getElementById('nombre').value;
    if(apepat==="" && apemat==="" && nombre===""){
        alert("Debe escribir algo para buscar");
        return false;
    }
    return true;
}
