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

  <script type="text/javascript" src="./Ende_files/jquery.js.descarga"></script>


</head>

<body>

  <div id="html"></div>
        <script>


          if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
             alert("movil");
          }

          $('#html').html('<?php
                            include "desktop-home.html";
                            ?>');
        </script>

  <div id="movil-version">
    <!-- Secciones  -->
    <div>
      <div class="section">
        <div class="section" id="ende-m">

          <div id="header">


            <img id="logo" src="img/logo.png" alt="">

            <p class="button-idiom">
              <button class="button-idiom" onclick="es();">Esp</button> /
              <button class="button-idiom" onclick="en();">Eng</button>
            </p>

            <img id="menu" src="img/movil/menu.svg" alt="">
          </div>
          <div id="move-movil">
            <div class="move font ">
              Av&nbsp;Carrera&nbsp;24&nbsp;#&nbsp;76&nbsp;-&nbsp;20&nbsp;San&nbsp;Felipe,&nbsp;Bogotá&nbsp;-&nbsp;Colombia&nbsp;//&nbsp;&nbsp;+57&nbsp;3105554359&nbsp;&nbsp;-&nbsp;&nbsp;645&nbsp;1192&nbsp;//&nbsp;info@tejolaembajada.com&nbsp;//&nbsp;Ma&nbsp;·&nbsp;Mi&nbsp;4&nbsp;-&nbsp;11pm&nbsp;|&nbsp;Ju&nbsp;&nbsp;4&nbsp;-&nbsp;1am&nbsp;|&nbsp;Vi&nbsp;&nbsp;4&nbsp;-&nbsp;1am&nbsp;|&nbsp;Sá&nbsp;|&nbsp;2&nbsp;-&nbsp;1am&nbsp;|&nbsp;Do&nbsp;|&nbsp;2&nbsp;-&nbsp;7pm&nbsp;
            </div>
          </div>
          <div class="content-first">

            <img class="banner" src="img/banner.png" alt="" />
            <p class="reserve font es">Reserve Cancha</p>
            <p class="reserve font en">Book a lane</p>
          </div>

        </div>
      </div>

      <div class="section">
        <div class="section" id="portafolio-m">
          <div class="div-white">
            <div id="container">
              <img class="photo-on" src="img/embajada.gif" alt="" />
              <div id="circle">
                <img id="myBtn-m" src="img/svg/draw.svg" alt="" />

                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="300px" height="300px" viewBox="80 80 138 138" enable-background="new 0 0 500 500">
                  <defs>
                    <path id="circlePath" d=" M 150, 150 m -60, 0 a 60,60 0 0,1 120,0 a 60,60 0 0,1 -120,0 "></path>
                  </defs>
                  <g>
                    <use xlink:href="#circlePath" fill="none"></use>
                    <text fill="#e7291e">
                      <textPath xlink:href="#circlePath">
                        - La Embajada -La Embajada - La Embajada - La Embajada -
                        La Embajada - La Embajada&nbsp;
                      </textPath>
                    </text>
                  </g>
                </svg>
              </div>
            </div>
          </div>
        </div>



      </div>

      <div class="section">
        <div class="section" id="gente-m" style="
            padding-top: 5%;">

          <div id="container-c">
            <div id="container-c-a">
              <img class="photo-on-b" src="img/3.png" alt="" />

              <div style="padding-bottom: 7%;" class="move font es">
                Reserve&nbsp;cancha&nbsp;-&nbsp;Reserve&nbsp;cancha&nbsp;-&nbsp;Reserve&nbsp;cancha&nbsp;-&nbsp;Reserve&nbsp;cancha&nbsp;-&nbsp;Reserve&nbsp;cancha&nbsp;-&nbsp;Reserve&nbsp;cancha&nbsp;-&nbsp;Reserve&nbsp;cancha&nbsp;-&nbsp;Reserve&nbsp;cancha&nbsp;-&nbsp;Reserve&nbsp;cancha&nbsp;
              </div>

              <div style="padding-bottom: 7%;" class="move font en">
                Book&nbsp;a&nbsp;lane&nbsp;-&nbsp;Book&nbsp;a&nbsp;lane&nbsp;-&nbsp;Book&nbsp;a&nbsp;lane&nbsp;-&nbsp;Book&nbsp;a&nbsp;lane&nbsp;-&nbsp;Book&nbsp;a&nbsp;lane&nbsp;-&nbsp;Book&nbsp;a&nbsp;lane&nbsp;-&nbsp;Book&nbsp;a&nbsp;lane&nbsp;-&nbsp;Book&nbsp;a&nbsp;lane&nbsp;-&nbsp;Book&nbsp;a&nbsp;lane&nbsp;-&nbsp;Book&nbsp;a&nbsp;lane&nbsp;-&nbsp;
              </div>
            </div>

            <div style="
                border-top: solid white;
                border-bottom: solid white;
                margin-top: 3%;
                 height: 90%;
            "></div>
            <img id="img-cruz" style="  margin-top: 3%;
            width: 6vw;" src="img/cruz.png" alt="" />
          </div>

        </div>
      </div>

      <div class="section">
        <div class="section" style="padding-top: 20%;" id="como-jugar-m">
          <img src="img/svg/Recurso 1.svg" alt="" style="
           width: 45vh;
    margin-left: 2vh;
    position: absolute;
    z-index: 3;
          ">
          <div style="
           position: absolute;
    width: 78%;
    height: 29vh;
    margin-top: 8vh;
    margin-left: 10vh;
    background: black;
      "></div>

          <p style='
              margin-top: 2vh;
    margin-left: 11vh;
    position: absolute;
    font-size: 3vh;
    font-family: belwe, Arial, sans-serif;
    color: white;
    display: block;
        '>
            ¿Cómo jugar tejo?
          </p>

          <p style='
        margin-top: 39vh;
    margin-left: 12vh;
    position: absolute;
    font-size: 3vh;
    font-family: belwe, Arial, sans-serif;
    color: white;
    display: block;
          '>
            How to play tejo?
          </p>
        </div>

      </div>

      <div class="section ">
        <div class="section" id="mensajes-m" style="
           padding-top: 30vh;
    ">
          <p class="es" style='
    left: 11%;
    margin-top: 4vw;
    position: absolute;
    font-size: 5vw;
    font-family: belwe, Arial, sans-serif;
    color: white;
    display: block;
  '>
            POLA<br />
            Y COMIDA <br />
          </p>

          <p class="en" style='
      left: 11%;
    margin-top: 4vw;
    position: absolute;
    font-size: 5vw;
    font-family: belwe, Arial, sans-serif;
    color: white;
    display: block;
  '>
            BEER<br />
            AND FOOD <br />
          </p>



          <img src="img/svg/draw-b.svg" alt="" style="
        width: 90%;
    height: 60vw;
    margin-left: 5%;
    border: solid;
    border-color: white
        " />

          <img class="photo-on-c" src="img/polas.gif" alt="" />
        </div>
      </div>

      <div class="section">
        <div class="section" style="padding-top: 5%;" id="conocenos-m">
          <div style="
          width: 100%;
          height: 20%;
      ">
            <img src="img/svg/Recurso 2.svg" alt="" style="
           width: 35%;
    margin-left: 62%;
    margin-top: 3vh;
          ">
          </div>
          <div style="
          width: 100%;
          height: 20%;
      ">
            <p class="es" style='
                left: 20%;
    text-align: end;
    margin-top: 2vh;
    position: absolute;
    font-size: 5vw;
    font-family: belwe, Arial, sans-serif;
    display: block;
          '>
              LA EMBAJADA ES EL PRIMER<br />
              ESPACIO DE CERVECERÍA<br />
              NON GRATA
            </p>
          </div>
          <div style="
          width: 100%;
          height: 20%;
        ">
            <p class="es" style='
            left: 10vh;
    width: 70%;
    margin-top: 0vw;
    position: absolute;
    font-size: 3vw;
    font-family: belwel;
    display: block;
            '>
              Somos una cervecería artesanal en el medio de diseño y cerveza, con un mensaje disruptivo:
              desafiar las convenciones para crear nuevas formas de experimentar el mundo. Declaramos ser
              una cervecería de zorros y zorras, pues este animal es nuestro símbolo de emprendimiento:
              astucia, recursividad y pasarla bien. Declaramos también que hacemos polas de amores y odios,
              porque buscamos que las personas tomen una posición definida frente a ellas. Este
              emprendimiento nació hace cuatro años con lo que llamamos la propuesta Non Grata:
            </p>
          </div>
          <div style="
          width: 100%;
          height: 20%;
          ">

            <p class="es" style='
              left: 8vh;
    width: 70%;
     margin-top: 15vw;
    position: absolute;
    font-size: 3vw;
    font-family: belwe;
    display: block;
            '>
              1. Cervezas con ingredientes especiales // <strong style="color: red;"> <br />Nos apasiona
                experimentar.</strong>
              <br />
              2. Tienen mayor nivel de alcohol // <strong style="color: red;"> <br />Nos gusta que se
                sientan</strong>.<br />
              3. Siempre tienen una historia que contar //<strong style="color: red;"> <br />Nos mueve
                conectar</strong>.
            </p>
          </div>
          <a style="color: black;" href="https://www.nongrata.com.co/#/">
            <p class="es" style='
         left: 31%;
    margin-top: 10vw;
    position: absolute;
    font-size: 6vw;
    font-family: belwe;
    display: block;
    border-bottom: solid red;
           '>
              Conócenos
            </p>

          </a>



        </div>
      </div>

      <!-- Fin secciones  -->

      <!-- Slides -->
      <a class="slide-a" href="#la-embajada-m">
        <div><span></span></div>
      </a>

      <a class="slide-b" href="#reserve-cancha-m">
        <div><span></span></div>
      </a>

      <a class="slide-c" href="#como-jugar-m">
        <div><span></span></div>
      </a>

      <a class="slide-d" href="#pola-comida-m">
        <div><span></span></div>
      </a>


      <a class="slide-e" href="#non-grata-m">
        <div><span></span></div>
      </a>
      <!-- Fin slides -->

      <!-- icons -->
      <a class="a-whats" href=""><img src="img/w-icon.png" alt="" /></a>
    </div>


    <!-- The Modal -->
    <div id="myModal-m" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <div class="close-m"></div>
        <img id="pop-section-m" src="img/svg/pop-sections/s1.svg" alt="">
        <button class="section-button" id="section-a-m"></button>
        <button class="section-button" id="section-b-m"></button>
        <button class="section-button" id="section-c-m"></button>
        <img id="galery-modal-m" src="img/pop-sections/s1.png" alt="">
        <div id="content-modal">
          <p id="title-modal">La Embajada</p>
          <p id="p-modal">Es el primer tejo artesanal de Colombia. Nunca
            antes la cerveza artesanal había coexistido con el
            deporte nacional, y ahora, juntos en un mismo
            espacio, están listos para hacer moñona.<br /><br />
            El tejo es la esencia de La Embajada.
            Se trata de una actividad que practicaban los
            indígenas nativos hace siglos, y que ahora es
            deporte nacional. Desde Cervecería Non Grata,
            retomamos el tejo y le damos un nuevo
            significado a través de la cerveza artesanal.
            El término 'embajada' se refiere a un territorio que
            conecta a las personas con su lugar de origen, sin
            importar el lugar del mundo en que se
            encuentren. Quienes hacen parte de este
            territorio o país, comparten valores comunes que
            moldean su identidad. De esta manera, en La
            Embajada, aquellos que comparten con nosotros
            el deseo de construir una nueva colombianidad,
            en general, y un amor por la cerveza y el tejo, en
            particular, son los embajadores de esta iniciativa.</p>
        </div>
      </div>

    </div>
  </div>




  <script>
    $(document).ready(function() {
      es();
    });
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

  <script src="Componentes/scroll/scroll.js"></script>
  <script src="./Ende_files/color.js.descarga"></script>
  <script src="./Ende_files/skrollr.js.descarga"></script>
  <script src="./Ende_files/custom.js.descarga"></script>
  <script src="./Ende_files/jquery.pixelentity.flare.min.js.descarga"></script>
  <script type="text/javascript" src="./Componentes/modal-home/modal-home.js"></script>



</body>



</html>