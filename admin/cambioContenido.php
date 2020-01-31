<?php
include_once("../conexion.php");


$conexion = new conexion();

$p = ($_GET['p']);
$q = ($_GET['q']);
$r = ($_GET['r']);


$canchasTotalConsulta = "UPDATE `textos` SET `contenido_es` = '".$q."' , `contenido_en` = '".$r."' WHERE `textos`.`id` = '".$p."';";

echo($canchasTotalConsulta);
$canchasTotalResultadoConsulta = $conexion->consulta($canchasTotalConsulta);
?>