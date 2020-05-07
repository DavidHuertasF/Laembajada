function resetFormularyToFirstStep() {
  $("#modalSecond").css("display", "none");
  $("#modalThird").css("display", "none");

  $("#div_cancha").empty();;
  reservationDate = new Date($("#dtp_input2").val());
  reservationDate.addDays(1);
  diaSemana();
  var x = new Date();
  var today = getDayOfYear(new Date());
  var hourToday = x.getHours() + 1;
  var dayReservation = getDayOfYear(reservationDate) + 1;

  reservationIsCurrentDay = today == dayReservation;
  var hours = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 23, 24];

  if (reservationIsCurrentDay) {
    //Si la reserva es para hoy quitar todas las horas que ya pasaron
    for (i = 0; i < hourToday; i++) {
      var exist = hours.find(element => element == i);
      if (exist === undefined) {
        // Si la hora no esta dentro de las horas de hoy
        hours.push(i); // agregarla
      }
    }
    getHoursAvailables(hours); // Traer las reservas de ese día para quitarlas si no son compatibles
  } else {
    if ($("#dtp_input2").val() != "") {
      getHoursAvailables(hours); // Traer las reservas de ese día para quitarlas si no son compatibles
    }
  }
}

function diaSemana() {
  var x = document.getElementById("dtp_input2");
  let date = new Date(x.value.replace(/-+/g, "/"));
  let options = {
    weekday: "short",
    month: "short",
    day: "numeric"
  };
  stringDate = date.toLocaleDateString("es-MX", options);
  stringDate = stringDate.replace(" de", ".");

  if (stringDate != "Invalid Date") {
    $("#p_date_in_hour").text(stringDate);
  }
}

function zeroPadded(val) {
  if (val >= 10) return val;
  else return "0" + val;
}

function getDayOfYear(now) {
  var start = new Date(now.getFullYear(), 0, 0);
  var diff = now - start;
  var oneDay = 1000 * 60 * 60 * 24;
  var day = Math.floor(diff / oneDay);
  return day;
}

function getHoursAvailables(h) {
  // Verificar estas horas disponibles con la base de datos para quitar las que no estan disponibles

  var canchas = parseInt($("#p_canchas").text());
  var hoursavailables = [];
  for (var i = 0; i < 24; i++) {
    // horas no disponibles a disponibles
    if (!h.includes(i)) {
      hoursavailables.push(i);
    }
  }

  hVerificated = [];
  hoursavailables.forEach(function(valor, indice, array) {
    // Por cada hora disponible, verificar en bd que hayan las canchas necesarias para ese dia

    var dateExtra = reservationDate;
    dateExtra.setHours(valor);
    d = dateExtra.addDays(1);
    varstringDate =
      d.getFullYear() +
      "-" +
      zeroPadded(d.getMonth() + 1) +
      "-" +
      zeroPadded(d.getDate()) +
      " " +
      d.getHours() +
      ":00:00";

      varstringDateFraction =
      d.getFullYear() +
      "-" +
      zeroPadded(d.getMonth() + 1) +
      "-" +
      zeroPadded(d.getDate()) +
      " " +
      d.getHours() +
      ":30:00";


    showReservasByDay(varstringDate); // Pone el dia y hora seleccionado en consulta con la bd y pone en variable html las canchas que estan reservadas para ese rango 
    var canchasReservadasParaHora = $("#myInput").val(); //Canchas reservadas para esa fecha y hora

    var necesito = parseInt($("#p_canchas").text()); // Cuantas canchas necesita el usuario
    var hay = canchasTotal - canchasReservadasParaHora; //hay x canchas disponibles

    if (necesito <= hay) {
      // Si hay las canchas suficientes agregarlas a la lista de horas disponibles
      hVerificated.push(valor);
    }

    showReservasByDay(varstringDateFraction);  //igual para las media horas
    var canchasReservadasParaHora = $("#myInput").val(); 
    var necesito = parseInt($("#p_canchas").text()); 
    var hay = canchasTotal - canchasReservadasParaHora; 
    if (necesito <= hay) {
      hVerificated.push(valor+'m');
    }

    //  console.log("Canchas reservadas para el " + varstringDate + " --> " + $("#myInput").val());
    // console.log("Canchas disponibles para el " + varstringDate + " --> " + hay);
  });

  var pppp = h;

  for ($i = 0; $i < 24; $i++) {
    if (!hVerificated.includes($i)) {
      if (!pppp.includes($i)) {
        pppp.push($i);
      }
    }
  }

  // if (hVerificated.length < 3) {
  //   $(".hourbutton").css("display", "none");
  // }

  // console.log( "Horas no disponibles para la fecha seleccionada :" + pppp);
  setHoursDisabled(pppp);

  var xm = [];
  hoursavailables.forEach(function(valor, indice, array) {
    xm.push(valor);
    xm.push(valor+'m');
  });

  addHoursAvailables(hVerificated, xm);
}

