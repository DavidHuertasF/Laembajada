<?php
include_once("conexion.php");
$conexion = new conexion();

date_default_timezone_set('America/Caracas');
$fecha_actual = date("Y-m-d H:i:s");


echo '<script type="text/javascript">
    var cancelados = [];
   </script>';
$dias_cierre = "select * from cierre";
$resultado_mostrar = $conexion->consulta($dias_cierre);
while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dia = $fila[1];
  echo '<script type="text/javascript">
  cancelados.push(new Date(("' . $dia  . '").replace(/-/g,"/")));
   </script>';
}



$dias_cierreA = "Select  
contenido_es
from 
textos where id = '8'
LIMIT 1;";
$resultado_mostrarA = $conexion->consulta($dias_cierreA);
while ($fila = mysqli_fetch_row($resultado_mostrarA["resultado"])) {
  $terminosA = $fila[0];
}


$dias_cierreB = "Select  
contenido_es
from 
textos where id = '9'
LIMIT 1;";
$resultado_mostrarB = $conexion->consulta($dias_cierreB);
while ($fila = mysqli_fetch_row($resultado_mostrarB["resultado"])) {
  $terminosB = $fila[0];
}

$terminosA = str_replace(array("\r\n", "\n\r", "\r", "\n"), "<br />", $terminosA);
$terminosB = str_replace(array("\r\n", "\n\r", "\r", "\n"), "<br />", $terminosB);



// Trae los textos para mostrarlos en el registro de reservas
$mostrar_textos = "select * from textos";
$resultado_mostrar = $conexion->consulta($mostrar_textos);
$dato = array();
$textos = array();
while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dato["id"] = $fila[0];
  $dato["nombre"] = $fila[1];
  $dato["contenido_es"] = $fila[2];
  $dato["contenido_en"] = $fila[3];
  array_push($textos, $dato);
}


// Trae los clientes para mostrarlos en el registro de reservas
$mostrar_clientes = "select * from cliente";
$resultado_mostrar = $conexion->consulta($mostrar_clientes);
$dato = array();
$clientes = array();
while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dato["id"] = $fila[0];
  $dato["nombre"] = $fila[1];
  array_push($clientes, $dato);
}

// Trae las canchas para mostrarlos en el registro de reservas
$mostrar_cancha = "select * from cancha";
$resultado_mostrar = $conexion->consulta($mostrar_cancha);
$dato = array();
$canchas = array();
while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dato["id"] = $fila[0];
  $dato["nombre"] = $fila[1];
  array_push($canchas, $dato);
}

$js_array = json_encode($canchas);
echo "<script>var canchas = " . $js_array . ";\n </script>";


// Sistema de reservas 
//Total de canchas existentes
$canchasTotalConsulta = " select count(*) from cancha";
$canchasTotalResultadoConsulta = $conexion->consulta($canchasTotalConsulta);
$fila = mysqli_fetch_row($canchasTotalResultadoConsulta["resultado"]);
$canchasTotal =  $fila[0];
echo '<script type="text/javascript">
    var canchasTotal = parseInt(' . $canchasTotal . ');
   </script>';
?>

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
<script type="text/javascript" src="./Componentes/modal-home/modal-home.js"></script>

<body>

  <img style="width: 0px" src="https://drive.google.com/uc?id=1ouSFlKSPS-IrgbE4NQl8kUg6p0WFCvms" alt="">
  <img style="width: 0px" src="https://drive.google.com/uc?id=1866ao6GQPQ02Jowe-9ZLOoN1ZZmk_m56" alt="">
  <img style="width: 0px" src="https://drive.google.com/uc?id=1tIMfIljNviIDmq0s1HBPSdE4GuSBgWJm" alt="">
  <div id="html"></div>
