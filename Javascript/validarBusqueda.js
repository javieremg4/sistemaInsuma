function validarBusqueda(){
    var indicio = document.getElementById('indicio').value;
    var spaceExp = /^\s+$/;
    if(indicio==="" || indicio===null || indicio.length===0 || !indicio.search(spaceExp)){
        alert("Debe escribir algo para poder buscar");
        return false;
    }else{
        buscarAlumno();
    }
}
