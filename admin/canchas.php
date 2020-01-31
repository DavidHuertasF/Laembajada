<?php
include_once("../conexion.php");
$conexion = new conexion();

date_default_timezone_set('America/Caracas');
$fecha_actual = date("Y-m-d H:i:s");


if (isset($_GET["eliminar"])) {
  $consulta_eliminar = "DELETE FROM cancha WHERE id = '".$_GET["eliminar"]."' ";
  $resultado_eliminar = $conexion->consulta($consulta_eliminar);

  echo("<script type='text/javascript'>window.location.href='canchas.php';</script>");
}

// Si se registra un usuario
if(isset($_POST["enviar"])){
  $consulta = "INSERT INTO `cancha` 
  VALUES (NULL,'".$_POST["nombre"]."')";
  $resultado = $conexion->consulta($consulta);
  echo("<script type='text/javascript'>window.location.href='canchas.php';</script>");
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


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="admin.css" />
  <link rel="stylesheet" href="table.css" />

  <title>Canchas</title>
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
        <th class="last_right">Eliminar</th>
      </tr>

    </thead>


    <tbody align="center">
      <?php for ($i = 0; $i < count($canchas); $i++) { ?>
        <tr>
          <td><?php echo $canchas[$i]["id"]; ?></td>
          <td> <textarea id="<?php echo $canchas[$i]["id"]; ?>_nombre-cancha" name="" id="" cols="20" rows="1"> <?php echo $canchas[$i]["nombre"]; ?></textarea>  <img style="margin-left: 10px; cursor:pointer;"  src="../img/save.png" onclick="actualizarCancha(<?php echo $canchas[$i]["id"];?>);"></td>
          <td class="fecha_creacion"><img  id="eliminar_btn" src="../img/delete.png" style="cursor: pointer;"  onclick="eliminarCancha(<?php echo $canchas[$i]["id"]; ?>);"></td>
        </tr>
      <?php } ?>

    </tbody>

  </table>

  <form style="margin: 60px;box-shadow: 0px 1px 15px 6px rgba(0, 0, 0, 0.16);width: 200px;padding: 30px;" action="canchas.php" method="POST">
				<h2>Nueva cancha</h2>
				<input type="text" class="form-control" name="nombre" placeholder="nombre"> <br>
				<button class="btn btn-info " name="enviar" style="
    background: #333333;
    color: white;
    /* margin-left: 5%; */
    padding: 8px;
    cursor: pointer;
    width: 100px;
    text-decoration: none !important;
    border-radius: 10px;
"><strong>Registrar</strong></button>
			</form>
</body>
  <script type="text/javascript" src="jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="admin.js" charset="UTF-8"></script>
  <script type="text/javascript" src="constructor.js" charset="UTF-8"></script>
  <script type="text/javascript" src="table.js" charset="UTF-8"></script>
</html>