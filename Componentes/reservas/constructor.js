var stringDate ="";
var finishDate = new Date();
finishDate.setMonth(finishDate.getMonth() + 4);

$("#dtp_input2").attr("name", "horainicio");

$(".form_date").datetimepicker({
  language: "es",
  weekStart: 2,
  autoclose: 1,
  daysOfWeekDisabled: [0, 1],
  endDate: finishDate,
  startView: 2,
  startDate: new Date(),
  minView: 2
});

$(".form_time").datetimepicker({
  format: "HH:00 P",
  language: "en",
  showMeridian: 1,
  weekStart: 1,
  autoclose: 1,
  useCurrent: false,
  startView: 1,
  minView: 1,
  maxView: 1,
  forceParse: 0,
  initialDate: null
});

$(".active.day").removeClass("active"); // Luego de crear el form date desactiva el día actual

$(".dropdown-menu").on("click", function(e) {
  desactivarSelecciones();
});


$('.button_change_canhcas').click(function(){
  resetFormularyToFirstStep();
});


$(".form_date").on("changeDate", function(e) { 
  $(".hourbutton").css("display", "block");
  resetFormularyToFirstStep();
});


// Modal ____________________________  Sistema de reservas

// Get the modal
var modalFirst = document.getElementById("modalFirst");
var modalSecond = document.getElementById("modalSecond");
// Get the button that opens the modal
var btn = document.getElementById("container-c");
var btnreserva = document.getElementsByClassName("reserve")[0];
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("closeModalFirst")[0];
var span2 = document.getElementsByClassName("closeModalFirst")[1];
var span3 = document.getElementsByClassName("closeModalFirst")[2];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modalFirst.style.display = "block";
}

btnreserva.onclick = function() {
  modalFirst.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  if (confirm("¿Desea cancelar la reservación?")) {
    location.reload();
  } else {
    
  }
}
span2.onclick = function() {
  if (confirm("¿Desea cancelar la reservación?")) {
    location.reload();
  } else {
  }
}

span3.onclick = function() {
  if (confirm("¿Desea cancelar la reservación?")) {
    location.reload();
  } else {
  }
}



// Modal ____________________________  PDF

var modal = document.getElementById("myModal-pdf");
var span = document.getElementsByClassName("close-pdf")[0];

  $("#action-pdf").click(function(event) {
  modal.style.display = "block";
});


span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//   }
// }
$(document).ready(function() {
  $(".scrolld").click(function(event) {
    $("#div-hora").animate({ scrollTop: "+=45px" }, 1);
  });

  $(".scroll").click(function(event) {
    $("#div-hora").animate({ scrollTop: "-=45px" }, 1);
  });
  $(".prev").empty();
  $(".prev").prepend("<img style='width:21px' src='img/left.png'></img>");

  $(".next").empty();
  $(".next").prepend("<img style='width:21px' src='img/right.png'></img>");
});

$("#input_cliente_celular-menu").on("click", function(e) {
  $("#input_cliente_celular").attr("disabdata-phonemaskled", "+57 (___)___-____");
});



