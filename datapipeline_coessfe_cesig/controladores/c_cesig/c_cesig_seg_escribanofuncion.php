<?php

require "modelos\m_cesig\m_cesig_seg_escribanofuncion.php";

class c_cesig_seg_escribanofuncion
{
    private $m_coessfe_sec_registros_y_funciones;
    private $conexion_coessfe;
    private $conexion_cesig;

    public function __construct(&$m_coessfe_sec_registros_y_funciones, &$conexion_coessfe, &$conexion_cesig)
    {
        $this->m_coessfe_sec_registros_y_funciones = &$m_coessfe_sec_registros_y_funciones;
        $this->conexion_cesig = &$conexion_cesig;
        $this->conexion_coessfe = &$conexion_coessfe;
    }

    public function analizarFuncionesEscribanos()
    {

        echo ("=> INICIO PROCESO CARGA/ACTUALIZACIÓN DE FUNCIONES DE ESCRIBANOS TABLA pad_escribanofuncion" . PHP_EOL . PHP_EOL);

        for ($i = 0; $i < count($this->m_coessfe_sec_registros_y_funciones); $i++) {

            echo (' => ANALIZANDO FUNCION MATRICULA ' . $this->m_coessfe_sec_registros_y_funciones[$i]->getMatricula() . ' RENGLON N° ' . $this->m_coessfe_sec_registros_y_funciones[$i]->getRenglon() . " ");

            try {

                //primero selecciono el id del escribano con la matricula
                $select_pad_escribano = "SELECT * FROM pad_escribano WHERE matricula = :matricula";
                $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribano);
                $stmt_cesig->bindValue(":matricula", $this->m_coessfe_sec_registros_y_funciones[$i]->getMatricula());
                $stmt_cesig->execute();
                $registro_pad_escribano = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                $idfuncion = $this->determinarTipoFuncionCESIG($this->m_coessfe_sec_registros_y_funciones[$i]->getCodFuncion());

                $select_seg_escribanofuncion = "SELECT * FROM seg_escribanofuncion WHERE idescribano = :idescribano AND idfuncion = :idfuncion AND fechaalta = :fechaalta";
                $stmt_cesig = $this->conexion_cesig->prepare($select_seg_escribanofuncion);
                $stmt_cesig->bindValue(':idescribano', $registro_pad_escribano['id'], PDO::PARAM_STR);
                $stmt_cesig->bindValue(':idfuncion', $idfuncion, PDO::PARAM_STR);
                $stmt_cesig->bindValue(':fechaalta', $this->m_coessfe_sec_registros_y_funciones[$i]->getDesdeFecha(), PDO::PARAM_STR);
                $stmt_cesig->execute();
                $registro_seg_escribanofuncion = $stmt_cesig->fetch(PDO::FETCH_ASSOC);
                
                if ($stmt_cesig->rowCount() > 0) {


                    $this->actualizarFuncionEscribano($this->m_coessfe_sec_registros_y_funciones[$i],$registro_seg_escribanofuncion);



                } else {

                    $this->cargarFuncionEscribano($this->m_coessfe_sec_registros_y_funciones[$i], $registro_pad_escribano['id']);

                }
            } catch (PDOException $e) {
                // Capturamos cualquier excepcion que pueda ocurrir durante la ejecucion de las consultas
                echo " => Error en la consulta: " . $e->getMessage() . PHP_EOL . PHP_EOL;
            }
        }
        echo ("=> FIN PROCESO CARGA/ACTUALIZACIÓN DE FUNCIONES DE ESCRIBANOS" . PHP_EOL . PHP_EOL);
    }

    private function cargarFuncionEscribano($registro_coessfe, $idescribano)
    {
        echo (' => LA FUNCIÓN NO SE ENCUENTRA REGISTRADA EN CESIG => CARGANDO FUNCIÓN ');

        //defino el id de funcion
        switch ($registro_coessfe->getCodFuncion()) {
            case 1:
                $idfuncion = 2;
                break;
            case 2:
                $idfuncion = 1;
                break;
            case 3:
                $idfuncion = 3;
                break;
            case 4:
                $idfuncion = 5;
                break;
            case 5:
                $idfuncion = 7;
                break;
            case 6:
                $idfuncion = 36;
                break;
            case 7:
                $idfuncion = 36;
                break;
            case 8:
                $idfuncion = 36;
                break;
            case 9:
                $idfuncion = 4;
                break;
            case 0:
                $idfuncion = 36;
                break;
        }

        $insert_seg_escribanofuncion =
        "INSERT INTO seg_escribanofuncion(creationtimestamp,creationuser,deleted,modificationtimestamp,modificationuser,versionnumber,fechaalta,fechabaja,idescribano,idfuncion,registro)
        VALUES(NOW(),'dummyuser',FALSE,NOW(),'dummyuser',0,:fechaalta,:fechabaja,:idescribano,:idfuncion,:registro) RETURNING id";
        $stmt_cesig = $this->conexion_cesig->prepare($insert_seg_escribanofuncion);
        $stmt_cesig->bindValue(":fechaalta", $registro_coessfe->getDesdeFecha(), PDO::PARAM_STR);
        $stmt_cesig->bindValue(":fechabaja", $registro_coessfe->getHastaFecha(), PDO::PARAM_STR);
        $stmt_cesig->bindValue(":idescribano", $idescribano, PDO::PARAM_STR);
        $stmt_cesig->bindValue(":idfuncion", $idfuncion, PDO::PARAM_STR);
        $stmt_cesig->bindValue(":registro", $registro_coessfe->getRegistro(), PDO::PARAM_STR);
        $stmt_cesig->execute();
        
        $idescribanofuncion = $stmt_cesig->fetchColumn();

        echo (' => FUNCIÓN REGISTRADA CON EXITO' . PHP_EOL . PHP_EOL);

        $select_pad_escribanosancion = "SELECT * FROM seg_escribanofuncion WHERE id = :id";
        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribanosancion);
        $stmt_cesig->bindValue(":id", $idescribanofuncion, PDO::PARAM_STR);
        $stmt_cesig->execute();
        $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

        echo ("=> DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL);

        foreach ($resultados as $fila) {
            foreach ($fila as $nombre_columna => $valor) {
                echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
            }
        }

    }

    private function actualizarFuncionEscribano($registro_coessfe, $registro_cesig)
    {

        echo ('=> LA FUNCIÓN SE ENCUENTRA REGISTRADA EN CESIG => VERIFICANDO CAMBIOS FUNCIÓN');

        //defino el id de funcion
        switch ($registro_coessfe->getCodFuncion()) {
            case 1:
                $idfuncion = 2;
                break;
            case 2:
                $idfuncion = 1;
                break;
            case 3:
                $idfuncion = 3;
                break;
            case 4:
                $idfuncion = 5;
                break;
            case 5:
                $idfuncion = 7;
                break;
            case 6:
                $idfuncion = 36;
                break;
            case 7:
                $idfuncion = 36;
                break;
            case 8:
                $idfuncion = 36;
                break;
            case 9:
                $idfuncion = 4;
                break;
            case 0:
                $idfuncion = 36;
                break;
        }

        $datos_a_actualizar = array();
        $columnas_a_actualizar = array();

        // Comparo alta fecha
        if ($registro_cesig['fechaalta'] != $registro_coessfe->getDesdeFecha()) {
            array_push($datos_a_actualizar, array($registro_cesig['fechaalta'], $registro_coessfe->getDesdeFecha()));
            array_push($columnas_a_actualizar, 'fechaalta');
        }

        // Comparo fecha baja
        if ($registro_cesig['fechabaja'] != $registro_coessfe->getHastaFecha()) {
            array_push($datos_a_actualizar, array($registro_cesig['fechabaja'], $registro_coessfe->getHastaFecha()));
            array_push($columnas_a_actualizar, 'fechabaja');
        }

        // Comparo idfuncion
        if ($registro_cesig['idfuncion'] != $idfuncion) {
            array_push($datos_a_actualizar, array($registro_cesig['idfuncion'], $idfuncion));
            array_push($columnas_a_actualizar, 'idfuncion');
        }

        // Comparo registro
        if ($registro_cesig['registro'] != $registro_coessfe->getRegistro()) {
            array_push($datos_a_actualizar, array($registro_cesig['idfuncion'], $registro_coessfe->getCodFuncion()));
            array_push($columnas_a_actualizar, 'idfuncion');
        }

        // Si se encontraron diferencias se realiza un UPDATE para actualizar los cambios
        if (count($datos_a_actualizar) != 0) {
            // Genero la sentencia para actualizar los datos que se modificaron

            $insert_seg_escribanofuncion = "UPDATE seg_escribanofuncion SET ";



            echo (" => DATOS A ACTUALIZAR: " . PHP_EOL . PHP_EOL);

            for ($i = 0; $i < count($datos_a_actualizar); $i++) {

                $insert_seg_escribanofuncion = $insert_seg_escribanofuncion . $columnas_a_actualizar[$i] . " = '" . $datos_a_actualizar[$i][1] . "',";

                echo ("        -> " . $columnas_a_actualizar[$i] . " -> valor actual = " . $datos_a_actualizar[$i][0] . " -> valor nuevo = " . $datos_a_actualizar[$i][1] . PHP_EOL . PHP_EOL);

            }

            $insert_seg_escribanofuncion = substr($insert_seg_escribanofuncion, 0, -1);

            $insert_seg_escribanofuncion = $insert_seg_escribanofuncion . " WHERE id = '" . $registro_cesig['id'] . "'";

            $stmt_cesig = $this->conexion_cesig->prepare($insert_seg_escribanofuncion);

            $stmt_cesig->execute();

            echo "    => TABLA pad_escribanolicencia ACTUALIZADA CON EXITO " . PHP_EOL . PHP_EOL;
        } else {
            echo (' => NO SE ENCONTRARON CAMBIOS' . PHP_EOL . PHP_EOL);
        }

    }

    // funcion que define el id de la funcion de CESIG segun el codigo de funcion de COESSFE
    private function determinarTipoFuncionCESIG($cod_funcion){
        //defino el id de funcion
        switch ($cod_funcion) {
            case 1:
                $idfuncion = 2;
            break;
            case 2:
                $idfuncion = 1;
            break;
            case 3:
                $idfuncion = 3;
            break;
            case 4:
                $idfuncion = 5;
            break;
            case 5:
                $idfuncion = 7;
            break;
            case 6:
                $idfuncion = 36;
            break;
            case 7:
                $idfuncion = 36;
            break;
            case 8:
                $idfuncion = 36;
            break;
            case 9:
                $idfuncion = 4;
            break;
            case 0:
                $idfuncion = 36;
            break;
        }

        return $idfuncion;
    }

}