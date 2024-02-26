<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./admin.css">
</head>

<body>

</body>

</html>
<?php
include_once('../inc/conexion.php');

$jsonData = json_decode(file_get_contents("php://input"), true);

$page = isset($jsonData['page']) ? intval($jsonData['page']) : 1;
$records_per_page = 6;
$offset = ($page - 1) * $records_per_page;

$stmt = "SELECT r.id_restaurante, r.nombre_restaurante, u.username, r.direccion, GROUP_CONCAT(c.nombre_comida) as nombre_comidas, r.imagen_res, r.email_oficial 
         FROM tbl_restaurante r 
         INNER JOIN tbl_user u ON u.id_user = r.propietario 
         INNER JOIN tbl_comida_restaurante cr ON cr.id_restaurante = r.id_restaurante 
         INNER JOIN tipo_comida c ON cr.id_comida = c.id_comida 
         WHERE 1=1";

if (isset($jsonData['word']) && $jsonData['word'] != '') {
    $word = $jsonData['word'];
    $stmt .= " AND (r.nombre_restaurante LIKE '%$word%' OR r.direccion LIKE '%$word%' OR r.email_oficial LIKE '%$word%')";
}

if (isset($jsonData['check']) && !empty($jsonData['check'])) {
    $stmt .= ' AND (';
    foreach ($jsonData['check'] as $value) {
        $stmt .= "c.nombre_comida LIKE '%$value%' OR ";
    }
    $stmt = rtrim($stmt, ' OR ') . ')';
}

$stmt .= " GROUP BY r.id_restaurante, r.nombre_restaurante, u.username, r.direccion, r.imagen_res, r.email_oficial";

if (isset($jsonData['check']) && !empty($jsonData['check'])) {
    $stmt .= ' HAVING';
    foreach ($jsonData['check'] as $value) {
        $stmt .= " SUM(c.nombre_comida LIKE '%$value%') > 0 AND";
    }
    $stmt = rtrim($stmt, ' AND ');
}

if (isset($jsonData['order']) && $jsonData['order'] != '') {
    $stmt .= ' ORDER BY ' . $jsonData['order'];
}

$stmt .= " LIMIT $offset, $records_per_page";

$sql = $pdo->prepare($stmt);
$sql->execute();

$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultado as $row) {
    echo "<tr>";
    foreach ($row as $key => $value) {
        if ($key !== 'id_restaurante') {
            echo '<td class="valores">' . $value . '</td>';
        }
    }
    echo '<td><button onclick="editar_res(' . $row['id_restaurante'] . ')" class="btn btn-success">Editar</button></td>' .
        '<td><button onclick="elim_res(' . $row['id_restaurante'] . ')"  class="btn btn-danger">Eliminar</button></td></tr>';
}

echo '</tbody></table>';

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
