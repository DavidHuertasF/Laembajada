function addHoursAvailables(hoursList) {
  $("#div-hora").empty();

  var xs = [];

  hoursList.forEach(function(valor, indice, array) {
    xs.push(valor);
  });

  xs.reverse();

  

  xs.forEach(function(valor, indice, array) {
     $("#div-hora").prepend("<button class='font hour-button' name='off' onclick='buttonHourFunction(this.id)' "+"id="+valor+" type='button'>"+intToHourAM(valor) + "</button>");
  });
}


function buttonCanchaFucntion(cancha){
    var status =  $("#"+cancha).attr('name') // estado del boton seleccionado (on, off)
    var actives = document.getElementsByName("onC").length;
    var canchasPeticion = parseInt($("#p_canchas").text());

    if(status == 'onC'){   // si está on ponerlo off
       
        if (actives == canchasPeticion){ // si hay x activos deshabilitar el resto
            document.getElementsByName("offC").forEach(function(valor, indice, array) {
                document.getElementsByName("offC").forEach(function(valor, indice, array) {
                    $("#"+valor.id).css("border","black 2px solid");
                    $("#"+valor.id).css("color","black");
                    $("#"+valor.id).attr("onclick","buttonCanchaFucntion(this.id);");
                 });
             });
        }
        $("#"+cancha).css("border","black 2px solid");
        $("#"+cancha).css("color","black");
        $("#"+cancha).attr("name", "offC");
    } else{ // si está off ponerlo en on
        if (actives == (canchasPeticion -1)){ //si se va a activar el último pedido 
           
            $("#"+cancha).css("border"," solid 2px red");
            $("#"+cancha).css("color","red");
            $("#"+cancha).attr("name", "onC");

            document.getElementsByName("offC").forEach(function(valor, indice, array) {
                $("#"+valor.id).css("border","grey 2px solid");
                $("#"+valor.id).css("color","grey");
                $("#"+valor.id).attr("onclick","");
             });


            
        }else{ // si no hay activos
            $("#"+cancha).css("border"," solid 2px red");
            $("#"+cancha).css("color","red");
            $("#"+cancha).attr("name", "onC");
           
        }
}
}


function buttonHourFunction(hour){ 
 
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
                hour = parseInt(hour, 10);
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
