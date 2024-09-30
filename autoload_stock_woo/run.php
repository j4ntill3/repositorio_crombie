<?php
//restrincción del limite ejecución
set_time_limit(0);

require_once('/home/spiazziweb.com.ar/public_html/wp-content/autoload-stock/config/requires.php');

//ejecución
$C_Categorias = new C_Categorias($connWOO,$stock);

$C_Categorias->obtenerDatosCSV();

$C_Categorias->obtenerCategoriasWOO();

$C_Categorias->actualizarCategoriasWOO();

$C_Categorias->obtenerCategoriasWOO();// IMPORTANTE: OBTENER CATEGORIAS DE NUEVO DESPUES DE ACTUALIZARLAS

$C_Categorias->obtenerJerarquiasWOO();

$C_Categorias->actualizarJerarquiasWOO();

$C_Productos = new C_Productos($connWOO,$stock,$C_Categorias->getCategoriasWOO(),$img,$folder_img);

$C_Productos->obtenerDatosProductosCSV();

$C_Productos->obtenerProductosWOO();

$C_Productos->actualizarProductosWOO();

$C_Productos->borrarProductosRestantes();

?>
