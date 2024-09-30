<?php

require "modelos\m_cesig\m_cesig_pad_empleado.php";

class c_cesig_empleados
{
    private $m_coessfe_pad_empleados;
    private $conexion_cesig;
    private $conexion_coessfe;

    public function __construct(&$m_coessfe_pad_empleados,&$conexion_cesig,&$conexion_coessfe)
    {
        $this->m_coessfe_pad_empleados = &$m_coessfe_pad_empleados;
        $this->conexion_cesig = &$conexion_cesig;
        $this->conexion_coessfe = &$conexion_coessfe;
    }

    public function analizarEmpleados()
    {
        echo ("=> INICIO PROCESO CARGA/ACTUALIZACIÓN DE EMPLEADOS TABLAS pad_persona/pad_empleado/seg_usuario/seg_perfil" . PHP_EOL . PHP_EOL);

        for ($i = 0; $i < count($this->m_coessfe_pad_empleados); $i++) {

            echo (' => ANALIZANDO EMPLEADO LEGAJO ' . $this->m_coessfe_pad_empleados[$i]->getLegajo());

            // Primero valido que tenga DNI o CUIT, si no, no se hace nada
            if (($this->m_coessfe_pad_empleados[$i]->getNroDocumento() == '' and $this->m_coessfe_pad_empleados[$i]->getCuil() == '') or ($this->m_coessfe_pad_empleados[$i]->getNroDocumento() == NULL and $this->m_coessfe_pad_empleados[$i]->getCuil() == '') or ($this->m_coessfe_pad_empleados[$i]->getNroDocumento() == '' and $this->m_coessfe_pad_empleados[$i]->getCuil() == NULL)) {
                throw new Exception('Error. El Escribano no tiene registrado ningun DNI o CUIT');
            }

            try {

                // Se intenta seleccionar el empleado segun su legajo de la tabla pad_empleado en cesig
                $select_pad_empleado = "SELECT * FROM pad_empleado WHERE legajo = :legajo";
                $stmt_cesig = $this->conexion_cesig->prepare($select_pad_empleado);
                $stmt_cesig->bindValue(':legajo', $this->m_coessfe_pad_empleados[$i]->getLegajo(), PDO::PARAM_STR);
                $stmt_cesig->execute();
                $registro_cesig_pad_empleado = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                // Comprobamos si la consulta arrojo resultados
                if ($stmt_cesig->rowCount() > 0) {

                    // Si la consulta tiene resultado significa que el empleado esta cargado en cesig
                    // Se procede a verificar si se tiene que actualizar algun dato

                    echo (' => EL EMPLEADO SE ENCUENTRA CARGADO EN CESIG => VERIFICANDO TABLAS RELACIONADAS' . PHP_EOL . PHP_EOL);
                    
                    // Se selecciona el empleado segun su dni de la tabla pad_persona
                    $select_pad_persona = "SELECT * FROM pad_persona WHERE numerodocumento = :dni";
                    $stmt_cesig = $this->conexion_cesig->prepare($select_pad_persona);
                    $stmt_cesig->bindValue(':dni', $this->m_coessfe_pad_empleados[$i]->getNroDocumento(), PDO::PARAM_STR);
                    $stmt_cesig->execute();
                    $registro_cesig_pad_persona = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                    $this->actualizarRegistroPadPersona($registro_cesig_pad_persona, $this->m_coessfe_pad_empleados[$i]);
                    $this->actualizarRegistroPadEmpleado($registro_cesig_pad_empleado, $this->m_coessfe_pad_empleados[$i]);

                } else {

                    // Si la consulta no arroja resultados significa que el empleado no esta cargado en cesig, se procede cargarlo
                    // Llamo a la funcion que carga los registros en las tablas pertinentes

                    echo (' => EL EMPLEADO NO SE ENCUENTRA CARGADO EN CESIG' . PHP_EOL . PHP_EOL);
                    $idpersona = $this->cargarEmpleadoTablaPadPersona($this->m_coessfe_pad_empleados[$i]);
                    $idempleado = $this->cargarEmpleadoTablaPadEmpleado($this->m_coessfe_pad_empleados[$i]);
                    $id_username = $this->cargarEmpleadoTablaSegUsuario($this->m_coessfe_pad_empleados[$i]);
                    $this->cargarEmpleadoSegPerfil($id_username, $idpersona, $idempleado);

                }
            } catch (PDOException $e) {
                // Capturamos cualquier excepcion que pueda ocurrir durante la ejecucion de las consultas
                echo " => Error en la consulta: " . $e->getMessage() . PHP_EOL . PHP_EOL;
            }
        }
        echo ("=> FIN PROCESO CARGA/ACTUALIZACIÓN DE EMPLEADOS" . PHP_EOL . PHP_EOL);
    }