<!-- 

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

  <script>
    function size(x) {
      if (x.matches) { // If media query matches
        movilVersion();
        es();
        modalMobile();
      } else {
        desktopVersion();
        modalDesktop();
        es();
      }
    }

    var x = window.matchMedia("(max-width: 600px)")
    size(x) // Call listener function at run time
    x.addListener(size) // Attach listener function on state changes

    function movilVersion() {
      $('#html').html(`<?php
                        include "mobile-home.html";
                        ?>`);
    }

    function desktopVersion() {
      $('#html').html(`<?php
                        include "desktop-home.html";
                        ?>`);
    }
  </script> -->



  <!-- Sistema de reservas -->

  <div id="modalEspera" class="modalt" style="display: none;">
    <div class="modal-content-third font" style="background: #ff000073;">
    <div class="cancelar-reserva"></div>
      <div id="third-section">
      <img class="reservaStep" style="margin-bottom: 30px;" src="img/Thirdstep-espera.png" alt="">

        <div id="reservaStepflex" style="display:flex; margin-top:25px;     flex-wrap: wrap;     justify-content: center;">

        <div style="margin-left: 41px;  width:400px;  ">
            <p style="    color: white;    margin-right: 40px;
    font-size: 27px;"> Canchas no disponibles para esta hora <br> <br> ¿Quieres dejar tus datos en caso de que se libere una cancha?</p>
          </div>

          <div  class="font"  style="display:flex; flex-direction:column; width: 300px; margin-top:30px;">
            <input id="input_cliente_nombre_espera" type="text" placeholder="Nombre Apellido*">
            <input id="input_cliente_celular_espera" type="text" placeholder="Celular*">
            <input id="input_cliente_correo_espera" type="text" placeholder="Correo*">
            <input id="input_cliente_comentario_espera" type="text" placeholder="   Comentarios">
          </div>

         
        </div>
        <div style="    display: flex;
    align-items: center;
    flex-flow: wrap;
    justify-content: space-evenly;
    width: 100%;
