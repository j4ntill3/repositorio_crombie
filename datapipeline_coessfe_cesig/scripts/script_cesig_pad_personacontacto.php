<?php

    ini_set('include_path', 'C:\Users\jantille\Desktop\datapipeline_coessfe_cesig');
    
    require "../config/includes.php";
    
    echo(PHP_EOL . "INICIO PROCESO" . PHP_EOL . PHP_EOL);

    $c_cesig_pad_personacontacto = new c_cesig_pad_personacontacto($conexion_coessfe,$conexion_cesig);

    $c_cesig_pad_personacontacto->analizarContactosPersonas();

    echo("FIN PROCESO" . PHP_EOL . PHP_EOL);

?>