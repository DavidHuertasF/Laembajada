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

// Trae los clientes para mostrarlos en el registro de reservas
$mostrar_cancha = "select * from cancha";
$resultado_mostrar = $conexion->consulta($mostrar_cancha);
$dato = array();
$canchas = array();
while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dato["id"] = $fila[0];
  $dato["nombre"] = $fila[1];
  array_push($canchas, $dato);
}

// Si se registra un ticket
if (isset($_POST["enviar"])) {
  $consulta = "INSERT INTO `reserva` 
  
		VALUES (NULL,
			'" . $_POST["horainicio"] . "', 
			'" . $_POST["horafin"] . "',
			'" . $_POST["id_cliente"] . "', 
			'" . $_POST["id_cancha"] . "',
			NOW())";
  $resultado = $conexion->consulta($consulta);
  echo "<meta http-equiv='refresh' content='0'>";
}



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
</head>

<body>
  
  <form  class="formt" action="reserva.php" method="POST">
    <div id="first-section">
    

        <!-- # Canchas -->
      <div>
        <p>Número canchas</p>
        <select class="form-control" id="selectCanchas">
          <?php
          for ($i = 1; $i < $canchasTotal + 1; $i++) { ?>
            <option value="<?php echo $i ?>"><?php echo $i ?></option>
          <?php } ?>
        </select>
      </div>

          <!-- Fecha -->
      <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
        <input class="form-control inputhide " size="16" type="text" value="" readonly />
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
      <input type="hidden" id="dtp_input2" value="" /><br/>
      </div>

     <!-- Hora prototipo -->
     <div id="div-hora">
     </div>      

    </div>
     
    <div id="second-section">
      <!-- Cancha -->
      <div id="div_cancha">
        <select class="form-control" name="id_cancha">
          <?php
          for ($i = 0; $i < count($canchas); $i++) { ?>
            <option value="<?php echo $canchas[$i]["id"]; ?>"><?php echo $canchas[$i]["nombre"]; ?></option>
          <?php } ?>
        </select>
      </div>

      <!-- Enviar -->
      <input class="btn btn-info" type="submit" name="enviar" value="Enviar"/>
      
      
     
    </div>

      <select style="display: none" class="form-control" name="id_cliente">
        <?php
        for ($i = 0; $i < count($clientes); $i++) { ?>
          <option value="<?php echo $clientes[$i]["id"]; ?>"><?php echo $clientes[$i]["nombre"]; ?></option>
        <?php } ?>
      </select>
      <input id="input-hora-fin" style="display: none" type="datetime" class="form-control" name="horafin" value="<?= $fecha_actual ?>"> <br/>
  </form>
    <br />

  <input type="text" style="display: none" id="myInput" value="ok">

  <button onclick="confirmateHours();">Confirmar primera fase</button>

  <style>
    .dropdown-menu {
      width: 200px;
      position: absolute;
    }

    #first-section{
      display: flex;
      flex-direction: row ;
      justify-content: space-between;
      padding: 30px;
    }
    #second-section{
      display: flex;
      flex-direction: row ;
      justify-content: space-between;
      padding: 30px;
    }

    .inputhide{
      pointer-events: none;
      width: 0px;
    height: 0px;
      margin-top: -11px;
    }

    .input-group{
      width: 200px;
      height: 300px;
    }

    #div-hora{
      width: 200px;
      height: 125px;
      overflow-y: scroll;
      display: flex;
      flex-direction: column ;
      align-items: center;
    }

    #div-hora button{
      width: 60%;
    background: transparent;
    border: solid red 1px;
    padding: 3%;
    margin-bottom: 8%;
    
   
    }
    #div-hora button:focus {
      outline:0;
      }

  
}



  </style>

</body>

<script type="text/javascript" src="recursos/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="recursos/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="recursos/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript" src="functions.js" charset="UTF-8"></script>
<script type="text/javascript" src="constructor.js" charset="UTF-8"></script>
<script type="text/javascript" src="hoursManager.js" charset="UTF-8"></script>


</html>