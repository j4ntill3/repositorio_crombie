<?php

require "modelos\m_cesig\m_cesig_pad_escribanosancion.php";

class c_cesig_pad_escribanosancion
{
    private $m_coessfe_sec_antecedentes_o_sanciones;
    private $conexion_coessfe;
    private $conexion_cesig;

    public function __construct(&$m_coessfe_sec_antecedentes_o_sanciones, &$conexion_coessfe, &$conexion_cesig)
    {
        $this->m_coessfe_sec_antecedentes_o_sanciones = &$m_coessfe_sec_antecedentes_o_sanciones;
        $this->conexion_cesig = &$conexion_cesig;
        $this->conexion_coessfe = &$conexion_coessfe;
    }

    public function analizarSancionesEscribanos()
    {

        echo ("=> INICIO PROCESO CARGA/ACTUALIZACIÓN DE SANCIONES DE ESCRIBANOS TABLA pad_escribanosancion" . PHP_EOL . PHP_EOL);

        for ($i = 0; $i < count($this->m_coessfe_sec_antecedentes_o_sanciones); $i++) {

            echo (' => ANALIZANDO SANCIÓN ID ' . $this->m_coessfe_sec_antecedentes_o_sanciones[$i]->getId());

            try {

                // Se selecciona la sancion segun su matricula de la tabla pad_escribanosancion
                $select_pad_escribanosancion = "SELECT * FROM pad_escribanosancion WHERE id = :id LIMIT 1";
                $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribanosancion);
                $stmt_cesig->bindValue(':id', $this->m_coessfe_sec_antecedentes_o_sanciones[$i]->getId(), PDO::PARAM_STR);
                $stmt_cesig->execute();
                $registro_cesig_pad_escribanosancion = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                // Comprobamos si la consulta arrojo resultados
                if ($stmt_cesig->rowCount() > 0) {
                    echo (' => LA SANCION SE ENCUENTRA CARGADA EN CESIG' . PHP_EOL . PHP_EOL);

                    $this->actualizarSancionEscribano($registro_cesig_pad_escribanosancion,$this->m_coessfe_sec_antecedentes_o_sanciones[$i]);

                } else {

                    // Si la consulta no arroja resultados significa que el empleado no esta cargado en cesig, se procede cargarlo
                    // Llamo a la funcion que carga los registros en las tablas pertinentes

                    echo (' => LA SANCIÓN NO SE ENCUENTRA CARGADA EN CESIG' . PHP_EOL . PHP_EOL);

                    $this->cargarSancionEscribano($this->m_coessfe_sec_antecedentes_o_sanciones[$i]);

                }
            } catch (PDOException $e) {
                // Capturamos cualquier excepcion que pueda ocurrir durante la ejecucion de las consultas
                echo " => Error en la consulta: " . $e->getMessage() . PHP_EOL . PHP_EOL;
            }
        }
        echo("=> FIN PROCESO CARGA/ACTUALIZACIÓN DE SANCIONES DE ESCRIBANOS");
    }

    private function cargarSancionEscribano($registro_coessfe)
    {
        echo ('     => CARGANDO SANCIÓN');

        $select_escribano = "SELECT * FROM pad_escribano WHERE matricula = :matricula LIMIT 1";
        $stmt_cesig = $this->conexion_cesig->prepare($select_escribano);
        $stmt_cesig->bindValue(":matricula", $registro_coessfe->getMatricula(), PDO::PARAM_STR);
        $stmt_cesig->execute();
        $registro_escribano = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

        if (isset($registro_escribano['id']) && $registro_escribano['id'] != NULL && $registro_escribano['id'] != '') {

            $idescribano = $registro_escribano['id'];

            if ($registro_coessfe->getCodTipoSancion() == '1') {
                $idtiposancion = 2;
            }
            if ($registro_coessfe->getCodTipoSancion() == '2') {
                $idtiposancion = 6;
            }
            if ($registro_coessfe->getCodTipoSancion() == '4') {
                $idtiposancion = 7;
            }
            if ($registro_coessfe->getCodTipoSancion() == '5') {
                $idtiposancion = 4;
            }

            $fechadesde = $registro_coessfe->getDesdeFecha();
            $fechahasta = $registro_coessfe->getHastaFecha();

            $esactiva = null;

            // Fecha actual
            $fecha_actual = date('Y-m-d');

            if ($fecha_actual <= $fechahasta) {
                $esactiva = 1;
            } else {
                $esactiva = 0;
            }


            $insert_pad_escribanosancion = "INSERT INTO pad_escribanosancion(id, idescribano, idtiposancion, idsubtiposancion, fechadesde, fechahasta, fechalevanta, numerointerno, idtipoexpediente, numeroexpediente, observacion, esactiva, creationtimestamp, creationuser, modificationtimestamp, modificationuser, versionnumber, deleted)
            VALUES(:id, :idescribano, :idtiposancion, 0, :fechadesde, :fechahasta, NULL, 0, NULL, NULL, NULL, :esactiva, NOW(), 'dummyuser', NOW(), 'dummyuser', 0, FALSE)";
            $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_escribanosancion);
            $stmt_cesig->bindValue(":id", $registro_coessfe->getId(), PDO::PARAM_STR);
            $stmt_cesig->bindValue(":idescribano", $idescribano, PDO::PARAM_STR);
            $stmt_cesig->bindValue(":idtiposancion", $idtiposancion, PDO::PARAM_STR);
            $stmt_cesig->bindValue(":fechadesde", $fechadesde, PDO::PARAM_STR);
            $stmt_cesig->bindValue(":fechahasta", $fechahasta, PDO::PARAM_STR);
            $stmt_cesig->bindValue(":esactiva", $esactiva, PDO::PARAM_STR);
            $stmt_cesig->execute();

            echo " => SANCION CARGADA CON EXITO";

            $select_pad_escribanosancion = "SELECT * FROM pad_escribanosancion WHERE id = :id";
            $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribanosancion);
            $stmt_cesig->bindValue(":id", $registro_coessfe->getId(), PDO::PARAM_STR);
            $stmt_cesig->execute();
            $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

            echo (" => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL);

            foreach ($resultados as $fila) {
                foreach ($fila as $nombre_columna => $valor) {
                    echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
                }
            }

        } else {
            echo "Sanción no apta para insertar en CESIG. " . PHP_EOL . PHP_EOL;
        }

    }

    private function actualizarSancionEscribano($registro_cesig, $registro_coessfe)
    {
        echo ('    => ANALIZANDO TABLA pad_escribanolicencia');

        $datos_a_actualizar = array();
        $columnas_a_actualizar = array();

        // Comparo desdefecha
        if ($registro_cesig['fechadesde'] != $registro_coessfe->getDesdeFecha()) {
            array_push($datos_a_actualizar, array($registro_cesig['fechadesde'], $registro_coessfe->getDesdeFecha()));
            array_push($columnas_a_actualizar, 'fechadesde');
        }

        // Comparo fechahasta
        if ($registro_cesig['fechahasta'] != $registro_coessfe->getHastaFecha()) {
            array_push($datos_a_actualizar, array($registro_cesig['fechahasta'], $registro_coessfe->getHastaFecha()));
            array_push($columnas_a_actualizar, 'fechahasta');
        }

        if ($registro_cesig['esactiva'] != FALSE) {

            // Fecha actual
            $fecha_actual = "2024-03-08";

            if ($fecha_actual >= $registro_cesig['fechahasta']) {
                array_push($datos_a_actualizar, array($registro_cesig['esactiva'], 0));
                array_push($columnas_a_actualizar, 'esactiva');
            }

        }

        // Si se encontraron diferencias se realiza un UPDATE para actualizar los cambios
        if (count($datos_a_actualizar) != 0) {
            // Genero la sentencia para actualizar los datos que se modificaron

            $insert_pad_escribanolicencia = "UPDATE pad_escribanolicencia SET ";

            echo (" => DATOS A ACTUALIZAR: " . PHP_EOL . PHP_EOL);

            for ($i = 0; $i < count($datos_a_actualizar); $i++) {

                $insert_pad_escribanolicencia = $insert_pad_escribanolicencia . $columnas_a_actualizar[$i] . " = '" . $datos_a_actualizar[$i][1] . "',";

                echo ("        -> " . $columnas_a_actualizar[$i] . " -> valor actual = " . $datos_a_actualizar[$i][0] . " -> valor nuevo = " . $datos_a_actualizar[$i][1] . PHP_EOL . PHP_EOL);

            }

            $insert_pad_escribanolicencia = substr($insert_pad_escribanolicencia, 0, -1);

            $insert_pad_escribanolicencia = $insert_pad_escribanolicencia . " WHERE id = '" . $registro_coessfe->getId() . "'";

            $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_escribanolicencia);

            $stmt_cesig->execute();

            echo "    => TABLA pad_escribanolicencia ACTUALIZADA CON EXITO " . PHP_EOL . PHP_EOL;
        } else {
            echo (' => NO SE ENCONTRARON CAMBIOS' . PHP_EOL . PHP_EOL);
        }

    }

}

?>