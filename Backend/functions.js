function resetFormularyToFirstStep() {
  reservationDate = new Date($("#dtp_input2").val());
  reservationDate.addDays(1);
  diaSemana();
  var x = new Date();
  var today = getDayOfYear(new Date());
  var hourToday = x.getHours() + 1;
  var dayReservation = getDayOfYear(reservationDate) + 1;

  reservationIsCurrentDay = today == dayReservation;
  var hours = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 23, 24];

  if (reservationIsCurrentDay) {
    for (i = 0; i < hourToday; i++) {
      var exist = hours.find(element => element == i);
      if (exist === undefined) {
        hours.push(i);
      }
    }
    getHoursAvailables(hours);
  } else {
    if ($("#dtp_input2").val() != "") {
      getHoursAvailables(hours);
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
  var canchas = parseInt($("#p_canchas").text());
  var hoursavailables = [];
  for (var i = 0; i < 24; i++) {
    if (!h.includes(i)) {
      hoursavailables.push(i);
    }
  }
  xxx = [];
  hoursavailables.forEach(function(valor, indice, array) {
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
      ":" +
      dateExtra.getMinutes() +
      ":" +
      d.getSeconds();

    var consulta = "";
    showReservasByDay(varstringDate);
    var canchasReservadasParaHora = $("#myInput").val();

    var necesito = parseInt($("#p_canchas").text());
    var hay = canchasTotal - canchasReservadasParaHora;

    if (necesito <= hay) {
      xxx.push(valor);
    }
    // alert("Canchas reservadas para el " + varstringDate + " --> " + $("#myInput").val());
    //  alert("Canchas disponibles para el " + varstringDate + " --> " + hay);
    //  xx.push(showReservasByDay(varstringDate));
  });

  var pppp = h;

  for ($i = 0; $i < 24; $i++) {
    if (!xxx.includes($i)) {
      if (!pppp.includes($i)) {
        pppp.push($i);
      }
    }
  }

  if (xxx.length < 3) {
    $(".hourbutton").css("display", "none");
  }

  // alert( "Horas no disponibles para la fecha seleccionada :" + pppp);
  setHoursDisabled(pppp);
  addHoursAvailables(xxx);
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
  xmlhttp.open("GET", "getuser.php?q=" + day, false);
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

function confirmateHours() {
  var hoursActive = getHoursActive();
  if (!hoursActive.length == 0) {
    var hourSelected = hoursActive[0];
    reservationDate.setHours(hourSelected);
    d = reservationDate.addDays(1);
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
    if (hoursActive.length == 1) {
      $("#input-hora-fin").val(
        d.getFullYear() +
          "-" +
          zeroPadded(d.getMonth() + 1) +
          "-" +
          zeroPadded(d.getDate()) +
          " " +
          (d.getHours() + 1) +
          ":00:00"
      );
    } else {
      $("#input-hora-fin").val(
        d.getFullYear() +
          "-" +
          zeroPadded(d.getMonth() + 1) +
          "-" +
          zeroPadded(d.getDate()) +
          " " +
          (d.getHours() + 2) +
          ":00:00"
      );
    }

    reservationDate = new Date($("#dtp_input2").val());
    finishHour = new Date($("#input-hora-fin").val());
    // alert(
    //   "Fecha seleccionada:  -->  " +
    //     reservationDate +
    //     " \n \n  hasta  --> " +
    //     finishHour
    // );

    showCanchasByDate($("#dtp_input2").val(), $("#input-hora-fin").val());
    $("#modalFirst").css("display", "none");
    $("#modalSecond").css("display", "block");
    readCanchasId();
  } else {
    alert("Seleccione todos los campos para continuar");
  }
}

function confirmateCanchas() {
  var finishHourOk = "";

  if (finishHour.getHours() <= 11) {
    finishHourOk = finishHour.getHours() + ":00 am";
  } else {
    finishHourOk = finishHour.getHours() - 13 + ":59 pm";
  }

  var resume =
    stringDate +
    "  | " +
    intToHourAM(reservationDate.getHours()) +
    " - " +
    finishHourOk;


  document.getElementsByName("onC").forEach(function(valor, indice, array) {
    var cancha = valor.textContent;
    resume = resume +" | "+cancha;
  });

  $("#resume_p").prepend(
    "<span style='color: white;  font-size:19px;'>Resumen</span><br>"+ resume +"</p>"
  );
  
  if (document.getElementsByName("onC").length > 0) {
     $("#modalFirst").css("display", "none");
     $("#modalSecond").css("display", "none");
     $("#modalThird").css("display", "block");
  } else {
    alert("Seleccione todos los campos para continuar");
  }
}

Date.prototype.addDays = function(days) {
  var date = new Date(this.valueOf());
  date.setDate(date.getDate() + days);
  return date;
};

$("#btn_substract").attr("disabled", true);
$("#btn_substract").css("color", "white");
$("#btn_substract").css("cursor", "auto");

function showCanchasByDate(datei, datef) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      $("#inputprueba").text(this.responseText);
    }
  };
  xmlhttp.open("GET", "getCanchas.php?q=" + datei + "&p=" + datef, false);
  // xmlhttp.open("GET", "getCanchas.php?q=2" + datei+", q=2", false);
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

