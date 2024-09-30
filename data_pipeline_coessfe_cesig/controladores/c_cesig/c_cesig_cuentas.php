<?php

class c_cesig_cuentas
{
    private $m_cesig_pad_persona;
    private $conexion_cesig;
    private $conexion_coessfe;

    public function __construct($m_cesig_pad_persona, $conexion_cesig, $conexion_coessfe)
    {
        $this->m_cesig_pad_persona = &$m_cesig_pad_persona;
        $this->conexion_cesig = &$conexion_cesig;
        $this->conexion_coessfe = &$conexion_coessfe;
    }

    public function analizarCuentas()
    {

        echo ("=> INICIO PROCESO CARGA/ACTUALIZACIÓN DE CUENTAS TABLAS pad_cuenta/pad_cuentatitular" . PHP_EOL . PHP_EOL);

        try {

            for ($i = 0; $i < count($this->m_cesig_pad_persona); $i++) {

                echo (" => ANALIZANDO CUENTA PERSONA ID " . $this->m_cesig_pad_persona[$i]->getId() . PHP_EOL . PHP_EOL);

                $select_pad_cuentatitular = "SELECT * FROM pad_cuentatitular WHERE idpersona = :idpersona ";
                $stmt_cesig = $this->conexion_cesig->prepare($select_pad_cuentatitular);
                $stmt_cesig->bindValue(":idpersona", $this->m_cesig_pad_persona[$i]->getId(), PDO::PARAM_STR);
                $stmt_cesig->execute();
                $registros_pad_cuentatitular = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                if ($stmt_cesig->rowCount() > 0) {

                    echo (" => CUENTA REGISTRADA " . PHP_EOL . PHP_EOL);

                } else {

                    echo (" => CUENTA NO REGISTRADA => CARGANDO DATOS" . PHP_EOL . PHP_EOL);

                    $stmt_cesig = $this->conexion_cesig->prepare("SELECT id FROM pad_cuenta ORDER BY id DESC LIMIT 1");
                    $stmt_cesig->execute();
                    $registro_id_pad_cuenta = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

                    $id = null;

                    if (!$registro_id_pad_cuenta) {
                        $id = 1;
                    }

                    $select_pad_escribano = "SELECT * FROM seg_perfil WHERE idpersona = :idpersona";

                    $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribano);
                    $stmt_cesig->bindValue(":idpersona", $this->m_cesig_pad_persona[$i]->getId());
                    $stmt_cesig->execute();
                    $registro_seg_perfil = $stmt_cesig->fetch(PDO::FETCH_ASSOC);


                    $insert_pad_cuenta = "INSERT INTO pad_cuenta(id,creationtimestamp,creationuser,deleted,modificationtimestamp,modificationuser,versionnumber,numerocuenta,nombretitular,cuittitular,idtipopersona)
                    VALUES(:id,NOW(),'dummyuser',FALSE,NOW(),'dummyuser',0,:numerocuenta,:nombretitular,:cuittitular,:idtipopersona) RETURNING id";

                    if ($id == null) {
                        $id = intval($registro_id_pad_cuenta["id"]) + 1;
                    }

                    $nombre = $this->m_cesig_pad_persona[$i]->getNombre1() . " " . $this->m_cesig_pad_persona[$i]->getApellido1();

                    echo ('    => CARGANDO PERSONA EN TABLA pad_cuenta');

                    $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_cuenta);
                    $stmt_cesig->bindValue(":id", $id, PDO::PARAM_STR);
                    $stmt_cesig->bindValue(":numerocuenta", $this->generarNumeroUsuario($id), PDO::PARAM_STR);
                    $stmt_cesig->bindValue(":nombretitular", $nombre, PDO::PARAM_STR);
                    $stmt_cesig->bindValue(":cuittitular", $this->m_cesig_pad_persona[$i]->getCuit(), PDO::PARAM_STR);

                    if ($registro_seg_perfil['idescribano'] != NULL) {
                        $stmt_cesig->bindValue(":idtipopersona", 1, PDO::PARAM_STR);
                    } else if ($registro_seg_perfil['idempleado'] != NULL) {
                        $stmt_cesig->bindValue(":idtipopersona", 2, PDO::PARAM_STR);
                    }

                    $stmt_cesig->execute();

                    $idcuenta = $stmt_cesig->fetchColumn();

                    $select_pad_cuenta = "SELECT * FROM pad_cuenta WHERE id = :id";
                    $stmt_cesig = $this->conexion_cesig->prepare($select_pad_cuenta);
                    $stmt_cesig->bindValue(":id", $idcuenta, PDO::PARAM_STR);
                    $stmt_cesig->execute();

                    echo " => REGISTRADO CON EXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL;

                    $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($resultados as $fila) {
                        foreach ($fila as $nombre_columna => $valor) {
                            echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
                        }
                    }

                    $insert_pad_cuentatitular = "INSERT INTO pad_cuentatitular(creationtimestamp,creationuser,deleted,modificationtimestamp,modificationuser,versionnumber,idcuenta,idpersona) VALUES(NOW(),'dummyuser',FALSE,NOW(),'dummyuser',0,:idcuenta,:idpersona) RETURNING id";

                    $stmt_cesig = $this->conexion_cesig->prepare($insert_pad_cuentatitular);
                    $stmt_cesig->bindValue(":idcuenta", $idcuenta, PDO::PARAM_STR);
                    $stmt_cesig->bindValue(":idpersona", $this->m_cesig_pad_persona[$i]->getId(), PDO::PARAM_STR);
                    $stmt_cesig->execute();

                    $idcuentatitular = $stmt_cesig->fetchColumn();

                    $select_pad_cuenta = "SELECT * FROM pad_cuentatitular WHERE id = :id";
                    $stmt_cesig = $this->conexion_cesig->prepare($select_pad_cuenta);
                    $stmt_cesig->bindValue(":id", $idcuentatitular, PDO::PARAM_STR);
                    $stmt_cesig->execute();

                    echo " => REGISTRADO CON EXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL;

                    $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($resultados as $fila) {
                        foreach ($fila as $nombre_columna => $valor) {
                            echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
                        }
                    }

                }

            }

        } catch (PDOException $e) {
            echo "Error al insertar datos ." . $i . " : " . $e->getMessage() . PHP_EOL . PHP_EOL; // Manejo de errores

        }
        echo ("=> FIN PROCESO CARGA/ACTUALIZACIÓN DE CUENTAS" . PHP_EOL . PHP_EOL);
    }

    private function generarNumeroUsuario($numero)
    {
        // Validar que el número sea válido
        if (!is_numeric($numero)) {
            return "El número proporcionado no es válido.";
        }

        // Convertir el número a una cadena y obtener su longitud
        $numeroCadena = (string) $numero;
        $longitudNumero = strlen($numeroCadena);

        // Verificar que el número tenga de 1 a 15 dígitos
        if ($longitudNumero < 1 || $longitudNumero > 15) {
            return "El número proporcionado debe tener entre 1 y 15 dígitos.";
        }

        // Calcular la cantidad de ceros necesarios
        $cantidadCeros = 15 - $longitudNumero;

        // Generar la cadena con los ceros y el número al final
        $cadena = str_repeat('0', $cantidadCeros) . $numeroCadena;

        return $cadena;
    }

}