<?php

    try {
        // Conexión a la base de datos
        require_once("./conexion.php");
        $email = $_POST['email'];

        /* SEGUNDA CONSULTA */
        // Insertar el nuevo usuario en la base de datos
        $query2 = "UPDATE tbl_user SET valid='1' where mail = :email";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam(':email', $email);
        $stmt2->execute();
        $stmt2->closeCursor();
        $pdo = null;
        exit();

    } catch (PDOException $e) {
        echo "Error in the database pdoection" . $e->getMessage();
        $pdo = null;
        die();
    }
// }
?>