">
          <button style="    margin-left: 0;
    margin-right: 0; width:auto;" class="font button_continuar" type="button" onclick="cambiarReserva();">Cambiar reserva</button>
          <p style="color:white; font-size:12px">
          <button   style="    margin-left: 0;
    margin-right: 0;"class="font button_continuar" type="button" onclick="entrarEspera();">Finalizar</button>
        </div>  
        <p style="color:white; font-size:12px">
          <span>Aceptas</span>
          <span style="text-decoration: underline">Términos y condiciones</span>
        </p>
      </div>
    </div>
  </div>



  <div id="modalExplicacion" class="modalt" style="display: none;">
    <div class="modal-content font">
    <div class="cancelar-reserva"></div>
      <div id="first-section">
      <img  id="embajadaImg" src="img/embajada.png" alt="">

        <div id="container" style="    width: 90%;">
        </div>
        <p class="first-section_subtitle">Hay dos maneras de jugar</p>
        <div class="first-section_content">
          <div class="column">
            <div class="column_header"><p>1. Hora de Juego</p></div>
            <p>La hora de tejo vale 60,000 en total para el grupo (hasta 8 personas por cancha) y el consumo es adicional.
            </p>
          </div>
          <div class="column">
            <div class="column_header"><p>2. Consumo de Pola</p></div>
            <p>Si compran la cerveza artesanal de la casa: Isamel, en petaco de 16 botellas (cada una de 6.2% de alcohol, $9,000cada una), cancelan $144,000 incluyen una hora de juego. *
            </p>
          </div>
        </div>
        
        <button class=" font button_continuar" type="button" onclick="startReserva()">Continuar</button>
        <p class="first-section_description"><?php echo $terminosA; ?></p>

        <div></div>
      </div>
    </div>
  </div>

  <div id="modalCotizar" class="modalt" style="display: none;">
    <div class="modal-content font">
    <div class="cancelar-reserva"></div>
    <div id="back-e" class="regresar"></div>

      <div id="first-section">
      <img class="reservaStep" style="margin-bottom: 30px;" src="img/secondstep.png" alt="">
        <div class="first-section_content">
          <div class="column">
            <div class="column_header"><p>Cotizar evento</p></div>
            <div class="column_content">
              <p>La hora de tejo vale 60,000 en total para el grupo (hasta 8 personas por cancha) y el consumo es adicional.
            </div>
            <div style=" display:flex;  align-items:center; margin:0px 20px; border-top: white 2px solid"><a  href="https://api.whatsapp.com/send?phone=+573105554359&amp;text=Hola,%20me%20quiero%20contactar%20con%20Tejo%20La%20Embajada%20para%20cotizar%20un%20evento"> <img style=" cursor:pointer;    width: 32px;  margin: 10px;" src="img/cruz.png" alt=""></a> Aquí</div>
            </p>
          </div>
          <div class="column">
            <div class="column_header"><p>Continuar Reserva</p></div>
            <div class="column_content"></div>
            <div  style=" display:flex;  align-items:center; margin:0px 20px; border-top: white 2px solid"> <img class="reserve-start" style="  cursor:pointer;   width: 32px;  margin: 10px;" src="img/cruz.png" alt=""> Aquí</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="modalNumberPerson" class="modalt" style="display: none;">
    <div class="modal-content font">
    <div class="cancelar-reserva"></div>
    <div id="back-a" class="regresar"></div>
      
      <div id="first-section">
        <img class="reservaStep" style="margin-bottom: 30px;" src="img/firststep.png" alt="">
        <div id="container" style="    width: 90%;">
          <!-- # Canchas -->
          <div id="div-canchas-section">
            <p class=" font title_div">No. Personas</p>
            <div id="div_counter_canchas">
              <button id="btn_substract_person" class="button_change_persons" type="button" onclick="substractPerson();">–</button>
              <p id="p_personas">01</p>
              <button type="button" class="button_change_persons" onclick="addPerson(<?php echo $canchasTotal ?>)" id="btn_add_person">+</button>
            </div>
            <p class=" font p_note">*Cuantas personas van a jugar?</p>
          </div>
        </div>

        <button class=" font button_continuar" type="button" onclick="confirmatePersons(<?php echo $canchasTotal ?>);">Continuar</button>
      </div>
    </div>
  </div>


  <div id="modalFirst" class="modalt" style="display: none;">
    <div class="modal-content font">
    <div class="cancelar-reserva"></div>
    <div id="back-b" class="regresar"></div>

      <div id="first-section">
        <img class="reservaStep" style="margin-bottom: 30px;" src="img/secondstep.png" alt="">
        <div id="container" style="    width: 90%;">
          <!-- # Canchas -->
          <div id="div-canchas-section">
            <p class=" font title_div">No. Canchas</p>
            <p style="color: red">Elejiste <b id="persons"></b> personas</p>
            <div id="div_counter_canchas">
              <button id="btn_substract" class="button_change_canhcas" type="button" onclick="substractHour(<?php echo $canchasTotal ?>);">–</button>
              <p id="p_canchas">01</p>
              <button type="button" class="button_change_canhcas" onclick="addHour(<?php echo $canchasTotal ?>)" id="btn_add">+</button>
            </div>
            <p class=" font p_note">*Máximo 8 personas por cancha</p>
          </div>

          <!-- Fecha -->
          <div id="div-fecha-section" class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
            <p class=" font title_div">Fecha</p>

            <span class="input-group-addon" style="
                  padding: 0px;
                  font-size: 0px;
                  font-weight: normal;
                  line-height: 0;
                  text-align: center;
                  background-color: white;
                  border: 0px solid #cccccc;
                  border-radius: 4px;
                  cursor: pointer;
                  width: 0px;
      "><span class=""></span></span>
            <input type="hidden" id="dtp_input2" value="" /><br />
          </div>

          <!-- Hora  -->
          <div id="div-hora-section">
            <p class=" font title_div">Hora</p>

            <div id="div_dates_in_hour">
              <!-- <button id="btn_substract_date" class="button_change_date" type="button" onclick="substractDate(<?php echo $canchasTotal ?>);">–</button> -->
              <div style="display: flex; width:120%; align-items: baseline;">
              <p class="" id="p_date_in_hour">Seleccione una fecha</p> 
              <p style="font-size: 13px;" id="p_date_in_hourss"></p>

              </div>
              <!-- <button id="btn_add_date" type="button" class="button_change_date" onclick="addDate(<?php echo $canchasTotal ?>)" >+</button> -->
            </div>

            <div class="scroll button_scroll">
              <img class="hourbutton" style="width: 21px; display:none;" src="img/up.png" alt="">
            </div>
            <div id="div-hora">
            </div>
            <div class="scrolld  button_scroll">
              <img class="hourbutton" style="width: 23px; display:none;" src="img/down.png" alt="">
            </div>
          </div>
        </div>

        <button class=" font button_continuar" type="button" onclick="confirmateHoursStep();">Continuar</button>
      </div>
    </div>
  </div>

  <div id="modalSecond" class="modalt" style="display: none;">

    <div class="modal-content-second font">
  <div id="back-c" class="regresar"></div>

    <div class="cancelar-reserva"></div>
      <div id="second-section">
        <img class="reservaStep" style="
        margin-bottom: 30px;" src="img/secondstep.png" alt="">
        <!-- Cancha -->
        <div id="div_cancha">
        </div>
        <button class=" font button_continuar" type="button" onclick="confirmateCanchas();">Continuar</button>
      </div>
    </div>
    <!-- Enviar -->
    <!-- <input class="btn btn-info" type="submit" name="enviar" value="Enviar" /> -->
  </div>

  <div id="modalThird" class="modalt" style="display: none;">
    <div class="modal-content-third font">
    <div class="cancelar-reserva"></div>
  <div id="back-d" class="regresar"></div>

      <div id="third-section">
      <img class="reservaStep" style="margin-bottom: 30px;" src="img/Thirdstep.png" alt="">

        <img class="reservaStep" src="img/datosStep.png" alt="">
        <div id="reservaStepflex" style="display:flex; margin-top:25px;">
          <div  class="font"  style="display:flex; flex-direction:column; margin-top:30px;">
            <input id="input_cliente_nombre" type="text" placeholder="Nombre Apellido*">
            <input id="input_cliente_celular" type="text" placeholder="Celular*">
            <input id="input_cliente_correo" type="text" placeholder="Correo*">
            <input id="input_cliente_comentario" type="text" placeholder="   Comentarios">
          </div>

          <div style="margin-left: 41px;     margin-top: 30px;">
            <img  id="embajadaImg" src="img/embajada.png" alt="">
            <div>
              <p id="resume_p" style="color: white;  font-size:15px;">

            </div>
            <p>

              <span style=" color:red; font-size:12px"><?php echo $terminosB; ?>
            </p>
          </div>
        </div>
        <button class="font button_continuar" type="button" onclick="confirmateReserva();">Reservar</button>
        <p style="color:white; font-size:12px">
          <span>Aceptas</span>
         <a target="blank" href="http://www.tejolaembajada.com/politica-tratamiento-datos/"> <span style="text-decoration: underline; color:white;">Términos y condiciones</span> </a>
        </p>
      </div>
    </div>
  </div>

  <div style="display: none">

    <select class="form-control" name="id_cliente">
      <?php
      for ($i = 0; $i < count($clientes); $i++) { ?>
        <option value="<?php echo $clientes[$i]["id"]; ?>"><?php echo $clientes[$i]["nombre"]; ?></option>
      <?php } ?>
    </select>


    <input id="input-hora-fin" type="datetime" class="form-control" name="horafin" value="<?= $fecha_actual ?>"> <br />

    <select class="form-control" name="id_cancha">
      <?php
      for ($i = 0; $i < count($canchas); $i++) { ?>
        <option value="<?php echo $canchas[$i]["id"]; ?>"><?php echo $canchas[$i]["nombre"]; ?></option>
      <?php } ?>
    </select>

    <p type="text" style=" 
    height: 32px;" name="" id="inputprueba"> </p>
    <input style="border: solid 1px;height: 46px;width: 140px;position: fixed;z-index: 20;top: 20;" type="text" id="myInput" value="ok">
  </div>



  <!-- FIN Sistema de reservas -->


  <!-- ______________________ MODAL PDF  ______________________ -->
