function eliminarReserva(id){
  if (confirm("¿Eliminar la reserva #"+id+"?")) {
    window.location.href='admin.php?eliminar='+ id ,"_self";
  } else {
  }
}

function habilitarDia(id, dia){
    window.location.href='reserva-fechas.php?eliminar='+ id ,"_self";
}


function eliminarCancha(id){
  if (confirm("¿Eliminar la cancha "+id+"?, todas las reservas relacionadas serán eliminadas" )) {
    window.location.href='canchas.php?eliminar='+ id ,"_self";
  } else {
  }
}

function eliminarCliente(id){
  if (confirm("¿Eliminar el cliente "+id+"?, todas las reservas relacionadas serán eliminadas" )) {
    window.location.href='clientes.php?eliminar='+ id ,"_self";
  } else {
  }
}

function confirmarReserva(id){
  if (confirm("¿Confirmar la reserva #"+id+"?")) {
    window.location.href='admin.php?confirmar='+ id ,"_self";
  } else {
  }
}



$(".hour_c").each(function(e) {
   var date = new Date($(this).text().replace(/\s/, 'T'));
   var hour = intToHourAM(date.getHours());
   $(this).text(hour);
});

$(".hour_d").each(function(e) {
  var date = new Date($(this).text().replace(/\s/, 'T'));
  var hour = intToHourAMl(date.getHours());
  $(this).text(hour);
});

$(".hour_dd").each(function(e) {
  var date = new Date($(this).text().replace(/\s/, 'T'));
  var hour = (date.getHours() -12)+":"+date.getMinutes()+" pm";
  $(this).text(hour);
});

$(".fecha").each(function(e) {
  var d = new Date($(this).text().replace(/\s/, 'T'));
  var fecha = d.getFullYear() +
  "-" +
  zeroPadded(d.getMonth() + 1) +
  "-" +
  zeroPadded(d.getDate()) ;
 
  $(this).text(fecha);
});

function zeroPadded(val) {
  if (val >= 10) return val;
  else return "0" + val;
}


  

function intToHourAM(hour){
  if(hour<=11){
      return hour+":00 am"
  }else {
      return (hour-12)+":00 pm";
  }
}

function intToHourAMl(hour){

  if(hour<=11){
      return hour+":00 am"
  }else {
      return (hour-12)+":59 pm";
  }
}

function intToHourAMll(hour){

  if(hour<=11){
      return hour+":00 am"
  }else {
      return (hour-12)+":59 pm";
  }
}

function showReservas(){

    var reservas = JSON.parse($('#back_reservas').val());
      reservas.forEach(function(valor, indice, array) {
    });
}

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("customers");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}


