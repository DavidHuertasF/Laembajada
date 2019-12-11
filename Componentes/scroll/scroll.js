menu();

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
    "top": ((-windowHeight / 100) + 14) *2 + "%"
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

menu();



});

function refresh(){
  var es = document.getElementsByClassName("l-e"); // get all elements
  for (var i = 0; i < es.length; i++) {
    es[i].style.display = "none";
  }
  var es = document.getElementsByClassName("r-c"); // get all elements
  for (var i = 0; i < es.length; i++) {
    es[i].style.display = "none";
  }
  var es = document.getElementsByClassName("c-j"); // get all elements
  for (var i = 0; i < es.length; i++) {
    es[i].style.display = "none";
  }
  var es = document.getElementsByClassName("p-c"); // get all elements
  for (var i = 0; i < es.length; i++) {
    es[i].style.display = "none";
  }
  var es = document.getElementsByClassName("n-g"); // get all elements
  for (var i = 0; i < es.length; i++) {
    es[i].style.display = "none";
  }
}

function menu(){
  var windowHeight = $(window).scrollTop();
  var sec = ((windowHeight*100)/window.innerHeight );
  if(sec<90){
    refresh();
  }else if(sec<180){
    refresh();
    var es = document.getElementsByClassName("l-e"); // get all elements
      for (var i = 0; i < es.length; i++) {
        es[i].style.display = "contents";
      }
  }else if(sec<270){
    refresh();
    var es = document.getElementsByClassName("r-c"); // get all elements
      for (var i = 0; i < es.length; i++) {
        es[i].style.display = "contents";
      }
  }else if(sec<350){
    refresh();
    var es = document.getElementsByClassName("c-j"); // get all elements
      for (var i = 0; i < es.length; i++) {
        es[i].style.display = "contents";
      }
  }else if(sec<420){
    refresh();
    var es = document.getElementsByClassName("p-c"); // get all elements
      for (var i = 0; i < es.length; i++) {
        es[i].style.display = "contents";
      }
  
}else{
  refresh();
  var es = document.getElementsByClassName("n-g"); // get all elements
    for (var i = 0; i < es.length; i++) {
      es[i].style.display = "contents";
    }
  }
}


