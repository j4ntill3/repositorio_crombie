<?php

    ini_set('include_path', 'C:\Users\jantille\Desktop\datapipeline_coessfe_cesig');
    
    require "../config/includes.php";
    
    echo(PHP_EOL . "INICIO PROCESO" . PHP_EOL . PHP_EOL);
    
    $c_coessfe_sec_registros_y_funciones = new c_coessfe_sec_registros_y_funciones($conexion_coessfe);

    $c_coessfe_sec_registros_y_funciones->guardarTablaSecRegistrosYFunciones();

    $c_cesig_seg_escribanofuncion = new c_cesig_seg_escribanofuncion($c_coessfe_sec_registros_y_funciones->getCoessfeSecRegistrosYFunciones(),$conexion_coessfe,$conexion_cesig);
    
    $c_cesig_seg_escribanofuncion->analizarFuncionesEscribanos();

    echo("FIN PROCESO" . PHP_EOL . PHP_EOL);

?>