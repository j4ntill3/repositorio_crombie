<?php

    ini_set('include_path', 'C:\Users\jantille\Desktop\datapipeline_coessfe_cesig');

    require "../config/includes.php";

    echo(PHP_EOL . "INICIO PROCESO" . PHP_EOL . PHP_EOL);
    
    $c_coessfe_pad_empleados = new c_coessfe_pad_empleados($conexion_coessfe);

    $c_coessfe_pad_empleados->guardarTablaPadEmpleados();

    $c_cesig_empleados = new c_cesig_empleados($c_coessfe_pad_empleados->getCCoessfePadEmpleados(),$conexion_cesig,$conexion_coessfe);

    $c_cesig_empleados->analizarEmpleados();

    echo("FIN PROCESO" . PHP_EOL . PHP_EOL);

?>