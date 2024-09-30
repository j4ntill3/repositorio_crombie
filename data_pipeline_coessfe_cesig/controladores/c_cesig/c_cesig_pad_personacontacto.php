<?php

require "modelos\m_cesig\m_cesig_pad_personacontacto.php";

class c_cesig_pad_personacontacto
{
    private $conexion_coessfe;
    private $conexion_cesig;

    public function __construct(&$conexion_coessfe, &$conexion_cesig)
    {
        $this->conexion_coessfe = &$conexion_coessfe;
        $this->conexion_cesig = &$conexion_cesig;
    }

    public function analizarContactosPersonas()
    {

        echo ("=> INICIO CARGA/ACTUALIZACIÓN DE CONTACTOS PARA PERSONAS TABLA pad_personacontacto" . PHP_EOL . PHP_EOL);

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

                $select_pad_personacontacto = "SELECT * FROM pad_personacontacto WHERE idpersona = :idpersona";
                $stmt_cesig = $this->conexion_cesig->prepare($select_pad_personacontacto);
                $stmt_cesig->bindValue("idpersona", $registros_pad_persona[$i]['id'], PDO::PARAM_STR);
                $stmt_cesig->execute();
                $registros_pad_personacontacto = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

                // verifico si la persona tiene algun contacto registrado
                // caso contrario cargo todos los contactos de la persona
                if ($registros_pad_personacontacto) {

                    echo ("=> LA PERSONA YA POSEE CONTACTOS REGISTRADOS(" . $tipopersona . ") => ANALIZANDO CONTACTOS ");

                    if ($tipopersona == "Escribano") {

                        $select_pad_escribano = "SELECT * FROM pad_escribano WHERE id = :id";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribano);
                        $stmt_cesig->bindValue(":id", $registro_seg_perfil['idescribano'], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_pad_escribano = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                        $select_sec_padron_escribanos = "SELECT * FROM sec_padron_escribanos WHERE matricula = :matricula";
                        $stmt_cesig = $this->conexion_coessfe->prepare($select_sec_padron_escribanos);
                        $stmt_cesig->bindValue(":matricula", $registro_pad_escribano['matricula'], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_sec_padron_escribanos = $stmt_cesig->fetch(PDO::FETCH_ASSOC);
                        
                        $this->analizarContactosEscribano($registros_pad_personacontacto, $registro_sec_padron_escribanos);

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

                        $this->analizarContactosEmpleado($registros_pad_personacontacto, $registro_pad_empleado);

                    }

                } else {
                    echo ("=> LA PERSONA NO POSEE CONTACTO REGISTRADOS => CARGANDO CONTACTO REGISTRADOS");

                    if ($tipopersona == "Escribano") {
                        $select_pad_escribano = "SELECT * FROM pad_escribano WHERE id = :id";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribano);
                        $stmt_cesig->bindValue(":id", $registro_seg_perfil['idescribano'], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_pad_escribano = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                        $this->cargarContactosEscribano($registros_pad_persona[$i]["id"], $registro_pad_escribano['matricula']);
                    }

                    if ($tipopersona == "Empleado") {
                        
                        $select_pad_empleado = "SELECT * FROM pad_empleado WHERE id = :id";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_empleado);
                        $stmt_cesig->bindValue(":id", $registro_seg_perfil['idempleado'], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_pad_empleado = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                        $this->cargarContactosEmpleado($registros_pad_persona[$i]["id"], intval($registro_pad_empleado['legajo']));
                    }
                }
            }
        } catch (PDOException $e) {
            // Capturamos cualquier excepcion que pueda ocurrir durante la ejecucion de las consultas
            echo " => Error en la consulta: " . $e->getMessage() . PHP_EOL . PHP_EOL;
        }
        echo ("=> FIN CARGA/ACTUALIZACIÓN DE CONTACTOS PARA PERSONAS");
    }

    private function analizarContactosEscribano($registros_pad_personacontacto, $registro_sec_padron_escribanos)
    {

        echo("=> CANTIDAD DE CONTACTOS A ANALIZAR " . count($registros_pad_personacontacto) . PHP_EOL . PHP_EOL);

        for ($i = 0; $i < count($registros_pad_personacontacto); $i++) {

            echo("=> ANALIZANDO CONTACTO " . ($i+1));
            
            $datos_a_actualizar = array();
            $columnas_a_actualizar = array();
            if ($registros_pad_personacontacto[$i]['idpersonatipocontacto'] == 1) { //email



            }
            if ($registros_pad_personacontacto[$i]['idpersonatipocontacto'] == 2) { // telefono

                if (!($registros_pad_personacontacto[$i]['contactovalor'] == $registro_sec_padron_escribanos['telefono'])) {
                    array_push($datos_a_actualizar, array($registros_pad_personacontacto[$i]['contactovalor'], $registro_sec_padron_escribanos['telefono']));
                    array_push($columnas_a_actualizar, 'contactovalor');
                }

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

                $update_pad_personacontacto = $update_pad_personacontacto . " WHERE id = '" . $registros_pad_personacontacto[$i]['id'] . "'";

                $stmt_cesig = $this->conexion_cesig->prepare($update_pad_personacontacto);

                $stmt_cesig->execute();
                
                echo "    => TABLA pad_personacontacto ACTUALIZADA CON EXITO " . PHP_EOL . PHP_EOL;
            } else {
                echo (' => NO SE ENCONTRARON CAMBIOS' . PHP_EOL . PHP_EOL);
            }

        }
    }

    private function analizarContactosEmpleado($registros_pad_personacontacto, $registro_pad_empleados)
    {

        echo("=> CANTIDAD DE CONTACTOS A ANALIZAR " . count($registros_pad_personacontacto) . PHP_EOL . PHP_EOL);

        for ($i = 0; $i < count($registros_pad_personacontacto); $i++) {

            echo("=> ANALIZANDO CONTACTO " . ($i+1));

            $datos_a_actualizar = array();
            $columnas_a_actualizar = array();
            if ($registros_pad_personacontacto[$i]['idpersonatipocontacto'] == 1) { //email



            }
            if ($registros_pad_personacontacto[$i]['idpersonatipocontacto'] == 2) { // telefono
                if (!($registros_pad_personacontacto[$i]['contactovalor'] == $registro_pad_empleados['telefono'])) {
                    array_push($datos_a_actualizar, array($registros_pad_personacontacto[$i]['contactovalor'], $registro_pad_empleados['telefono']));
                    array_push($columnas_a_actualizar, 'contactovalor');
                }
            }

            // Si se encontraron diferencias se realiza un UPDATE para actualizar los cambios
            if (count($datos_a_actualizar) != 0) {
                // Genero la sentencia para actualizar los datos que se modificaron

                $update_pad_personacontacto = "UPDATE pad_personacontacto SET ";

                echo (" => DATOS A ACTUALIZAR: " . PHP_EOL . PHP_EOL);
                ////////////
                for ($i = 0; $i < count($datos_a_actualizar); $i++) {

                    if (is_int($datos_a_actualizar[$i][1])) {
                        $update_pad_personacontacto = $update_pad_personacontacto . $columnas_a_actualizar[$i] . " = " . intval($datos_a_actualizar[$i][1]) . ",";
                    } else {
                        $update_pad_personacontacto = $update_pad_personacontacto . $columnas_a_actualizar[$i] . " = '" . $datos_a_actualizar[$i][1] . "',";
                    }

                    echo ("        -> " . $columnas_a_actualizar[$i] . " -> valor actual = " . $datos_a_actualizar[$i][0] . " -> valor nuevo = " . $datos_a_actualizar[$i][1] . PHP_EOL . PHP_EOL);

                }

                $update_pad_personacontacto = substr($update_pad_personacontacto, 0, -1);

                $update_pad_personacontacto = $update_pad_personacontacto . " WHERE id = '" . $registros_pad_personacontacto[$i]['id'] . "'";

                $stmt_cesig = $this->conexion_cesig->prepare($update_pad_personacontacto);

                $stmt_cesig->execute();
                
                echo "    => TABLA pad_personacontacto ACTUALIZADA CON EXITO " . PHP_EOL . PHP_EOL;
            } else {
                echo (' => NO SE ENCONTRARON CAMBIOS' . PHP_EOL . PHP_EOL);
            }

        }
    }
    private function cargarContactosEscribano($idpersona, $matricula)
    {

        $select_sec_padron_escribanos = "SELECT * FROM sec_padron_escribanos WHERE matricula = :matricula";
        $stmt_coessfe = $this->conexion_coessfe->prepare($select_sec_padron_escribanos);
        $stmt_coessfe->bindValue(":matricula", $matricula, PDO::FETCH_ASSOC);
        $stmt_coessfe->execute();
        $registro_sec_padron_escribanos = $stmt_coessfe->fetch(PDO::FETCH_ASSOC);

        $contactos = array();

        if ($registro_sec_padron_escribanos['e_mail'] != NULL) {
            $contactovalor = $registro_sec_padron_escribanos['e_mail'];
            $idpersonatipocontacto = 1;
            array_push($contactos, array($contactovalor, $idpersonatipocontacto));
        }
        if ($registro_sec_padron_escribanos['e_mail2'] != NULL) {
            $contactovalor = $registro_sec_padron_escribanos['e_mail2'];
            $idpersonatipocontacto = 1;
            array_push($contactos, array($contactovalor, $idpersonatipocontacto));
        }
        if ($registro_sec_padron_escribanos['telefono'] != NULL) {
            $contactovalor = $registro_sec_padron_escribanos['telefono'];
            $idpersonatipocontacto = 2;
            array_push($contactos, array($contactovalor, $idpersonatipocontacto));
        }

        // se verifica que el escribano tenga algun contacto cargado
        // caso contrario se carga solo un contacto de tipo "Sin Contacto" (cod = 4)
        if (count($contactos) > 0) {
            echo ("=> SE HAN DETECTADO " . count($contactos) . " DE CONTACTOS A CARGAR " . PHP_EOL . PHP_EOL);
            for ($j = 0; $j < count($contactos); $j++) {
                echo ("  => CARGANDO CONTACTO " . $j . " ");

                $insert_pad_personacontacto = "INSERT INTO pad_personacontacto(idpersona,idpersonatipocontacto,contactovalor,esoficial,espublico,creationtimestamp,creationuser,deleted,modificationtimestamp,modificationuser,versionnumber) VALUES(:idpersona,:idpersonatipocontacto,:contactovalor,TRUE,TRUE,NOW(),'dummyuser',FALSE,NOW(),'dummyuser',0) RETURNING id";
                $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_personacontacto);
                $stmt_cesig->bindValue(":idpersona", $idpersona, PDO::PARAM_STR);
                $stmt_cesig->bindValue(":contactovalor", $contactos[$j][0], PDO::PARAM_STR);
                $stmt_cesig->bindValue(":idpersonatipocontacto", $contactos[$j][1], PDO::PARAM_STR);
                $stmt_cesig->execute();

                $idpersonacontacto = $stmt_cesig->fetchColumn();

                // consulto los datos registrados

                echo ("  => CONTACTO REGISTRADO CON EXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL);

                $select_pad_personacontacto = "SELECT * FROM pad_personacontacto WHERE id = :id";
                $stmt_cesig = $this->conexion_cesig->prepare($select_pad_personacontacto);
                $stmt_cesig->bindValue(":id", $idpersonacontacto, PDO::PARAM_STR);
                $stmt_cesig->execute();
                $resultados = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                foreach ($resultados as $nombre_columna => $valor) {
                    echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
                }

            }
        } else {
            $contactovalor = "Sin Contacto";
            $idpersonatipocontacto = 4;
            array_push($contactos, array($contactovalor, $idpersonatipocontacto));
        }

        echo "=> CARGA DE CONTACTO EXITOSA" . PHP_EOL . PHP_EOL;
    }

    private function cargarContactosEmpleado($idpersona, $legajo)
    {
        
        $select_pad_empleados = "SELECT * FROM pad_empleados WHERE legajo = :legajo AND id_organizacion = 1";
        $stmt_coessfe = $this->conexion_coessfe->prepare($select_pad_empleados);
        $stmt_coessfe->bindValue(":legajo", $legajo, PDO::PARAM_STR);
        $stmt_coessfe->execute();
        $registro_pad_empleados = $stmt_coessfe->fetch(PDO::FETCH_ASSOC);

        if ($registro_pad_empleados['e_mail'] != NULL) {
            $contactovalor = $registro_pad_empleados['e_mail'];
            $idpersonatipocontacto = 1;
        } else if ($registro_pad_empleados['telefono'] != NULL) {
            $contactovalor = $registro_pad_empleados['telefono'];
            $idpersonatipocontacto = 2;
        } else {
            $contactovalor = "Sin Contacto";
            $idpersonatipocontacto = 4;
        }
        
        $insert_pad_personacontacto = "INSERT INTO pad_personacontacto(idpersona,idpersonatipocontacto,contactovalor,esoficial,espublico,creationtimestamp,creationuser,deleted,modificationtimestamp,modificationuser,versionnumber) VALUES(:idpersona,:idpersonatipocontacto,:contactovalor,TRUE,TRUE,NOW(),'dummyuser',FALSE,NOW(),'dummyuser',0) RETURNING id";
        $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_personacontacto);
        $stmt_cesig->bindValue(":idpersona", $idpersona, PDO::PARAM_STR);
        $stmt_cesig->bindValue(":idpersonatipocontacto", $idpersonatipocontacto, PDO::PARAM_STR);
        $stmt_cesig->bindValue(":contactovalor", $contactovalor, PDO::PARAM_STR);
        $stmt_cesig->execute();
        
        $idpersonacontacto = $stmt_cesig->fetchColumn();

        echo ("  => CONTACTO REGISTRADO CON EXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL);

        $select_pad_personacontacto = "SELECT * FROM pad_personacontacto WHERE id = :id";
        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_personacontacto);
        $stmt_cesig->bindValue(":id", $idpersonacontacto, PDO::PARAM_STR);
        $stmt_cesig->execute();
        $resultados = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

        foreach ($resultados as $nombre_columna => $valor) {
            echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
        }

    }

}