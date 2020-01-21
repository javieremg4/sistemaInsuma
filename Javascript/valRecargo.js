window.onload = valRecargo();
function valRecargo(){
	var f = new Date();
	if(f.getDate()>10){
		var hoy =f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
		document.getElementById('recargo').innerHTML = "Aplica Recargo: "+hoy;
	}
	verSaldo();
}
