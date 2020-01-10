<?php
include_once("conexion.php");
$host = "localhost";
$user = "root";
$pass = "";
$base_datos = "laembajada";
$conexion = new conexion($host, $user, $pass, $base_datos);


$q = ($_GET['q']);


$canchasTotalConsulta = "SELECT count(*) FROM reserva WHERE '".$q."' >= `fecha_inicio` AND '".$q." ' <= `fecha_fin`";



$canchasTotalResultadoConsulta = $conexion->consulta($canchasTotalConsulta);
$fila = mysqli_fetch_row($canchasTotalResultadoConsulta["resultado"]);
$canchasTotal =  $fila[0];

echo $canchasTotal;

?>