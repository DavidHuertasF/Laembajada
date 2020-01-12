var e = new Date();
e.setMonth(e.getMonth() + 4);

var f = new Date();
f.setHours(f.getHours() - 4);

$("#dtp_input2").attr("name", "horainicio");

$(".form_date").datetimepicker({
  language: "es",
  weekStart: 2,
  autoclose: 1,
  daysOfWeekDisabled: [0, 1],
  endDate: e,
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

desactivarSelecciones();
$(".dropdown-menu").on("click", function(e) {
  desactivarSelecciones();
});


$("#selectCanchas").on("change", function() {
  resetFormularyToFirstStep();
});

$(".form_date").on("changeDate", function(e) {
  resetFormularyToFirstStep();
});


