<?php
include_once("../../conexion.php");
$conexion = new conexion();

$p = ($_GET['p']);
$q = ($_GET['q']);
$c = ($_GET['c']);

$canchasTotalConsulta = "INSERT INTO `reserva` (`id`, `fecha_inicio`, `fecha_fin`, `id_cliente`, `id_cancha`, `fecha_creacion`) VALUES (NULL, '".$p."', '".$q."', (SELECT MAX(id) FROM cliente),'".$c."',NOW());";


$canchasTotalResultadoConsulta = $conexion->consulta($canchasTotalConsulta);


?>