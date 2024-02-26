<?php
include_once('../inc/conexion.php');

$jsonData = json_decode(file_get_contents("php://input"), true);

$name = $jsonData['name'];
$owner = $jsonData['owner'];
$direc = $jsonData['direccion'];
$email = $jsonData['email'];
$tipo = $jsonData['tipos'];

try {
    $pdo->beginTransaction();

    $sql1 = $pdo->prepare("INSERT INTO tbl_restaurante (nombre_restaurante, propietario, direccion, email_oficial, id_restaurante) VALUES (:nr, :ow, :dr, :eo, :ir)");

    $sql1->bindParam(":nr", $name, PDO::PARAM_STR);
    $sql1->bindParam(":ow", $owner, PDO::PARAM_STR);
    $sql1->bindParam(":dr", $direc, PDO::PARAM_STR);
    $sql1->bindParam(":eo", $email, PDO::PARAM_STR);
    $sql1->bindParam(":ir", $id, PDO::PARAM_INT);
    $sql1->execute();

    $lastInsertId = $pdo->lastInsertId();

    foreach ($tipo as $value) {
        $sql2 = $pdo->prepare("INSERT INTO tbl_comida_restaurante(id_comida, id_restaurante) VALUES (:ti, :ir)");
        $sql2->bindParam(":ti", $value, PDO::PARAM_INT);
        $sql2->bindParam(":ir", $lastInsertId, PDO::PARAM_INT);
        $sql2->execute();
    }

    $pdo->commit();
    echo "Transaction successful.";
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Transaction failed: " . $e->getMessage();
}
