<?php

require "modelos\m_coessfe\m_coessfe_sec_domicilios.php";

class c_coessfe_sec_domicilios
{
    private $m_coessfe_sec_domicilios = array();
    private $conexion_coessfe;

    public function __construct(&$conexion_coessfe)
    {
        $this->conexion_coessfe = &$conexion_coessfe;
    }

    public function guardarTablaSecDomicilios()
    {

        $select_sec_domicilios = "SELECT * FROM sec_domicilios";

        $stmt = $this->conexion_coessfe->query($select_sec_domicilios);

        $stmt->execute();

        $resultados_sec_domicilios = $stmt->fetchALL(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($resultados_sec_domicilios); $i++) {

            $m_coessfe_sec_domicilios = new m_coessfe_sec_domicilios
            (
                $resultados_sec_domicilios[$i]['matricula'],
                $resultados_sec_domicilios[$i]['renglon'],
                $resultados_sec_domicilios[$i]['fecha'],
                $resultados_sec_domicilios[$i]['hasta_fecha'],
                $resultados_sec_domicilios[$i]['domicilio'],
                $resultados_sec_domicilios[$i]['cod_postal'],
                $resultados_sec_domicilios[$i]['sub_cod_postal'],
                $resultados_sec_domicilios[$i]['ultimo_domicilio']
            );

            array_push($this->m_coessfe_sec_domicilios, $m_coessfe_sec_domicilios);
        }

        unset($resultados_sec_licencias);

    }

    public function &getCoessfeSecDomicilios()
    {
        return $this->m_coessfe_sec_domicilios;
    }

}

?>