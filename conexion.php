<?php

class conexion{

    function __construct(){

        $this->host = 'localhost';
        $this->user = 'root';
        $this->pass = '';
        $this->base_datos = 'laembajada';
    }
    
    public function consulta($consulta){
            $conexion = mysqli_connect($this->host,$this->user,$this->pass,$this->base_datos);
            $resultado_consulta = mysqli_query($conexion, $consulta);
            $numero = mysqli_affected_rows($conexion);
            $resultado = array('resultado'=>$resultado_consulta,'numero'=>$numero);
            return $resultado;
    }

    public function cerrar_conexion($conexion){
        mysqli_close($conexion);
    }
}

?>
