<?php

// if (!filter_has_var(INPUT_POST, 'regOk')) {
//     header('Location: ../indexRegister.php');
//     exit();
// } else {
    if($_POST['regMail'] !== '' && $_POST["regPwd"] !== '') { 
    try {
        // Conexión a la base de datos
        require_once("./conexion.php");
        $user = $_POST['regMail'];
        $password = $_POST['regPwd'];

        $query = "SELECT id_user, username, pwd, es_admin FROM tbl_user WHERE username = :username AND valid = 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $user);
        $stmt->execute();
        $resultadoConsulta = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener todas las filas como un array asociativo
        $stmt->closeCursor();
        foreach ($resultadoConsulta as $fila) {
            $userid = $fila['id_user'];
            $hashedPassword = $fila['pwd'];                       }
            if (password_verify($password, $hashedPassword)) {
                session_start();
                $_SESSION['username'] = $user;
                $_SESSION["user_id"] = $userid;
                $_SESSION['rol'] = $fila['es_admin'];
                echo 'ok';
                exit();
            }else{
                // Error en el inicio de sesión
                echo 'error';
            }
        exit();

    } catch (PDOException $e) {
        echo "Error in the database connection" . $e->getMessage();
        $pdo = null;
        die();
    }
    }else{
        echo 'error';

    }
?>