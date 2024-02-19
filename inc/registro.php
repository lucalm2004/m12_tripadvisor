<?php

    try {
        // Conexión a la base de datos
        require_once("./conexion.php");
        $user = $_POST['userR'];
        $email = $_POST['corrR'];
        $password = $_POST['contra1R'];
        $name = $_POST['name'];

    

        /* PRIMERA CONSULTA */
        // Verificar si el nombre de usuario ya está en uso
        $query = "SELECT id_user FROM tbl_user WHERE username = :username or mail = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $user);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $resultadoPrimeraConsulta = $stmt->fetchAll();
        $stmt->closeCursor();

        if (!empty($resultadoPrimeraConsulta)) {
        echo('usuarioRepetido');            
        $pdo = null;
            exit();
        }

        // Hashear la contraseña antes de almacenarla en la base de datos con BCRYPT
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        /* SEGUNDA CONSULTA */
        // Insertar el nuevo usuario en la base de datos
        $query2 = "INSERT INTO tbl_user (username, mail, pwd, nombre_completo) VALUES (:username,:email,:contrasena, :nombre)";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam(':username', $user);
        $stmt2->bindParam(':contrasena', $hashedPassword);
        $stmt2->bindParam(':email', $email);
        $stmt2->bindParam(':nombre', $name);

        $stmt2->execute();
        $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $stmt2->closeCursor();
        $pdo = null;

        // Registro exitoso, redirige al usuario a la página de inicio de sesión
        echo 'ok';
        exit();

    } catch (PDOException $e) {
        echo "Error in the database pdoection" . $e->getMessage();
        $pdo = null;
        die();
    }
// }
?>