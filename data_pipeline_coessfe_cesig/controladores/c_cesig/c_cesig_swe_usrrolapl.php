<?php

class c_cesig_swe_usrrolapl
{
    private $conexion_coessfe;
    private $conexion_coessfe2;
    private $conexion_cesig;

    public function __construct(&$conexion_coessfe, &$conexion_coessfe2, &$conexion_cesig)
    {
        $this->conexion_coessfe = &$conexion_coessfe;
        $this->conexion_coessfe2 = &$conexion_coessfe2;
        $this->conexion_cesig = &$conexion_cesig;
    }

    public function analizarUsrRolApl()
    {

        try {

            echo ("=> INICIO CARGA DE TABLA swe_usrrolapl" . PHP_EOL . PHP_EOL);

            $select_swe_usrapl = "SELECT * FROM swe_usrapl";
            $stmt_cesig = $this->conexion_cesig->prepare($select_swe_usrapl);
            $stmt_cesig->execute();
            $registros_swe_usrapl = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < count($registros_swe_usrapl); $i++) {

                $select_swe_usrrolapl = "SELECT * FROM swe_usrrolapl WHERE idusrapl = :idusrapl";
                $stmt_cesig = $this->conexion_cesig->prepare($select_swe_usrrolapl);
                $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]['id'], PDO::PARAM_STR);
                $stmt_cesig->execute();

                $username = $registros_swe_usrapl[$i]["username"];
                $posicion_guion = strpos($username, '-');

                $cuitodni = intval(substr($username, 0, $posicion_guion));

                $username = $registros_swe_usrapl[$i]["username"];
                $posicion_guion = strpos($username, "-");
                $tipousuario = substr($username, $posicion_guion + 1);

