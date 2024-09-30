<?php

require "modelos\m_cesig\m_cesig_pad_escribano.php";

class c_cesig_escribanos
{
    private $m_coessfe_sec_padron_escribanos;

    private $m_coessfe_sec_licencias;

    private $m_coessfe_sec_antecedentes_o_sanciones;

    private $conexion_cesig;
    private $conexion_coessfe;

    public function __construct(&$m_coessfe_sec_padron_escribanos, &$conexion_cesig, &$conexion_coessfe)
    {
        $this->m_coessfe_sec_padron_escribanos = &$m_coessfe_sec_padron_escribanos;
        $this->conexion_cesig = &$conexion_cesig;
        $this->conexion_coessfe = &$conexion_coessfe;
        $this->determinarUsuariosActivos();
    }

    private function determinarUsuariosActivos()
    {

        // Realizo una consulta para seleccionar los escribanos que son usuarios activos de coessfe
        $select_sec_padron_escribanos =
            "
            SELECT *
            FROM sec_padron_escribanos
            INNER JOIN sec_registros_y_funciones ON sec_padron_escribanos.matricula = sec_registros_y_funciones.matricula
            INNER JOIN sec_funciones ON sec_registros_y_funciones.cod_funcion = sec_funciones.cod_funcion
            WHERE sec_registros_y_funciones.hasta_fecha IS NULL
            AND sec_funciones.activo = 1
            ORDER BY sec_padron_escribanos.matricula;
        ";
        $stmt_coessfe = $this->conexion_coessfe->prepare($select_sec_padron_escribanos);
        $stmt_coessfe->execute();
        $usuarios_activos_sec_padron_escribanos = $stmt_coessfe->fetchAll(PDO::FETCH_ASSOC);

        // Itero sobre todo el padron de escribanos para determinar cuales son usuarios activos
        for ($i = 0; $i < count($this->m_coessfe_sec_padron_escribanos); $i++) {

            for ($j = 0; $j < count($usuarios_activos_sec_padron_escribanos); $j++) {
                if ($this->m_coessfe_sec_padron_escribanos[$i]->getMatricula() == $usuarios_activos_sec_padron_escribanos[$j]['matricula']) {
                    $this->m_coessfe_sec_padron_escribanos[$i]->setUsuarioCesig(true);
                }
            }

            // Se define al escribano como usuario no activo si este no se encuentra en la lista de usuarios
            if ($this->m_coessfe_sec_padron_escribanos[$i]->getUsuarioCesig() != true) {
                $this->m_coessfe_sec_padron_escribanos[$i]->setUsuarioCesig(false);
            }

        }

    }

