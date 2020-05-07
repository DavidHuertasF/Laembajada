<?php
include_once("../../conexion.php");
$conexion = new conexion();

$p = ($_GET['p']);
$cc = ($_GET['cc']);
$qk = ($_GET['qk']);
$can = ($_GET['can']);

    $canchasTotalConsulta = "INSERT INTO `espera` (`numero_canchas`,`comentarios`, `id`, `fecha_inicio`, `fecha_fin`, `cliente_id`  ) VALUES ('".$can."','".$qk."',NULL, '".$p."', '".$cc."', (SELECT MAX(id) FROM cliente));";

    $canchasTotalResultadoConsulta = $conexion->consulta($canchasTotalConsulta);
    
 echo $canchasTotalConsulta;

?>