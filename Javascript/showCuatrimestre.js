function showCuatrimestre(){
var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    var f=new Date();
    var msg = document.getElementById("div-fecha");
    
    msg.innerHTML = "Hoy es " + diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear() + "\n";

    var msg = document.getElementById("span-ciclo");

    if(f.getMonth()>=7 && f.getMonth()<=11){
        msg.innerHTML = "Ciclo Escolar " + f.getFullYear() + "-" + (f.getFullYear()+1);
    }else if(f.getMonth()>=0 && f.getMonth()<=6) {
        msg.innerHTML = "Ciclo Escolar " + (f.getFullYear()-1) + "-" + f.getFullYear();
    }

    var msg = document.getElementById("span-cuat");

    if (f.getMonth()>2 && f.getMonth()<7) { //Cuat. C (Abril-Julio)
        msg.innerHTML = "Cuatrimestre Abril-Julio";
    } else if(f.getMonth()>6 && f.getMonth()<11) { //Cuat. A (Agosto-Noviembre)
        msg.innerHTML = "Cuatrimestre Agosto-Noviembre";    
    } else{ //Cuat. B (Diciembre-Marzo)
        msg.innerHTML = "Cuatrimestre Diciembre-Marzo";
    }
}
