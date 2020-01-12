function resetFormularyToFirstStep() {
  reservationDate = new Date($("#dtp_input2").val());
  reservationDate.addDays(1);

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
    // alert("horas de hoy disponibles: "  +hours)
    getHoursAvailables(hours);
  } else {
    getHoursAvailables(hours);
  }
  //  alert( "Horas no disponibles antes del proceso :" + hours);
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
  var canchas = $("#selectCanchas option:selected").text();
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
    showUser(varstringDate);
    var canchasReservadasParaHora = $("#myInput").val();

    var necesito = $("#selectCanchas option:selected").text();
    var hay = canchasTotal - canchasReservadasParaHora;

    if (necesito <= hay) {
      xxx.push(valor);
    }
    // alert("Canchas reservadas para el " + varstringDate + " --> " + $("#myInput").val());
    //  alert("Canchas disponibles para el " + varstringDate + " --> " + hay);
    //  xx.push(showUser(varstringDate));
  });

  var pppp = h;

  for ($i = 0; $i < 24; $i++) {
    if (!xxx.includes($i)) {
      if (!pppp.includes($i)) {
        pppp.push($i);
      }
    }
  }

  // alert( "Horas no disponibles para la fecha seleccionada :" + pppp);
  setHoursDisabled(pppp);
  addHoursAvailables(xxx);

}

function showUser(day) {
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

function desactivarSelecciones(){
  if (
    $(".form_date")
      .find("input")
      .val() == ""
  ) {
    $(".active.day").removeClass("active");
  }if (
    $(".form_time")
      .find("input")
      .val() == ""
  ){
  $(".active.hour").removeClass("active");
  }
}


function confirmateHours(){
  var hoursActive = getHoursActive();
  if(!hoursActive.length == 0 ){
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
      if(hoursActive.length == 1){
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
      }else{
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
      finishHour =  new Date($("#input-hora-fin").val());
        alert ("Fecha seleccionada:  --> " + reservationDate + " hasta  --> "+finishHour);
  }else{
        alert ("Seleccione una hora para la reserva");
  }
}

Date.prototype.addDays = function(days) {
  var date = new Date(this.valueOf());
  date.setDate(date.getDate() + days);
  return date;
};
