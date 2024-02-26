<?php
// Configura la extensión mysqli para reportar errores de MySQL de manera estricta.
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Parámetros de conexión a la base de datos.
$dbserver = "mysql:dbname=db_tripadvisor;host:localhost";
$dbusername = "root";
$dbpassword = "";

try {
    $pdo = new PDO($dbserver, $dbusername, $dbpassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch (Exception $e) {
    echo "Error en la conexión con la base de datos: " . $e->getMessage();

    die();
}