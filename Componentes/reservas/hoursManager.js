function enableOnlyRangeOptions(hour) {
  var selectIsFraction = $("#" + hour).attr("fraction");
  // console.log("Habilitar solo rango a las" + hour +" -- es fraccion? : "+selectIsFraction );
  // console.log(hoursListGlobal);
  hour = parseInt(hour, 10);

  hoursListGlobal.forEach(function(valor, indice, array) {
    if (valor != hour) {
      $("#" + valor).attr("disabled", true);
      $("#" + valor).css("border", "none");
      $("#" + valor).css("color", "grey");
    }
  });

  if (selectIsFraction == "true") {
    var idx = hoursListGlobal.indexOf(hour + "m");
    // revisar los anteriores
    x = 0;
    start = true;
    fraction = true;
    for (let i = idx - 1; i >= 0; i--) {
      if (start) {
        if (hoursListGlobal[i] == hour) {
      
          $("#" + hour).attr("disabled", false);
          $("#" + hour).css("border", "red 1px solid");
          $("#" + hour).css("color", "black");
          x++;
          start = false;
        } else {
          // console.log(
          //   "El inmediatamente anterior no corresponde, se termina el proceso"
          // );
          break;
        }
      } else {
        if (fraction) {
          if (hoursListGlobal[i] == hour - x + "m") {
            // console.log(
            //   "Luego tenemos una fraccion " +
            //   hoursListGlobal[i] +"("+(hour - x) +")"+
            //     "que correspone, por lo que se activa"
            // );

            $("#" + (hour - x) + "m").attr("disabled", false);
            $("#" + (hour - x) + "m").css("border", "red 1px solid");
            $("#" + (hour - x) + "m").css("color", "black");
            fraction = false;
          } else {
            // console.log(
            //   "Luego tenemos una fraccion que no correspone," +
            //   hoursListGlobal[i] +"("+(hour - x)  +")"+
            //     ", se termina el proceso"
            // );
            break;
          }
        } else {
          if (hoursListGlobal[i] == hour - x) {
            // console.log(
            //   "Luego tenemos una hora " +
            //   hoursListGlobal[i] +"("+(hour - x) +")"+
            //     "que correspone, por lo que se activa"
            // );
            $("#" + (hour - x)).attr("disabled", false);
            $("#" + (hour - x)).css("border", "red 1px solid");
            $("#" + (hour - x)).css("color", "black");
            x++;

            fraction = true;
          } else {
            // console.log(
            //   "Luego tenemos una hora " +
            //   hoursListGlobal[i] +"("+(hour - x) +")"+
            //     "que no correspone, por lo que no se activa"
            // );
            break;
          }
        }
      }
    }

    // revisar los posteriores

    x = 0;
    start = true;
    fraction = true;
    for (let i = idx + 1; i <= hoursListGlobal.length; i++) {
      if (start) {
        if (hoursListGlobal[i] == hour + 1) {
          console.log(
            "El inmediatamente posterior es" +
              hoursListGlobal[i] +
              "correctamente por lo que se activa"
          );
          $("#" + (hour + 1)).attr("disabled", false);
          $("#" + (hour + 1)).css("border", "red 1px solid");
          $("#" + (hour + 1)).css("color", "black");
          x++;
          start = false;
        } else {
          console.log(
            "El inmediatamente posterior " +
              hoursListGlobal[i] +
              " no corresponde, se termina el proceso"
          );
          break;
        }
      } else {
        if (fraction) {
          if (hoursListGlobal[i] == hour + x + "m") {
            // console.log(
            //   "Luego tenemos una fraccion " +
            //     hoursListGlobal[i] +
            //     "(" +
            //     (hour + x) +
            //     ")" +
            //     "que correspone, por lo que se activa"
            // );

            $("#" + (hour + x) + "m").attr("disabled", false);
            $("#" + (hour + x) + "m").css("border", "red 1px solid");
            $("#" + (hour + x) + "m").css("color", "black");
            x++;

            fraction = false;
          } else {
            // console.log(
            //   "Luego tenemos una fraccion que no correspone," +
            //     hoursListGlobal[i] +
            //     "(" +
            //     (hour + x) +
            //     ")" +
            //     ", se termina el proceso"
            // );
            break;
          }
        } else {
          if (hoursListGlobal[i] == hour + x) {
            // console.log(
            //   "Luego tenemos una hora " +
            //     hoursListGlobal[i] +
            //     "(" +
            //     (hour + x) +
            //     ")" +
            //     "que correspone, por lo que se activa"
            // );
            $("#" + (hour + x)).attr("disabled", false);
            $("#" + (hour + x)).css("border", "red 1px solid");
            $("#" + (hour + x)).css("color", "black");

            fraction = true;
          } else {
            // console.log(
            //   "Luego tenemos una hora " +
            //     hoursListGlobal[i] +
            //     "(" +
            //     (hour + x) +
            //     ")" +
            //     "que no correspone, por lo que no se activa"
            // );
            break;
          }
        }
      }
    }
  } else {
    var idx = hoursListGlobal.indexOf(hour);
    // revisar los anteriores
    x = 0;
    start = true;
    fraction = false;
    for (let i = idx - 1; i >= 0; i--) {
      if (start) {
        if (hoursListGlobal[i] == hour - 1 + "m") {
          console.log(
            "Fraccion completa" +
              hoursListGlobal[i] +
              "correctamente por lo que se activa"
          );
          $("#" + (hour - 1) + "m").attr("disabled", false);
          $("#" + (hour - 1) + "m").css("border", "red 1px solid");
          $("#" + (hour - 1) + "m").css("color", "black");
          x++;
          start = false;
        } else {
          // console.log(
          //   "El inmediatamente anterior"+ hoursListGlobal[i] +(hour)+"no corresponde, se termina el proceso"
          // );
          break;
        }
      } else {
        if (fraction) {
          if (hoursListGlobal[i] == hour - x + "m") {
            // console.log(
            //   "Luego tenemos una fraccion " +
            //   hoursListGlobal[i] +"("+(hour - x) +")"+
            //     "que correspone, por lo que se activa"
            // );

            $("#" + (hour - x) + "m").attr("disabled", false);
            $("#" + (hour - x) + "m").css("border", "red 1px solid");
            $("#" + (hour - x) + "m").css("color", "black");
            fraction = false;
          } else {
            // console.log(
            //   "Luego tenemos una fraccion que no correspone," +
            //   hoursListGlobal[i] +"("+(hour - x)  +")"+
            //     ", se termina el proceso"
            // );
            break;
          }
        } else {
          if (hoursListGlobal[i] == hour - x) {
            // console.log(
            //   "Luego tenemos una hora " +
            //   hoursListGlobal[i] +"("+(hour - x) +")"+
            //     "que correspone, por lo que se activa"
            // );
            $("#" + (hour - x)).attr("disabled", false);
            $("#" + (hour - x)).css("border", "red 1px solid");
            $("#" + (hour - x)).css("color", "black");
            x++;

            fraction = true;
          } else {
            // console.log(
            //   "Luego tenemos una hora " +
            //   hoursListGlobal[i] +"("+(hour - x) +")"+
            //     "que no correspone, por lo que no se activa"
            // );
            break;
          }
        }
      }
    }

    // revisar los posteriores

    x = 0;
    start = true;
    fraction = false;
    for (let i = idx + 1; i <= hoursListGlobal.length; i++) {
      if (start) {
        if (hoursListGlobal[i] == hour + "m") {
          // console.log(
          //   "El inmediatamente posterior es" +
          //     hoursListGlobal[i] +
          //     "correctamente por lo que se activa"
          // );
          $("#" + hour + "m").attr("disabled", false);
          $("#" + hour + "m").css("border", "red 1px solid");
          $("#" + hour + "m").css("color", "black");
          x++;
          start = false;
        } else {
          // console.log(
          //   "El inmediatamente posterior " +
          //     hoursListGlobal[i] +"("+(hour + 1)+"m"+")"+
          //     " no corresponde, se termina el proceso"
          // );
          break;
        }
      } else {
        if (fraction) {
          if (hoursListGlobal[i] == hour + x + "m") {
            console.log(
              "Fraccion individual escogida " +
                hoursListGlobal[i] +
                "(" +
                (hour + x) +
                ")" +
                "que correspone, por lo que se activa"
            );

            $("#" + (hour + x) + "m").attr("disabled", false);
            $("#" + (hour + x) + "m").css("border", "red 1px solid");
            $("#" + (hour + x) + "m").css("color", "black");
            x++;

            fraction = false;
          } else {
            // console.log(
            //   "Luego tenemos una fraccion que no correspone," +
            //     hoursListGlobal[i] +
            //     "(" +
            //     (hour + x) +
            //     ")" +
            //     ", se termina el proceso"
            // );
            break;
          }
        } else {
          if (hoursListGlobal[i] == hour + x) {
            // console.log(
            //   "Luego tenemos una hora " +
            //     hoursListGlobal[i] +
            //     "(" +
            //     (hour + x) +
            //     ")" +
            //     "que correspone, por lo que se activa"
            // );
            $("#" + (hour + x)).attr("disabled", false);
            $("#" + (hour + x)).css("border", "red 1px solid");
            $("#" + (hour + x)).css("color", "black");

            fraction = true;
          } else {
            // console.log(
            //   "Luego tenemos una hora " +
            //     hoursListGlobal[i] +
            //     "(" +
            //     (hour + x) +
            //     ")" +
            //     "que no correspone, por lo que no se activa"
            // );
            break;
          }
        }
      }
    }
  }
}

