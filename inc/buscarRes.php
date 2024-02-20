<?php
session_start();
require_once("../conexion/conexion.php");

// Capturar los filtros enviados por POST
$nombreResta = $_POST['nombreResta'] ?? '';
$tipo_comida = $_POST['tipo_comida'] ?? '';
$precio = $_POST['precio'] ?? '';
$valoracion = $_POST['valoracion'] ?? '';

// Consulta base
$sql = "SELECT * FROM tbl_restaurante 
        INNER JOIN tbl_valoracion ON tbl_restaurante.valoracion = tbl_valoracion.id_valoracion 
        INNER JOIN tbl_comida_restaurante ON tbl_comida_restaurante.id_resturante = tbl_restaurante.id_restaurante";

// Aplicar filtros si se han enviado valores por POST

if (!empty($nombreResta)) {
    $sql .= " WHERE tbl_restaurante.nombre_restuarante = :restaurante";
}

if (!empty($tipo_comida)) {
    $sql .= " WHERE tbl_comida_restaurante.tipo_comida = :tipo_comida";
}

if (!empty($valoracion)) {
    $sql .= " AND tbl_valoracion.valoracion LIKE :valoracion";
}

if (!empty($precio)) {
    if ($precio == 1){
        // Aquí puedes agregar la lógica para el rango "Menos de 10€"
        $sql .= " AND tbl_restaurante.precio_medio < 10";
    }
    elseif ($precio == 2){
        // Aquí puedes agregar la lógica para el rango "De 10€ a 20€"
        $sql .= " AND tbl_restaurante.precio_medio >= 10 AND tbl_restaurante.precio_medio <= 20";
    }
    elseif ($precio == 3){
        // Aquí puedes agregar la lógica para el rango "De 20€ a 30€"
        $sql .= " AND tbl_restaurante.precio_medio >= 20 AND tbl_restaurante.precio_medio <= 30";
    }
    elseif ($precio == 4){
        // Aquí puedes agregar la lógica para el rango "De 30€ a 40€"
        $sql .= " AND tbl_restaurante.precio_medio >= 30 AND tbl_restaurante.precio_medio <= 40";
    }
    elseif ($precio == 5){
        // Aquí puedes agregar la lógica para el rango "De 40€ a 50€"
        $sql .= " AND tbl_restaurante.precio_medio >= 40 AND tbl_restaurante.precio_medio <= 50";
    }
    elseif ($precio == 6){
        // Aquí puedes agregar la lógica para el rango "Más de 50€"
        $sql .= " AND tbl_restaurante.precio_medio > 50";
    }
}

// Preparar y ejecutar la consulta
$stmt = $pdo->prepare($sql);

// Bindear los parámetros si es necesario
if (!empty($nombreResta)) {
    $stmt->bindParam(':restaurante', $nombreResta);
}

if (!empty($tipo_comida)) {
    $stmt->bindParam(':tipo_comida', $tipo_comida);
}

if (!empty($valoracion)) {
    $valoracion = "%" . $valoracion . "%";
    $stmt->bindParam(':valoracion', $valoracion);
}

$stmt->execute();

?>