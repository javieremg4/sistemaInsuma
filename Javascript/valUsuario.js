function valUsuario(){
    var spaceExp = /^\s*$/;
    var username = document.getElementById("username").value;
    if(username==="" || username===null || !username.search(spaceExp) || username.length===0){
        alert("Error: El Nombre de Usuario es Obligatorio");
        return false;
    }
    var userNameExp = /^[a-zA-Z][\w\s]*[a-zA-Z\d]$/;
    if(username.search(userNameExp)){
        alert("Error: Revise el Nombre de Usuario");
        return false;
    }
    if(username.length>20){
        alert("Error: El Nombre de Usuario es Muy Largo");
        return false;
    }
    var password = document.getElementById("pass").value;
    if(password==="" || password===null || !password.search(spaceExp) || password.length===0){
        alert("Error: La Contraseña es Obligatoria");
        return false;
    }
    var passExp = /^[\w]{6}[\w]*$/;
    if(password.search(passExp)){
        alert("Error: Revise la Contraseña");
        return false;
    }
    if(password.length>20){
        alert("Error: La Contraseña es Muy Larga");
        return false;
    }
    return true;
}
var show=false;
function showHide(){
    var inputPass = document.getElementById("pass");
    if(show){
        inputPass.type = "password";
        document.getElementById("msgPass").innerHTML="<i class='fas fa-eye-slash'></i>";
        show=false;
    }else{
        inputPass.type ="text";
        document.getElementById("msgPass").innerHTML="<i class='fas fa-eye'></i>";
        show=true;
    }
}
