window.onload = function valRecargo(){
	var f = new Date();
	if(f.getDate()>10){
        var rec = document.getElementById('recargo');
		var hoy =f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()
		rec.innerHTML = "Aplica Recargo: "+hoy;
	}
}
