<?php
include_once("../conexion.php");
$conexion = new conexion();

$q = ($_GET['q']);

$canchasTotalConsulta = "SELECT * FROM cliente WHERE  id = '".$q." )
";


$resultado_mostrar = $conexion->consulta($canchasTotalConsulta);
$canchas = array();
while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dato = $fila[0];
  array_push($canchas, $dato);
  echo $dato;
}

?>