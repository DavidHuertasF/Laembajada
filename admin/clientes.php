<?php
include_once("../conexion.php");
$conexion = new conexion();

date_default_timezone_set('America/Caracas');
$fecha_actual = date("Y-m-d H:i:s");


if (isset($_GET["eliminar"])) {
  $consulta_eliminar = "DELETE FROM cliente WHERE id = '".$_GET["eliminar"]."' ";
  $resultado_eliminar = $conexion->consulta($consulta_eliminar);

  echo("<script type='text/javascript'>window.location.href='clientes.php';</script>");
}





$mostrar_clientes = "select * from cliente";
$resultado_mostrar = $conexion->consulta($mostrar_clientes);
$dato = array();
$clientes = array();
while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dato["id"] = $fila[0];
  $dato["nombre"] = $fila[1];
  $dato["celular"] = $fila[2];
  $dato["correo"] = $fila[3];
  array_push($clientes, $dato);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="admin.css" />
  <link rel="stylesheet" href="table.css" />

  <title>Clientes</title>
</head>

<body>

<div class="topnav">
  <a onclick="openNav()" href="#home">&#9776;</a>
 
</div>


  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <img style="width: 50%;
    margin-left: 20%;
    margin-bottom: 20%;"
     src="https://drive.google.com/uc?id=1-fjb7iyB9gtxNTZRqP0e2hTasAszRcE4" alt="">
     <a href="admin.php">Reservas</a>
    <a href="clientes.php">Clientes</a>
    <a href="canchas.php">Canchas</a>
    <a href="contenido.php">Contenido</a>
  </div>

  <table id="customers">
    <thead align="center">
      <tr>
        <th  class="last_left"><img style="width: 30px" src="../img/barcode.png" alt=""></th>
        <th>Nombre</th>
        <th>Celular</th>
         <th>Correo</th>
        <th class="last_right">Eliminar</th>
      </tr>

    </thead>


    <tbody align="center">
      <?php for ($i = 0; $i < count($clientes); $i++) { ?>
        <tr>
          <td><?php echo $clientes[$i]["id"]; ?></td>
          <td>  <?php echo $clientes[$i]["nombre"]; ?></td>
          <td>  <?php echo $clientes[$i]["celular"]; ?></td>
          <td>  <?php echo $clientes[$i]["correo"]; ?></td>
          <td class="fecha_creacion"><img  id="eliminar_btn" src="../img/delete.png" style="cursor: pointer;"  onclick="eliminarCliente(<?php echo $clientes[$i]["id"]; ?>);"></td>
        </tr>
      <?php } ?>

    </tbody>

  </table>

</body>
  <script type="text/javascript" src="jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="admin.js" charset="UTF-8"></script>
  <script type="text/javascript" src="constructor.js" charset="UTF-8"></script>
  <script type="text/javascript" src="table.js" charset="UTF-8"></script>
</html>