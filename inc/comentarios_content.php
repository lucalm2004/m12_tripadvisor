<?php
include_once('./conexion.php');

$jsonData = json_decode(file_get_contents("php://input"), true);

$id = $jsonData['id'];

$page = isset($jsonData['page']) ? intval($jsonData['page']) : 1;
$records_per_page = 10;
$offset = ($page - 1) * $records_per_page;

$stmt = "SELECT * FROM tbl_valoracion v INNER JOIN tbl_user u ON v.username = u.id_user WHERE v.restaurante = " . $id;

if (isset($jsonData['filter']) && !empty($jsonData['filter'])) {
    $stmt .= ' AND (';
    foreach ($jsonData['filter'] as $value) {
        $stmt .= "(valoracion <= $value AND valoracion >= " . ($value - 0.9) . ") OR ";
    }
    $stmt = rtrim($stmt, ' OR ') . ')';
}

$stmt .= " ORDER BY valoracion DESC";
$stmt .= " LIMIT $offset, $records_per_page";

$sql = $pdo->prepare($stmt);
$sql->execute();

$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultado as $row) {
    echo "<div>";
    echo "<h6>Usuario: " . $row['username'] . "</h6>";
    echo "<p>Comentario: " . $row['comentario'] . "</p>";
    echo "Valoración: " . $row['valoracion'] . "<br>";
    echo "</div>";
    echo "<br>";
}


$limitPosition = strpos($stmt, 'LIMIT');

if ($limitPosition !== false) {
    $newString = substr($stmt, 0, $limitPosition);
} else {
    $newString = $stmt;
}

$total_pages_query = $pdo->prepare($newString);
$total_pages_query->execute();
$total_rows = $total_pages_query->rowCount();
$total_pages = ceil($total_rows / $records_per_page);

echo '<nav aria-label="Page navigation example"><ul id="pagination" class="pagination">';
if ($total_pages <= 1) {
    echo "<li class='page-item disabled'><a class='page-link'>1</a></li>";
} else {
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<li onclick='changePage(" . $i . ")' class='page-item'><a class='page-link'>" . $i . "</a></li>";
    }
}

echo '</ul></nav>';