<!-- <div id="myModal-pdf" class="modal"> -->

<!-- Modal content -->
<!-- <div class="modal-content-pdf">
<div class=" close-pdf"></div>
  <div>
  <iframe src="https://drive.google.com/file/d/1rolIoLIgGpS5MeiWvZFN2-fZ9o66Qz-Y/preview" style="width:100%;height:700px; border: none;"></iframe>
</div>
</div>

</div> -->
 <!-- ______________________ FIN MODAL PDF  ______________________ -->


  <script src="Componentes/scroll/scroll.js"></script>
  <script src="./Ende_files/color.js.descarga"></script>
  <script src="./Ende_files/skrollr.js.descarga"></script>
  <script src="./Ende_files/custom.js.descarga"></script>
  <script src="./Ende_files/jquery.pixelentity.flare.min.js.descarga"></script>


  <link href="style/Home/bootstrap-datetimepicker.css" rel="stylesheet" media="screen" />
  <link href="style/Home/reserva.css" rel="stylesheet" media="screen" />

</body>

<script type="text/javascript" src="Componentes/reservas/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="Componentes/reservas/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript" src="Componentes/reservas/functions.js" charset="UTF-8"></script>
<script type="text/javascript" src="Componentes/reservas/constructor.js" charset="UTF-8"></script>
<script type="text/javascript" src="Componentes/reservas/hoursManager.js" charset="UTF-8"></script>

<script>
  var slides = document.querySelectorAll('#slides .slide');
  var currentSlide = 0;
  var slideInterval = setInterval(nextSlide,5000);

  function nextSlide() {
      slides[currentSlide].className = 'slide';
      currentSlide = (currentSlide+1)%slides.length;
      slides[currentSlide].className = 'slide showing';
  }
</script>

</html>