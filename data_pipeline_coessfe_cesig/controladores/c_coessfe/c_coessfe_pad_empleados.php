<?php

require "modelos\m_coessfe\m_coessfe_pad_empleados.php";

class c_coessfe_pad_empleados{

    private $m_coessfe_pad_empleados = array();
    private $conexion_coessfe;

    public function __construct(&$conexion_coessfe) {
        $this->conexion_coessfe = &$conexion_coessfe;
    }

    public function guardarTablaPadEmpleados(){
        $select_pad_empleados = "SELECT * FROM pad_empleados WHERE id_organizacion = 1  and legajo in (27, 32, 37, 46, 57, 60) order by legajo";

        $stmt = $this->conexion_coessfe->query($select_pad_empleados);
    
        $stmt->execute();

        $resultados_coessfe_pad_empleados = $stmt->fetchALL(PDO::FETCH_ASSOC);

        for ($i=0;$i<count($resultados_coessfe_pad_empleados);$i++) {
                $coessfe_pad_empleados = new m_coessfe_pad_empleados(
                    $resultados_coessfe_pad_empleados[$i]['legajo'],
                    $resultados_coessfe_pad_empleados[$i]['id_organizacion'],
                    $resultados_coessfe_pad_empleados[$i]['apellidos'],
                    $resultados_coessfe_pad_empleados[$i]['nombres'],
                    $resultados_coessfe_pad_empleados[$i]['direccion'],
                    $resultados_coessfe_pad_empleados[$i]['cod_postal_direccion'],
                    $resultados_coessfe_pad_empleados[$i]['sub_cod_postal_direccion'],
                    $resultados_coessfe_pad_empleados[$i]['telefono'],
                    $resultados_coessfe_pad_empleados[$i]['celular'],
                    $resultados_coessfe_pad_empleados[$i]['e_mail'],
                    $resultados_coessfe_pad_empleados[$i]['tipo_documento'],
                    $resultados_coessfe_pad_empleados[$i]['cod_tipo_documento'],
                    $resultados_coessfe_pad_empleados[$i]['nro_documento'],
                    $resultados_coessfe_pad_empleados[$i]['fecha_nacimiento'],
                    $resultados_coessfe_pad_empleados[$i]['cod_postal_lugar_nacimiento'],
                    $resultados_coessfe_pad_empleados[$i]['sub_cod_postal_lugar_nac'],
                    $resultados_coessfe_pad_empleados[$i]['nacionalidad'],
                    $resultados_coessfe_pad_empleados[$i]['estado_civil'],
                    $resultados_coessfe_pad_empleados[$i]['id_estado_civil'],
                    $resultados_coessfe_pad_empleados[$i]['sexo'],
                    $resultados_coessfe_pad_empleados[$i]['id_sexo'],
                    $resultados_coessfe_pad_empleados[$i]['titulo'],
                    $resultados_coessfe_pad_empleados[$i]['seccion'],
                    $resultados_coessfe_pad_empleados[$i]['categoria'],
                    $resultados_coessfe_pad_empleados[$i]['cod_categoria_utedyc'],
                    $resultados_coessfe_pad_empleados[$i]['fecha_ingreso'],
                    $resultados_coessfe_pad_empleados[$i]['cuil'],
                    $resultados_coessfe_pad_empleados[$i]['caja_jub'],
                    $resultados_coessfe_pad_empleados[$i]['obra_social'],
                    $resultados_coessfe_pad_empleados[$i]['contrasena'],
                    $resultados_coessfe_pad_empleados[$i]['fecha_ult_cambio_categoria'],
                    $resultados_coessfe_pad_empleados[$i]['cod_lugar_cobro'],
                    $resultados_coessfe_pad_empleados[$i]['caja_de_ahorro'],
                    $resultados_coessfe_pad_empleados[$i]['legajo_nuevo']
            );
        
            array_push($this->m_coessfe_pad_empleados,$coessfe_pad_empleados);

        }

        unset($resultados_coessfe_pad_empleados);

    }

    public function &getCCoessfePadEmpleados(){
        return $this->m_coessfe_pad_empleados;
    }

}

?>