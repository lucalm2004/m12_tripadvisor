<?php
session_start();
require_once("./conexion.php");
if (!isset($_SESSION['username'])) {
    header('Location: ../home.php');
    exit();
}
// Consulta SQL corregida
try{
    
$sql = "SELECT tbl_restaurante.id_restaurante, tbl_restaurante.nombre_restaurante, tbl_restaurante.precio_medio, tbl_restaurante.valoracion, tbl_restaurante.imagen_res FROM tbl_restaurante ORDER BY tbl_restaurante.precio_medio DESC LIMIT 12";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($stmt->rowCount() > 0) {
    foreach ($resultado as $row) {
        $sql2 = "SELECT COUNT(valoracion) AS cantidad, SUM(valoracion) AS suma FROM tbl_valoracion WHERE restaurante = " . $row['id_restaurante'];
        $stmt2 = $pdo->query($sql2);
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        if ($result2['cantidad'] != 0) {
            $promedio = $result2['suma'] / $result2['cantidad'];
        } else {
            $promedio = 'sin valoraciones';
        }
        echo "<li id='card2' class='card' onclick='openModal(".$row['id_restaurante'].")'>";
        echo "<div class='img'><img src='./img/" . $row['imagen_res'] . "' alt='img' draggable='false'></div>";
        echo "<label>" . $row['nombre_restaurante'] . "</label>";
        echo "<div class='valoraciones'>";
        if (is_numeric($promedio)) {
            if ($promedio == 5) {
                echo "<img src='./img/estrella_valoracion_5.png' class='estrella_foto'>";
            } elseif ($promedio >= 4.5 and $promedio < 5) {
                echo "<img src='./img/estrella_valoracion_4,5.png' class='estrella_foto'>";
            } elseif ($promedio >= 4 and $promedio < 4.5) {
                echo "<img src='./img/estrella_valoracion_4.png' class='estrella_foto'>";
            } elseif ($promedio >= 3.5 and $promedio < 4) {
                echo "<img src='./img/estrella_valoracion_3,5.png' class='estrella_foto'>";
            } elseif ($promedio >= 3 and $promedio < 3.5) {
                echo "<img src='./img/estrella_valoracion_3.png' class='estrella_foto'>";
            } elseif ($promedio >= 2.5 and $promedio < 3) {
                echo "<img src='./img/estrella_valoracion_2,5.png' class='estrella_foto'>";
            } elseif ($promedio >= 2 and $promedio < 2.5) {
                echo "<img src='./img/estrella_valoracion_2.png' class='estrella_foto'>";
            } elseif ($promedio >= 1.5 and $promedio < 2) {
                echo "<img src='./img/estrella_valoracion_1,5.png' class='estrella_foto'>";
            } elseif ($promedio >= 1 and $promedio < 1.5) {
                echo "<img src='./img/estrella_valoracion_1.png' class='estrella_foto'>";
            } elseif ($promedio >= 0.1 and $promedio < 1) {
                echo "<img src='./img/estrella_valoracion_0,5.png' class='estrella_foto'>";
            }
        } else {
            echo "<span style='font-size: 16px;'>opiniones</span>";
        }
        echo "<strong class='numeroR'>" .  round($promedio * 10) / 10 . "</strong>";
        echo "</div>";
        echo "<span>Precio medio de " . $row['precio_medio'] . "</span>";
        echo "</li>";
    }
} else {
    echo "<div style='display: flex; justify-content: center; align-items: center;'>
            <h1 style='color: green;'>0 resultados</h1>
        </div>";
}
}catch(PDOException $e){
    echo "Error: $e";
}
?>