var hoursListGlobal = [];
var houtlll = [];

function resetHours(){
  // console.log("Disponibles = "+ houtlll.length + " de --> " +hoursListGlobal.length);
  addHoursAvailables(houtlll, hoursListGlobal);
  $("#p_date_in_hourss").text("");
  $("#modalSecond").css("display", "none");
  $("#modalThird").css("display", "none");
}


function addHoursAvailables(hoursList, hoursavailables) {
  // console.log("Disponibles = "+ hoursList.length + " de --> " +hoursavailables.length);
  hoursListGlobal = hoursavailables;
  houtlll = hoursList;

  $("#div-hora").empty();
  var xs = [];
  var xm = [];

  hoursavailables.forEach(function(valor, indice, array) {
    xm.push(valor);
  });

  hoursList.forEach(function(valor, indice, array) {
    xs.push(valor);
  });

  xs.reverse();
  xm.reverse();

  // console.log(xm);

   console.log("horas disponibles para el dia y canchas seleccionadas: " + hoursList );

  xm.forEach(function(valor, indice, array) {
    var x = valor + "";
    var isAvailable = xs.includes(valor);
    
    if (isAvailable) {

      if (x.charAt(valor.length - 1) == "m") {
        $("#div-hora").prepend(
          "<button avaliable=true class='font hour-button fraction' fraction='true' name='off' onclick='buttonHourFunction(this.id, true)' " +
            "id=" +
            valor.substring(0, 2) +
            "m" +
            " type='button'>" +
            intToHourAMPlus(valor.substring(0, 2)) +
            "</button>"
        );
      } else {
        $("#div-hora").prepend(
          "<button avaliable=true class='font  hour-button' name='off'  fraction='false' onclick='buttonHourFunction(this.id, false)' " +
            "id=" +
            valor +
            " type='button'>" +
            intToHourAM(valor) +
            "</button>"
        );
      }
    }else{

      if (x.charAt(valor.length - 1) == "m") {
        $("#div-hora").prepend(
          "<button avaliable=false class=' noavailable tooltip font hour-button fraction' fraction='true' name='off' onclick='buttonHourFunction(this.id, true)' " +
            "id=" +
            valor.substring(0, 2) +
            "m" +
            " type='button'>" +
            intToHourAMPlus(valor.substring(0, 2)) +
            "  <span class='tooltiptext'>—————</span></button>  "
        );
      } else {
        $("#div-hora").prepend(
          "<button avaliable=false class=' noavailable tooltip font hour-button' name='off'  fraction='false' onclick='buttonHourFunction(this.id, false)' " +
            "id=" +
            valor +
            " type='button'>" +
            intToHourAM(valor) +
            " <span class='tooltiptext'>—————</span> </button> "
        );
      }

    }

  });
}

