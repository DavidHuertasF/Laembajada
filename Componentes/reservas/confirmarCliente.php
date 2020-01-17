<?php
include_once("../../conexion.php");
$conexion = new conexion();

$p = ($_GET['p']);
$q = ($_GET['q']);
$c = ($_GET['c']);

$canchasTotalConsulta = "INSERT INTO `cliente` (`id`, `nombre`, `celular`, `correo`) VALUES (NULL, '".$p."', '".$q."', '".$c."');";

$canchasTotalResultadoConsulta = $conexion->consulta($canchasTotalConsulta);

?>