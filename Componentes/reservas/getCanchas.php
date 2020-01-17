<?php
include_once("../../conexion.php");
$conexion = new conexion();

$q = ($_GET['q']);
$p = ($_GET['p']);



$canchasTotalConsulta = "SELECT `id_cancha` FROM reserva WHERE 
NOT('".$q."' < `fecha_inicio` AND '".$p." ' <= `fecha_inicio`) AND 
NOT('".$q."' >= `fecha_fin` AND '".$p." ' > `fecha_fin`)
";


$resultado_mostrar = $conexion->consulta($canchasTotalConsulta);
$canchas = array();
while ($fila = mysqli_fetch_row($resultado_mostrar["resultado"])) {
  $dato = $fila[0];
  array_push($canchas, $dato);
  echo $dato.", ";
}

?>