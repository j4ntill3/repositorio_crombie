<?php

    ini_set('include_path', 'C:\Users\jantille\Desktop\datapipeline_coessfe_cesig');
    
    require "../config/includes.php";
    
    echo(PHP_EOL . "INICIO PROCESO" . PHP_EOL . PHP_EOL);
    
    $c_coessfe_sec_padron_escribanos = new c_coessfe_sec_padron_escribanos($conexion_coessfe);

    $c_coessfe_sec_padron_escribanos->guardarTablaSecPadronescribanos();

    $c_cesig_escribanos = new c_cesig_escribanos($c_coessfe_sec_padron_escribanos->getCCoessfeSecPadronescribanos(),$conexion_cesig,$conexion_coessfe);

    $c_cesig_escribanos->analizarEscribanos();

    echo("FIN PROCESO" . PHP_EOL . PHP_EOL);

?>