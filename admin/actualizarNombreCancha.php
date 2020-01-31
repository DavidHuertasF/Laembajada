<?php
include_once("../conexion.php");


$conexion = new conexion();

$p = ($_GET['p']);
$q = ($_GET['q']);


$canchasTotalConsulta = "UPDATE `cancha` SET `nombre` = '".$q."' WHERE `cancha`.`id` = '".$p."';";

echo $canchasTotalConsulta;
$canchasTotalResultadoConsulta = $conexion->consulta($canchasTotalConsulta);
?>