function showReservasByDay(day) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      $("#myInput").val(this.responseText);
    }
  };
  xmlhttp.open("GET", "Componentes/reservas/getuser.php?q=" + day, false);
  xmlhttp.send();
}

function setHoursDisabled(listHours) {
  $(".form_time").datetimepicker("setHoursDisabled", listHours);
  $(".form_time").datetimepicker("reset");
}

function desactivarSelecciones() {
  if (
    $(".form_date")
      .find("input")
      .val() == ""
  ) {
    $(".active.day").removeClass("active");
  }
  if (
    $(".form_time")
      .find("input")
      .val() == ""
  ) {
    $(".active.hour").removeClass("active");
  }
}

function deshabilitarFecha(){
  if ($("#dtp_input2").val() != "") {
    
      var fecha = $("#dtp_input2").val();
      if(confirm("Deshabilitar el "+fecha+" ?")){
        if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          }
        };
        xmlhttp.open(
          "GET",
          "Componentes/reservas/cancelardia.php?q=" +fecha,
          false
        );
        xmlhttp.send();
        location.reload();
    }    
    }else{
      alert("seleccione una fecha válida");
    }
}


function confirmateHoursStep(){
  var disabled = false;

  $('.noavailable').each(function(index, value){
    if(this.name == 'on'){
      disabled = true;
    }
  });

  if(disabled){
  
        alert("Seleccione horas disponibles para continuar");
    
  }else{
    confirmateHours() ;
  }
}

