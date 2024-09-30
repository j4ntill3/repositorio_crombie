<?php

class c_cesig_swe_usrapl
{
    private $conexion_cesig;

    public function __construct(&$conexion_cesig)
    {
        $this->conexion_cesig = &$conexion_cesig;
    }

    public function analizarUsr()
    {

        try {

            echo("=> INICIO CARGA DE TABLA swe_usrapl" . PHP_EOL . PHP_EOL);

            $select_seg_perfil = "SELECT * FROM seg_perfil";
            $stmt_cesig = $this->conexion_cesig->prepare($select_seg_perfil);
            $stmt_cesig->execute();
            $registros_seg_perfil = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < count($registros_seg_perfil); $i++) {

                echo("=> ANALIZANDO USERAPL " . $registros_seg_perfil[$i]['userapl'] . " ");

                $select_swe_usrapl = "SELECT * FROM swe_usrapl WHERE username = :username";
                $stmt_cesig = $this->conexion_cesig->prepare($select_swe_usrapl);
                $stmt_cesig->bindValue("username", $registros_seg_perfil[$i]['userapl'], PDO::PARAM_STR);
                $stmt_cesig->execute();

                if ($stmt_cesig->rowCount() > 0) {

                    echo ("=> YA ESTA REGISTRADO" . PHP_EOL . PHP_EOL);

                } else {

                    echo ("=> NO ESTA REGISTRADO => CARGANDO USUARIO ");
                    
                    $insert_swe_usrapl = "INSERT INTO swe_usrapl(username,idaplicacion,uid,fechaalta,fechabaja,usuario,fechaultmdf,estado,permiteweb) 
                    VALUES(:username,2,NULL,NOW(),NULL,'anonymous',NOW(),1,1) RETURNING id";
            
                    $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrapl);
                    $stmt_cesig->bindValue(":username", $registros_seg_perfil[$i]['userapl'], PDO::PARAM_STR);
                    $stmt_cesig->execute();

                    $idusrapl = $stmt_cesig->fetchColumn();
            
                    echo ("=> REGISTRADO CON EXITO => DATOS CARGADOS: " . PHP_EOL . PHP_EOL);

                    $select_swe_usrapl = "SELECT * FROM swe_usrapl WHERE id = :idusrapl";
                    $stmt_cesig = $this->conexion_cesig->prepare($select_swe_usrapl);
                    $stmt_cesig->bindValue(":idusrapl", $idusrapl, PDO::PARAM_STR);
                    $stmt_cesig->execute();

                    $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($resultados as $nombre_columna => $valor) {
                        echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
                    }

                }

            }

        } catch (PDOException $e) {

            echo "Error al insertar datos ." . $i . " : " . $e->getMessage() . PHP_EOL . PHP_EOL; // Manejo de errores

        }

        echo("=> FIN CARGA DE TABLA swe_usrapl" . PHP_EOL . PHP_EOL);

    }

    function definirTipoUsuario($idpersona)
    {

        $select_seg_perfil = "SELECT * FROM seg_perfil WHERE idpersona = :idpersona";
        $stmt_cesig = $this->conexion_cesig->prepare($select_seg_perfil);
        $stmt_cesig->bindValue('idpersona', $idpersona, PDO::FETCH_ASSOC);
        $stmt_cesig->execute();
        $registro_seg_perfil = $stmt_cesig->fetch(PDO::FETCH_ASSOC);

        // escribano, escribano y empleado
        if (($registro_seg_perfil['idescribano'] != NULL and $registro_seg_perfil['idempleado'] == NULL) AND ($registro_seg_perfil['idescribano'] != NULL and $registro_seg_perfil['idempleado'] != NULL)) {
            return "Escribano";
        }
        
        // empleado
        if ($registro_seg_perfil['idescribano'] == NULL and $registro_seg_perfil['idempleado'] != NULL) {
            return "Empleado";
        }

    }

}