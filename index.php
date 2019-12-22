<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>La embajada</title>
  <link rel="stylesheet" href="style/Home/home.css" />
  <link rel="stylesheet" href="Componentes/modal-home/modal-home.css" />
  <link rel="stylesheet" href="Componentes/scroll/scroll.css" />


  <!-- responsive -->
  <link rel="stylesheet" href="style/Home/responsive/extra-small.css" />
  <link rel="stylesheet" href="style/Home/responsive/small.css" />
  <link rel="stylesheet" href="style/Home/responsive/medium.css" />
  <link rel="stylesheet" href="style/Home/responsive/large.css" />
  <link rel="stylesheet" href="style/Home/responsive/extra-large.css" />

  <link rel="stylesheet" href="style/Home/responsive/tablet.css" />

  <script type="text/javascript" src="./Ende_files/jquery.js.descarga">

  
  </script>
  <script>

  captura();

  function captura() {
       
       jQuery.ajax({
             url:"mobile-home.html",
             type: 'POST',
             success:function(result){
              mobile(result);
             }

           }); 

           jQuery.ajax({
             url:"desktop-home.html",
             type: 'POST',
             success:function(result){
               desktop(result);
             }

           }); 
  
           function mobile( result){
              window.xe = result;
            }
            function desktop( result){
              window.x = result;
            }
   }
  
  </script>


</head>
<script type="text/javascript" src="./Componentes/modal-home/modal-home.js"></script>

<body>
    <img style="width: 0px" src="img/pop-sections/s1.png" alt="">
    <img style="width: 0px"  src="img/pop-sections/s2.png" alt="">
    <img style="width: 0px"  src="img/pop-sections/s3.png" alt="">
  <div id="html"></div>


  <script>

    setInterval(color, 10);

    function es() {
      $("html").attr("lang", "es");

      var es = document.getElementsByClassName("en"); // get all elements
      for (var i = 0; i < es.length; i++) {
        es[i].style.display = "none";
      }
      var es = document.getElementsByClassName("es"); // get all elements
      for (var i = 0; i < es.length; i++) {
        es[i].style.display = "block";
      }
    }

    function en() {
      $("html").attr("lang", "en");
      var elements = document.getElementsByClassName("es"); // get all elements
      for (var i = 0; i < elements.length; i++) {
        elements[i].style.display = "none";
      }

      var elements = document.getElementsByClassName("en"); // get all elements
      for (var i = 0; i < elements.length; i++) {
        elements[i].style.display = "block";
      }
    }

    function color() {
      var bodyStyle = window.getComputedStyle(document.body, null);
      bgColor = bodyStyle.backgroundColor;

      var elements = document.getElementsByClassName("dinamic-background"); // get all elements
      for (var i = 0; i < elements.length; i++) {
        elements[i].style.backgroundColor = bgColor;
      }
    }
  </script>

  <script>
 
      function size(x) {

        if (x.matches) { // If media query matches
          setTimeout("movilVersion()",1);
          $( document ).ready(function() {
            setTimeout("modalMobile()",100);
});
        
        } else {
          setTimeout("desktopVersion()",1);

          $( document ).ready(function() {
            setTimeout("modalDesktop()",100);

});
        }
      }

      var x = window.matchMedia("(max-width: 600px)")
      size(x) // Call listener function at run time
      x.addListener(size) // Attach listener function on state changes

      function movilVersion(){
        
          $('#html').html(window.xe);
      }function  desktopVersion(){
        $('#html').html(window.x);
      }
  </script>
  

  <script src="Componentes/scroll/scroll.js"></script>
  <script src="./Ende_files/color.js.descarga"></script>
  <script src="./Ende_files/skrollr.js.descarga"></script>
  <script src="./Ende_files/custom.js.descarga"></script>
  <script src="./Ende_files/jquery.pixelentity.flare.min.js.descarga"></script>



</body>



</html>