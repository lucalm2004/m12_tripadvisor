<?php

include_once('../inc/conexion.php');

$jsonData = json_decode(file_get_contents("php://input"), true);

$id = $jsonData['id'];

try {
    $sql_com = $pdo->prepare('DELETE FROM tbl_comida_restaurante WHERE id_restaurante = :ir');
    $sql_com->bindParam(":ir", $id, PDO::PARAM_INT);
    $sql_com->execute();

    $sql_val = $pdo->prepare('DELETE FROM tbl_valoracion WHERE restaurante = :ir');
    $sql_val->bindParam(":ir", $id, PDO::PARAM_INT);
    $sql_val->execute();

    $sql_res = $pdo->prepare('DELETE FROM tbl_restaurante WHERE id_restaurante = :ir');
    $sql_res->bindParam(":ir", $id, PDO::PARAM_INT);
    $sql_res->execute();
} catch (PDOException $e) {
    echo "Ha ocurrido un error con el registro " . $e->getMessage();
    die();
}
