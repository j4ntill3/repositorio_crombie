<?php

require "modelos\m_coessfe\m_coessfe_sec_antecedentes_o_sanciones.php";

class c_coessfe_sec_antecedentes_o_sanciones {
    private $m_coessfe_sec_antecedentes_o_sanciones = array();
    private $conexion_coessfe;

    public function __construct(&$conexion_coessfe) {
        $this->conexion_coessfe = &$conexion_coessfe;
    }

    public function guardarTablaSecAntecedentesOSanciones(){
        
        $select_sec_antecedentes_o_sanciones = "SELECT * FROM sec_antecedentes_o_sanciones";

        $stmt = $this->conexion_coessfe->query($select_sec_antecedentes_o_sanciones);
    
        $stmt->execute();
    
        $resultados_sec_antecedentes_o_sanciones = $stmt->fetchALL(PDO::FETCH_ASSOC);
    
        for($i=0;$i<count($resultados_sec_antecedentes_o_sanciones);$i++){
    
            $m_coessfe_sec_antecedentes_o_sanciones = new m_coessfe_sec_antecedentes_o_sanciones
            (
                $resultados_sec_antecedentes_o_sanciones[$i]['id'],
                $resultados_sec_antecedentes_o_sanciones[$i]['renglon'],
                $resultados_sec_antecedentes_o_sanciones[$i]['matricula'],
                $resultados_sec_antecedentes_o_sanciones[$i]['registro'],
                $resultados_sec_antecedentes_o_sanciones[$i]['cod_tipo_sancion'],
                $resultados_sec_antecedentes_o_sanciones[$i]['desde_fecha'],
                $resultados_sec_antecedentes_o_sanciones[$i]['hasta_fecha'],
                $resultados_sec_antecedentes_o_sanciones[$i]['fecha_levanta_sancion'],
                $resultados_sec_antecedentes_o_sanciones[$i]['observaciones']
            );
    
            array_push($this->m_coessfe_sec_antecedentes_o_sanciones,$m_coessfe_sec_antecedentes_o_sanciones);

        }
    
        unset($resultados_sec_antecedentos_o_sanciones);

    }

    public function &getCoessfeSecAntecedentesOSanciones(){
        return $this->m_coessfe_sec_antecedentes_o_sanciones;
    }

}

?>