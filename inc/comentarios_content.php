<?php
include_once('./conexion.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../home.php');
    exit();
}

$jsonData = json_decode(file_get_contents("php://input"), true);

$id = $jsonData['id'];



$stmt = "SELECT * FROM tbl_valoracion v INNER JOIN tbl_user u ON v.username = u.id_user WHERE v.restaurante = " . $id;

if (isset($jsonData['filter']) && !empty($jsonData['filter'])) {
    $stmt .= ' AND (';
    foreach ($jsonData['filter'] as $value) {
        $stmt .= "(valoracion <= $value AND valoracion >= " . ($value - 0.9) . ") OR ";
    }
    $stmt = rtrim($stmt, ' OR ') . ')';
}

$stmt .= " ORDER BY valoracion DESC";

$sql = $pdo->prepare($stmt);
$sql->execute();

$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultado as $row) {
    echo "<div class='review2'>";
    echo "<h2>" . $row['username'] . "</h2>";
    echo "<p>" . $row['comentario'] . "</p>";
    if ($row['valoracion'] == 5) {
        echo "<img src='./img/estrella_valoracion_5.png' class='estrella_foto3'>";
    } elseif ($row['valoracion'] >= 4.5 and $row['valoracion'] < 5) {
        echo "<img src='./img/estrella_valoracion_4,5.png' class='estrella_foto3'>";
    } elseif ($row['valoracion'] >= 4 and $row['valoracion'] < 4.5) {
        echo "<img src='./img/estrella_valoracion_4.png' class='estrella_foto3'>";
    } elseif ($row['valoracion'] >= 3.5 and $row['valoracion'] < 4) {
        echo "<img src='./img/estrella_valoracion_3,5.png' class='estrella_foto3'>";
    } elseif ($row['valoracion'] >= 3 and $row['valoracion'] < 3.5) {
        echo "<img src='./img/estrella_valoracion_3.png' class='estrella_foto3'>";
    } elseif ($row['valoracion'] >= 2.5 and $row['valoracion'] < 3) {
        echo "<img src='./img/estrella_valoracion_2,5.png' class='estrella_foto3'>";
    } elseif ($row['valoracion'] >= 2 and $row['valoracion'] < 2.5) {
        echo "<img src='./img/estrella_valoracion_2.png' class='estrella_foto3'>";
    } elseif ($row['valoracion'] >= 1.5 and $row['valoracion'] < 2) {
        echo "<img src='./img/estrella_valoracion_1,5.png' class='estrella_foto3'>";
    } elseif ($row['valoracion'] >= 1 and $row['valoracion'] < 1.5) {
        echo "<img src='./img/estrella_valoracion_1.png' class='estrella_foto3'>";
    } elseif ($row['valoracion'] >= 0.1 and $row['valoracion'] < 1) {
        echo "<img src='./img/estrella_valoracion_0,5.png' class='estrella_foto3'>";
    }
    echo "</div>";
    echo "<br>";
}

echo '</ul></nav>';