function buttonCanchaFucntion(cancha) {
  $("#modalThird").css("display", "none");
  var status = $("#" + cancha).attr("name"); // estado del boton seleccionado (on, off)
  var actives = document.getElementsByName("onC").length;
  var canchasPeticion = parseInt($("#p_canchas").text());

  if (status == "onC") {
    // si está on ponerlo off

    if (actives == canchasPeticion) {
      // si hay x activos deshabilitar el resto
      document
        .getElementsByName("offC")
        .forEach(function(valor, indice, array) {
          document
            .getElementsByName("offC")
            .forEach(function(valor, indice, array) {
              $("#" + valor.id).css("border", "black 2px solid");
              $("#" + valor.id).css("color", "black");
              $("#" + valor.id).attr(
                "onclick",
                "buttonCanchaFucntion(this.id);"
              );
            });
        });
    }
    $("#" + cancha).css("border", "black 2px solid");
    $("#" + cancha).css("color", "black");
    $("#" + cancha).attr("name", "offC");
  } else {
    // si está off ponerlo en on
    if (actives == canchasPeticion - 1) {
      //si se va a activar el último pedido

      $("#" + cancha).css("border", " solid 2px red");
      $("#" + cancha).css("color", "red");
      $("#" + cancha).attr("name", "onC");

      document
        .getElementsByName("offC")
        .forEach(function(valor, indice, array) {
          $("#" + valor.id).css("border", "grey 2px solid");
          $("#" + valor.id).css("color", "grey");
          $("#" + valor.id).attr("onclick", "");
        });
    } else {
      // si no hay activos
      $("#" + cancha).css("border", " solid 2px red");
      $("#" + cancha).css("color", "red");
      $("#" + cancha).attr("name", "onC");
    }
  }
}

var fractionHourAvailables = 2;

