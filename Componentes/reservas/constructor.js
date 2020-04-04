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

var modalFirst = document.getElementById("modalExplicacion");
var modalSecond = document.getElementById("modalSecond");
var span = document.getElementsByClassName("closeModalFirst");



$(".reserve").click(function(event) {
  // modalFirst.style.display = "block";
});

$(".reservem").click(function(event) {
  modalFirst.style.display = "block";
});



$(".reserve-start").click(function(event) {
  $("#modalFirst").css("display", "block");
  $("#modalCotizar").css("display", "none");
});

$(".cancelar-reserva").click(function(event) {
  if (confirm("¿Desea cancelar la reservación?")) {
    location.reload();
  }
});

// Modal ____________________________  PDF
var modal = document.getElementById("myModal-pdf");
var span = document.getElementsByClassName("close-pdf")[0];

  $("#action-pdf").click(function(event) {
    $("#menu-movil-div").css("display", "block");
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

$("#menu").click(function(event) {

      $('html, body').css({
        overflow: 'hidden',
        height: '100%'
      });

    $("#menu-movil-div").css("display", "block");
});

$("#close-menu").click(function(event) {

  $('html, body').css({
    overflow: 'initial',
    height: 'auto'
  });
$("#menu-movil-div").css("display", "none");
});


$(".menu-movil-option").click(function(event) {

  $('html, body').css({
    overflow: 'initial',
    height: 'auto'
  });
$("#menu-movil-div").css("display", "none");
});

