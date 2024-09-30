<?php

require "modelos\m_coessfe\m_coessfe_sec_licencias.php";

class c_coessfe_sec_licencias
{
    private $m_coessfe_sec_licencias = array();
    private $conexion_coessfe;

    public function __construct(&$conexion_coessfe)
    {
        $this->conexion_coessfe = &$conexion_coessfe;
    }

    public function guardarTablaSecLicencias()
    {

        $select_sec_licencias = "SELECT * FROM sec_licencias";

        $stmt = $this->conexion_coessfe->query($select_sec_licencias);

        $stmt->execute();

        $resultados_sec_licencias = $stmt->fetchALL(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($resultados_sec_licencias); $i++) {

            $m_coessfe_sec_licencias = new m_coessfe_sec_licencias
            (
                $resultados_sec_licencias[$i]['cod_licencia'],
                $resultados_sec_licencias[$i]['matricula_escr_licencia'],
                $resultados_sec_licencias[$i]['desde_fecha'],
                $resultados_sec_licencias[$i]['hasta_fecha'],
                $resultados_sec_licencias[$i]['matricula_reg_interino'],
                $resultados_sec_licencias[$i]['operador'],
                $resultados_sec_licencias[$i]['fecha_carga']
            );

            array_push($this->m_coessfe_sec_licencias, $m_coessfe_sec_licencias);
        }

        unset($resultados_sec_licencias);

    }

    public function &getCoessfeSecLicencias()
    {
        return $this->m_coessfe_sec_licencias;
    }

}

?>