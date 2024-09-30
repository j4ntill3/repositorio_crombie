<?php

    ini_set('include_path', 'C:\Users\jantille\Desktop\datapipeline_coessfe_cesig');

    require "../config/includes.php";

    echo (PHP_EOL . "INICIO PROCESO" . PHP_EOL . PHP_EOL);

    $c_cesig_swe_usrrolapl = new c_cesig_swe_usrrolapl($conexion_coessfe,$conexion_coessfe2,$conexion_cesig);

    $c_cesig_swe_usrrolapl->analizarUsrRolApl();

    echo ("FIN PROCESO" . PHP_EOL . PHP_EOL);

?>