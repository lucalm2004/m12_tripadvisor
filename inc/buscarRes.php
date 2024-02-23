<?php
session_start();
require_once("./conexion.php");

// Capturar los filtros enviados por POST
$nombreResta = $_POST['nombreResta'] ?? '';
// $tipo_comida = $_POST['tipo_comida'] ?? '';
$precio = $_POST['precio'] ?? '';
$valoracion = $_POST['valoracion'] ?? '';
// Consulta base
$sql = "SELECT tbl_restaurante.id_restaurante, tbl_restaurante.nombre_restuarante, tbl_restaurante.precio_medio, tbl_restaurante.valoracion, tbl_restaurante.imagen_res FROM tbl_restaurante";
// Array para almacenar las condiciones
$conditions = [];
$zero='';
// Agregar condiciones según los filtros
if (!empty($nombreResta)) {
    $conditions[] = "tbl_restaurante.nombre_restuarante LIKE :restaurante";
}

if (!empty($precio)) {
    if ($precio == 1) {
        $conditions[] = "tbl_restaurante.precio_medio < 10";
    } elseif ($precio == 2) {
        $conditions[] = "tbl_restaurante.precio_medio >= 10 AND tbl_restaurante.precio_medio <= 20";
    } elseif ($precio == 3) {
        $conditions[] = "tbl_restaurante.precio_medio >= 20 AND tbl_restaurante.precio_medio <= 30";
    } elseif ($precio == 4) {
        $conditions[] = "tbl_restaurante.precio_medio >= 30 AND tbl_restaurante.precio_medio <= 40";
    } elseif ($precio == 5) {
        $conditions[] = "tbl_restaurante.precio_medio >= 40 AND tbl_restaurante.precio_medio <= 50";
    } elseif ($precio == 6) {
        $conditions[] = "tbl_restaurante.precio_medio > 50";
    }
}

// Combinar condiciones con AND si hay más de una
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

// Preparar y ejecutar la consulta
$stmt = $pdo->prepare($sql);

// Bindear los parámetros si es necesario
if (!empty($nombreResta)) {
    $nombreResta2 = "%" . $nombreResta . "%";
    $stmt->bindParam(':restaurante', $nombreResta2);
}

