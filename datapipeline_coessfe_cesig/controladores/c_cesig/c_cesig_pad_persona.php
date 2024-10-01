<?php

require "modelos\m_cesig\m_cesig_pad_persona.php";

class c_cesig_pad_persona
{
    private $m_cesig_pad_persona = array();
    private $conexion_cesig;

    public function __construct(&$conexion_cesig)
    {
        $this->conexion_cesig = &$conexion_cesig;
    }

    public function guardarTablaPadPersona()
    {

        $select_pad_persona = "SELECT * FROM pad_persona";

        $stmt = $this->conexion_cesig->query($select_pad_persona);

        $stmt->execute();

        $resultados_pad_persona = $stmt->fetchALL(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($resultados_pad_persona); $i++) {

            $m_cesig_pad_persona = new m_cesig_pad_persona
            (
                $resultados_pad_persona[$i]['id'],
                $resultados_pad_persona[$i]['creationtimestamp'],
                $resultados_pad_persona[$i]['creationuser'],
                $resultados_pad_persona[$i]['deleted'],
                $resultados_pad_persona[$i]['modificationtimestamp'],
                $resultados_pad_persona[$i]['modificationuser'],
                $resultados_pad_persona[$i]['versionnumber'],
                $resultados_pad_persona[$i]['apellido1'],
                $resultados_pad_persona[$i]['apellido2'],
                $resultados_pad_persona[$i]['cuit'],
                $resultados_pad_persona[$i]['mailoficial'],
                $resultados_pad_persona[$i]['nombre1'],
                $resultados_pad_persona[$i]['nombre2'],
                $resultados_pad_persona[$i]['nombre3'],
                $resultados_pad_persona[$i]['razonsocial'],
                $resultados_pad_persona[$i]['sexo'],
                $resultados_pad_persona[$i]['apellidonombreconyuge'],
                $resultados_pad_persona[$i]['localidadnacimiento'],
                $resultados_pad_persona[$i]['idpaisnacimiento'],
                $resultados_pad_persona[$i]['fechanacimiento'],
                $resultados_pad_persona[$i]['idtipodoc'],
                $resultados_pad_persona[$i]['numerodocumento'],
                $resultados_pad_persona[$i]['idestadocivil'],
                $resultados_pad_persona[$i]['ingresosbrutos'],
                $resultados_pad_persona[$i]['idcondicioniva']
            );

            array_push($this->m_cesig_pad_persona, $m_cesig_pad_persona);
        }

    }

    public function &getCesigPadPersona()
    {
        return $this->m_cesig_pad_persona;
    }

}

?>