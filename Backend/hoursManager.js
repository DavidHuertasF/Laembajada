function addHoursAvailables(hoursList) {
  $("#div-hora").empty();

  var xs = [];

  hoursList.forEach(function(valor, indice, array) {
    xs.push(valor);
  });

  xs.reverse();

  xs.forEach(function(valor, indice, array) {
     $("#div-hora").prepend("<button class='hour-button' name='off' onclick='buttonHourFunction(this.id)' "+"id="+valor+" type='button'>"+intToHourAM(valor) + "</button>");
  });
}

function buttonHourFunction(h){ 
    var hour = parseInt(h);
    var status =  $("#"+hour).attr('name') // estado del boton seleccionado (on, off)
    var actives = document.getElementsByName("on").length; // cuantos ya están activos

    if(status == 'on'){   // si está on ponerlo off
       
        if (actives == 2){ // si hay dos activos habilitar el resto
            document.getElementsByName("off").forEach(function(valor, indice, array) {
                var id =  document.getElementsByName("off")[indice].id;
                $("#"+id).attr("disabled", false);
                $("#"+id).css("border","red 1px solid");
                $("#"+id).css("color","black");
             });
        }
        $("#"+hour).css("background-color","white");
        $("#"+hour).css("color","black");
        $("#"+hour).attr("name", "off");

       
    }
    else{ // si está off
            if (actives == 1){ //si uno ya está activo
                var activeHour = document.getElementsByName("on")[0].id; // obtener la hora que ya esta activada
                var mayor = hour +1; 
                var menor = hour -1; //obtener rango de la hora seleccionada

                if( activeHour == mayor ||  activeHour == menor ){ // si cumple con el rango activar y desactivar el rango
                    $("#"+hour).css("background-color","red");
                    $("#"+hour).css("color","white");
                    $("#"+hour).attr("name", "on");

                    //desactivar el resto
                    document.getElementsByName("off").forEach(function(valor, indice, array) {
                       var id =  document.getElementsByName("off")[indice].id;
                       $("#"+id).attr("disabled", true);
                       $("#"+id).css("border","none");
                       $("#"+id).css("color","grey");
                    });
                }
            }else{ // si no hay activos
                $("#"+hour).css("background-color","red");
                $("#"+hour).css("color","white");
                $("#"+hour).attr("name", "on");
            }
    }
}

function getHoursActive(){
    var actives = [];
    document.getElementsByName("on").forEach(function(valor, indice, array) {
        actives.push(valor.id);
     });
     return actives;
}

function intToHourAM(hour){

    if(hour<=11){
        return hour+":00 am"
    }else {
        return (hour-12)+":00 pm";
    }

}