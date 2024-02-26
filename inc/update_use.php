<?php
include_once('./conexion.php');

$jsonData = json_decode(file_get_contents("php://input"), true);

$id = $jsonData['id'];
$name = $jsonData['name'];
$ncompleto = $jsonData['ncompleto'];
$email = $jsonData['email'];

try {
    $sql0 = $pdo->prepare("SELECT * FROM tbl_user WHERE id_user <> :id AND (username = :nr OR mail = :em)");
    $sql0->bindParam(":id", $id, PDO::PARAM_STR);
    $sql0->bindParam(":nr", $name, PDO::PARAM_STR);
    $sql0->bindParam(":em", $email, PDO::PARAM_STR);
    $sql0->execute();

    if ($sql0->fetchAll(PDO::FETCH_ASSOC)) {
        echo "Usuario o email ya en uso.";
    }else {
        $sql1 = $pdo->prepare("UPDATE tbl_user SET username = :nr, mail = :em, nombre_completo = :nc
                                WHERE id_user = :iu");

        $sql1->bindParam(":nr", $name, PDO::PARAM_STR);
        $sql1->bindParam(":nc", $ncompleto, PDO::PARAM_STR);
        $sql1->bindParam(":em", $email, PDO::PARAM_STR);
        $sql1->bindParam(":iu", $id, PDO::PARAM_INT);
        $sql1->execute();

        echo "Transaction successful.";
    }
} catch (PDOException $e) {
    echo "Transaction failed: " . $e->getMessage();
}
