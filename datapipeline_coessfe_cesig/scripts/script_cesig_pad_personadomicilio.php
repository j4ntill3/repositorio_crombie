<?php

    ini_set('include_path', 'C:\Users\jantille\Desktop\datapipeline_coessfe_cesig');
    
    require "../config/includes.php";
    
    echo(PHP_EOL . "INICIO PROCESO" . PHP_EOL . PHP_EOL);

    $c_cesig_pad_personadomicilio = new c_cesig_pad_personadomicilio($conexion_coessfe,$conexion_cesig);

    $c_cesig_pad_personadomicilio->analizarDomiciliosPersonas();

    echo("FIN PROCESO" . PHP_EOL . PHP_EOL);

?>