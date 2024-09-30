<?php

require "modelos\m_coessfe\m_coessfe_sec_registros_y_funciones.php";

class c_coessfe_sec_registros_y_funciones
{
    private $m_coessfe_sec_registros_y_funciones = array();
    private $conexion_coessfe;

    public function __construct(&$conexion_coessfe)
    {
        $this->conexion_coessfe = &$conexion_coessfe;
    }

    public function guardarTablaSecRegistrosYFunciones()
    {

        $select_sec_registros_y_funciones = "SELECT * FROM sec_registros_y_funciones";

        $stmt = $this->conexion_coessfe->query($select_sec_registros_y_funciones);

        $stmt->execute();

        $resultados_sec_registros_y_funciones = $stmt->fetchALL(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($resultados_sec_registros_y_funciones); $i++) {

            $m_coessfe_sec_registros_y_funciones = new m_coessfe_sec_registros_y_funciones
            (
                $resultados_sec_registros_y_funciones[$i]['matricula'],
                $resultados_sec_registros_y_funciones[$i]['renglon'],
                $resultados_sec_registros_y_funciones[$i]['registro'],
                $resultados_sec_registros_y_funciones[$i]['cod_funcion'],
                $resultados_sec_registros_y_funciones[$i]['desde_fecha'],
                $resultados_sec_registros_y_funciones[$i]['hasta_fecha'],
                $resultados_sec_registros_y_funciones[$i]['observaciones'],
                $resultados_sec_registros_y_funciones[$i]['ultimo_registro']
            );

            array_push($this->m_coessfe_sec_registros_y_funciones, $m_coessfe_sec_registros_y_funciones);
        }

        unset($resultados_sec_registros_y_funciones);

    }

    public function &getCoessfeSecRegistrosYFunciones()
    {
        return $this->m_coessfe_sec_registros_y_funciones;
    }

}

?>