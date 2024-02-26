<?php
session_start();
require_once("./inc/conexion.php");
if (!isset($_SESSION['username']) && $_SESSION['rol'] !== 1) {
    header('Location: ./home.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- jQuery -->
    <script src='https://code.jquery.com/jquery-3.7.0.js'></script>
    <!-- Data Table JS -->
    <script src='https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js'></script>
    <script src='https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./css/adminus.css">
    <title>CRUD</title>
</head>
<div class="encabezado-img">
</div>

<body>
    <div class="container">
        <div id="contenedor_busquedas"> <br>
            <a href="./pagina.php">⬅</a>
            <h1>CRUD USUARIOS</h1><br>
            <label for="word">Buscar: </label><input class="busqueda" id="wordU" type="text">
            <label for="order">Orden: </label><select name="" id="orderU" class="busqueda1">
        </div>
        <option></option>
        <option value="username">Usuario</option>
        <option value="nombre_completo">Nombre</option>
        </select>
        <div id='button_add'>
            <button id='newuser'>Agregar Usuarios</button>
        </div>
        <br>
        <div class="table-responsive">
            <table id='CRUD_table' class="table">
                <thead>
                    <tr id="mail">
                        <th scope="col">Usuario</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Restaurante</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody id="bodyCrud">
        </div>
    </div>
    <div id='alert'></div>
    <script>

    </script>
    <script src="./js/crudUser.js"></script>
</body>

</html>