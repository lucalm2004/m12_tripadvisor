<?php

include_once('./conexion.php');

$jsonData = json_decode(file_get_contents("php://input"), true);

$id = $jsonData['id'];

try {
    $sql_res = $pdo->prepare('UPDATE tbl_restaurante SET propietario = NULL WHERE propietario = :ir');
    $sql_res->bindParam(":ir", $id, PDO::PARAM_INT);
    $sql_res->execute();

    $sql_com = $pdo->prepare('DELETE FROM tbl_user WHERE id_user = :iu');
    $sql_com->bindParam(":iu", $id, PDO::PARAM_INT);
    $sql_com->execute();
} catch (PDOException $e) {
    
    echo "Ha ocurrido un error con el registro " . $e->getMessage();
    die();
}
