<?php
include_once("conexion.php");
$conexion = new conexion();

date_default_timezone_set('America/Caracas');
$fecha_actual = date("Y-m-d H:i:s");

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
<html>

<head>
  <title>Reserva</title>
  <link href="recursos/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen" />
  <link href="recursos/css/reserva.css" rel="stylesheet" media="screen" />

</head>

<body>
  <button id="reservaBtn">Reservar</button>
  <div id="modalFirst" class="modal">
    <div class="modal-content">
      <span class="closeModalFirst">&times;</span>
      <div id="first-section">
        <img style="margin-bottom: 30px;" src="../img/reservaStep.png" alt="">
        <div id="container" style="    width: 90%;">
          <!-- # Canchas -->
          <div id="div-canchas-section">
            <p class="title_div">No. Canchas</p>
            <div id="div_counter_canchas">
              <button id="btn_substract" class="button_change_canhcas" type="button" onclick="substractHour(<?php echo $canchasTotal ?>);">–</button>
              <p id="p_canchas">01</p>
              <button type="button" class="button_change_canhcas" onclick="addHour(<?php echo $canchasTotal ?>)" id="btn_add">+</button>
            </div>
            <p class="p_note">*Máximo 8 personas por cancha</p>
          </div>

          <!-- Fecha -->
          <div id="div-fecha-section" class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
            <p class="title_div">Fecha</p>

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
      "><span class="glyphicon glyphicon-calendar"></span></span>
            <input type="hidden" id="dtp_input2" value="" /><br />
          </div>

          <!-- Hora  -->
          <div id="div-hora-section">
            <p class="title_div">Hora</p>

            <div id="div_dates_in_hour">
              <!-- <button id="btn_substract_date" class="button_change_date" type="button" onclick="substractDate(<?php echo $canchasTotal ?>);">–</button> -->
              <p style="" id="p_date_in_hour">Seleccione una fecha</p>
              <!-- <button id="btn_add_date" type="button" class="button_change_date" onclick="addDate(<?php echo $canchasTotal ?>)" >+</button> -->
            </div>

            <div class="scroll button_scroll">
              <img class="hourbutton" style="width: 21px; display:none;" src="../img/up.png" alt="">
            </div>
            <div id="div-hora">
            </div>
            <div class="scrolld  button_scroll">
              <img class="hourbutton" style="width: 23px; display:none;" src="../img/down.png" alt="">
            </div>
          </div>
        </div>

        <button class="button_continuar" type="button" onclick="confirmateHours();">Continuar</button>
      </div>
    </div>
  </div>

  <div id="modalSecond" class="modal">
    <div class="modal-content-second">
      <span class="closeModalFirst">&times;</span>
      <div id="second-section">
        <img style="
        margin-bottom: 30px;" src="../img/canchaStep.png" alt="">
        <!-- Cancha -->
        <div id="div_cancha">
        </div>
        <button class="button_continuar" type="button" onclick="confirmateCanchas();">Continuar</button>
      </div>
    </div>
    <!-- Enviar -->
    <input class="btn btn-info" type="submit" name="enviar" value="Enviar" />
  </div>

  <div id="modalThird" class="modal">
    <div class="modal-content-third">
      <span class="closeModalFirst">&times;</span>
      <div id="third-section">

        <img src="../img/datosStep.png" alt="">
        <div style="display:flex; margin-top:25px;">
          <div style="display:flex; flex-direction:column; margin-top:30px;">
            <input id="input_cliente_nombre" type="text" placeholder="Nombre Apellido*">
            <input id="input_cliente_celular" type="text" placeholder="Celular*">
            <input id="input_cliente_correo" type="text" placeholder="Correo*">
            <input type="text" placeholder="Comentarios">
          </div>

          <div style="margin-left: 41px;     margin-top: 30px;">
            <img src="../img/embajada.png" alt="">
            <div>
              <p id="resume_p" style="color: white;  font-size:15px;">

            </div>
            <p>
              <span style="color:red; font-size:12px">*Te estaremos contactando para confirmar la reserva</span><br>
              <span style="color:red; font-size:12px">*La reserva se mantiene 15 minutos después de la hora fijada</span><br>
              <span style="color:red; font-size:12px">*La reserva no tiene ningún costo</span>
            </p>
          </div>
        </div>
        <button class="button_continuar" type="button" onclick="confirmateReserva();">Finalizar</button>
        <p style="color:white; font-size:12px">
          <span>Aceptas</span>
          <span style="text-decoration: underline">Términos y condicoones</span>
        </p>
      </div>
    </div>
  </div>





  <div>

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
    <input type="text" style="display: none" id="myInput" value="ok">
  </div>


</body>
<script type="text/javascript" src="recursos/phone-mask.min.js"></script>
<script type="text/javascript" src="recursos/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="recursos/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="recursos/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript" src="functions.js" charset="UTF-8"></script>
<script type="text/javascript" src="constructor.js" charset="UTF-8"></script>
<script type="text/javascript" src="hoursManager.js" charset="UTF-8"></script>

</html>