<?php

    ini_set('include_path', 'C:\Users\jantille\Desktop\datapipeline_coessfe_cesig');
    
    require "../config/includes.php";
    
    echo(PHP_EOL . "INICIO PROCESO" . PHP_EOL . PHP_EOL);
    
    $c_coessfe_sec_licencias = new c_coessfe_sec_licencias($conexion_coessfe);

    $c_coessfe_sec_licencias->guardarTablaSecLicencias();

    $c_cesig_pad_escribanolicencia = new c_cesig_pad_escribanolicencia($c_coessfe_sec_licencias->getCoessfeSecLicencias(),$conexion_coessfe,$conexion_cesig);

    $c_cesig_pad_escribanolicencia->analizarLicenciasEscribanos();

    echo("FIN PROCESO" . PHP_EOL . PHP_EOL);

?>