// Ejecutar la consulta
$stmt->execute();
if ($stmt->rowCount() > 0) {
    echo "<div class='wrapper'>";
    echo "<ul class='carousel'  name='zero'>";
    if ($valoracion==''){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $sql2 = "SELECT COUNT(valoracion) AS cantidad, SUM(valoracion) AS suma FROM tbl_valoracion WHERE restaurante = " . $row['id_restaurante'] ."";
            $stmt2 = $pdo->query($sql2);
            $result = $stmt2->fetch(PDO::FETCH_ASSOC);
            if ($result['cantidad']!=0){
                $promedio = $result['suma'] / $result['cantidad'];
            }
            else{
                $promedio = 'sin valoraciones';
            }
            echo "<li class='card' onclick='openModal(".$row['id_restaurante'].")'>";
            echo "<div class='img'><img src='./img/" . $row['imagen_res'] . "' alt='img' draggable='false'></div>";
            echo "<label>" . $row['nombre_restuarante'] . "</label>";
            echo "<div class='valoraciones'>";
            if (is_numeric($promedio)){
                if ($promedio==5){
                    echo "<img src='./img/estrella_valoracion_5.png' class='estrella_foto'>";
                }
                elseif ($promedio>=4.5 and $promedio<5){
                    echo "<img src='./img/estrella_valoracion_4,5.png' class='estrella_foto'>";
                }
                elseif ($promedio>=4.5 and $promedio<5){
                    echo "<img src='./img/estrella_valoracion_4,5.png' class='estrella_foto'>";
                }
                elseif ($promedio>=4 and $promedio<4.5){
                    echo "<img src='./img/estrella_valoracion_4.png' class='estrella_foto'>";
                }
                elseif ($promedio>=3.5 and $promedio<4){
                    echo "<img src='./img/estrella_valoracion_3,5.png' class='estrella_foto'>";
                }
                elseif ($promedio>=3 and $promedio<3.5){
                    echo "<img src='./img/estrella_valoracion_3.png' class='estrella_foto'>";
                }
                elseif ($promedio>=2.5 and $promedio<3){
                    echo "<img src='./img/estrella_valoracion_2,5.png' class='estrella_foto'>";
                }
                elseif ($promedio>=2 and $promedio<2.5){
                    echo "<img src='./img/estrella_valoracion_2.png' class='estrella_foto'>";
                }
                elseif ($promedio>=1.5 and $promedio<2){
                    echo "<img src='./img/estrella_valoracion_1,5.png' class='estrella_foto'>";
                }
                elseif ($promedio>=1 and $promedio<1.5){
                    echo "<img src='./img/estrella_valoracion_1.png' class='estrella_foto'>";
                }
                elseif ($promedio>=0.1 and $promedio<1){
                    echo "<img src='./img/estrella_valoracion_0,5.png' class='estrella_foto'>";
                }
            }
            else{
                echo "<span style='font-size: 16px;'>opiniones</span>";
            }
            echo "<strong class='numeroR'>" .  round($promedio * 10) / 10 . "</strong>";
            echo "</div>";
            echo "<span>Precio medio de " . $row['precio_medio'] . "</span>";
            echo "</li>";
        }
    }
    elseif ($valoracion!=''){
        $zero=true;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $promedio2='';
            $sql2 = "SELECT COUNT(valoracion) AS cantidad, SUM(valoracion) AS suma FROM tbl_valoracion WHERE restaurante = " . $row['id_restaurante'] ."";
            $stmt2 = $pdo->query($sql2);
            $result = $stmt2->fetch(PDO::FETCH_ASSOC);
            if ($result['cantidad']!=0){
                $promedio = $result['suma'] / $result['cantidad'];
                $promedio2 = floor($promedio);
            }
            else{
                $promedio = 'sin valoraciones';
            }
            if ($promedio2!=$valoracion){
                echo "<li class='card' style='display: none;'>";
            }
            else{
                echo "<li class='card' onclick='openModal(".$row['id_restaurante'].")'>";
                $zero=false;
            }
            echo "<div class='img'><img src='./img/" . $row['imagen_res'] . "' alt='img' draggable='false'></div>";
            echo "<label>" . $row['nombre_restuarante'] . "</label>";
            echo "<div class='valoraciones'>";
            if (is_numeric($promedio)){
                if ($promedio==5){
                    echo "<img src='./img/estrella_valoracion_5.png' class='estrella_foto'>";
                }
                elseif ($promedio>=4.5 and $promedio<5){
                    echo "<img src='./img/estrella_valoracion_4,5.png' class='estrella_foto'>";
                }
                elseif ($promedio>=4.5 and $promedio<5){
                    echo "<img src='./img/estrella_valoracion_4,5.png' class='estrella_foto'>";
                }
                elseif ($promedio>=4 and $promedio<4.5){
                    echo "<img src='./img/estrella_valoracion_4.png' class='estrella_foto'>";
                }
                elseif ($promedio>=3.5 and $promedio<4){
                    echo "<img src='./img/estrella_valoracion_3,5.png' class='estrella_foto'>";
                }
                elseif ($promedio>=3 and $promedio<3.5){
                    echo "<img src='./img/estrella_valoracion_3.png' class='estrella_foto'>";
                }
                elseif ($promedio>=2.5 and $promedio<3){
                    echo "<img src='./img/estrella_valoracion_2,5.png' class='estrella_foto'>";
                }
                elseif ($promedio>=2 and $promedio<2.5){
                    echo "<img src='./img/estrella_valoracion_2.png' class='estrella_foto'>";
                }
                elseif ($promedio>=1.5 and $promedio<2){
                    echo "<img src='./img/estrella_valoracion_1,5.png' class='estrella_foto'>";
                }
                elseif ($promedio>=1 and $promedio<1.5){
                    echo "<img src='./img/estrella_valoracion_1.png' class='estrella_foto'>";
                }
                elseif ($promedio>=0.1 and $promedio<1){
                    echo "<img src='./img/estrella_valoracion_0,5.png' class='estrella_foto'>";
                }
            }
            else{
                echo "<span style='font-size: 16px;'>opiniones</span>";
            }
            echo "<strong class='numeroR'>" .  round($promedio * 10) / 10 . "</strong>";
            echo "</div>";
            echo "<span>Precio medio de " . $row['precio_medio'] . "</span>";
            echo "</li>";
        }
    }
echo "</ul>";
if ($zero!=true){
    echo "<i id='left' class='fa-solid fa-angle-left'></i>";
    echo "<i id='right' class='fa-solid fa-angle-right'></i>";
}
else{
    echo "<h1 style='color: green;'>0 resultados</h1>";
}
}
else{
    echo "<div>
        <h1 style='color: green;'>0 resultados</h1>
    </div>";
}
echo "</div>";
?>