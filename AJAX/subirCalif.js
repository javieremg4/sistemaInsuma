function subirCalifAjax(info){
    var table = document.getElementById('tabCalif').firstChild;
    var students = new Array();
    for(i=1; i<table.children.length; i++){
        var student = table.children[i];
        var studentArray = new Array();
        for(j=1; j<student.children.length; j++){
            studentArray[j-1] = student.children[j].innerHTML;
        }
        students[i-1] = studentArray;
    }
    console.log(students);
    var array = info+"&students="+JSON.stringify(students);
    var ajax;
    if(window.XMLHttpRequest){
        ajax = new XMLHttpRequest();
    }else{
        ajax = ActiveXObject("Microsoft.XMLHTTP")
    }
    ajax.onreadystatechange = function (){
        if(ajax.readyState===4 || ajax.status===200){
            document.getElementById('verExcel').innerHTML = ajax.responseText;
        }
    }
    ajax.open("POST","../PHP/subirCalif.php",true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send(array);
}