    private function cargarEmpleadoTablaPadEmpleado($registro_coessfe)
    {
        echo ('    => CARGANDO EMPLEADO EN TABLA pad_empleado');

        // Preparo la sentencia INSERT que registrara al Empleado en cesig

        $insert_pad_empleado = "INSERT INTO public.pad_empleado(id, creationtimestamp, creationuser, deleted, modificationtimestamp, modificationuser, versionnumber, legajo, idtipoempleado, tituloprofesional, idempleadocategoria, esconveniocolectivo, tituloexpedidopor, idbanco, cobrosucursal, cobrocuenta, cobrocbu, cajajubilacion, idobrasocial, apellidonombrepadre, apellidonombremadre, observacion, idcargoempleado, fechaaltaantiguedad, fechaaltajubilacion)
        VALUES(nextval('pad_empleado_id_seq'::regclass), NOW(), 'dummyuser', FALSE, NOW(), 'dummyuser', 0, :legajo, 21, :tituloprofesional, 0, FALSE, NULL, 0, 0, '', NULL, NULL, 1, NULL, NULL, NULL, 0, :fechaaltaantiguedad, NULL) RETURNING 1;";

        $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_empleado);

        // Agrego "legajo"
        $stmt_cesig->bindValue(':legajo', $registro_coessfe->getLegajo(), PDO::PARAM_STR);

        // Agrego "tituloprofesional"
        switch (strtoupper($registro_coessfe->getTitulo())) {
            case 'Abogado':
                $stmt_cesig->bindValue(':tituloprofesional', 1, PDO::PARAM_STR);
                break;
            case 'Escribano':
                $stmt_cesig->bindValue(':tituloprofesional', 2, PDO::PARAM_STR);
                break;
            case 'Notario';
                $stmt_cesig->bindValue(':tituloprofesional', 3, PDO::PARAM_STR);
                break;
            case NULL;
                $stmt_cesig->bindValue(':tituloprofesional', NULL, PDO::PARAM_STR);
                break;
            default:
                $stmt_cesig->bindValue(':tituloprofesional', 0, PDO::PARAM_STR);
                break;
        }

        // Agrego "fechaaltaantiguedad"
        $stmt_cesig->bindValue(':fechaaltaantiguedad', $registro_coessfe->getFechaIngreso(), PDO::PARAM_STR);

        //Ejecuto el insert en pad_empleado
        $stmt_cesig->execute();

        $idempleado = $stmt_cesig->fetchColumn();

