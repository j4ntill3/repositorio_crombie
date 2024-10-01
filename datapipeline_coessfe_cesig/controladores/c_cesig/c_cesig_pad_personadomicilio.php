<?php

require "modelos\m_cesig\m_cesig_pad_personadomicilio.php";

class c_cesig_pad_personadomicilio
{
    private $conexion_coessfe;
    private $conexion_cesig;

    public function __construct(&$conexion_coessfe, &$conexion_cesig)
    {
        $this->conexion_coessfe = &$conexion_coessfe;
        $this->conexion_cesig = &$conexion_cesig;
    }

    public function analizarDomiciliosPersonas()
    {

        echo ("=> INICIO CARGA/ACTUALIZACIÓN DE DOMICILIOS PARA PERSONAS TABLA pad_personadomicilio" . PHP_EOL . PHP_EOL);

        try {

            //selecciono las personas a analizar
            $select_pad_persona = "SELECT * FROM pad_persona";
            $stmt_cesig = $this->conexion_cesig->prepare($select_pad_persona);
            $stmt_cesig->execute();
            $registros_pad_persona = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < count($registros_pad_persona); $i++) {

                echo ("=> ANALIZANDO PERSONA ID " . $registros_pad_persona[$i]['id'] . PHP_EOL);

                // selecciono en la tabla seg_perfil segun el id de la persona
                // para verificar si se trata de un escribano o un empleado
                $select_seg_perfil = "SELECT * FROM seg_perfil WHERE idpersona = :idpersona";
                $stmt_cesig = $this->conexion_cesig->prepare($select_seg_perfil);
                $stmt_cesig->bindValue("idpersona", $registros_pad_persona[$i]['id'], PDO::PARAM_STR);
                $stmt_cesig->execute();
                $registro_seg_perfil = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                if (
                    ($registro_seg_perfil['idescribano'] != NULL and $registro_seg_perfil['idempleado'] == NULL)
                    or ($registro_seg_perfil['idescribano'] != NULL and $registro_seg_perfil['idempleado'] != NULL)
                ) {
                    $tipopersona = "Escribano";
                }

                if ($registro_seg_perfil['idempleado'] != NULL and $registro_seg_perfil['idescribano'] == NULL) {
                    $tipopersona = "Empleado";
                }

                $select_pad_personadomicilio = "SELECT * FROM pad_personadomicilio WHERE idpersona = :idpersona";
                $stmt_cesig = $this->conexion_cesig->prepare($select_pad_personadomicilio);
                $stmt_cesig->bindValue("idpersona", $registros_pad_persona[$i]['id'], PDO::PARAM_STR);
                $stmt_cesig->execute();
                $registros_pad_personadomicilio = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

                // verifico si la persona tiene algun domicilio registrado
                // caso contrario cargo todos los domicilio de la persona
                if ($registros_pad_personadomicilio) {

                    echo (" => LA PERSONA YA POSEE DOMICILIOS REGISTRADOS(" . $tipopersona . ") => ANALIZANDO DOMICILIOS ");

                    if ($tipopersona == "Escribano") {

                        $select_pad_escribano = "SELECT * FROM pad_escribano WHERE id = :id";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribano);
                        $stmt_cesig->bindValue(":id", $registro_seg_perfil['idescribano'], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_pad_escribano = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                        $select_sec_domicilios = "SELECT * FROM sec_domicilios WHERE matricula = :matricula";
                        $stmt_cesig = $this->conexion_coessfe->prepare($select_sec_domicilios);
                        $stmt_cesig->bindValue(":matricula", $registro_pad_escribano['matricula'], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registros_sec_domicilios = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

                        $this->analizarDomiciliosEscribano($registros_pad_personadomicilio, $registros_sec_domicilios);

                    }

                    if ($tipopersona == "Empleado") {

                        $select_pad_empleado = "SELECT * FROM pad_empleado WHERE id = :id";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_empleado);
                        $stmt_cesig->bindValue(":id", $registro_seg_perfil['idempleado'], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_pad_empleado = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                        $select_pad_empleados = "SELECT * FROM pad_empleados WHERE legajo = :legajo AND id_organizacion = 1";
                        $stmt_cesig = $this->conexion_coessfe->prepare($select_pad_empleados);
                        $stmt_cesig->bindValue(":legajo", $registro_pad_empleado['legajo'], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_pad_empleado = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                        $this->analizarDomicilioEmpleado($registros_pad_personadomicilio, $registro_pad_empleado);

                    }

                } else {

                    echo (" => LA PERSONA NO POSEE DOMICILIOS REGISTRADOS(" . $tipopersona . ") => CARGANDO DOMICILIOS ");

                    //selecciono en la tabla seg_perfil segun el id de la persona
                    // para verificar si se trata de un escribano o un empleado
                    $select_seg_perfil = "SELECT * FROM seg_perfil WHERE idpersona = :idpersona";
                    $stmt_cesig = $this->conexion_cesig->prepare($select_seg_perfil);
                    $stmt_cesig->bindValue("idpersona", $registros_pad_persona[$i]['id'], PDO::PARAM_STR);
                    $stmt_cesig->execute();
                    $registro_seg_perfil = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                    // si es escribano o escribano y empleado
                    if (
                        ($registro_seg_perfil['idescribano'] != NULL and $registro_seg_perfil['idempleado'] == NULL)
                        or ($registro_seg_perfil['idescribano'] != NULL and $registro_seg_perfil['idempleado'] != NULL)
                    ) {

                        echo ("=> PERSONA REGISTRADA COMO ESCRIBANO" . PHP_EOL);

                        $select_pad_escribano = "SELECT * FROM pad_escribano WHERE id = :id";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribano);
                        $stmt_cesig->bindValue(":id", $registro_seg_perfil['idescribano'], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_pad_escribano = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                        $this->cargarDomiciliosEscribano($registros_pad_persona[$i]["id"], $registro_pad_escribano['matricula']);
                    }
                    // si es empleado
                    if ($registro_seg_perfil['idempleado'] != NULL and $registro_seg_perfil['idescribano'] == NULL) {

                        echo ("=> PERSONA REGISTRADA COMO EMPLEADO " . PHP_EOL);

                        $select_pad_empleado = "SELECT * FROM pad_empleado WHERE id = :id";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_empleado);
                        $stmt_cesig->bindValue(":id", $registro_seg_perfil['idempleado'], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_pad_empleado = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                        $this->cargarDomicilioEmpleado($registros_pad_persona[$i]["id"], intval($registro_pad_empleado['legajo']));
                    }
                }

            }

        } catch (PDOException $e) {
            // Capturamos cualquier excepcion que pueda ocurrir durante la ejecucion de las consultas
            echo " => Error en la consulta: " . $e->getMessage() . PHP_EOL . PHP_EOL;
        }
        echo ("=> FIN CARGA/ACTUALIZACIÓN DE DOMICILIOS PARA PERSONAS" . PHP_EOL . PHP_EOL);
    }

    private function analizarDomiciliosEscribano($registros_pad_personadomicilio, $registros_sec_domicilios)
    {
        //verificar si se agrego un nuevo domicilio
        if (count($registros_sec_domicilios) > count($registros_pad_personadomicilio)) {

            for ($i = 0; $i < count($registros_pad_personadomicilio); $i++) {

                echo ("=> SE HAN AGREGADO " . (count($registros_sec_domicilios) - count($registros_pad_personadomicilio)) . " DOMICILIOS" . PHP_EOL . PHP_EOL);

                for ($j = count($registros_pad_personadomicilio); $j < count($registros_sec_domicilios); $j++) {

                    echo("=> AGREGANDO DOMICILIO ");

                    // antes de insertar el domicilio se debe consultar el id de la localidad segun el codigo postal
                    // en caso de no encontrase se define el idlocalidad en 0

                    $select_def_localidad = "SELECT * FROM def_localidad WHERE codigopostal = :codigopostal";
                    $stmt_cecig = $this->conexion_cesig->prepare($select_def_localidad);
                    $stmt_cecig->bindValue(':codigopostal', intval($registros_sec_domicilios[$j]['cod_postal']), PDO::PARAM_STR);
                    $stmt_cecig->execute();
                    $registros_def_localidad = $stmt_cecig->fetch(PDO::FETCH_ASSOC);

                    if ($stmt_cecig->rowCount() > 0) {
                        $idlocalidad = $registros_def_localidad['id'];
                    } else {
                        $idlocalidad = 0;
                    }

                    $insert_pad_personadomicilio = "INSERT INTO pad_personadomicilio(idpersona,idtipodomicilio,fechadesde,domicilio,idlocalidad,creationtimestamp,creationuser,deleted,modificationtimestamp,modificationuser,versionnumber,secuencia)
                    VALUES(:idpersona,1,:fechadesde,:domicilio,:idlocalidad,NOW(),'dummyuser',FALSE,NOW(),'dummyuser',0,:secuencia) RETURNING id";

                    $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_personadomicilio);
                    $stmt_cesig->bindValue(":idpersona", $registros_pad_personadomicilio[0]['idpersona'], PDO::PARAM_STR);
                    $stmt_cesig->bindValue(":fechadesde", $registros_sec_domicilios[$j]['fecha'], PDO::PARAM_STR);
                    $stmt_cesig->bindValue(":domicilio", $registros_sec_domicilios[$j]['domicilio'], PDO::PARAM_STR);
                    $stmt_cesig->bindValue(":idlocalidad", $idlocalidad, PDO::PARAM_STR);
                    $stmt_cesig->bindValue(":secuencia", $registros_sec_domicilios[$j]['renglon'], PDO::PARAM_STR);
                    $stmt_cesig->execute();

                    $idDomicilio = $stmt_cesig->fetchColumn();

                    // consulto los datos registrados

                    echo (" => DOMICILIO REGISTRADO CON EXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL);

                    $select_pad_personadomicilio = "SELECT * FROM pad_personadomicilio WHERE id = :id";
                    $stmt_cesig = $this->conexion_cesig->prepare($select_pad_personadomicilio);
                    $stmt_cesig->bindValue(":id", $idDomicilio, PDO::PARAM_STR);
                    $stmt_cesig->execute();
                    $resultados = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                    foreach ($resultados as $nombre_columna => $valor) {
                        echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
                    }

                }

            }

        } else {
            echo ('=> NO SE ENCONTRARON DOMICILIOS NUEVOS' . PHP_EOL . PHP_EOL);
        }
    }

    private function analizarDomicilioEmpleado($registros_pad_personadomicilio, $registro_pad_empleados)
    {

        $datos_a_actualizar = array();
        $columnas_a_actualizar = array();

        if ($registros_pad_personadomicilio[0]['domicilio'] != $registro_pad_empleados['direccion']) { 
            array_push($datos_a_actualizar, array($registros_pad_personadomicilio[0]['domicilio'], $registro_pad_empleados['direccion']));
            array_push($columnas_a_actualizar, 'domicilio');
        }

        $select_def_localidad = "SELECT * FROM def_localidad WHERE codigopostal = :codigopostal";
        $stmt_cecig = $this->conexion_cesig->prepare($select_def_localidad);
        $stmt_cecig->bindValue(':codigopostal', intval($registro_pad_empleados['cod_postal_direccion']), PDO::PARAM_STR);
        $stmt_cecig->execute();
        $registros_def_localidad = $stmt_cecig->fetch(PDO::FETCH_ASSOC);

        if ($stmt_cecig->rowCount() > 0) {
            $idlocalidad = $registros_def_localidad['id'];
        } else {
            $idlocalidad = 0;
        }

        if ($registros_pad_personadomicilio[0]['idlocalidad'] != $idlocalidad) { 
            array_push($datos_a_actualizar, array($registros_pad_personadomicilio[0]['idlocalidad'], $idlocalidad));
            array_push($columnas_a_actualizar, 'idlocalidad');
        }

        // Si se encontraron diferencias se realiza un UPDATE para actualizar los cambios
        if (count($datos_a_actualizar) != 0) {
            // Genero la sentencia para actualizar los datos que se modificaron

            $update_pad_personacontacto = "UPDATE pad_personacontacto SET ";

            echo (" => DATOS A ACTUALIZAR: " . PHP_EOL . PHP_EOL);

            for ($i = 0; $i < count($datos_a_actualizar); $i++) {

                if (is_int($datos_a_actualizar[$i][1])) {
                    $update_pad_personacontacto = $update_pad_personacontacto . $columnas_a_actualizar[$i] . " = " . intval($datos_a_actualizar[$i][1]) . ",";
                } else {
                    $update_pad_personacontacto = $update_pad_personacontacto . $columnas_a_actualizar[$i] . " = '" . $datos_a_actualizar[$i][1] . "',";
                }

                echo ("        -> " . $columnas_a_actualizar[$i] . " -> valor actual = " . $datos_a_actualizar[$i][0] . " -> valor nuevo = " . $datos_a_actualizar[$i][1] . PHP_EOL . PHP_EOL);

            }

            $update_pad_personacontacto = substr($update_pad_personacontacto, 0, -1);

            $update_pad_personacontacto = $update_pad_personacontacto . " WHERE id = '" . $registros_pad_personadomicilio[0]['id'] . "'";

            $stmt_cesig = $this->conexion_cesig->prepare($update_pad_personacontacto);

            $stmt_cesig->execute();

            echo "    => TABLA pad_personadomicilio ACTUALIZADA CON EXITO " . PHP_EOL . PHP_EOL;
        } else {
            echo ('=> NO SE ENCONTRARON CAMBIOS' . PHP_EOL . PHP_EOL);
        }
    }
    private function cargarDomiciliosEscribano($idpersona, $matricula)
    {

        $select_sec_domicilios = "SELECT * FROM sec_domicilios WHERE matricula = :matricula";
        $stmt_coessfe = $this->conexion_coessfe->prepare($select_sec_domicilios);
        $stmt_coessfe->bindValue(":matricula", $matricula, PDO::FETCH_ASSOC);
        $stmt_coessfe->execute();
        $registro_sec_domicilios = $stmt_coessfe->fetchAll(PDO::FETCH_ASSOC);

        for ($j = 0; $j < count($registro_sec_domicilios); $j++) {

            echo (" => CARGANDO DOMICILIO " . $j . PHP_EOL);

            // antes de insertar el domicilio se debe consultar el id de la localidad segun el codigo postal
            // en caso de no encontrase se define el idlocalidad en 0

            $select_def_localidad = "SELECT * FROM def_localidad WHERE codigopostal = :codigopostal";
            $stmt_cecig = $this->conexion_cesig->prepare($select_def_localidad);
            $stmt_cecig->bindValue(':codigopostal', intval($registro_sec_domicilios[$j]['cod_postal']), PDO::PARAM_STR);
            $stmt_cecig->execute();
            $registros_def_localidad = $stmt_cecig->fetch(PDO::FETCH_ASSOC);

            if ($stmt_cecig->rowCount() > 0) {
                $idlocalidad = $registros_def_localidad['id'];
            } else {
                $idlocalidad = 0;
            }

            $insert_pad_personadomicilio = "INSERT INTO pad_personadomicilio(idpersona,idtipodomicilio,fechadesde,domicilio,idlocalidad,creationtimestamp,creationuser,deleted,modificationtimestamp,modificationuser,versionnumber,secuencia) 
            VALUES(:idpersona,1,:fechadesde,:domicilio,:idlocalidad,NOW(),'dummyuser',FALSE,NOW(),'dummyuser',0,:secuencia) RETURNING id";

            $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_personadomicilio);
            $stmt_cesig->bindValue(":idpersona", $idpersona, PDO::PARAM_STR);
            $stmt_cesig->bindValue(":fechadesde", $registro_sec_domicilios[$j]['fecha'], PDO::PARAM_STR);
            $stmt_cesig->bindValue(":domicilio", $registro_sec_domicilios[$j]['domicilio'], PDO::PARAM_STR);
            $stmt_cesig->bindValue(":idlocalidad", $idlocalidad, PDO::PARAM_STR);
            $stmt_cesig->bindValue(":secuencia", $registro_sec_domicilios[$j]['renglon'], PDO::PARAM_STR);
            $stmt_cesig->execute();

            $idomicilio = $stmt_cesig->fetchColumn();

            // consulto los datos registrados

            echo ("  => DOMICILIO REGISTRADO CON EXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL);

            $select_pad_personacontacto = "SELECT * FROM pad_personadomicilio WHERE id = :id";
            $stmt_cesig = $this->conexion_cesig->prepare($select_pad_personacontacto);
            $stmt_cesig->bindValue(":id", $idomicilio, PDO::PARAM_STR);
            $stmt_cesig->execute();
            $resultados = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

            foreach ($resultados as $nombre_columna => $valor) {
                echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
            }

            echo ("  => REGISTRADO DOMICILIO " . $j . PHP_EOL . PHP_EOL);

        }

    }

    private function cargarDomicilioEmpleado($idpersona, $legajo)
    {

        $select_pad_empleados = "SELECT * FROM pad_empleados WHERE legajo = :legajo AND id_organizacion = 1";
        $stmt_coessfe = $this->conexion_coessfe->prepare($select_pad_empleados);
        $stmt_coessfe->bindValue(":legajo", $legajo, PDO::PARAM_STR);
        $stmt_coessfe->execute();
        $registro_pad_empleados = $stmt_coessfe->fetch(PDO::FETCH_ASSOC);

        // antes de insertar el domicilio se debe consultar el id de la localidad segun el codigo postal
        // en caso de no encontrase se define el idlocalidad en 0

        $select_def_localidad = "SELECT * FROM def_localidad WHERE codigopostal = :codigopostal";
        $stmt_cecig = $this->conexion_cesig->prepare($select_def_localidad);
        $stmt_cecig->bindValue(':codigopostal', intval($registro_pad_empleados['cod_postal_direccion']), PDO::PARAM_STR);
        $stmt_cecig->execute();
        $registros_def_localidad = $stmt_cecig->fetch(PDO::FETCH_ASSOC);

        if ($stmt_cecig->rowCount() > 0) {
            $idlocalidad = $registros_def_localidad['id'];
        } else {
            $idlocalidad = 0;
        }

        $insert_pad_personadomicilio = "INSERT INTO pad_personadomicilio(idpersona,idtipodomicilio,fechadesde,domicilio,idlocalidad,creationtimestamp,creationuser,deleted,modificationtimestamp,modificationuser,versionnumber,secuencia) 
        VALUES(:idpersona,1,:fechadesde,:domicilio,:idlocalidad,NOW(),'dummyuser',FALSE,NOW(),'dummyuser',0,:secuencia) RETURNING id";

        $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_personadomicilio);
        $stmt_cesig->bindValue(":idpersona", $idpersona, PDO::PARAM_STR);
        $stmt_cesig->bindValue(":fechadesde", $registro_pad_empleados['fecha_ingreso'], PDO::PARAM_STR);
        $stmt_cesig->bindValue(":domicilio", $registro_pad_empleados['direccion'], PDO::PARAM_STR);
        $stmt_cesig->bindValue(":idlocalidad", $idlocalidad, PDO::PARAM_STR);
        $stmt_cesig->bindValue(":secuencia", 1, PDO::PARAM_STR);
        $stmt_cesig->execute();

        $idpersonacontacto = $stmt_cesig->fetchColumn();

        // consulto los datos registrados

        echo ("  => CONTACTO REGISTRADO CON EXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL);

        $select_pad_personadomicilio = "SELECT * FROM pad_personadomicilio WHERE id = :id";
        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_personadomicilio);
        $stmt_cesig->bindValue(":id", $idpersonacontacto, PDO::PARAM_STR);
        $stmt_cesig->execute();
        $resultados = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

        foreach ($resultados as $nombre_columna => $valor) {
            echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
        }



    }

}