function confirmateHours() {
 
    var hoursActive = getHoursActive();

    if (!hoursActive.length == 0) {
      //Selecciono algo
      if (hoursActive.length > 1) {
        // Selecciono rango

        var inicio = hoursActive[0];
        var fin = hoursActive[1];

        var inicioesmedio = false;
        var finesmedio = false;

        if (inicio.charAt(inicio.length - 1) == "m") {
          inicioesmedio = true;
        }

        if (fin.charAt(fin.length - 1) == "m") {
          finesmedio = true;
        }

        var reservationDateFinal = reservationDate;

        var hourSelected = parseInt(hoursActive[0], 10);
        var hourFinal = parseInt(hoursActive[1], 10);

        reservationDate.setHours(hourSelected);

        d = reservationDate.addDays(1);

        if (inicioesmedio) {
          $("#dtp_input2").val(
            d.getFullYear() +
              "-" +
              zeroPadded(d.getMonth() + 1) +
              "-" +
              zeroPadded(d.getDate()) +
              " " +
              d.getHours() +
              ":30:00"
          );
        } else {
          $("#dtp_input2").val(
            d.getFullYear() +
              "-" +
              zeroPadded(d.getMonth() + 1) +
              "-" +
              zeroPadded(d.getDate()) +
              " " +
              d.getHours() +
              ":00:00"
          );
        }

        if (finesmedio) {
          $("#input-hora-fin").val(
            d.getFullYear() +
              "-" +
              zeroPadded(d.getMonth() + 1) +
              "-" +
              zeroPadded(d.getDate()) +
              " " +
              (hourFinal ) +
              ":59:00"
          );
        } else {
          $("#input-hora-fin").val(
            d.getFullYear() +
              "-" +
              zeroPadded(d.getMonth() + 1) +
              "-" +
              zeroPadded(d.getDate()) +
              " " +
              hourFinal +
              ":29:00"
          );
        }

        reservationDate = new Date($("#dtp_input2").val());
        finishHour = new Date($("#input-hora-fin").val());

        // console.log("Configurando rango .. ");
      } else {
        // Selecciono solo uno

        var inicio = hoursActive[0];
        var inicioesmedio = false;

        if (inicio.charAt(inicio.length - 1) == "m") {
          inicioesmedio = true;
        }

        var hourSelected = parseInt(hoursActive[0], 10);
        reservationDate.setHours(hourSelected);

        d = reservationDate.addDays(1);



        if (inicioesmedio) {
          $("#dtp_input2").val(
            d.getFullYear() +
              "-" +
              zeroPadded(d.getMonth() + 1) +
              "-" +
              zeroPadded(d.getDate()) +
              " " +
              d.getHours() +
              ":30:00"
          );

            //  agrega la hora
        $("#input-hora-fin").val(
          d.getFullYear() +
            "-" +
            zeroPadded(d.getMonth() + 1) +
            "-" +
            zeroPadded(d.getDate()) +
            " " +
            (d.getHours()) +
            ":59:00"
        );
        } else {
          $("#dtp_input2").val(
            d.getFullYear() +
              "-" +
              zeroPadded(d.getMonth() + 1) +
              "-" +
              zeroPadded(d.getDate()) +
              " " +
              d.getHours() +
              ":00:00"
          );

          //  agrega la fraccion
        $("#input-hora-fin").val(
          d.getFullYear() +
            "-" +
            zeroPadded(d.getMonth() + 1) +
            "-" +
            zeroPadded(d.getDate()) +
            " " +
            (d.getHours()) +
            ":29:00"
        );
        }

        reservationDate = new Date($("#dtp_input2").val());
        finishHour = new Date($("#input-hora-fin").val());

        
      }

      showCanchasByDate($("#dtp_input2").val(), $("#input-hora-fin").val());
        $("#modalSecond").css("display", "block");
        readCanchasId();
    } else {
      alert("Seleccione una hora de reserva valida");
    }

    // console.log(
    //   "Creando reserva para el "+reservationDate.getDate()+ "/" +(reservationDate.getMonth()+1)+ "/" +reservationDate.getFullYear()+" --> inicio- "+ dateToString(reservationDate) + " | final:- " + dateToString(finishHour)
    // );

    
}

function dateToString(date){

  var minutes = date.getMinutes();
  var minutesString = "";
  if(minutes < 10){
    minutesString = "0" + minutes
  }else{
    minutesString = minutes;
  }

  if (date.getHours() <= 11) {
    dateString = date.getHours() + ":"+minutesString+" am";
  } else {
    dateString = date.getHours() - 12 + ":"+minutesString+" pm";
  }
  return dateString;
}


function confirmateCanchas() {

  var actives = document.getElementsByName("onC").length;
  var canchasPeticion = parseInt($("#p_canchas").text());

  if (actives == canchasPeticion) {
  
  var resume =
    stringDate +
    "  | " +
    dateToString(reservationDate) +
    " - " +
    dateToString(finishHour);

  document.getElementsByName("onC").forEach(function(valor, indice, array) {
    var cancha = valor.textContent;
    resume = resume + " | " + cancha;
  });

  $("#resume_p").prepend(
    "<span style='color: white;  font-size:19px;'>Resumen</span><br>" +
      resume +
      "</p>"
  );

    $("#modalThird").css("display", "block");
   
}else{
    alert("Seleccione "+canchasPeticion+" canchas para continuar");
}
}

Date.prototype.addDays = function(days) {
  var date = new Date(this.valueOf());
  date.setDate(date.getDate() + days);
  return date;
};

