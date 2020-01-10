<?php
include_once("conexion.php");
$conexion = new conexion();

$q = ($_GET['q']);

$canchasTotalConsulta = "SELECT count(*) FROM reserva WHERE '".$q."' >= `fecha_inicio` AND '".$q." ' <= `fecha_fin`";

$canchasTotalResultadoConsulta = $conexion->consulta($canchasTotalConsulta);
$fila = mysqli_fetch_row($canchasTotalResultadoConsulta["resultado"]);
$canchasTotal =  $fila[0];

echo $canchasTotal;

?>