function substractHour() {
  $("#btn_add").attr("disabled", false);
  $("#btn_add").css("color", "red");
  $("#btn_add").css("cursor", "pointer");

  var actualHour = parseInt($("#p_canchas").text());
  var newHour = parseInt(actualHour) - 1;

  if (newHour == 1) {
    $("#btn_substract").attr("disabled", true);
    $("#btn_substract").css("color", "white");
    $("#btn_substract").css("cursor", "auto");
  }
  $("#p_canchas").text("0" + newHour);
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
        "'style='background-size: contain; background-repeat: no-repeat; background-image: url(\"../img/cancha.png\") 'class='cancha-button' name='offC' onclick='buttonCanchaFucntion(this.id)' " +
        "id=" +
        nombre +
        ">" +
        nombre +
        "</div>"
    );
  }
}

function confirmateReserva() {
  reservationDate = new Date($("#dtp_input2").val());
  finishHour = new Date($("#input-hora-fin").val());

  var nombre = $("#input_cliente_nombre").val();
  var celular = $("#input_cliente_celular").val();
  var correo=$("#input_cliente_correo").val();

  if(nombre == '' || celular == '' || correo ==''){
    alert("falta algún dato obligatorio");
  }else{
    creatUser();
    document.getElementsByName("onC").forEach(function(valor, indice, array) {
      var id = valor.id;
      id = id.substring(0, id.length - 1);

      d = reservationDate;
      e = finishHour;

      var start =
        d.getFullYear() +
        "-" +
        zeroPadded(d.getMonth() + 1) +
        "-" +
        zeroPadded(d.getDate()) +
        " " +
        d.getHours() +
        ":00:00";
      var end =
        e.getFullYear() +
        "-" +
        zeroPadded(e.getMonth() + 1) +
        "-" +
        zeroPadded(e.getDate()) +
        " " +
        e.getHours() +
        ":00:00";
      confirmate(start, end, id);
    });
    location.reload();
  }
}

function creatUser(){

  
  var nombre = $("#input_cliente_nombre").val();
  var celular = $("#input_cliente_celular").val();
  var correo=$("#input_cliente_correo").val();
  

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
    "confirmarCliente.php?p=" + nombre + "&q=" + celular + "&c=" + correo,
    false
  );
  xmlhttp.send();
}

function confirmate(start, end, cancha) {
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      $("#inputprueba").text(this.responseText);
    }
  };
  xmlhttp.open(
    "GET",
    "confirmar.php?p=" + start + "&q=" + end + "&c=" + cancha,
    false
  );
  xmlhttp.send();

}



