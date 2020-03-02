function valCalif(grado,idAlumno){
    var exp = /^(\d*|\d+.){1}\d$/
    var expWhite = /^\s*$/;
    var califTable = document.getElementById('califTable').children[0];
    for(x=1; x<califTable.children.length; x++){
        var row = califTable.children[x];
        for(y=1; y<4; y++){
            var calif = row.children[y].children[0].value;
            if(calif.search(expWhite)){
                if(calif.search(exp)){
                    alert("Error: "+calif);
                    return false;
                }
                if(calif>10 || calif<0){
                    alert("Error: "+calif);
                    return false;
                }
            }
        }
    }
    var califArray = new Array();
    var index = 0;
    for(x=1; x<califTable.children.length; x++){
        var row = califTable.children[x];
        var subject = new Array();
        subject[0] = row.getAttribute("id");
        for(y=1; y<4; y++){
            var calif = row.children[y].children[0].value;
            if(calif.search(expWhite) && calif!="" && calif!=null && calif.length>0){
                subject[y] = calif;
            }else{
                subject[y] = null;
            }
        }
        if(subject[1]!==null || subject[2]!==null || subject[3]!==null){
            califArray[index] = subject;
            index += 1;
        }
    }
    console.log(califArray);
    var array = "idAlumno="+idAlumno+"&calif="+JSON.stringify(califArray);
    modCalif(array,grado);
}
