<?php
// Incluir el archivo de conexión a la base de datos
include_once("./conexion.php");

// Iniciar sesión
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../home.php');
    exit();
}

// Verificar si se recibió una solicitud POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $comentario = $_POST['comentario'];
    $ranking = $_POST['rating'];
    $user_id = $_SESSION["user_id"];
    $restaurante = $_POST['id_res'];
    echo $ranking;

    try {
        // Preparar la consulta SQL para insertar una nueva valoración
        $sql = "INSERT INTO tbl_valoracion (username,comentario, valoracion,restaurante) VALUES (:username,:comentario, :valoracion,:restaurante)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
        $stmt->bindParam(':valoracion', $ranking, PDO::PARAM_STR);
        $stmt->bindParam(':username', $user_id, PDO::PARAM_STR);
        $stmt->bindParam(':restaurante', $restaurante, PDO::PARAM_STR);

        $stmt->execute();
        // echo "vale";

        // Mensaje de éxito
        // echo "La valoración se ha registrado correctamente.";
    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        echo "Error al registrar la valoración: " . $e->getMessage();
    }
}
?>