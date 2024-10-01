<?php

class c_cesig_swe_usrauth
{
    private $conexion_cesig;

    public function __construct(&$conexion_cesig)
    {
        $this->conexion_cesig = &$conexion_cesig;
    }

    public function analizarUsrAuth()
    {

        try {

            echo("=> INICIO CARGA DE TABLA swe_usrauth" . PHP_EOL . PHP_EOL);

            $select_pad_persona = "SELECT * FROM pad_persona";
            $stmt_cesig = $this->conexion_cesig->prepare($select_pad_persona);
            $stmt_cesig->execute();
            $registros_pad_persona = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);

            for($i=0;$i<count($registros_pad_persona);$i++){

                echo(" => ANALIZANDO usrauth PERSONA ID " . $registros_pad_persona[$i]["id"]);

                $nomusuario = NULL;

                if($registros_pad_persona[$i]["cuit"] != NULL){
                    $nomusuario = $registros_pad_persona[$i]["cuit"];
                } else if($registros_pad_persona[$i]["numerodocumento"] != NULL AND $registros_pad_persona[$i]["cuit"] == NULL){
                    $nomusuario = $registros_pad_persona[$i]["numerodocumento"];
                }

                if($nomusuario != NULL){

                    $select_swe_usrauth = "SELECT * FROM swe_usrauth WHERE nomusuario = :nomusuario";
                    $stmt_cesig = $this->conexion_cesig->prepare($select_swe_usrauth);
                    $stmt_cesig->bindValue(":nomusuario", $nomusuario, PDO::PARAM_STR);
                    $stmt_cesig->execute();

                    if(($stmt_cesig->rowCount() > 0)){

                        echo(" => YA POSEE UN usrauth REGISTRADO " . PHP_EOL . PHP_EOL);

                    } else {

                        echo(" => NO POSEE UN usrauth REGISTRADO => CARGANDO usrauth");
                        
                        $insert_swe_usrauth = "INSERT INTO swe_usrauth(nomusuario,password,idaplicacion,usuario,fechaultmdf,estado,salt) VALUES(:nomusuario,:password,2,'anonymous',NOW(),1,'coessfe1') RETURNING id";
                        $stmt_cesig = $this->conexion_cesig->prepare($insert_swe_usrauth);
                        $stmt_cesig->bindValue(":nomusuario", $nomusuario);
                        $stmt_cesig->bindValue(":password", $nomusuario);
                        $stmt_cesig->execute();

                        $idusrauth = $stmt_cesig->fetchColumn();

                        echo " => REGISTRADO CON ÉXITO => DATOS REGISTRADOS: " . PHP_EOL . PHP_EOL;

                        // Consultos los datos cargados y los muestro en pantalla
                        $select_pad_escribano = "SELECT * FROM swe_usrauth WHERE id = :id";
                        $stmt_cesig = $this->conexion_cesig->prepare($select_pad_escribano);
                        $stmt_cesig->bindValue(':id', $idusrauth, PDO::PARAM_STR);
                        $stmt_cesig->execute();

                        // Muestro datos cargados
                        $resultados = $stmt_cesig->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($resultados as $fila) {
                            foreach ($fila as $nombre_columna => $valor) {
                                echo "        ->" . $nombre_columna . ": " . $valor . PHP_EOL . PHP_EOL;
                            }
                        }

                    }

                } else {
                    echo("=> Persona no apta para cargar, no tiene dni ni cuit para generar su username" . $i . PHP_EOL . PHP_EOL);
                }
        
            }

        } catch (PDOException $e) {
            echo "Error en la consulta ." . $i . " : " . $e->getMessage() . PHP_EOL . PHP_EOL; // Manejo de errores
        }
        echo("=> FIN CARGA DE TABLA swe_usrauth" . PHP_EOL . PHP_EOL);
    }


}