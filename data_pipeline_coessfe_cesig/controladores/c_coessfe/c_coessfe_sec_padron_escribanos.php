<?php

require "modelos\m_coessfe\m_coessfe_sec_padron_escribanos.php";

class c_coessfe_sec_padron_escribanos {
    private $m_coessfe_sec_padron_escribanos = array();
    private $conexion_coessfe;

    public function __construct(&$conexion_coessfe) {
        $this->conexion_coessfe = &$conexion_coessfe;
    }

    public function guardarTablaSecPadronescribanos(){
        $select_sec_padron_escribanos = "SELECT *
        FROM sec_padron_escribanos";

        $stmt = $this->conexion_coessfe->query($select_sec_padron_escribanos);
    
        $stmt->execute();
    
        $resultados_sec_padron_escribanos = $stmt->fetchALL(PDO::FETCH_ASSOC);
    
        for($i=0;$i<count($resultados_sec_padron_escribanos);$i++){
    
            $coessfe_sec_padron_escribanos = new m_coessfe_sec_padron_escribanos
            (
                $resultados_sec_padron_escribanos[$i]['matricula'],
                $resultados_sec_padron_escribanos[$i]['apellido1'],
                $resultados_sec_padron_escribanos[$i]['apellido2'],
                $resultados_sec_padron_escribanos[$i]['nombre1'],
                $resultados_sec_padron_escribanos[$i]['nombre2'],
                $resultados_sec_padron_escribanos[$i]['nombre3'],
                $resultados_sec_padron_escribanos[$i]['sexo'],
                $resultados_sec_padron_escribanos[$i]['apellido_de_casada'],
                $resultados_sec_padron_escribanos[$i]['cod_titulo'],
                $resultados_sec_padron_escribanos[$i]['fecha_titulo'],
                $resultados_sec_padron_escribanos[$i]['expedido'],
                $resultados_sec_padron_escribanos[$i]['fecha_matricula'],
                $resultados_sec_padron_escribanos[$i]['nacido_en'],
                $resultados_sec_padron_escribanos[$i]['fecha_nacimiento'],
                $resultados_sec_padron_escribanos[$i]['cod_tipo_doc'],
                $resultados_sec_padron_escribanos[$i]['nro_documento'],
                $resultados_sec_padron_escribanos[$i]['telefono'],
                $resultados_sec_padron_escribanos[$i]['fax'],
                $resultados_sec_padron_escribanos[$i]['e_mail'],
                $resultados_sec_padron_escribanos[$i]['cuit'],
                $resultados_sec_padron_escribanos[$i]['cod_iva'],
                $resultados_sec_padron_escribanos[$i]['credencial'],
                $resultados_sec_padron_escribanos[$i]['baja'],
                $resultados_sec_padron_escribanos[$i]['causa_baja'],
                $resultados_sec_padron_escribanos[$i]['fecha_baja'],
                $resultados_sec_padron_escribanos[$i]['sir'],
                $resultados_sec_padron_escribanos[$i]['fecha_sir'],
                $resultados_sec_padron_escribanos[$i]['nro_inscripcion_sir'],
                $resultados_sec_padron_escribanos[$i]['observaciones'],
                $resultados_sec_padron_escribanos[$i]['cod_causa_baja'],
                $resultados_sec_padron_escribanos[$i]['enviar_a_id'],
                $resultados_sec_padron_escribanos[$i]['e_mail2'],
                $resultados_sec_padron_escribanos[$i]['es_legalizador']
            );
    
            array_push($this->m_coessfe_sec_padron_escribanos,$coessfe_sec_padron_escribanos);

        }
    
        unset($resultados_sec_padron_escribanos);
    }

    public function &getCCoessfeSecPadronescribanos(){
        return $this->m_coessfe_sec_padron_escribanos;
    }

}