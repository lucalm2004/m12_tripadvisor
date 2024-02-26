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
    <link rel="stylesheet" href="./css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>CRUD</title>
</head>

<body>

    <div class="encabezado-img"></div>
    <div class>
        <div class="card-busqueda">
            <div id="contenedor_busquedas">
                <a href="./pagina.php">⬅</a>
                <h1>CRUD RESTAURANTES</h1><br>
                <label for="word"></label><input class="busqueda" id="word" type="text" placeholder="Buscar...">
                <label for="order" placeholder="Orden..."></label><select name="" id="order" class="busqueda">
                    <option></option>
                    <option value="nombre_restaurante">Nombre</option>
                    <option value="propietario">Propietario</option>
                    <option value="direccion">Direccion</option>
                </select>
            </div>
            <!-- <label for="filtro">Filtrar: </label> -->
            <div id="filtro">
                <?php
                include_once('./inc/conexion.php');

                $sql = $pdo->prepare('SELECT * FROM tipo_comida ORDER BY nombre_comida');
                $sql->execute();

                $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultado as $index => $valor) {
                    if ($index % 5 == 0 && $index != 0) {
                        echo '</ul>';
                        echo '</div>';
                    }
                    if ($index % 5 == 0) {
                        echo '<div class="col_filtro">';
                        echo '<ul>';
                    }

                    echo '<li><input class="checkbox" type="checkbox" name="" value="' . $valor['nombre_comida'] . '"><label>' . $valor['nombre_comida'] . '</label></li>';
                }
                echo '</ul>';
                echo '</div>';
                ?>
            </div>
        </div>
        <div id='button_add'>
            <button id='newRest' class="btn btn-success">Agregar Restaurante</button>
        </div>
        <div class="card-tabla">
            <div class="table-responsive">
                <table id='CRUD_table' class="table">
                    <thead>
                        <tr id="mail">
                            <th scope="col">Nombre</th>
                            <th scope="col">Propietario</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Tipo Comida</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="bodyCrud">
            </div>
        </div>
    </div>
    <div id='alert'></div>
    <script>

    </script>
    <script src="./js/script.js"></script>
</body>

</html>