function showCanchasByDate(datei, datef) {
  $("#modalSecond").css("display", "block");
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      $("#inputprueba").text(this.responseText);
      // console.log( "Canchas ocupadas: " + this.responseText);
    }
  };
  xmlhttp.open(
    "GET",
    "Componentes/reservas/getCanchas.php?q=" + datei + "&p=" + datef,
    false
  );
  xmlhttp.send();
}

function addHour(maxCanchas) {
  $("#btn_substract").attr("disabled", false);
  $("#btn_substract").css("color", "red");
  $("#btn_substract").css("cursor", "pointer");

  $("#btn_substract").css("display", "block");
  var actualHour = parseInt($("#p_canchas").text());
  var newHour = parseInt(actualHour) + 1;

  if (newHour == maxCanchas) {
    $("#btn_add").attr("disabled", true);
    $("#btn_add").css("color", "white");
    $("#btn_add").css("cursor", "auto");
  }
  $("#p_canchas").text("0" + newHour);
}


function substractHour(maxCanchas) {
  $("#btn_add").attr("disabled", false);
  $("#btn_add").css("color", "red");
  $("#btn_add").css("cursor", "pointer");

  var actualHour = parseInt($("#p_canchas").text());
  var newHour = parseInt(actualHour) - 1;
 

  if (newHour == minCanchas) {
    $("#btn_substract").attr("disabled", true);
    $("#btn_substract").css("color", "white");
    $("#btn_substract").css("cursor", "auto");
  }
  $("#p_canchas").text("0" + newHour);
}


function addPerson(canchas) {

  maxPersonas = canchas * 8;

  $("#btn_substract_person").attr("disabled", false);
  $("#btn_substract_person").css("color", "red");
  $("#btn_substract_person").css("cursor", "pointer");

  $("#btn_substract_person").css("display", "block");
  var actualPersons= parseInt($("#p_personas").text());
  var newPersons = parseInt(actualPersons) + 1;

  if (newPersons == maxPersonas) {
    $("#btn_add_person").attr("disabled", true);
    $("#btn_add_person").css("color", "white");
    $("#btn_add_person").css("cursor", "auto");
  }
  if(newPersons>9){
   $("#p_personas").text(  newPersons);
  }else{
   $("#p_personas").text("0" + newPersons);
  }
}

$("#btn_substract_person").attr("disabled", true);
$("#btn_substract_person").css("color", "white");
$("#btn_substract_person").css("cursor", "auto");

function substractPerson() {
  $("#btn_add_person").attr("disabled", false);
  $("#btn_add_person").css("color", "red");
  $("#btn_add_person").css("cursor", "pointer");

  var actualHour = parseInt($("#p_personas").text());
  var newHour = parseInt(actualHour) - 1;

  if (newHour == 1) {
    $("#btn_substract_person").attr("disabled", true);
    $("#btn_substract_person").css("color", "white");
    $("#btn_substract_person").css("cursor", "auto");
  }
  if(newHour>9){
    $("#p_personas").text( newHour);

  }else{
    $("#p_personas").text("0" + newHour);

  }
}

Array.prototype.remove = function() {
  var what,
    a = arguments,
    L = a.length,
    ax;
  while (L && this.length) {
    what = a[--L];
    while ((ax = this.indexOf(what)) !== -1) {
      this.splice(ax, 1);
    }
  }
  return this;
};

function readCanchasId() {
  var x = "";
  $("#div_cancha").empty();
  x = $("#inputprueba").text();

  var canchasTotales = canchas;
  var canchasOcupadas = [];
  var canchasDisponibles = [];

  for (var i = 0; i < x.length; i++) {
    var p = x.charAt(i);
    if (p >= "0" && p <= "9") {
      canchasOcupadas.push(p);
    }
  }

  for (var i = 0; i < canchasTotales.length; i++) {
    if (!canchasOcupadas.includes(canchasTotales[i].id)) {
      canchasDisponibles.push(canchasTotales[i]);
    }
  }

  for (var i = 0; i < canchasDisponibles.length; i++) {
    var id = canchasDisponibles[i].id;
    var nombre = canchasDisponibles[i].nombre;

    $("#div_cancha").prepend(
      "<div  id='" +
        id +
        "c" +
        "'style=' cursor: pointer; background-size: contain; background-repeat: no-repeat; 'class='cancha-button' name='offC' onclick='buttonCanchaFucntion(this.id)' " +
        "id=" +
        nombre +
        "><p style='font-size: 13px; text-align: center;'>" +
        nombre +
        "</p></div>"
    );
  }
}

