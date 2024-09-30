<?php

require "modelos\m_cesig\m_cesig_pad_escribanolicencia.php";

class c_cesig_pad_escribanolicencia
{
    private $m_coessfe_sec_licencias;
    private $conexion_coessfe;
    private $conexion_cesig;

    public function __construct(&$m_coessfe_sec_licencias, &$conexion_coessfe, &$conexion_cesig)
    {
        $this->m_coessfe_sec_licencias = &$m_coessfe_sec_licencias;
        $this->conexion_cesig = &$conexion_cesig;
        $this->conexion_coessfe = &$conexion_coessfe;
    }

    public function analizarLicenciasEscribanos()
    {

        echo ("=> INICIO PROCESO CARGA/ACTUALIZACIÓN DE LICENCIAS DE ESCRIBANOS TABLA pad_escribanolicencia" . PHP_EOL . PHP_EOL);

        for ($i = 0; $i < count($this->m_coessfe_sec_licencias); $i++) {

            echo (' => ANALIZANDO LICENCIA ID  ' . $this->m_coessfe_sec_licencias[$i]->getCodLicencia());

            try {

                // Se selecciona la licencia segun su matricula de la tabla pad_escribano
                $select_pad_escribano = "SELECT * FROM pad_escribanolicencia WHERE id = :id LIMIT 1";
                $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribano);
                $stmt_cesig->bindValue(':id', $this->m_coessfe_sec_licencias[$i]->getCodLicencia(), PDO::PARAM_STR);
                $stmt_cesig->execute();
                $registro_cesig_pad_escribano = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                // Comprobamos si la consulta arrojo resultados
                if ($stmt_cesig->rowCount() > 0) {
                    echo (' => LA LICENCIA SE ENCUENTRA CARGADA EN CESIG' . PHP_EOL . PHP_EOL);

                    $this->actualizarLicenciaEscribano($registro_cesig_pad_escribano, $this->m_coessfe_sec_licencias[$i]);

                } else {

                    // Si la consulta no arroja resultados significa que el empleado no esta cargado en cesig, se procede cargarlo
                    // Llamo a la funcion que carga los registros en las tablas pertinentes

                    echo (' => LA LICENCIA NO SE ENCUENTRA CARGADA EN CESIG');

                    $this->cargarLicenciaEscribano($this->m_coessfe_sec_licencias[$i]);

                }
            } catch (PDOException $e) {
                // Capturamos cualquier excepcion que pueda ocurrir durante la ejecucion de las consultas
                echo " => Error en la consulta: " . $e->getMessage() . PHP_EOL . PHP_EOL;
            }
        }
        echo ("=> FIN PROCESO CARGA/ACTUALIZACIÓN DE LICENCIAS DE ESCRIBANOS" . PHP_EOL . PHP_EOL);
    }

    private function cargarLicenciaEscribano($registro_coessfe)
    {

        echo (' => CARGANDO LICENCIA');

        // Select escribano
        $select = "SELECT * FROM pad_escribano WHERE matricula = :matricula LIMIT 1";
        $stmt_cesig = $this->conexion_cesig->prepare($select);
        $stmt_cesig->bindValue(':matricula', $registro_coessfe->getMatriculaEscrLicencia(), PDO::PARAM_STR);
        $stmt_cesig->execute();
        $escribano_licencia = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

        // Select escribano REGENTE
        $select = "SELECT * FROM pad_escribano WHERE matricula = :matricula LIMIT 1";
        $stmt_cesig = $this->conexion_cesig->prepare($select);
        $stmt_cesig->bindValue(':matricula', $registro_coessfe->getMatriculaRegInterino(), PDO::PARAM_STR);
        $stmt_cesig->execute();
        $escribano_regente_licencia = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

        if (isset($escribano_licencia['id']) and isset($escribano_regente_licencia['id'])) {

            $idescribano = $escribano_licencia['id'];

            $idescribanoregente = $escribano_regente_licencia['id'];

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

            $insert_pad_escribanolicencia = "INSERT INTO public.pad_escribanolicencia(id, idescribano, idescribanoregente, fechadesde, fechahasta, fechalevanta, esactiva, creationtimestamp, creationuser, modificationtimestamp,modificationuser, versionnumber, deleted)
                VALUES(:id, :idescribano, :idescribanoregente, :fechadesde, :fechahasta, NULL,:esactiva, NOW(), 'dummyuser',NOW(),'dummyuser', 0, FALSE) RETURNING id";

            $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_escribanolicencia);

            $stmt_cesig->bindValue(':id', $registro_coessfe->getCodLicencia(), PDO::PARAM_STR);
            $stmt_cesig->bindValue(':idescribano', $idescribano, PDO::PARAM_STR);
            $stmt_cesig->bindValue(':idescribanoregente', $idescribanoregente, PDO::PARAM_STR);
            $stmt_cesig->bindValue(':fechadesde', $fechadesde, PDO::PARAM_STR);
            $stmt_cesig->bindValue(':fechahasta', $fechahasta, PDO::PARAM_STR);
            $stmt_cesig->bindValue(':esactiva', $esactiva, PDO::PARAM_STR);
            $stmt_cesig->execute();

            echo " => LICENCIA CARGADA CON EXITO " . PHP_EOL . PHP_EOL;

            $select_pad_escribanolicencia = "SELECT * FROM pad_escribanolicencia WHERE id = :id";
            $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribanolicencia);
            $stmt_cesig->bindValue(":id", $registro_coessfe->getCodLicencia(), PDO::PARAM_STR);
            $stmt_cesig->execute();
            $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

            echo (" => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL);

            foreach ($resultados as $fila) {
                foreach ($fila as $nombre_columna => $valor) {
                    echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
                }
            }

        } else { // si no se si tiene la matricula del escribano o del regente interino no se puede cargar la licencia
            echo ('Error. Licencia no apta para cargar en CESIG' . PHP_EOL . PHP_EOL);
        }

    }


    private function actualizarLicenciaEscribano($registro_cesig,$registro_coessfe)
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
            $fecha_actual = date("Y-m-d");

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

            $insert_pad_escribanolicencia = $insert_pad_escribanolicencia . " WHERE id = '" . $registro_coessfe->getCodLicencia() . "'";

            $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_escribanolicencia);

            $stmt_cesig->execute();

            echo "    => TABLA pad_escribanolicencia ACTUALIZADA CON EXITO " . PHP_EOL . PHP_EOL;
        } else {
            echo (' => NO SE ENCONTRARON CAMBIOS' . PHP_EOL . PHP_EOL);
        }

    }

}

?>