<?php
session_start();
require_once("./conexion.php");
if (!isset($_SESSION['username'])){
    header('Location: ../home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipo'])) {
    $targetDirectory = '../img/';
    // echo $_POST['tipo'];
    $targetName = 'ban'.$_POST['tipo'] . '.jpg';
    $targetFile = $targetDirectory . $targetName;
    // basename($_FILES['file']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen
    $check = getimagesize($_FILES['file']['tmp_name']);
    if ($check !== false) {
        if ($imageFileType === 'jpg' || $imageFileType === 'jpeg' || $imageFileType === 'png' || $imageFileType === 'gif') {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
                echo json_encode(['success' => true, 'filename' => basename($targetFile)]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error al mover el archivo']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Formato de imagen no permitido']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'El archivo no es una imagen']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Solicitud no válida']);
}
?>
