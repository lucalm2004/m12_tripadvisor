<?php
include_once('./conexion.php');

$jsonData = json_decode(file_get_contents("php://input"), true);

$page = isset($jsonData['page']) ? intval($jsonData['page']) : 1;
$records_per_page = 6;
$offset = ($page - 1) * $records_per_page;

$stmt = "SELECT id_user, username, nombre_completo, mail, es_admin FROM tbl_user WHERE 1=1";

if (isset($jsonData['word']) && $jsonData['word'] != '') {
    $word = $jsonData['word'];
    $stmt .= " AND (username LIKE '%$word%' OR nombre_completo LIKE '%$word%' OR mail LIKE '%$word%')";
}

if (isset($jsonData['check']) && !empty($jsonData['check'])) {
    $stmt .= ' AND (';
    foreach ($jsonData['check'] as $value) {
        $stmt .= "c.nombre_comida LIKE '%$value%' OR ";
    }
    $stmt = rtrim($stmt, ' OR ') . ')';
}

if (isset($jsonData['order']) && $jsonData['order'] != '') {
    $stmt .= ' ORDER BY ' . $jsonData['order'];
}

$stmt .= " LIMIT $offset, $records_per_page";

$sql = $pdo->prepare($stmt);
$sql->execute();

$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = 'SELECT u.id_user, r.nombre_restaurante FROM tbl_user u INNER JOIN tbl_restaurante r ON u.id_user = r.propietario;';
$sql2 = $pdo->prepare($stmt2);
$sql2->execute();
$resultado2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

$restaurantes_por_usuario = [];
foreach ($resultado2 as $res) {
    $id_usuario = $res['id_user'];
    $nombre_restaurante = $res['nombre_restaurante'];

    if (!isset($restaurantes_por_usuario[$id_usuario])) {
        $restaurantes_por_usuario[$id_usuario] = [];
    }

    $restaurantes_por_usuario[$id_usuario][] = $nombre_restaurante;
}

foreach ($resultado as $row) {
    echo "<tr>";
    foreach ($row as $key => $value) {
        if ($key !== 'id_user' && $key !== 'es_admin') {
            echo '<td>' . $value . '</td>';
        }
    }

    if (isset($restaurantes_por_usuario[$row['id_user']])) {
        echo '<td>';
        foreach ($restaurantes_por_usuario[$row['id_user']] as $restaurante) {
            echo $restaurante . '<br>';
        }
        echo '</td>';
    } else {
        echo '<td>No hay restaurantes asociados</td>';
    }
    echo '<td><button onclick="editar_use(' . $row['id_user'] . ')" class="btn btn-success" >Editar</button></td><td><button onclick="elim_use(' . $row['id_user'] . ')"class="btn btn-danger">Eliminar</button></td></tr>';
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
