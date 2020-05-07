<?php
include_once("../../conexion.php");
$conexion = new conexion();

$q = ($_GET['q']);

$canchasTotalConsulta = "INSERT INTO `cierre` (`id`, `fecha`) VALUES (NULL, '".$q."');";

$canchasTotalResultadoConsulta = $conexion->consulta($canchasTotalConsulta);

?>