    public function analizarEscribanos()
    {
        echo ("=> INICIO PROCESO CARGA/ACTUALIZACIÓN DE ESCRIBANOS TABLAS pad_persona/pad_escribano/seg_usuario/seg_perfil" . PHP_EOL . PHP_EOL);

        for ($i = 0; $i < count($this->m_coessfe_sec_padron_escribanos); $i++) {

            echo (' => ANALIZANDO ESCRIBANO MATRÍCULA ' . $this->m_coessfe_sec_padron_escribanos[$i]->getMatricula() . PHP_EOL);

            try {

                // Primero valido que tenga DNI o CUIT, si no, no se hace nada

                if (($this->m_coessfe_sec_padron_escribanos[$i]->getNroDocumento() == '' and $this->m_coessfe_sec_padron_escribanos[$i]->getCuit() == '') or ($this->m_coessfe_sec_padron_escribanos[$i]->getNroDocumento() == NULL and $this->m_coessfe_sec_padron_escribanos[$i]->getCuit() == '') or ($this->m_coessfe_sec_padron_escribanos[$i]->getNroDocumento() == '' and $this->m_coessfe_sec_padron_escribanos[$i]->getCuit() == NULL)) {
                    throw new Exception('Error. El Escribano no tiene registrado ningún DNI o CUIT');
                }

                // Verifico si el escribano es un usuario activo
                // Caso afirmativo se analisa como usuario activa
                // Caso contrario se analisa como usuario no activo

                if ($this->m_coessfe_sec_padron_escribanos[$i]->getUsuarioCesig() == true) {

                    echo (' => EL ESCRIBANO ES USUARIO ACTIVO' . PHP_EOL);

                    // Se selecciona el ESCRIBANO segun su matricula de la tabla pad_escribano
                    $select_pad_escribano = "SELECT * FROM pad_escribano WHERE matricula = :matricula LIMIT 1";
                    $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribano);
                    $stmt_cesig->bindValue(':matricula', $this->m_coessfe_sec_padron_escribanos[$i]->getMatricula(), PDO::PARAM_STR);
                    $stmt_cesig->execute();
                    $registro_cesig_pad_escribano = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                    // Comprobamos si la consulta arrojo resultados
                    if ($stmt_cesig->rowCount() > 0) {

                        // Si la consulta tiene resultado significa que el escribano ya esta cargado en cesig
                        // Se procede a analizar cambios en las tablas correspondientes del escribano

                        echo (' => EL ESCRIBANO SE ENCUENTRA CARGADO EN CESIG');

                        // Se selecciona el escribano segun su id en la tabla seg_perfil
                        $select_seg_perfil = "SELECT * FROM seg_perfil WHERE idescribano = :idescribano";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_seg_perfil);
                        $stmt_cesig->bindValue("idescribano", $registro_cesig_pad_escribano['id'], PDO::PARAM_STR);
                        $stmt_cesig->execute();

                        // Si esta consulta no arroja resultados significa que el escribano fue dado de alta como usuario activo de cesig
                        // caso contrario se verifican cambios en las tablas pertinentes

                        echo (' => VERIFICANDO ALTA DE USUARIO ACTIVO');

                        if ($stmt_cesig->rowCount() > 0) {

                            echo (' => ALTA CONFIRMADA => ACTUALIZANDO DATOS DE ESCRIBANO' . PHP_EOL . PHP_EOL);

                            $select_pad_persona = "SELECT * FROM pad_persona WHERE ";

                            // formatear cuit
                            $cuit = substr($this->m_coessfe_sec_padron_escribanos[$i]->getCuit(), 3, strlen($this->m_coessfe_sec_padron_escribanos[$i]->getCuit()) - 5);

                            // Consulto registro en tabla pad_persona segun dni o cuit
                            if($this->m_coessfe_sec_padron_escribanos[$i]->getNroDocumento() != '' AND $this->m_coessfe_sec_padron_escribanos[$i]->getNroDocumento() != NULL){
                                
                                $select_pad_persona = "SELECT * FROM pad_persona WHERE numerodocumento = :numerodocumento";
                                $stmt_cesig = $this->conexion_cesig->prepare($select_pad_persona);
                                $stmt_cesig->bindValue(':numerodocumento', $this->m_coessfe_sec_padron_escribanos[$i]->getNroDocumento(), PDO::PARAM_STR);
                                $stmt_cesig->execute();
                                $registro_cesig_pad_persona = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                            } elseif ($this->m_coessfe_sec_padron_escribanos[$i]->getCuit() != '' AND $this->m_coessfe_sec_padron_escribanos[$i]->getCuit() != NULL) {
                                
                                $select_pad_persona = "SELECT * FROM pad_persona WHERE cuit = :cuit";
                                $stmt_cesig = $this->conexion_cesig->prepare($select_pad_persona);
                                $stmt_cesig->bindValue(':cuit', $cuit, PDO::PARAM_STR);
                                $stmt_cesig->execute();
                                $registro_cesig_pad_persona = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                            }

                            //actualizo tablas
                            $this->actualizarEscribanoRegistroPadPersona($registro_cesig_pad_persona, $this->m_coessfe_sec_padron_escribanos[$i]);
                            $this->actualizarEscribanoRegistroPadEscribano($registro_cesig_pad_escribano, $this->m_coessfe_sec_padron_escribanos[$i]);

                        } else {

                            echo (' => NO HA SIDO DADO DE ALTA COMO USUARIO => CARGANDO ALTA DE USUARIO ACTIVO' . PHP_EOL . PHP_EOL);

                            //cargo como usuario activo
                            $idpersona = $this->cargarEscribanoTablaPadPersona($this->m_coessfe_sec_padron_escribanos[$i]);
                            $id_username = $this->cargarEscribanoTablaSegUsuario($this->m_coessfe_sec_padron_escribanos[$i]);
                            $id_escribano = $registro_cesig_pad_escribano['id'];
                            $this->cargarEscribanoSegPerfil($id_username, $idpersona, $id_escribano);
                            //actualizo tabla restante

                            echo(' => ACTUALIZANDO TABLAS RESTANTES' . PHP_EOL . PHP_EOL);

                            $this->actualizarEscribanoRegistroPadEscribano($registro_cesig_pad_escribano, $this->m_coessfe_sec_padron_escribanos[$i]);
                        }

                    } else {

                        // Si la consulta no arroja resultados significa que el empleado no esta cargado en cesig, se procede cargarlo
                        // Llamo a las funciones que carga los registros en las tablas pertinentes segun el indice de iteración

                        echo (' => EL ESCRIBANO NO SE ENCUENTRA CARGADO EN CESIG' . PHP_EOL . PHP_EOL);

                        $idpersona = $this->cargarEscribanoTablaPadPersona($this->m_coessfe_sec_padron_escribanos[$i]);
                        $idescribano = $this->cargarEscribanoTablaPadEscribano($this->m_coessfe_sec_padron_escribanos[$i]);
                        $id_username = $this->cargarEscribanoTablaSegUsuario($this->m_coessfe_sec_padron_escribanos[$i]);
                        $this->cargarEscribanoSegPerfil($id_username, $idpersona, $idescribano);

                    }
                } else {

                    echo (' => El ESCRIBANO NO ES USUARIO ACTIVO ' . PHP_EOL . PHP_EOL);

                    // Se selecciona el ESCRIBANO segun su matricula de la tabla pad_escribano
                    $select_pad_escribano = "SELECT * FROM pad_escribano WHERE matricula = :matricula LIMIT 1";
                    $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribano);
                    $stmt_cesig->bindValue(':matricula', $this->m_coessfe_sec_padron_escribanos[$i]->getMatricula(), PDO::PARAM_STR);
                    $stmt_cesig->execute();
                    $registro_cesig_pad_escribano = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                    // Comprobamos si la consulta arrojo resultados
                    if ($stmt_cesig->rowCount() > 0) {

                        // Si la consulta tiene resultado significa que el escribano ya esta cargado en cesig
                        // Se procede a analizar cambios en las tablas correspondientes del escribano

                        $this->actualizarEscribanoRegistroPadEscribano($registro_cesig_pad_escribano, $this->m_coessfe_sec_padron_escribanos[$i]);

                    } else {

                        // Si la consulta no arroja resultados significa que el empleado no esta cargado en cesig, se procede cargarlo
                        // Llamo a las funciones que carga los registros en las tablas pertinentes segun el indice de iteración

                        $this->cargarEscribanoTablaPadEscribano($this->m_coessfe_sec_padron_escribanos[$i]);
                    }

                }

            } catch (PDOException $e) {
                $mensaje = $e->getMessage();

                if ($mensaje === 'Error. El Escribano no tiene registrado ningun DNI o CUIT') {
                    echo " => " . $mensaje . PHP_EOL . PHP_EOL;
                } else {
                    // Capturamos cualquier excepcion que pueda ocurrir durante la ejecucion de las consultas
                    echo " => Error en la consulta: " . $e->getMessage() . PHP_EOL . PHP_EOL;
                }
            }
        }
        echo ("=> FIN PROCESO CARGA/ACTUALIZACIÓN DE ESCRIBANOS" . PHP_EOL . PHP_EOL);
    }

    private function cargarEscribanoTablaPadEscribano($registro_coessfe)
    {
        echo ('    => CARGANDO ESCRIBANO EN TABLA pad_escribano');

        // Preparo la sentencia INSERT que registrara al escribano en cesig

        $insert_pad_escribano = "INSERT INTO public.pad_escribano(id, creationtimestamp, creationuser, deleted, modificationtimestamp, modificationuser, versionnumber, matricula, credencial, fechacredencial, idtituloprofesional, fechatituloprofesional, tituloexpedidopor, fechamatricula, casillerorgr, agenteretencionsellos, observacion1, observacion2)
        VALUES(nextval('pad_escribano_id_seq'::regclass), NOW(), 'dummyuser', false, NOW(), 'dummyuser', 0, :matricula, :credencial, NULL, :idtituloprofesional, :fechatituloprofesional, :tituloexpedidopor, :fechamatricula, 0, NULL, NULL, NULL) RETURNING id";

        $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_escribano);

        // Agrego "matricula"
        $stmt_cesig->bindValue(':matricula', $registro_coessfe->getMatricula(), PDO::PARAM_STR);

        // Agrego "credencial"
        // Si es null se carga como tal, si no, se convierte el valor a entero
        if ($registro_coessfe->getCredencial() == "") {
            $stmt_cesig->bindValue(':credencial', NULL, PDO::PARAM_STR);
        } else {
            $stmt_cesig->bindValue(':credencial', intval($registro_coessfe->getCredencial()), PDO::PARAM_STR);
        }

        // Agrego "idtituloprofesional" (EN REBICION)
        // Por ahora validar que el tipo de profesional no sea igual a 4,
        // caso contrario se carga con 0
        if ($registro_coessfe->getCodTitulo() != 4) {
            $stmt_cesig->bindValue(':idtituloprofesional', $registro_coessfe->getCodTitulo(), PDO::PARAM_STR);
        } else {
            $stmt_cesig->bindValue(':idtituloprofesional', 0, PDO::PARAM_STR);
        }

        //Agrego "fechatituloprofesional"
        $stmt_cesig->bindValue(':fechatituloprofesional', $registro_coessfe->getFechaTitulo(), PDO::PARAM_STR);

        //Agrego "tituloexpedidopor"
        $stmt_cesig->bindValue(':tituloexpedidopor', $registro_coessfe->getExpedido(), PDO::PARAM_STR);

        // Agrego "fechamatricula"
        $stmt_cesig->bindValue(':fechamatricula', $registro_coessfe->getFechaMatricula(), PDO::PARAM_STR);

        //Ejecuto el insert en pad_escribanos
        $stmt_cesig->execute();

        // Guardo el id del escribano insertado
        $idescribano = $stmt_cesig->fetchColumn();

        // Consultos los datos cargados y los muestro en pantalla
        $select_pad_escribano = "SELECT * FROM pad_escribano WHERE id = :id";
        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribano);
        $stmt_cesig->bindValue(':id', $idescribano, PDO::PARAM_STR);
        $stmt_cesig->execute();

        echo " => REGISTRADO CON ÉXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL;

        // Muestro datos cargados
        $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultados as $fila) {
            foreach ($fila as $nombre_columna => $valor) {
                echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
            }
        }

        return $idescribano;

    }

    private function cargarEscribanoTablaPadPersona($registro_coessfe)
    {
        echo ('    => CARGANDO ESCRIBANO EN TABLA pad_persona');

        // Preparo la sentencia INSERT que registrara al Escribano en cesig

        $insert_pad_persona = "INSERT INTO public.pad_persona(id, creationtimestamp, creationuser, deleted, modificationtimestamp, modificationuser, versionnumber, apellido1, apellido2, cuit, mailoficial, nombre1, nombre2, nombre3, razonsocial, sexo, apellidonombreconyuge, localidadnacimiento, idpaisnacimiento, fechanacimiento, idtipodoc, numerodocumento, ingresosbrutos, idcondicioniva)
        VALUES(nextval('pad_persona_id_seq'::regclass), NOW(), 'dummyuser', FALSE, NOW(), 'dummyuser', 0, :apellido1, :apellido2, :cuit, :mailoficial, :nombre1, :nombre2, :nombre3, NULL, :sexo, NULL, '', 263, :fechanacimiento, :idtipodoc, :numerodocumento, NULL, 0) RETURNING id";

        $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_persona);

        // Agrego apellido1 
        $stmt_cesig->bindValue(':apellido1', $registro_coessfe->getApellido1(), PDO::PARAM_STR);

        // Agrego apellido2
        $stmt_cesig->bindValue(':apellido2', $registro_coessfe->getApellido2(), PDO::PARAM_STR);

        // Agrego cuit, hay que convertirlo al formato deseado
        $cuit = $registro_coessfe->getCuit();
        if ($registro_coessfe->getCuit() != '' and $registro_coessfe->getCuit() != NULL) {
            $cuit = intval(str_replace('-', '', $cuit)); //cuit sin guiones, y convertido a entero
            $stmt_cesig->bindValue(':cuit', $cuit, PDO::PARAM_INT);
        } else {
            $stmt_cesig->bindValue(':cuit', NULL, PDO::PARAM_INT);
        }

        // Agrego mail
        $stmt_cesig->bindValue(':mailoficial', $registro_coessfe->getEmail(), PDO::PARAM_STR);

        // Agrego nombre1
        $stmt_cesig->bindValue(':nombre1', $registro_coessfe->getNombre1(), PDO::PARAM_STR);

        // Agrego nombre2
        $stmt_cesig->bindValue(':nombre2', $registro_coessfe->getNombre2(), PDO::PARAM_STR);

        // Agrego nombre3
        $stmt_cesig->bindValue(':nombre3', $registro_coessfe->getNombre3(), PDO::PARAM_STR);

        // Agrego sexo
        $stmt_cesig->bindValue(':sexo', $registro_coessfe->getSexo(), PDO::PARAM_STR);

        // Agrego fecha nacimiento
        $stmt_cesig->bindValue(':fechanacimiento', $registro_coessfe->getFechaNacimiento(), PDO::PARAM_STR);

        // Agrego id tipo documento
        $stmt_cesig->bindValue(':idtipodoc', $registro_coessfe->getCodTipoDoc(), PDO::PARAM_STR);

        // Agrego numero de documento
        $stmt_cesig->bindValue(':numerodocumento', $registro_coessfe->getNroDocumento(), PDO::PARAM_STR);

        //Ejecuto el insert en pad_empleado
        $stmt_cesig->execute();

        // Me guardo el id de pad persona
        $idpersona = $stmt_cesig->fetchColumn();

        // Verificar si la insercion fue exitosa y muestro los datos que han sido insertados
        $select_pad_empleado = "SELECT * FROM pad_persona WHERE id = :id";
        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_empleado);
        $stmt_cesig->bindValue(':id', $idpersona, PDO::PARAM_STR);
        $stmt_cesig->execute();

        echo " => ESCRIBANO CARGADO CON EXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL;

        $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultados as $fila) {
            foreach ($fila as $nombre_columna => $valor) {
                echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
            }
        }

        return $idpersona;

    }

    private function cargarEscribanoTablaSegUsuario($registro_coessfe)
    {
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
        $fullname = $registro_coessfe->getApellido1();
        // Apellido 2
        if ($registro_coessfe->getApellido2() != NULL) {
            $fullname = $fullname . " " . $registro_coessfe->getApellido2();
        }
        // Nombre 1
        $fullname = $fullname . ", " . $registro_coessfe->getNombre1();
        // Nombre 2
        if ($registro_coessfe->getNombre2() != NULL) {
            $fullname = $fullname . " " . $registro_coessfe->getNombre2();
        }
        // Nombre 3
        if ($registro_coessfe->getNombre3() != NULL) {
            $fullname = $fullname . " " . $registro_coessfe->getNombre3();
        }

        // username
        // si no se tiene un CUIL registrado se utiliza el DNI para la columna username
        if ($registro_coessfe->getCuit() != NULL and $registro_coessfe->getCuit() != '') {
            $username = strval($registro_coessfe->getCuit());
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

    private function cargarEscribanoSegPerfil($id_username,$idpersona,$idescribano)
    {

        echo ('    => CARGANDO ESCRIBANO EN TABLA seg_perfil');

        $insert_escribano_seg_usuario = "INSERT INTO seg_perfil(creationtimestamp,creationuser,deleted,modificationtimestamp,modificationuser,versionnumber,userapl,idempleado,idescribano,idexterno,idpersona,idusuario)
                VALUES (NOW(),'dummyuser',FALSE,NOW(),'dummyuser',0,:userapl,NULL,:idescribano,NULL,:idpersona,:idusuario) RETURNING id";
        $stmt_cesig = $this->conexion_cesig->prepare($insert_escribano_seg_usuario);

        $userapl = $id_username['username'] . "-Escribano";

        $stmt_cesig->bindValue(":userapl", $userapl, PDO::PARAM_STR);
        $stmt_cesig->bindValue(":idescribano", $idescribano, PDO::PARAM_STR);
        $stmt_cesig->bindValue(":idpersona", $idpersona, PDO::PARAM_STR);
        $stmt_cesig->bindValue(":idusuario", $id_username['idusuario'], PDO::PARAM_STR);
        $stmt_cesig->execute();

        $idperfil = $stmt_cesig->fetchColumn();

        // Verificar si la insercion fue exitosa y muestro los datos que han sido insertados
        $select_pad_empleado = "SELECT * FROM seg_perfil WHERE id = :id";
        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_empleado);
        $stmt_cesig->bindValue(':id', $idperfil, PDO::PARAM_STR);
        $stmt_cesig->execute();

        echo " => ESCRIBANO CARGADO CON EXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL;

        $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultados as $fila) {
            foreach ($fila as $nombre_columna => $valor) {
                echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
            }
        }

    }

    private function actualizarEscribanoRegistroPadEscribano($registro_cesig,$registro_coessfe)
    {
        echo ('    => ANALIZANDO TABLA pad_escribano');

        $datos_a_actualizar = array();
        $columnas_a_actualizar = array();

        // Comparo credencial
        if ($registro_cesig['credencial'] != $registro_coessfe->getCredencial()) {
            array_push($datos_a_actualizar, array($registro_cesig['credencial'], $registro_coessfe->getCredencial()));
            array_push($columnas_a_actualizar, 'credencial');
        }

        // Comparo idtituloprofesional (no tiene que ser igual que 4 por ahora)
        if ($registro_cesig['idtituloprofesional'] != $registro_coessfe->getCodTitulo() and $registro_coessfe->getCodTitulo() != 4) {
            array_push($datos_a_actualizar, array($registro_cesig['idtituloprofesional'], $registro_coessfe->getCodTitulo()));
            array_push($columnas_a_actualizar, 'idtituloprofesional');
        }

        // Comparo fecha del titulo
        if ($registro_cesig['fechatituloprofesional'] != $registro_coessfe->getFechaTitulo()) {
            array_push($datos_a_actualizar, array($registro_cesig['fechatituloprofesional'], $registro_coessfe->getFechaTitulo()));
            array_push($columnas_a_actualizar, 'fechatituloprofesional');
        }

        // Comparo expedido del titulo
        if ($registro_cesig['tituloexpedidopor'] != $registro_coessfe->getExpedido()) {
            array_push($datos_a_actualizar, array($registro_cesig['tituloexpedidopor'], $registro_coessfe->getExpedido()));
            array_push($columnas_a_actualizar, 'tituloexpedidopor');
        }

        // Comparo fecha de matricula
        if ($registro_cesig['fechamatricula'] != $registro_coessfe->getFechaMatricula()) {
            array_push($datos_a_actualizar, array($registro_cesig['fechamatricula'], $registro_coessfe->getFechaMatricula()));
            array_push($columnas_a_actualizar, 'fechamatricula');
        }

        // Comparo observaciones (por ahora no)

        // Si se encontraron diferencias se realiza un UPDATE para actualizar los cambios
        if (count($datos_a_actualizar) != 0) {
            // Genero la sentencia para actualizar los datos que se modificaron

            $insert_pad_empleado_update = "UPDATE pad_escribano SET ";

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

            $insert_pad_empleado_update = $insert_pad_empleado_update . " WHERE matricula = '" . $this->m_coessfe_sec_padron_escribanos[$i]->getMatricula() . "'";

            $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_empleado_update);

            $stmt_cesig->execute();

            echo "    => TABLA pad_escribano ACTUALIZADA CON ÉXITO " . PHP_EOL . PHP_EOL;
        } else {
            echo (' => NO SE ENCONTRARON CAMBIOS' . PHP_EOL . PHP_EOL);
        }

    }

    private function actualizarEscribanoRegistroPadPersona($registro_cesig,$registro_coessfe)
    {
        echo ('    => ANALIZANDO TABLA pad_persona');

        $datos_a_actualizar = array();
        $columnas_a_actualizar = array();

        // Comparo apellido1

        if (
            $registro_cesig['apellido1'] != $registro_coessfe->getApellido1()
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['apellido1'], $registro_coessfe->getApellido1()));
            array_push($columnas_a_actualizar, 'apellido1');
        }

        // Comparo apellido2

        if (
            $registro_cesig['apellido2'] != $registro_coessfe->getApellido2()
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['apellido2'], $registro_coessfe->getApellido2()));
            array_push($columnas_a_actualizar, 'apellido2');
        }

        // Comparo mail
        if (
            $registro_cesig['mailoficial'] != $registro_coessfe->getEmail()
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['mailoficial'], $registro_coessfe->Email()));
            array_push($columnas_a_actualizar, 'mailoficial');
        }

        // Comparo nombre1
        if (
            $registro_cesig['nombre1'] != $registro_coessfe->getNombre1()
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['nombre1'], $registro_coessfe->getNombre1()));
            array_push($columnas_a_actualizar, 'nombre1');
        }

        // Comparo nombre2
        if (
            $registro_cesig['nombre2'] != $registro_coessfe->getNombre2()
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['nombre2'], $registro_coessfe->getNombre2()));
            array_push($columnas_a_actualizar, 'nombre2');
        }

        // Comparo nombre3
        if (
            $registro_cesig['nombre3'] != $registro_coessfe->getNombre3()
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['nombre1'], $registro_coessfe->getNombre1()));
            array_push($columnas_a_actualizar, 'nombre1');
        }

        // Comparo sexo
        if (
            $registro_cesig['sexo'] != $registro_coessfe->getSexo()
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['sexo'], $registro_coessfe->getSexo()));
            array_push($columnas_a_actualizar, 'sexo');
        }

        // Comparo fecha nacimiento
        if (
            $registro_cesig['fechanacimiento'] != $registro_coessfe->getFechaNacimiento()
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['fechanacimiento'], $registro_coessfe->getFechaNacimiento()));
            array_push($columnas_a_actualizar, 'fechanacimiento');
        }

        // Comparo id tipo documento
        if (
            $registro_cesig['idtipodoc'] != $registro_coessfe->getCodTipoDoc()
        ) {
            array_push($datos_a_actualizar, array($registro_cesig['idtipodoc'], $registro_coessfe->getCodTipoDoc()));
            array_push($columnas_a_actualizar, 'idtipodoc');
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

            $insert_pad_persona_update = $insert_pad_persona_update . " WHERE numerodocumento = '" . $this->m_coessfe_sec_padron_escribanos[$i]->getNroDocumento() . "'";

            $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_persona_update);

            $stmt_cesig->execute();

            echo "    => TABLA pad_persona ACTUALIZADA CON ÉXITO " . PHP_EOL . PHP_EOL;

        } else {
            echo (' => NO SE ENCONTRARON CAMBIOS' . PHP_EOL . PHP_EOL);
        }

    }

}