<?php
include_once("conexion.php");
$conexion = new conexion();

date_default_timezone_set('America/Caracas');
$fecha_actual = date("Y-m-d H:i:s");


if (isset($_GET["eliminar"])) {
  $consulta_eliminar = "DELETE FROM cierre WHERE id = '" . $_GET["eliminar"] . "' ";
  $resultado_eliminar = $conexion->consulta($consulta_eliminar);

  echo ("<script type='text/javascript'>window.location.href='reserva-fechas.php';</script>");
}


echo '<script type="text/javascript">
    var cancelados = [];
   </script>';
$dias_cierre = "SELECT * from cierre where cierre.fecha > CURRENT_TIMESTAMP;";
$dato = array();
$dias = array();
$resultado_mostrar = $conexion->consulta($dias_cierre);
while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dia = $fila[1];
  $dato["id"] = $fila[0];
  $dato["dia"] = $dia;
  $dato["eliminar"] = "<img  style='cursor: pointer;'   onclick='habilitarDia(" . $dato['id'] . "," . $dato['dia'] . ")' id='switch_btn' src='img/switch.png'></img>";
  echo '<script type="text/javascript">
  cancelados.push(new Date(("' . $dia  . '").replace(/-/g,"/").replace(/\s/, "T")+"Z"));
   </script>';
  array_push($dias, $dato);
}



// echo '<script type="text/javascript">
//    alert(cancelados);
//    </script>';

?>

<!DOCTYPE html>
<html lang="en">

<style>
  table {
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
    <a href="admin/reserva-calendario.html">Agenda</a>
    <a href="admin/admin.php">Lista</a>
    <a class="active" href="#">Administrar fechas</a>
    <a  href="admin/espera.php">En espera</a>
    <a style="float: right" href="reserva-agregar.php">Agregar reserva <img src="img/plus.png" alt=""></a>

  </div>


  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <img style="width: 50%;
    margin-left: 20%;
    margin-bottom: 20%;" src="https://drive.google.com/uc?id=1-fjb7iyB9gtxNTZRqP0e2hTasAszRcE4" alt="">
    <a href="admin/admin.php">• _Reservas</a>
    <a href="admin/clientes.php">_Clientes</a>
    <a href="admin/canchas.php">_Canchas</a>
    <a href="admin/contenido.php">_Contenido</a>
  </div>
  <input style="display:none; " id="input-hora-fin" type="datetime" class="form-control" name="horafin" value="<?= $fecha_actual ?>"> <br />

  <div style="display: flex;justify-content: space-around;     flex-wrap: wrap;">
    <div style="
    width: 400px;
    display: flex;
      justify-content: space-evenly;">
      <div id="modalFirst" class="modalt">
        <div class="modal-content font">
          <div id="first-section">
            <div id="container">
              <!-- # Canchas -->
              <div id="div-canchas-section">

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
                <input type="hidden" id="dtp_input2" value="" /><br />
              </div>

              <!-- Hora  -->
              <div id="div-hora-section">


              </div>
            </div>
          </div>

          <button class=" font button_continuar" type="button" onclick="deshabilitarFecha();">Deshabilitar</button>
        </div>
      </div>
    </div>


    <table id="customers" style="margin-top:10px; width: 350px;">
      <thead align="center">
        <tr>
          <th>Día</th>
          <th class="last_right">Habilitar</th>
        </tr>

      </thead>


      <tbody align="center">
        <?php for ($i = 0; $i < count($dias); $i++) { ?>
          <tr>
            <td class=""><?php echo $dias[$i]["dia"]; ?></td>
            <td class=""><?php echo $dias[$i]["eliminar"]; ?></td>
          </tr>
        <?php } ?>

      </tbody>

    </table>
  </div>  
</body>


<script type="text/javascript" src="./Ende_files/jquery.js.descarga"></script>
<script type="text/javascript" src="Componentes/reservas/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="Componentes/reservas/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript" src="Componentes/reservas/functions-admin.js" charset="UTF-8"></script>
<script type="text/javascript" src="Componentes/reservas/constructor-admin.js" charset="UTF-8"></script>
<script type="text/javascript" src="Componentes/reservas/hoursManager.js" charset="UTF-8"></script>
<script type="text/javascript" src="admin/admin.js" charset="UTF-8"></script>



<script type="text/javascript">


</script>

</html>