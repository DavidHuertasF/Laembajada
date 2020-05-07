<?php
include_once("../conexion.php");
$conexion = new conexion();



// Trae los textos para mostrarlos 
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

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="admin.css" />
  <link rel="stylesheet" href="table.css" />

  <title>Contenido</title>
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
     <a href="admin.php">_Reservas</a>
    <a href="clientes.php">_Clientes</a>
    <a href="canchas.php">_Canchas</a>
    <a href="contenido.php">•_Contenido</a>
  </div>
<a href="https://drive.google.com/drive/folders/10axxJYRBTsGaTyJHJ124nUp-k0-KyhUO?usp=sharing">
  <p style="
    width: fit-content;
    background: #333333;
    color: white;
    margin-left: 5%;
    padding: 14px;
    cursor:pointer;
    text-decoration: none !important;
    border-radius: 10px;
    box-shadow: 0px 1px 15px 6px rgba(0, 0, 0, 0.16);
">Contenido multimedia  <img src="../img/drive.png" alt="" style="
    margin-top: -2px;
    vertical-align: middle;
"></p>
</a>

  <table id="customerss">
    <thead align="center">
      <tr>
        <th>Campo</th>
        <th>Español</th>
        <th>Inglés</th>
        <th>Guardar cambios</th>
      </tr>

    </thead>


    <tbody align="center">
      <?php for ($i = 0; $i < count($textos); $i++) { ?>
        <tr>
          <td class="campo"><?php echo $textos[$i]["nombre"]; ?></td>
          <td class="id_cliente"> 
            <textarea id="<?php echo $textos[$i]["id"];?>_es" rows="4" cols="50">
              <?php echo $textos[$i]["contenido_es"]; ?>
            </textarea>  </td>
          <td class="id_cancha">
           <textarea id="<?php echo $textos[$i]["id"];?>_en"  rows="4" cols="50">
              <?php echo $textos[$i]["contenido_en"]; ?>
            </textarea>  </td>
          </td>
          <td class="fecha_creacion">
         
            <img style="
              cursor:pointer;
            " 
            src="../img/save.png" onclick="cambio(<?php echo $textos[$i]["id"];?>);"></img>
          </td>
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