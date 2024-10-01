<?php

    ini_set('include_path', 'C:\Users\jantille\Desktop\datapipeline_coessfe_cesig');

    require "../config/includes.php";

    echo (PHP_EOL . "INICIO PROCESO" . PHP_EOL . PHP_EOL);

    // Guardo todos los datos de las tablas de COESSFE a utilzar

    // Tabla sec_padron_escribanos
    $c_coessfe_sec_padron_escribanos = new c_coessfe_sec_padron_escribanos($conexion_coessfe);
    $c_coessfe_sec_padron_escribanos->guardarTablaSecPadronescribanos();

    // Tabla pad_empleados
    $c_coessfe_pad_empleados = new c_coessfe_pad_empleados($conexion_coessfe);
    $c_coessfe_pad_empleados->guardarTablaPadEmpleados();

    // Tabla sec_registros_y_funciones
    $c_coessfe_sec_registros_y_funciones = new c_coessfe_sec_registros_y_funciones($conexion_coessfe);
    $c_coessfe_sec_registros_y_funciones->guardarTablaSecRegistrosYFunciones();

    // Tabla sec_licencias
    $c_coessfe_sec_licencias = new c_coessfe_sec_licencias($conexion_coessfe);
    $c_coessfe_sec_licencias->guardarTablaSecLicencias();

    // Tabla sec_antecedentes_o_sanciones
    $c_coessfe_sec_antecedentes_o_saciones = new c_coessfe_sec_antecedentes_o_sanciones($conexion_coessfe);
    $c_coessfe_sec_antecedentes_o_saciones->guardarTablaSecAntecedentesOSanciones();
    
    // Tabla pad_persona
    $c_cesig_pad_persona = new c_cesig_pad_persona($conexion_cesig);
    $c_cesig_pad_persona->guardarTablaPadPersona();

    // Actualizo o cargo los datos en las tablas de CESIG

    // Datos de escribanos; Tablas pad_escribano, pad_persona, seg_usuario, seg_perfil 
    $c_cesig_escribanos = new c_cesig_escribanos($c_coessfe_sec_padron_escribanos->getCCoessfeSecPadronescribanos(),$conexion_cesig,$conexion_coessfe);
    $c_cesig_escribanos->analizarEscribanos();

    // Datos empleados; Tablas pad_empleado, pad_persona, seg_usuario, seg_perfil
    $c_cesig_empleados = new c_cesig_empleados($c_coessfe_pad_empleados->getCCoessfePadEmpleados(),$conexion_cesig,$conexion_coessfe);
    $c_cesig_empleados->analizarEmpleados();

    // Cuentas
    $c_cesig_cuentas = new c_cesig_cuentas($c_cesig_pad_persona->getCesigPadPersona(),$conexion_cesig, $conexion_coessfe);
    $c_cesig_cuentas->analizarCuentas();
    
    // Funciones escribanos
    $c_cesig_seg_escribanofuncion = new c_cesig_seg_escribanofuncion($c_coessfe_sec_registros_y_funciones->getCoessfeSecRegistrosYFunciones(),$conexion_coessfe,$conexion_cesig);
    $c_cesig_seg_escribanofuncion->analizarFuncionesEscribanos();

    // Licencias escribanos
    $c_cesig_pad_escribanolicencia = new c_cesig_pad_escribanolicencia($c_coessfe_sec_licencias->getCoessfeSecLicencias(),$conexion_coessfe,$conexion_cesig);
    $c_cesig_pad_escribanolicencia->analizarLicenciasEscribanos();

    // Sanciones escribanos
    $c_cesig_pad_escribanosancion = new c_cesig_pad_escribanosancion($c_coessfe_sec_antecedentes_o_saciones->getCoessfeSecAntecedentesOSanciones(),$conexion_coessfe,$conexion_cesig);
    $c_cesig_pad_escribanosancion->analizarSancionesEscribanos();

    // Contantos personas
    $c_cesig_pad_personacontacto = new c_cesig_pad_personacontacto($conexion_coessfe,$conexion_cesig);
    $c_cesig_pad_personacontacto->analizarContactosPersonas();

    // Domicilios personas
    $c_cesig_pad_personadomicilio = new c_cesig_pad_personadomicilio($conexion_coessfe,$conexion_cesig);
    $c_cesig_pad_personadomicilio->analizarDomiciliosPersonas();

    // Usuarios -> swe_usrapl
    $c_cesig_swe_usrapl = new c_cesig_swe_usrapl($conexion_cesig);
    $c_cesig_swe_usrapl->analizarUsr();

    // Roles de usuario -> swe_usrrolapl
    $c_cesig_swe_usrrolapl = new c_cesig_swe_usrrolapl($conexion_coessfe,$conexion_coessfe2,$conexion_cesig);
    $c_cesig_swe_usrrolapl->analizarUsrRolApl();

    // auth -> swe_usrauth
    $c_cesig_swe_usrauth = new c_cesig_swe_usrauth($conexion_cesig);
    $c_cesig_swe_usrauth->analizarUsrAuth();

    echo ("FIN PROCESO" . PHP_EOL . PHP_EOL);

?>