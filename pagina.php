<?php
session_start();
require_once("./inc/conexion.php");
if (!isset($_SESSION['username'])) {
    header('Location: ./home.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tripadvisor: Web</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="icon" id="favicon" href="https://static.tacdn.com/favicon.ico?v2" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

</head>

<body class="body2">
    <nav class="navbar">
        <img src="./img/tripadvisor.svg" class="logo">
        <button class="boton2">Inicio</button>
        <button class="boton2">Mejores valorados</button>
        <button class="boton2">Opinión</button>
        <a href="./inc/cerrarSesion.php" class="salir">Cerrar Sesión</a>
        <?php
        if ($_SESSION['rol'] == 1) {
            echo "<a href=''><button class='boton2'>Administrar</button></a>";
        }

        ?>
    </nav>
    <div class="cuerpo">
        <h1>Busca sitios para comer</h1>
        <div class="filtros">
            <select name="" id="valoracion" class="mi-select">
                <option value="">Según las estrellas</option>
                <option value="1">1 estrella</option>
                <option value="2">2 estrellas</option>
                <option value="3">3 estrellas</option>
                <option value="4">4 estrellas</option>
                <option value="5">5 estrellas</option>

            </select>
            <select name="" id="precio" class="mi-select">
                <option value="">Según el precio medio</option>
                <option value="1">Menos de 10€</option>
                <option value="2">De 10€ a 20€</option>
                <option value="3">De 20€ a 30€</option>
                <option value="4">De 30€ a 40€</option>
                <option value="5">De 40€ a 50€</option>
                <option value="6">Mas de 50€</option>
            </select>
            
            <select name="" id="tipoC" class="mi-select">
                <option value="">tipo de comida</option>
                <?php
                $sql = "SELECT * FROM tipo_comida";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $tipos_comida = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tipos_comida as $tipo) {
                    echo "<option value='" . $tipo['id_comida'] . "'>" . $tipo['nombre_comida'] . "</option>";
                }
                ?>
            </select>
            <button id="resetF" class="">Resetear</button>

        </div>
        <br>
        <div>
            <div class="lupa">
                <input type="search" name="" id="campo-busqueda" class="campo-busqueda" placeholder="Buscar...">
                <button class="botonL" id="buscarR">Buscar</button>
            </div>
            <br>
            <br>
        </div>
    </div>
    <br>
    <div class="fondoTar" id="carR">
        <div class="wrapper">
            <ul class="carousel">
            <?php
                // Consulta SQL corregida
                $sql = "SELECT tbl_restaurante.id_restaurante, tbl_restaurante.nombre_restuarante, tbl_restaurante.precio_medio, tbl_restaurante.valoracion, tbl_restaurante.imagen_res FROM tbl_restaurante";

                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($stmt->rowCount() > 0) {
                    foreach ($resultado as $row) {
                        $sql2 = "SELECT COUNT(valoracion) AS cantidad, SUM(valoracion) AS suma FROM tbl_valoracion WHERE restaurante = " . $row['id_restaurante'];
                        $stmt2 = $pdo->query($sql2);
                        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                        if ($result2['cantidad'] != 0) {
                            $promedio = $result2['suma'] / $result2['cantidad'];
                        } else {
                            $promedio = 'sin valoraciones';
                        }
                        echo "<li class='card' onclick='openModal(".$row['id_restaurante'].")'>";
                        echo "<div class='img'><img src='./img/" . $row['imagen_res'] . "' alt='img' draggable='false'></div>";
                        echo "<label>" . $row['nombre_restuarante'] . "</label>";
                        echo "<div class='valoraciones'>";
                        if (is_numeric($promedio)) {
                            if ($promedio == 5) {
                                echo "<img src='./img/estrella_valoracion_5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 4.5 and $promedio < 5) {
                                echo "<img src='./img/estrella_valoracion_4,5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 4 and $promedio < 4.5) {
                                echo "<img src='./img/estrella_valoracion_4.png' class='estrella_foto'>";
                            } elseif ($promedio >= 3.5 and $promedio < 4) {
                                echo "<img src='./img/estrella_valoracion_3,5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 3 and $promedio < 3.5) {
                                echo "<img src='./img/estrella_valoracion_3.png' class='estrella_foto'>";
                            } elseif ($promedio >= 2.5 and $promedio < 3) {
                                echo "<img src='./img/estrella_valoracion_2,5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 2 and $promedio < 2.5) {
                                echo "<img src='./img/estrella_valoracion_2.png' class='estrella_foto'>";
                            } elseif ($promedio >= 1.5 and $promedio < 2) {
                                echo "<img src='./img/estrella_valoracion_1,5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 1 and $promedio < 1.5) {
                                echo "<img src='./img/estrella_valoracion_1.png' class='estrella_foto'>";
                            } elseif ($promedio >= 0.1 and $promedio < 1) {
                                echo "<img src='./img/estrella_valoracion_0,5.png' class='estrella_foto'>";
                            }
                        } else {
                            echo "<span style='font-size: 16px;'>opiniones</span>";
                        }
                        echo "<strong class='numeroR'>" .  round($promedio * 10) / 10 . "</strong>";
                        echo "</div>";
                        echo "<span>Precio medio de " . $row['precio_medio'] . "</span>";
                        echo "</li>";
                    }
                } else {
                    echo "<div style='display: flex; justify-content: center; align-items: center;'>
                            <h1 style='color: green;'>0 resultados</h1>
                        </div>";
                }
            ?>
            </ul>
            <i id="left" class="fa-solid fa-angle-left"></i>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
    </div>
    <div>
        <div class="anuncio">
            <?php
            $sql = "SELECT imagen_res FROM tbl_restaurante ORDER BY tbl_restaurante.precio_medio ASC LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultado as $row) {
                echo "<img src='./img/". $row['imagen_res']."' class='rotada'>";
            }
            ?>
            
            <h2 class="h1O">El restaurante más asequible según nuestros usuarios.</h2>
        </div>
    </div>
    <div>
        <br>
        <br>
        <br>
        <h2 class="subT">Los Mas caros</h2>
    </div>
    <div class="fondoTar">
        <div class="wrapper">
            <ul class="carousel">
                <?php
                // Consulta SQL corregida
                $sql = "SELECT tbl_restaurante.id_restaurante, tbl_restaurante.nombre_restuarante, tbl_restaurante.precio_medio, tbl_restaurante.valoracion, tbl_restaurante.imagen_res FROM tbl_restaurante ORDER BY tbl_restaurante.precio_medio DESC LIMIT 12";

                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($stmt->rowCount() > 0) {
                    foreach ($resultado as $row) {
                        $sql2 = "SELECT COUNT(valoracion) AS cantidad, SUM(valoracion) AS suma FROM tbl_valoracion WHERE restaurante = " . $row['id_restaurante'];
                        $stmt2 = $pdo->query($sql2);
                        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                        if ($result2['cantidad'] != 0) {
                            $promedio = $result2['suma'] / $result2['cantidad'];
                        } else {
                            $promedio = 'sin valoraciones';
                        }
                        echo "<li class='card' onclick='openModal(".$row['id_restaurante'].")'>";
                        echo "<div class='img'><img src='./img/" . $row['imagen_res'] . "' alt='img' draggable='false'></div>";
                        echo "<label>" . $row['nombre_restuarante'] . "</label>";
                        echo "<div class='valoraciones'>";
                        if (is_numeric($promedio)) {
                            if ($promedio == 5) {
                                echo "<img src='./img/estrella_valoracion_5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 4.5 and $promedio < 5) {
                                echo "<img src='./img/estrella_valoracion_4,5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 4 and $promedio < 4.5) {
                                echo "<img src='./img/estrella_valoracion_4.png' class='estrella_foto'>";
                            } elseif ($promedio >= 3.5 and $promedio < 4) {
                                echo "<img src='./img/estrella_valoracion_3,5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 3 and $promedio < 3.5) {
                                echo "<img src='./img/estrella_valoracion_3.png' class='estrella_foto'>";
                            } elseif ($promedio >= 2.5 and $promedio < 3) {
                                echo "<img src='./img/estrella_valoracion_2,5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 2 and $promedio < 2.5) {
                                echo "<img src='./img/estrella_valoracion_2.png' class='estrella_foto'>";
                            } elseif ($promedio >= 1.5 and $promedio < 2) {
                                echo "<img src='./img/estrella_valoracion_1,5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 1 and $promedio < 1.5) {
                                echo "<img src='./img/estrella_valoracion_1.png' class='estrella_foto'>";
                            } elseif ($promedio >= 0.1 and $promedio < 1) {
                                echo "<img src='./img/estrella_valoracion_0,5.png' class='estrella_foto'>";
                            }
                        } else {
                            echo "<span style='font-size: 16px;'>opiniones</span>";
                        }
                        echo "<strong class='numeroR'>" .  round($promedio * 10) / 10 . "</strong>";
                        echo "</div>";
                        echo "<span>Precio medio de " . $row['precio_medio'] . "</span>";
                        echo "</li>";
                    }
                } else {
                    echo "<div style='display: flex; justify-content: center; align-items: center;'>
                            <h1 style='color: green;'>0 resultados</h1>
                        </div>";
                }
                ?>
            </ul>
            <i id="right" class="fa-solid fa-angle-right"></i>
            <i id="left" class="fa-solid fa-angle-left"></i>
        </div>
    </div>
    <div>
        <br>
        <br>
        <br>
        <h2 class="subT">Los Mas baratos</h2>
    </div>
    <div class="fondoTar">
        <div class="wrapper">
            <ul class="carousel">
                <?php
                // Consulta SQL corregida
                $sql = "SELECT tbl_restaurante.id_restaurante, tbl_restaurante.nombre_restuarante, tbl_restaurante.precio_medio, tbl_restaurante.valoracion, tbl_restaurante.imagen_res FROM tbl_restaurante ORDER BY tbl_restaurante.precio_medio LIMIT 12";

                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($stmt->rowCount() > 0) {
                    foreach ($resultado as $row) {
                        $sql2 = "SELECT COUNT(valoracion) AS cantidad, SUM(valoracion) AS suma FROM tbl_valoracion WHERE restaurante = " . $row['id_restaurante'];
                        $stmt2 = $pdo->query($sql2);
                        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                        if ($result2['cantidad'] != 0) {
                            $promedio = $result2['suma'] / $result2['cantidad'];
                        } else {
                            $promedio = 'sin valoraciones';
                        }
                        echo "<li class='card' onclick='openModal(".$row['id_restaurante'].")'>";
                        echo "<div class='img'><img src='./img/" . $row['imagen_res'] . "' alt='img' draggable='false'></div>";
                        echo "<label>" . $row['nombre_restuarante'] . "</label>";
                        echo "<div class='valoraciones'>";
                        if (is_numeric($promedio)) {
                            if ($promedio == 5) {
                                echo "<img src='./img/estrella_valoracion_5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 4.5 and $promedio < 5) {
                                echo "<img src='./img/estrella_valoracion_4,5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 4 and $promedio < 4.5) {
                                echo "<img src='./img/estrella_valoracion_4.png' class='estrella_foto'>";
                            } elseif ($promedio >= 3.5 and $promedio < 4) {
                                echo "<img src='./img/estrella_valoracion_3,5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 3 and $promedio < 3.5) {
                                echo "<img src='./img/estrella_valoracion_3.png' class='estrella_foto'>";
                            } elseif ($promedio >= 2.5 and $promedio < 3) {
                                echo "<img src='./img/estrella_valoracion_2,5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 2 and $promedio < 2.5) {
                                echo "<img src='./img/estrella_valoracion_2.png' class='estrella_foto'>";
                            } elseif ($promedio >= 1.5 and $promedio < 2) {
                                echo "<img src='./img/estrella_valoracion_1,5.png' class='estrella_foto'>";
                            } elseif ($promedio >= 1 and $promedio < 1.5) {
                                echo "<img src='./img/estrella_valoracion_1.png' class='estrella_foto'>";
                            } elseif ($promedio >= 0.1 and $promedio < 1) {
                                echo "<img src='./img/estrella_valoracion_0,5.png' class='estrella_foto'>";
                            }
                        } else {
                            echo "<span style='font-size: 16px;'>opiniones</span>";
                        }
                        echo "<strong class='numeroR'>" .  round($promedio * 10) / 10 . "</strong>";
                        echo "</div>";
                        echo "<span>Precio medio de " . $row['precio_medio'] . "</span>";
                        echo "</li>";
                    }
                } else {
                    echo "<div style='display: flex; justify-content: center; align-items: center;'>
                            <h1 style='color: green;'>0 resultados</h1>
                        </div>";
                }
                ?>
            </ul>
            <i id="right" class="fa-solid fa-angle-right"></i>
            <i id="left" class="fa-solid fa-angle-left"></i>
        </div>
    </div>
    <div class="restauranteModal" id="restauranteModal" style="display: none;">

