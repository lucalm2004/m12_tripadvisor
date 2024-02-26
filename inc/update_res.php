<?php
include_once('../inc/conexion.php');

$jsonData = json_decode(file_get_contents("php://input"), true);

$id = $jsonData['id'];
$name = $jsonData['name'];
$owner = $jsonData['owner'];
$direc = $jsonData['direccion'];
$email = $jsonData['email'];
$tipo = $jsonData['tipos'];

try {
    // Begin transaction
    $pdo->beginTransaction();

    $sql1 = $pdo->prepare("UPDATE tbl_restaurante SET 
                            nombre_restaurante = :nr,
                            propietario = :ow,
                            direccion = :dr,
                            email_oficial = :eo
                            WHERE id_restaurante = :ir");

    $sql1->bindParam(":nr", $name, PDO::PARAM_STR);
    $sql1->bindParam(":ow", $owner, PDO::PARAM_STR);
    $sql1->bindParam(":dr", $direc, PDO::PARAM_STR);
    $sql1->bindParam(":eo", $email, PDO::PARAM_STR);
    $sql1->bindParam(":ir", $id, PDO::PARAM_INT);
    $sql1->execute();

    $sql2 = $pdo->prepare("DELETE FROM tbl_comida_restaurante WHERE id_restaurante = :ir");
    $sql2->bindParam(":ir", $id, PDO::PARAM_INT);
    $sql2->execute();

    foreach ($tipo as $value) {
        $sql3 = $pdo->prepare("INSERT INTO tbl_comida_restaurante(id_comida, id_restaurante) VALUES (:ti, :ir)");
        $sql3->bindParam(":ti", $value, PDO::PARAM_INT);
        $sql3->bindParam(":ir", $id, PDO::PARAM_INT);
        $sql3->execute();
    }

    $pdo->commit();
    echo "Transaction successful.";
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Transaction failed: " . $e->getMessage();
}
