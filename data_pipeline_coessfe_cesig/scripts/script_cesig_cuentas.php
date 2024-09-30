<?php

    ini_set('include_path', 'C:\Users\jantille\Desktop\datapipeline_coessfe_cesig');

    require "../config/includes.php";

    echo (PHP_EOL . "INICIO PROCESO" . PHP_EOL . PHP_EOL);

    $c_cesig_pad_persona = new c_cesig_pad_persona($conexion_cesig);

    $c_cesig_pad_persona->guardarTablaPadPersona();

    $c_cesig_cuentas = new c_cesig_cuentas($c_cesig_pad_persona->getCesigPadPersona(),$conexion_cesig, $conexion_coessfe);

    $c_cesig_cuentas->analizarCuentas();

    echo ("FIN PROCESO" . PHP_EOL . PHP_EOL);

?>