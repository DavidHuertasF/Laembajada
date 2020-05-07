<?php
include_once("../conexion.php");
$conexion = new conexion();

date_default_timezone_set('America/Caracas');
$fecha_actual = date("Y-m-d H:i:s");

// Trae los clientes para mostrarlos en el registro de reservas
$mostrar_clientes = "select * from espera";
$resultado_mostrar = $conexion->consulta($mostrar_clientes);
$dato = array();
$clientes = array();


if (isset($_GET["eliminar"])) {
  $consulta_eliminar = "DELETE FROM reserva WHERE id = '".$_GET["eliminar"]."' ";
  $resultado_eliminar = $conexion->consulta($consulta_eliminar);
  //  echo($m);
  echo("<script type='text/javascript'>window.location.href='admin.php';</script>");
}



while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dato["id"] = $fila[0];
  $dato["nombre"] = $fila[1];
  array_push($clientes, $dato);
}



// Trae las reservas para mostrarlas en la tabla
$mostrar = "SELECT 
r.`id`,
r.`fecha_inicio`,
r.`fecha_fin`,
cl.nombre,
r.`comentarios`,
cl.id,
cl.celular,
cl.correo,
r.`numero_canchas`
FROM `espera` r, cliente cl
 where r.`cliente_id` = cl.id ";
$resultado_mostrar = $conexion->consulta($mostrar);
$dato = array();
$reservas = array();

while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dato["id"] = $fila[0];
  $dato["fecha_inicio"] = $fila[1];
  $dato["fecha_fin"] = $fila[2];

  $dato["id_cliente"] = "<p
  class='p_client'
><span>".$fila[3]." "."</span><img onclick='modalCliente(`".$fila[5]."`,`".$fila[3]."`,`".$fila[6]."`,`".$fila[7]."`);' style='cursor: pointer;' src='../img/eye.png'></p>";
  $dato["comentarios"] = $fila[4];
  $dato["canchas"] = $fila[8];
  $dato["eliminar"] = "<img  style='cursor: pointer;'   onclick='eliminarReserva(".$dato['id'].")' id='eliminar_btn' src='../img/delete.png'></img>";
  
  array_push($reservas, $dato);
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

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="admin.css" />
  <link rel="stylesheet" href="table.css" />
  

  <title>Document</title>
</head>

<body>

<div class="topnav">
  <a onclick="openNav()" href="#home">&#9776;</a>
  <a  href="reserva-calendario.html">Agenda</a>
  <a  href="espera.php">Lista</a>
  <a  href="../reserva-fechas.php">Administrar fechas</a>
  <a  class="active">En espera</a>
  <a style="float: right"  href="../reserva-agregar.php">Agregar reserva <img src="../img/plus.png"  alt=""></a>
</div>


  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <img style="width: 50%;
    margin-left: 20%;
    margin-bottom: 20%;"
     src="https://drive.google.com/uc?id=1-fjb7iyB9gtxNTZRqP0e2hTasAszRcE4" alt="">
    <a href="admin.php">• _Reservas</a>
    <a href="clientes.php">_Clientes</a>
    <a href="canchas.php">_Canchas</a>
    <a href="contenido.php">_Contenido</a>
  </div>

  

  <table id="customers">
    <thead align="center">
      <tr>
        <th  class="last_left"><img style="width: 30px" src="../img/barcode.png" alt=""></th>
        <th>Canchas</th>
        <th>Fecha</th>
        <th>Hora inicial</th>
        <th>Hora final</th>
        <th>Cliente</th>

        <th class="last_right">Eliminar</th>
      </tr>

    </thead>


    <tbody align="center">
      <?php for ($i = 0; $i < count($reservas); $i++) { ?>
        <tr>
          <td id="id"><?php echo $reservas[$i]["id"]; ?></td>
          <td ><?php echo $reservas[$i]["canchas"]; ?></td>
          <td class="fecha"><?php echo $reservas[$i]["fecha_inicio"]; ?></td>
          <td class="hour_c" id="fecha_inicio"><?php echo $reservas[$i]["fecha_inicio"]; ?></td>
          <td class="hour_dd" id="fecha_fin"><?php echo $reservas[$i]["fecha_fin"]; ?></td>
          <td class="id_cliente"><?php echo $reservas[$i]["id_cliente"]; ?></td>


          <td class="fecha_creacion"><?php echo $reservas[$i]["eliminar"]; ?></td>
        </tr>
      <?php } ?>

    </tbody>

  </table>

  <!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <span class="close">&times;</span>
  <div></div>
  <p><b>id: </b><span id="id_cliente"></span></p><br>
  <p><b>Nombre: </b><span id="nombre_cliente"></span></p><br>
  <p><b>Celular: </b><span id="celular_cliente"></span></p><br>
  <p><b>Correo: </b><span id="correo_cliente"></span></p><br>
</div>

</div>
</body>
  <script type="text/javascript" src="jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="admin.js" charset="UTF-8"></script>
  <script type="text/javascript" src="constructor.js" charset="UTF-8"></script>
  <script type="text/javascript" src="table.js" charset="UTF-8"></script>
</html>