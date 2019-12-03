$(window).scroll(function() {
  var $righta = $("#scroll-component-right-a");
  var $rightb = $("#scroll-component-right-b");
  var $rightc = $("#scroll-component-right-c");
  var $lefta = $("#scroll-component-left-a");
  var $leftb = $("#scroll-component-left-b");
  var $leftc = $("#scroll-component-left-c");

  var $divblue = $(".div-blue");

  var windowHeight = $(window).scrollTop();


  $divblue.css({
    "top": ((-windowHeight / 100) + 14) *1.4 + "%"
  });


  $righta.css({
    "margin-top": windowHeight / 100 + 13 + "%"
  });

  $rightb.css({
    "margin-top": windowHeight / 100 + 32 + "%"
  });

  $rightc.css({
    "margin-top": windowHeight / 100 + 50 + "%"
  });

  $lefta.css({
    "margin-top": windowHeight / 100 - 5 + "%"
  });

  $leftb.css({
    "margin-top": windowHeight / 100 + 13 + "%"
  });

  $leftc.css({
    "margin-top": windowHeight / 100 + 32 + "%"
  });



});