</div>
    <footer class="footer">
        <div>
            <label for="" class="tn">Acerca de TripAdvisor</label>
            <ul>
                <li>Solo colaboramos con restaurantes y bares</li>
                <li>Cocina auténtica y deliciosa</li>
                <li>Ambientes acogedores y elegantes para disfrutar con amigos y familia</li>
                <li>Variedad de bebidas refrescantes y cocteles innovadores</li>
                <li>Servicio profesional y atento para garantizar una experiencia inolvidable</li>
                <li>Opciones vegetarianas y veganas para todos los gustos</li>
            </ul>
        </div>
        <div>
            <label class="tn">Nuestro Compromiso</label>
            <ul>
                <li>Garantizamos la transparencia y veracidad en todas nuestras reseñas</li>
                <li>Valoramos y respetamos la opinión de cada usuario</li>
                <li>Promovemos la honestidad y autenticidad en cada reseña publicada</li>
                <li>Estamos comprometidos con la calidad y fiabilidad de la información proporcionada</li>
                <li>Proporcionamos una plataforma segura y confiable para compartir experiencias</li>
                <li>Trabajamos constantemente para mejorar y enriquecer la experiencia del usuario</li>
            </ul>
        </div>
        <div>
            <label for="" class="tn">Nuestras redes sociales</label>
            <ul>
                <li><a href="">Facebook</a></li>
                <li><a href="">Instagram</a></li>
                <li><a href="">Twitter</a></li>
                <li><a href="">YouTube</a></li>
            </ul>
        </div>
    </footer>
</body>

</html>
<script src="./js/jsPagina.js"></script>
<script src="./js/tarjetas.js"></script>
<script src="./js/buscarR.js"></script>
<script src="./js/script_cmnt.js"></script>
<!-- <script src="./js/estrellas.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>