        // Verificar si la insercion fue exitosa y muestro los datos que han sido insertados
        $select_pad_empleado = "SELECT * FROM pad_empleado WHERE legajo = :legajo";
        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_empleado);
        $stmt_cesig->bindValue(':legajo', strval($registro_coessfe->getLegajo()), PDO::PARAM_STR);
        $stmt_cesig->execute();


        echo " => EMPLEADO REGSITRADO CON EXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL;

        $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultados as $fila) {
            foreach ($fila as $nombre_columna => $valor) {
                echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
            }
        }

        return $idempleado;

    }

    private function cargarEmpleadoTablaPadPersona($registro_coessfe)
    {
        echo ('    => CARGANDO EMPLEADO EN TABLA pad_persona');

        // Preparo la sentencia INSERT que registrara al Empleado en cesig

        $insert_pad_persona = "INSERT INTO public.pad_persona(id, creationtimestamp, creationuser, deleted, modificationtimestamp, modificationuser, versionnumber, apellido1, apellido2, cuit, mailoficial, nombre1, nombre2, nombre3, razonsocial, sexo, apellidonombreconyuge, localidadnacimiento, idpaisnacimiento, fechanacimiento, idtipodoc, numerodocumento, idestadocivil, ingresosbrutos, idcondicioniva)
        VALUES(nextval('pad_persona_id_seq'::regclass), NOW(), 'dummyuser', FALSE, NOW(), 'dummyuser', 0, :apellido1, :apellido2, :cuit, :mailoficial, :nombre1, :nombre2, :nombre3, NULL, :sexo, NULL, '', 263, :fechanacimiento, :idtipodoc, :numerodocumento, :idestadocivil, NULL, 0) RETURNING id;";

        $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_persona);

        // Agrego apellidos
        // Como los apellidos en cesig se guardan cada uno por columna se deben dividir la columna "apellidos" que tomamos de los empleados de coessfe

        // Dividir el apellido completo en otros apellidos
        $apellidos = explode(' ', $registro_coessfe->getApellidos());

        // Tomar hasta 2 apellidos
        $apellidosExtraidos = array_slice($apellidos, 0, 2);

        // Agrego apellido1
        $stmt_cesig->bindValue(':apellido1', $apellidosExtraidos[0], PDO::PARAM_STR);

        // Agrego apellido2
        // Si no tiene segundo apellido se guarda como null
        if (isset($apellidosExtraidos[1]) && !empty($apellidosExtraidos[1])) {
            $stmt_cesig->bindValue(':apellido2', $apellidosExtraidos[1], PDO::PARAM_STR);
        } else {
            $stmt_cesig->bindValue(':apellido2', NULL, PDO::PARAM_STR);
        }

        // Agrego cuit
        $cuilSinGuiones = preg_replace('/-/', '', $registro_coessfe->getCuil());
        $stmt_cesig->bindValue(':cuit', $cuilSinGuiones, PDO::PARAM_STR);

        // Agrego mail
        $stmt_cesig->bindValue(':mailoficial', $registro_coessfe->getEmail(), PDO::PARAM_STR);

        // Agrego nombres
        // Como los nombres en cesig se guardan cada uno por columna se debe dividir la columna "nombres" que tomamos de los empleados de coessfe

        // Dividir el nombre completo en otros nombres
        $nombres = explode(' ', $registro_coessfe->getNombres());

        // Tomar hasta 3 nombres
        $nombresExtraidos = array_slice($nombres, 0, 3);

        // Agrego nombre1
        $stmt_cesig->bindValue(':nombre1', $nombresExtraidos[0], PDO::PARAM_STR);

        // Agrego nombre2
        // Si no tiene segundo nombre se guarda como null
        if (isset($nombresExtraidos[1]) && !empty($nombresExtraidos[1])) {
            $stmt_cesig->bindValue(':nombre2', $nombresExtraidos[1], PDO::PARAM_STR);
        } else {
            $stmt_cesig->bindValue(':nombre2', NULL, PDO::PARAM_STR);
        }

        // Agrego nombre3
        // Si no tiene segundo nombre se guarda como null
        if (isset($nombresExtraidos[2]) && !empty($nombresExtraidos[2])) {
            $stmt_cesig->bindValue(':nombre3', $nombresExtraidos[2], PDO::PARAM_STR);
        } else {
            $stmt_cesig->bindValue(':nombre3', NULL, PDO::PARAM_STR);
        }

        // Agrego sexo
        $stmt_cesig->bindValue(':sexo', $registro_coessfe->getSexo(), PDO::PARAM_STR);

        // Agrego fecha nacimiento
        $stmt_cesig->bindValue(':fechanacimiento', $registro_coessfe->getFechaNacimiento(), PDO::PARAM_STR);

        // Agrego id tipo documento
        $stmt_cesig->bindValue(':idtipodoc', $registro_coessfe->getCodTipoDocumento(), PDO::PARAM_STR);

        // Agrego numero de documento
        $stmt_cesig->bindValue(':numerodocumento', $registro_coessfe->getNroDocumento(), PDO::PARAM_STR);

        // Agrego id estado civil
        $stmt_cesig->bindValue(':idestadocivil', $registro_coessfe->getIdEstadoCivil(), PDO::PARAM_STR);

        //Ejecuto el insert en pad_empleado
        $stmt_cesig->execute();

        $idpersona = $stmt_cesig->fetchColumn();

        // Verificar si la insercion fue exitosa y muestro los datos que han sido insertados
        $select_pad_empleado = "SELECT * FROM pad_persona WHERE numerodocumento = :numerodocumento";
        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_empleado);
        $stmt_cesig->bindValue(':numerodocumento', $registro_coessfe->getNroDocumento(), PDO::PARAM_STR);
        $stmt_cesig->execute();

        echo " => EMPLEADO CARGADO CON EXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL;

        $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultados as $fila) {
            foreach ($fila as $nombre_columna => $valor) {
                echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
            }
        }

        return $idpersona;

    }

    private function cargarEmpleadoTablaSegUsuario($registro_coessfe){
        echo ('    => CARGANDO ESCRIBANO EN TABLA seg_usuario');

        $insert_seg_usuario = "INSERT INTO seg_usuario(id,creationtimestamp, creationuser, deleted, modificationtimestamp,modificationuser, versionnumber, accountlocked, email, fechaalta, fechabaja, fullname, username, verifiedemail) VALUES(nextval('seg_usuario_id_seq'::regclass), NOW(), 'dummyuser', '0', NOW(),'dummyuser', '0', '0', :email, NOW(), NULL, :fullname, :username, '0') RETURNING id";
        $stmt_cesig = $this->conexion_cesig->prepare($insert_seg_usuario);

        // Email
        if ($registro_coessfe->getEmail() != NULL and $registro_coessfe->getEmail() != '') {
            $email = $registro_coessfe->getEmail();
        } else {
            $email = "Sin registro";
        }

        //fecha baja null

        // fullname
        // se deben concatenar los apellidos y los nombres del escribano para 
        // la columna fullname

        // Apellido 1
        $fullname = $registro_coessfe->getApellidos() . ", " . $registro_coessfe->getNombres();

        // username
        // si no se tiene un CUIL registrado se utiliza el DNI para la columna username
        if ($registro_coessfe->getCuil() != NULL and $registro_coessfe->getCuil() != '') {
            $username = strval($registro_coessfe->getCuil());
            $username = str_replace('-', '', $username); //cuit sin guiones
        } else if ($registro_coessfe->getNroDocumento() != NULL and $registro_coessfe->getNroDocumento() != '') {
            $username = $registro_coessfe->getNroDocumento();
        }

        $stmt_cesig->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt_cesig->bindValue(':fullname', $fullname, PDO::PARAM_STR);
        $stmt_cesig->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt_cesig->execute();

        // Me guardo el id del usuario insertado
        $idusuario = $stmt_cesig->fetchColumn();

        // Verificar si la insercion fue exitosa y muestro los datos que han sido insertados
        $select_pad_empleado = "SELECT * FROM seg_usuario WHERE id = :id";
        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_empleado);
        $stmt_cesig->bindValue(':id', $idusuario, PDO::PARAM_STR);
        $stmt_cesig->execute();

        echo " => ESCRIBANO CARGADO CON EXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL;

        $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultados as $fila) {
            foreach ($fila as $nombre_columna => $valor) {
                echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
            }
        }

        // Esta funcion debe retornar dos valores, se utiliza un array
        $id_username = array('idusuario' => $idusuario, 'username' => $username);

        return $id_username;
    }

    private function cargarEmpleadoSegPerfil($id_username, $idpersona, $idempleado){
        echo ('    => CARGANDO EMPLEADO EN TABLA seg_perfil');

        $insert_empleado_seg_usuario = "INSERT INTO seg_perfil(creationtimestamp,creationuser,deleted,modificationtimestamp,modificationuser,versionnumber,userapl,idempleado,idescribano,idexterno,idpersona,idusuario)
                VALUES (NOW(),'dummyuser',FALSE,NOW(),'dummyuser',0,:userapl,:idempleado,NULL,NULL,:idpersona,:idusuario) RETURNING id";
        $stmt_cesig = $this->conexion_cesig->prepare($insert_empleado_seg_usuario);

        $userapl = $id_username['username'] . "-Empleado";

        $stmt_cesig->bindValue(":userapl", $userapl, PDO::PARAM_STR);
        $stmt_cesig->bindValue(":idempleado", $idempleado, PDO::PARAM_STR);
        $stmt_cesig->bindValue(":idpersona", $idpersona, PDO::PARAM_STR);
        $stmt_cesig->bindValue(":idusuario", $id_username['idusuario'], PDO::PARAM_STR);
        $stmt_cesig->execute();

        $idperfil = $stmt_cesig->fetchColumn();

        // Verificar si la insercion fue exitosa y muestro los datos que han sido insertados
        $select_seg_perfil = "SELECT * FROM seg_perfil WHERE id = :id";
        $stmt_cesig = $this->conexion_cesig->prepare($select_seg_perfil);
        $stmt_cesig->bindValue(':id', $idperfil, PDO::PARAM_STR);
        $stmt_cesig->execute();

        echo " => EMPLEADO CARGADO CON EXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL;

        $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultados as $fila) {
            foreach ($fila as $nombre_columna => $valor) {
                echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
            }
        }
    }

    private function actualizarRegistroPadEmpleado($registro_cesig,$registro_coessfe)
    {
        echo ('    => ANALIZANDO TABLA pad_empleado');

        $datos_a_actualizar = array();
        $columnas_a_actualizar = array();

        // Comparo tituloprofesional
        if ($registro_cesig['tituloprofesional'] != $registro_coessfe->getTitulo()) {
            if ($registro_coessfe->getTitulo() == NULL) {
                array_push($datos_a_actualizar, array($registro_cesig['tituloprofesional'], NULL));
                array_push($columnas_a_actualizar, 'tituloprofesional');
            }
        }

        // Comparo fecha antiguedad
        if ($registro_cesig['fechaaltaantiguedad'] != $registro_coessfe->getFechaIngreso()) {
            array_push($datos_a_actualizar, array($registro_cesig['fechaaltaantiguedad'], $registro_coessfe->getFechaIngreso()));
            array_push($columnas_a_actualizar, 'fechaaltaantiguedad');
        }

        // Si se encontraron diferencias se realiza un UPDATE para actualizar los cambios
        if (count($datos_a_actualizar) != 0) {
            // Genero la sentencia para actualizar los datos que se modificaron

            $insert_pad_empleado_update = "UPDATE pad_empleado SET ";

            echo (" => DATOS A ACTUALIZAR: " . PHP_EOL . PHP_EOL);

            for ($i = 0; $i < count($datos_a_actualizar); $i++) {

                if (is_int($datos_a_actualizar[$i][1])) {
                    $insert_pad_empleado_update = $insert_pad_empleado_update . $columnas_a_actualizar[$i] . " = " . intval($datos_a_actualizar[$i][1]) . ",";
                } else {
                    $insert_pad_empleado_update = $insert_pad_empleado_update . $columnas_a_actualizar[$i] . " = '" . $datos_a_actualizar[$i][1] . "',";
                }

                echo ("        -> " . $columnas_a_actualizar[$i] . " -> valor actual = " . $datos_a_actualizar[$i][0] . " -> valor nuevo = " . $datos_a_actualizar[$i][1] . PHP_EOL . PHP_EOL);

            }

            $insert_pad_empleado_update = substr($insert_pad_empleado_update, 0, -1);

            $insert_pad_empleado_update = $insert_pad_empleado_update . " WHERE legajo = '" . $registro_coessfe->getLegajo() . "'";

            $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_empleado_update);

            $stmt_cesig->execute();

            echo "    => TABLA pad_empleado ACTUALIZADO CON EXITO" . PHP_EOL . PHP_EOL;

        } else {
            echo (' => NO SE ENCONTRARON CAMBIOS' . PHP_EOL . PHP_EOL);
        }

    }

    private function actualizarRegistroPadPersona($registro_cesig,$registro_coessfe)
    {
        echo ('    => ANALIZANDO TABLA pad_persona');

        $datos_a_actualizar = array();
        $columnas_a_actualizar = array();

        // Comparo apellidos
        // Como los apellidos en cesig se guardan cada uno por columna se deben dividir la columna "apellidos" que tomamos de los empleados de coessfe

        // Dividir el apellido completo en otros apellidos
        $apellidos = explode(' ', $registro_coessfe->getApellidos());

        // Tomar hasta 2 apellidos
        $apellidosExtraidos = array_slice($apellidos, 0, 2);

        // Comparo apellido1

        if (
            isset($registro_cesig['apellido1']) &&
            is_array($apellidosExtraidos) &&
            isset($apellidosExtraidos[0]) &&
            $registro_cesig['apellido1'] != $apellidosExtraidos[0]
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['apellido1'], $apellidosExtraidos[0]));
            array_push($columnas_a_actualizar, 'apellido1');
        }

        // Comparo apellido2
        if (
            isset($apellidosExtraidos[1]) && !empty($apellidosExtraidos[1]) &&
            isset($registro_cesig['apellido2']) &&
            $registro_cesig['apellido2'] != $apellidosExtraidos[1]
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['apellido2'], $apellidosExtraidos[1]));
            array_push($columnas_a_actualizar, 'apellido2');
        }

        // Comparo cuit (a evaluar)

        // Comparo mail
        if (
            isset($registro_cesig['mailoficial']) && $registro_coessfe->getEMail() != NULL &&
            $registro_cesig['mailoficial'] != $registro_coessfe->getEMail()
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['mailoficial'], $registro_coessfe->getEMail()));
            array_push($columnas_a_actualizar, 'mailoficial');
        }

        // Comparo nombres
        // Como los nombres en cesig se guardan cada uno por columna se debe dividir la columna "nombres" que tomamos de los empleados de coessfe
        // Dividir el nombre completo en otros nombres
        $nombres = explode(' ', $registro_coessfe->getNombres());
        // Tomar hasta 3 nombres
        $nombresExtraidos = array_slice($nombres, 0, 3);

        // Comparo nombre1
        if (
            isset($registro_cesig['nombre1']) &&
            $registro_cesig['nombre1'] != $nombresExtraidos[0]
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['nombre1'], $nombresExtraidos[0]));
            array_push($columnas_a_actualizar, 'nombre1');
        }

        // Comparo nombre2
        if (
            isset($nombresExtraidos[1]) && !empty($nombresExtraidos[1]) &&
            isset($registro_cesig['nombre2']) &&
            $registro_cesig['nombre2'] != $nombresExtraidos[1]
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['nombre2'], $nombresExtraidos[1]));
            array_push($columnas_a_actualizar, 'nombre2');
        }

        // Comparo nombre3
        if (
            isset($nombresExtraidos[2]) && !empty($nombresExtraidos[2]) &&
            isset($registro_cesig['nombre3']) &&
            $registro_cesig['nombre3'] != $nombresExtraidos[2]
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['nombre3'], $nombresExtraidos[2]));
            array_push($columnas_a_actualizar, 'nombre3');
        }

        // Comparo sexo
        if (
            isset($registro_cesig['sexo']) && $registro_coessfe->getSexo() != NULL &&
            $registro_cesig['sexo'] != $registro_coessfe->getSexo()
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['sexo'], $registro_coessfe->getSexo()));
            array_push($columnas_a_actualizar, 'sexo');
        }

        // Comparo fecha nacimiento
        if (
            isset($registro_cesig['fechanacimiento']) && $registro_coessfe->getFechaNacimiento() &&
            $registro_cesig['fechanacimiento'] != $registro_coessfe->getFechaNacimiento()
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['fechanacimiento'], $registro_coessfe->getFechaNacimiento()));
            array_push($columnas_a_actualizar, 'fechanacimiento');
        }

        // Comparo id tipo documento
        if (
            isset($registro_cesig['idtipodoc']) && $registro_coessfe->getCodTipoDocumento() &&
            $registro_cesig['idtipodoc'] != $registro_coessfe->getCodTipoDocumento()
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['idtipodoc'], $registro_coessfe->getCodTipoDocumento()));
            array_push($columnas_a_actualizar, 'idtipodoc');
        }

        // Comparo id estado civil
        if (
            isset($registro_cesig['idestadocivil']) && $registro_coessfe->getIdEstadoCivil() &&
            $registro_cesig['idestadocivil'] != $registro_coessfe->getIdEstadoCivil()
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['idestadocivil'], $registro_coessfe->getIdEstadoCivil()));
            array_push($columnas_a_actualizar, 'idestadocivil');
        }

        // Si se encontraron diferencias se realiza un UPDATE para actualizar los cambios
        if (count($datos_a_actualizar) != 0) {
            // Genero la sentencia para actualizar los datos que se modificaron

            $insert_pad_persona_update = "UPDATE pad_persona SET ";

            echo (" => DATOS A ACTUALIZAR: " . PHP_EOL . PHP_EOL);

            for ($i = 0; $i < count($datos_a_actualizar); $i++) {

                if (is_int($datos_a_actualizar[$i][1])) {
                    $insert_pad_persona_update = $insert_pad_persona_update . $columnas_a_actualizar[$i] . " = " . intval($datos_a_actualizar[$i][1]) . ",";
                } else {
                    $insert_pad_persona_update = $insert_pad_persona_update . $columnas_a_actualizar[$i] . " = '" . $datos_a_actualizar[$i][1] . "',";
                }

                if ($datos_a_actualizar[$i][0] && $datos_a_actualizar[$i][0]) {
                    echo ("        -> " . $columnas_a_actualizar[$i] . " -> valor actual = " . $datos_a_actualizar[$i][0] . " -> valor nuevo = " . $datos_a_actualizar[$i][1] . PHP_EOL . PHP_EOL);
                }


            }

            $insert_pad_persona_update = substr($insert_pad_persona_update, 0, -1);

            $insert_pad_persona_update = $insert_pad_persona_update . " WHERE numerodocumento = '" . $registro_coessfe->getLegajo() . "'";

            $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_persona_update);

            $stmt_cesig->execute();

            echo "    => TABLA pad_persona ACTUALIZADA CON EXITO " . PHP_EOL . PHP_EOL;

        } else {
            echo (' => NO SE ENCONTRARON CAMBIOS' . PHP_EOL . PHP_EOL);
        }

    }

}

?>