function confirmateReserva() {
  reservationDate = new Date($("#dtp_input2").val());
  finishHour = new Date($("#input-hora-fin").val());

  var nombre = $("#input_cliente_nombre").val();
  var celular = $("#input_cliente_celular").val();
  var correo = $("#input_cliente_correo").val();

  var comentario = $("#input_cliente_comentario").val();

  if (nombre == "" || celular == "" || correo == "") {
    alert("falta algún dato obligatorio");
  } else {

    var colorID = Math.floor(Math.random() * 11); 
    creatUser();
    document.getElementsByName("onC").forEach(function(valor, indice, array) {
      var id = valor.id;
      id = id.substring(0, id.length - 1);

      d = reservationDate;
      e = finishHour;

      var minutesStart =d.getMinutes();
      var minutesStartString = "";

      if(minutesStart < 10){
        minutesStartString = "0" + minutesStart
      }else{
        minutesStartString = minutesStart;
      }

      var minutesEnd =e.getMinutes();
      var minutesEndString = "";

      if(minutesEnd < 10){
        minutesEndString = "0" + minutesEnd
      }else{
        minutesEndString = minutesEnd;
      }

      var start =
        d.getFullYear() +
        "-" +
        zeroPadded(d.getMonth() + 1) +
        "-" +
        zeroPadded(d.getDate()) +
        " " +
        d.getHours() +
        ":"+minutesStartString+":00";
      var end =
        e.getFullYear() +
        "-" +
        zeroPadded(e.getMonth() + 1) +
        "-" +
        zeroPadded(e.getDate()) +
        " " +
        e.getHours() +
        ":"+minutesEndString+":00";
      confirmate(start, end, id, colorID, comentario);
    });
    location.reload();
  }
}

function creatUser() {
  var nombre = $("#input_cliente_nombre").val();
  var celular = $("#input_cliente_celular").val();
  var correo = $("#input_cliente_correo").val();

  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    }
  };
  xmlhttp.open(
    "GET",
    "Componentes/reservas/confirmarCliente.php?p=" +
      nombre +
      "&q=" +
      celular +
      "&c=" +
      correo,
    false
  );
  xmlhttp.send();
}

function confirmate(start, end, cancha, colorID, comentario) {

  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      $("#inputprueba").text(this.responseText);
    }
    console.log(this.responseText);
    // alert(this.responseText);
  };
  xmlhttp.open(
    "GET",
    "Componentes/reservas/confirmar.php?p=" +
      start +
      "&cc=" +
      colorID +
      "&q=" +
      end +
      "&qk=" +
      comentario +
      "&c=" +
      cancha,
    false
  );
  xmlhttp.send();
}

var actualPersons;
var minCanchas;
function confirmatePersons(maxCanchas){



  
  actualPersons  = parseInt($("#p_personas").text());
  minCanchas =parseInt(actualPersons/8.1) + 1;


  if (maxCanchas ==  minCanchas){
    $("#btn_add").attr("disabled", true);
    $("#btn_add").css("color", "white");
    $("#btn_add").css("cursor", "auto");

    
  }
    $("#btn_substract").attr("disabled", true);
    $("#btn_substract").css("color", "white");
    $("#btn_substract").css("cursor", "auto");
  
  $("#p_canchas").text("0" + (minCanchas));

  if(actualPersons < 20){
    $("#modalNumberPerson").css("display", "none");
    $("#modalFirst").css("display", "block");
  }else{
    $("#modalNumberPerson").css("display", "none");
    $("#modalCotizar").css("display", "block");
  }
}

function startReserva(){
  $("#modalNumberPerson").css("display", "block");
  $("#modalExplicacion").css("display", "none");
}