function buttonHourFunction(hour, fraction) {
  var actives = document.getElementsByName("on").length; // cuantos ya están activos

  if (actives > 1) {
    // si ya hay un rango reiniciar
    resetHours();
  } else {
    //Si no hay rango y es el la primer seleccion
    // log(getHoursActive());
    // console.log('cambio');
    var off = false;
    var status = $("#" + hour).attr("name"); // estado del boton seleccionado (on, off)

    // Revisar si el botón seleccionado está activado o desactivado
    //activado
    if (status == "on") {
      // Habilitar todo
      resetHours();
      off = true;
    }
    //desactivado
    else {
      if (actives == 1) {
        //si uno ya está activo crear rango

        // ______________     Proceso de rango de horas con fracciones de 30 minutos   ______________________

        var selectIsFraction = $("#" + hour).attr("fraction");
        var activeHour = document.getElementsByName("on")[0].id;

        //verificar  horas escogidas sean exactas
        if ($('button[name="on"]').attr("fraction") == "true") {
          //la hora seleccionada anteriormente es una fracción

          activeHour = activeHour.match(/\d+/)[0];

          hour = parseInt(hour, 10);
          activeHour = parseInt(activeHour, 10);
          var num1 = Math.min(hour, activeHour);
          var num2 = Math.max(hour, activeHour);

          if (selectIsFraction == "false") {
            //Si el seleccionado no es fracción

            for (let i = num1; i <= num2; i++) {
              if (num2 == hour) {
                // Agregar todo el rango
                if (activeHour != i) {
                  // Excepto la hora del del anterior
                  activeButton(i);
                }
                if (hour != i) {
                  // Excepto la fracción del seleccionado
                  activeButton(i + "m");
                }
              } else {
                activeButton(i);
                activeButton(i + "m");
              }
            }
          } else {
            //Si el seleccionado  es fracción

            for (let i = num1; i <= num2; i++) {
              // Agregar todo el rango
              off = true;

              if (num1 == hour) {
                // si el seleccioando es el menor
                if (i != hour) {
                  // no tome la hora completa del seleccionado
                  // Excepto la hora seleccionada
                  activeButton(i);
                }
              } else {
                // si es el mayor tomela excepto la del primero
                if (i != activeHour) {
                  activeButton(i);
                }
              }
              activeButton(i + "m");
            }
          }
        } else {
          //la hora seleccionada anteriormente no es una fracción

          hour = parseInt(hour, 10);
          activeHour = parseInt(activeHour, 10);
          var num1 = Math.min(hour, activeHour);
          var num2 = Math.max(hour, activeHour);

          if (selectIsFraction == "false") {
            //Si el seleccionado  actual  no es fracción

            for (let i = num1; i <= num2; i++) {
              // Agregar todo el rango
              activeButton(i);

              if (i != num2) {
                // Excepto la ultima fraccion
                activeButton(i + "m");
              }
            }
          } else {
            //Si el seleccionado  actual es fracción

            for (let i = num1; i <= num2; i++) {
              // Agregar todo el rango
              // Excepto la primera fraccion

              if (hour == num1 && num1 != num2) {
                if (i != hour) {
                  // alert("agregando "+i+" que no puede ser igual a " + hour);
                  off = true;
                  activeButton(i);
                }
                if (i != activeHour) {
                  activeButton(i + "m");
                }
              } else {
                activeButton(i);
                activeButton(i + "m");
              }
            }
          }
        }

        //desactivar el resto
        document
          .getElementsByName("off")
          .forEach(function(valor, indice, array) {
            var id = document.getElementsByName("off")[indice].id;
            $("#" + id).attr("disabled", true);
            $("#" + id).css("border", "none");
            $("#" + id).css("color", "grey");
          });
      } else {
        // si es el primero que se activa revisar su rango apto
        console.log(
          "Seleccionado" +
            hour +
            " ... activado el proceso para determinar su rango"
        );
        enableOnlyRangeOptions(hour);
      }
    }

    if (off) {
    } else {
      activeButton(hour);
    }
  }
  cambioxd();

}

function activeButton(id) {
  $("#" + id).css("background-color", "red");
  $("#" + id).css("color", "white");
  $("#" + id).attr("name", "on");
  $("#" + id).attr("disabled", false);
}

function getHoursActive() {
  var actives = [];
  var range = [];
  document.getElementsByName("on").forEach(function(valor, indice, array) {
    actives.push(valor.id);
  });
  range.push(actives[0]);
  range.push(actives[actives.length - 1]);

  if (actives.length == 1 || actives.length == 0) {
    range = actives;
  }
  return range;
}

function intToHourAM(hour) {
  if (hour <= 11) {
    return hour + ":00 am";
  } else {
    return hour - 12 + ":00 pm";
  }
}

function intToHourAMPlus(hour) {
  if (hour <= 11) {
    return hour + ":30 am";
  } else {
    return hour - 12 + ":30 pm";
  }
}