                if ($stmt_cesig->rowCount() > 0) {

                    echo (" => EL USUARIO(" . $tipousuario . ") YA TIENE ROLES CARGADOS " . PHP_EOL . PHP_EOL);

                } else {

                    echo (" => CARGANDO ROLES DE USUARIO(" . $tipousuario . ")");

                    if ($tipousuario == "Escribano") {

                        $select_pad_persona = "SELECT * FROM pad_persona WHERE cuit = :cuit OR numerodocumento = :numerodocumento LIMIT 1";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_persona);
                        $stmt_cesig->bindValue(":cuit", $cuitodni, PDO::PARAM_STR);
                        $stmt_cesig->bindValue(":numerodocumento", $cuitodni, PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_pad_persona = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                        $select_seg_perfil = "SELECT * FROM seg_perfil WHERE idpersona = :idpersona";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_seg_perfil);
                        $stmt_cesig->bindValue(":idpersona", $registro_pad_persona['id'], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_pad_perfil = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                        $select_pad_escribano = "SELECT * FROM pad_escribano WHERE id = :id";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribano);
                        $stmt_cesig->bindValue(":id", $registro_pad_perfil['idescribano'], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_pad_escribano = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                        // Selecciono o inserto primero como usuario de escribano comun

                        $select_usuarios = "SELECT * FROM usuarios WHERE login = :login AND idGrupoUsuario = 2";
                        $stmt_coessfe2 = $this->conexion_coessfe2->prepare($select_usuarios);
                        $stmt_coessfe2->bindValue(":login", $registro_pad_escribano['matricula'], PDO::PARAM_STR);
                        $stmt_coessfe2->execute();
                        $registro_usuario = $stmt_coessfe2->fetch(PDO::FETCH_ASSOC);

                        $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                        $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                        $stmt_cesig->bindValue(":idrolapl", 8, PDO::PARAM_STR);
                        $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                        $stmt_cesig->execute();

                        $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                        $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                        $stmt_cesig->bindValue(":idrolapl", 13, PDO::PARAM_STR);
                        $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                        $stmt_cesig->execute();

                        $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                        $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                        $stmt_cesig->bindValue(":idrolapl", 20, PDO::PARAM_STR);
                        $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                        $stmt_cesig->execute();

                        echo (' => ESCRIBANO CARGADO CON ÉXITO => VERIFICANDO SI ES LEGALIZADOR ');

                        // verifico si tambien es legalizador eh inserto

                        $usuario_legalizador = $registro_pad_escribano['matricula'] . "_legalizador";

                        $select_usuarios = "SELECT * FROM usuarios WHERE (login = :login1 OR login = :login2) AND idGrupoUsuario = 5";
                        $stmt_coessfe2 = $this->conexion_coessfe2->prepare($select_usuarios);
                        $stmt_coessfe2->bindValue("login1", $registro_pad_escribano['matricula'], PDO::PARAM_STR);
                        $stmt_coessfe2->bindValue("login2", $usuario_legalizador, PDO::PARAM_STR);
                        $stmt_coessfe2->execute();
                        $registro_usuario = $stmt_coessfe2->fetch(PDO::FETCH_ASSOC);

                        if ($registro_usuario) {

                            echo (' => EL ESCRIBANO ES LEGALIZADOR => CARGANDO COMO LEGALIZADOR');

                            $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                            $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                            $stmt_cesig->bindValue(":idrolapl", 12, PDO::PARAM_STR);
                            $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                            $stmt_cesig->execute();

                            $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                            $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                            $stmt_cesig->bindValue(":idrolapl", 16, PDO::PARAM_STR);
                            $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                            $stmt_cesig->execute();

                            echo (' => ROLES DE USUARIO REGISTRADOS CON EXITO => DATOS CARGADOS: ' . PHP_EOL . PHP_EOL);

                            $select_pad_personadomicilio = "SELECT * FROM swe_usrrolapl WHERE idusrapl = :idusrapl";
                            $stmt_cesig = $this->conexion_cesig->prepare($select_pad_personadomicilio);
                            $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                            $stmt_cesig->execute();
                            $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

                            for($x=0;$x<count($resultados);$x++){

                                echo("      => ROL " . ($x+1) . PHP_EOL . PHP_EOL);

                                foreach ($resultados[$x] as $nombre_columna => $valor) {
                                    echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
                                }

                            }

                        } else {
                            echo (' => EL ESCRIBANO NO ES LEGALIZADOR => ROLES DE USUARIO REGISTRADOS CON EXITO => DATOS CARGADOS: ') . PHP_EOL . PHP_EOL;

                            $select_pad_personadomicilio = "SELECT * FROM swe_usrrolapl WHERE idusrapl = :idusrapl";
                            $stmt_cesig = $this->conexion_cesig->prepare($select_pad_personadomicilio);
                            $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                            $stmt_cesig->execute();
                            $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

                            for($x=0;$x<count($resultados);$x++){

                                echo("      => ROL " . ($x+1) . PHP_EOL . PHP_EOL);

                                foreach ($resultados[$x] as $nombre_columna => $valor) {
                                    echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
                                }

                            }
                        }

                    }

                    if ($tipousuario == "Empleado") {

                        $select_pad_persona = "SELECT * FROM pad_persona WHERE cuit = :cuit OR numerodocumento = :numerodocumento LIMIT 1";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_persona);
                        $stmt_cesig->bindValue(":cuit", $cuitodni, PDO::PARAM_STR);
                        $stmt_cesig->bindValue(":numerodocumento", $cuitodni, PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_pad_persona = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                        $select_seg_perfil = "SELECT * FROM seg_perfil WHERE idpersona = :idpersona";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_seg_perfil);
                        $stmt_cesig->bindValue(":idpersona", $registro_pad_persona['id'], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_pad_perfil = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                        $select_pad_empleado = "SELECT * FROM pad_empleado WHERE id = :id";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_empleado);
                        $stmt_cesig->bindValue(":id", $registro_pad_perfil['idempleado'], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $registro_pad_empleado = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                        if ($registro_pad_empleado['legajo'] == '37') { // Marina

                            $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                            $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                            $stmt_cesig->bindValue(":idrolapl", 2, PDO::PARAM_STR);
                            $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                            $stmt_cesig->execute();

                            $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                            $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                            $stmt_cesig->bindValue(":idrolapl", 3, PDO::PARAM_STR);
                            $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                            $stmt_cesig->execute();

                            $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                            $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                            $stmt_cesig->bindValue(":idrolapl", 8, PDO::PARAM_STR);
                            $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                            $stmt_cesig->execute();

                            $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                            $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                            $stmt_cesig->bindValue(":idrolapl", 14, PDO::PARAM_STR);
                            $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                            $stmt_cesig->execute();

                            $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                            $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                            $stmt_cesig->bindValue(":idrolapl", 15, PDO::PARAM_STR);
                            $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                            $stmt_cesig->execute();

                            $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                            $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                            $stmt_cesig->bindValue(":idrolapl", 17, PDO::PARAM_STR);
                            $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                            $stmt_cesig->execute();

                        } else { // Los demas empleados

                            $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                            $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                            $stmt_cesig->bindValue(":idrolapl", 8, PDO::PARAM_STR);
                            $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                            $stmt_cesig->execute();

                            $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                            $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                            $stmt_cesig->bindValue(":idrolapl", 14, PDO::PARAM_STR);
                            $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                            $stmt_cesig->execute();

                            $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                            $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                            $stmt_cesig->bindValue(":idrolapl", 15, PDO::PARAM_STR);
                            $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                            $stmt_cesig->execute();

                            $insert_swe_usrrolapl = "INSERT INTO swe_usrrolapl(idrolapl,idusrapl,usuario,fechaultmdf,estado) VALUES(:idrolapl,:idusrapl,'anonymous',NOW(),1)";
                            $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrrolapl);
                            $stmt_cesig->bindValue(":idrolapl", 17, PDO::PARAM_STR);
                            $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                            $stmt_cesig->execute();

                        }

                        echo (' => ROLES DE USUARIO REGISTRADOS CON EXITO => DATOS CARGADOS: ' . PHP_EOL . PHP_EOL);

                        $select_pad_personadomicilio = "SELECT * FROM swe_usrrolapl WHERE idusrapl = :idusrapl";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_personadomicilio);
                        $stmt_cesig->bindValue(":idusrapl", $registros_swe_usrapl[$i]["id"], PDO::PARAM_STR);
                        $stmt_cesig->execute();
                        $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

                        for($x=0;$x<count($resultados);$x++){

                            echo("      => ROL " . ($x+1) . PHP_EOL . PHP_EOL);

                            foreach ($resultados[$x] as $nombre_columna => $valor) {
                                echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
                            }

                        }
                    }
                }

            }

        } catch (PDOException $e) {
            echo "Error al insertar datos ." . $i . " : " . $e->getMessage() . PHP_EOL . PHP_EOL; // Manejo de errores

        }
        echo ("=> FIN CARGA DE TABLA" . PHP_EOL . PHP_EOL);
    }

}