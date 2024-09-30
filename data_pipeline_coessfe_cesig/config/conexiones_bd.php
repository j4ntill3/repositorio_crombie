<?php

$db_postgres = "";
$dbuser_postgres = "";
$dbpass_postgres = "";
$dbhost_postgres = "";
$dbport_postgres = "";

$db_mysql = "";
$dbuser_mysql = "";
$dbpass_mysql = "";
$dbhost_mysql = "";

$db_mysql2 = "";
$dbuser_mysql2 = "";
$dbpass_mysql2 = "";
$dbhost_mysql2 = "";

try 
{
    $conexion_cesig = new PDO("pgsql:host=$dbhost_postgres;port=$dbport_postgres;dbname=$db_postgres", $dbuser_postgres, $dbpass_postgres);
    $conexion_cesig->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch(PDOException $e) { echo "Error en la conexión a PostgreSQL: " . $e->getMessage() . PHP_EOL . PHP_EOL; }

try 
{
    $conexion_coessfe = new PDO("mysql:host=$dbhost_mysql;dbname=$db_mysql", $dbuser_mysql, $dbpass_mysql);
    $conexion_coessfe->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch(PDOException $e) { echo "Error en la conexión MySQL: " . $e->getMessage() . PHP_EOL . PHP_EOL; }

try 
{
    $conexion_coessfe2 = new PDO("mysql:host=$dbhost_mysql2;dbname=$db_mysql2", $dbuser_mysql2, $dbpass_mysql2);
    $conexion_coessfe2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch(PDOException $e) { echo "Error en la conexión MySQL: " . $e->getMessage() . PHP_EOL . PHP_EOL; }

?>