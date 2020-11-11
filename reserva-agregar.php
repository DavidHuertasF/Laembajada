
<?php
include_once("conexion.php");
$conexion = new conexion();


echo '<script type="text/javascript">
    var cancelados = [];
   </script>';
$dias_cierre = "select * from cierre";
$resultado_mostrar = $conexion->consulta($dias_cierre);
while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dia = $fila[1];
  echo '<script type="text/javascript">
  cancelados.push(new Date(("' . $dia  . '").replace(/-/g,"/").replace(/\s/, "T")+"Z"));
   </script>';
}


date_default_timezone_set('America/Caracas');
$fecha_actual = date("Y-m-d H:i:s");

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
<html lang="en">

<style>
  table{
    background: transparent !important;
    box-shadow: none !important;
  }

  .modal-content {
    width: auto !important;
}

.modal-content {
  padding: 0px 30px 0px 30px !important;
}

.next {
  background-size: auto;
}
</style>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="admin/admin.css" />
  <link rel="stylesheet" href="admin/table.css" />
   <link href="style/Home/bootstrap-datetimepicker.css" rel="stylesheet" media="screen" />
   <link href="style/Home/reserva-admin.css" rel="stylesheet" media="screen" />

  <title>Document</title>
</head>
<script type="text/javascript" src="./Componentes/modal-home/modal-home.js"></script>
<body>
<input style="display:none; border: solid 1px;height: 46px;width: 140px;position: fixed;z-index: 20;top: 20;" type="text" id="myInput" value="ok">
<div class="topnav">
  <a onclick="openNav()" href="#home">&#9776;</a>
  <a  href="admin/reserva-calendario.html">Agenda</a>
  <a  href="admin/admin.php">Lista</a>
  <a  href="reserva-fechas.php">Administrar fechas</a>
  <a  href="admin/espera.php">En espera</a>
  <a class="active" style="float: right"  href="nueva-reserva.html">Agregar reserva <img src="img/plus.png"  alt=""></a>

</div>


  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <img style="width: 50%;
    margin-left: 20%;
    margin-bottom: 20%;"
     src="https://drive.google.com/uc?id=1-fjb7iyB9gtxNTZRqP0e2hTasAszRcE4" alt="">
    <a href="admin/admin.php">• _Reservas</a>
    <a href="admin/clientes.php">_Clientes</a>
    <a href="admin/canchas.php">_Canchas</a>
    <a href="admin/contenido.php">_Contenido</a>
  </div>
 <br />


  <div style="display: flex;
    justify-content: space-evenly;">
    <div id="modalFirst" class="modalt">
      <div class="modal-content font">
        <div style=" display:none;  
       margin-left: -4ex;
    width: 54ex;
    background: rgb(0 0 0 / 20%);
    height: 85ex;
    position: absolute;" id="no-touch"></div>
        <div id="first-section">
          <div id="container" >
            <!-- # Canchas -->
            <div id="div-canchas-section">
              <p class=" font title_div">No. Canchas</p>
              <div id="div_counter_canchas">
                <button id="btn_substract" class="button_change_canhcas" type="button" onclick="substractHour(<?php echo $canchasTotal ?>);">–</button>
                <p id="p_canchas">01</p>
                <button type="button" class="button_change_canhcas" onclick="addHour(<?php echo $canchasTotal ?>)" id="btn_add">+</button>
              </div>
            </div>
            <!-- Fecha -->
            <div id="div-fecha-section" class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
              <p class=" font title_div"></p>

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
              <input style="display: none;" id="dtp_input2" value="" /><br />
                <input  style="display: none;" id="input-hora-fin" type="datetime" class="form-control" name="horafin" value=""><br />
              <p type="text" style=" display:none;
    height: 32px;" name="" id="inputprueba"> </p>
            </div>

            <!-- Hora  -->
            <div id="div-hora-section">
              <p class=" font title_div">Hora</p>

              <div id="div_dates_in_hour">
                <!-- <button id="btn_substract_date" class="button_change_date" type="button" onclick="substractDate(<?php echo $canchasTotal ?>);">–</button> -->
                <p class="" style=" margin:0;   font-size: 13px;" id="p_date_in_hour">Seleccione una fecha</p>
                <p style=" margin:0;  font-size: 13px;" id="p_date_in_hourss"></p>
                <!-- <button id="btn_add_date" type="button" class="button_change_date" onclick="addDate(<?php echo $canchasTotal ?>)" >+</button> -->
              </div>

              
              <div id="div-hora">
              </div>
             
            </div>
          </div>

          <button class=" font button_continuar" type="button" onclick="confirmateHoursStep();">Continuar</button>
        </div>
      </div>
    </div>

    <div id="modalSecond" style="display: none" class="modalt">
      <div class="modal-content-second font">
        <div id="second-section">
          <!-- Cancha -->
          <p class=" font title_div">Canchas disponibles</p>
          <div id="div_cancha">
          </div>
          <button class=" font button_continuar" type="button" onclick="confirmateCanchas();">Continuar</button>

        </div>
      </div>
      <!-- Enviar -->
      <input style="display: none" class="btn btn-info" type="submit" name="enviar" value="Enviar" />
    </div>

    <div id="modalThird" style="display: none" class="modalt">
      <div class="modal-content-third font">

        <div id="third-section">
        <p style="margin-bottom: -40px;" class=" font title_div">Cliente</p>

          <div id="reservaStepflex" style="display:flex; margin-top:25px;">
            <div  class="font"  style="display:flex; flex-direction:column; margin-top:30px;">
              <input id="input_cliente_nombre" type="text" placeholder="Nombre Apellido*">
              <input id="input_cliente_celular" type="text" placeholder="Celular*">
              <input id="input_cliente_correo" type="text" placeholder="Correo*">
              <input id="input_cliente_comentario" type="text" placeholder="   Comentarios">
            </div>

        
          </div>
          <button class="font button_continuar" type="button" onclick="confirmateReserva();">Reservar</button>
          <p style="color:white; font-size:12px">
          
          </p>
        </div>
      </div>
    </div>

    <div id="loadingi" style=" 
    width: 100vw;
    position: fixed;
    background: #00000085;
    height: 100vh;
    top: 0;
    display:none;      
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 30px; " class="load-wrapp">
      <div class="load-3">
        <p>Cargando</p>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
      </div>
  </div>
  </div>

</div>
</body>

<script type="text/javascript" src="./Ende_files/jquery.js.descarga"></script>
<script type="text/javascript" src="Componentes/reservas/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="Componentes/reservas/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript" src="Componentes/reservas/functions-admin.js" charset="UTF-8"></script>
<script type="text/javascript" src="Componentes/reservas/constructor-admin.js" charset="UTF-8"></script>
<script type="text/javascript" src="Componentes/reservas/hoursManager.js" charset="UTF-8"></script>
<script type="text/javascript" src="admin/admin.js" charset="UTF-8"></script>
</html>