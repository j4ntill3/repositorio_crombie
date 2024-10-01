<?php

    ini_set('include_path', 'C:\Users\jantille\Desktop\datapipeline_coessfe_cesig');
    
    require "../config/includes.php";
    
    echo(PHP_EOL . "INICIO PROCESO" . PHP_EOL . PHP_EOL);
    
    $c_coessfe_sec_antecedentes_o_saciones = new c_coessfe_sec_antecedentes_o_sanciones($conexion_coessfe);

    $c_coessfe_sec_antecedentes_o_saciones->guardarTablaSecAntecedentesOSanciones();

    $c_cesig_pad_escribanosancion = new c_cesig_pad_escribanosancion($c_coessfe_sec_antecedentes_o_saciones->getCoessfeSecAntecedentesOSanciones(),$conexion_coessfe,$conexion_cesig);

    $c_cesig_pad_escribanosancion->analizarSancionesEscribanos();

    echo("FIN PROCESO" . PHP_EOL . PHP_EOL);

?>