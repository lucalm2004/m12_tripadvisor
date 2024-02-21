<?php
session_start();
require_once("./inc/conexion.php");
if (!isset($_SESSION['username'])){
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
    <link rel="icon" id="favicon" href="https://static.tacdn.com/favicon.ico?v2" type="image/x-icon">
</head>
<body class="body2">
    <nav class="navbar">
        <img src="./img/tripadvisor.svg" class="logo">
        <button class="boton2">Inicio</button>
        <button class="boton2">Restaurantes mejores valorados</button>
        <button class="boton2">Opinion</button>
        <a href="./inc/cerrarSesion.php" class="salir">Cerrar Sesión</a>
        <?php
        if ($_SESSION['rol']==1){
            echo "<a href=''><button class='boton2'>Administrar</button></a>";
        }

        ?>
    </nav>
    <div class="cuerpo">
        <h1>Busca sitios para comer</h1>
        <div class="filtros">
            <select name="" id="" class="mi-select">
                <option value="">Según las estrellas</option>
                <option value="1">1 estrella</option>
                <option value="2">2 estrellas</option>
                <option value="3">3 estrellas</option>
                <option value="4">4 estrellas</option>
                <option value="5">5 estrellas</option>

            </select>  
            <select name="" id="" class="mi-select">
                <option value="">Según el precio medio</option>
                <option value="1">Menos de 10€</option>
                <option value="2">De 10€ a 20€</option>
                <option value="3">De 20€ a 30€</option>
                <option value="4">De 30€ a 40€</option>
                <option value="5">De 40€ a 50€</option>
                <option value="6">Mas de 50€</option>
            </select>
            <select name="" id="" class="mi-select">
            <option value="">tipo de comida</option>
            <?php
                $sql = "SELECT * FROM tipo_comida";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $tipos_comida = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($tipos_comida as $tipo) {
                    echo "<option value='" . $tipo['id_comida'] . "'>" . $tipo['nombre_comida'] . "</option>";
                }
            ?>
            </select>
        </div>
        <br>
        <div>
            <div class="lupa">
                <input type="search" name="" id="" class="campo-busqueda" placeholder="Buscar...">
                <button class="botonL">Buscar</button>
            </div>  
            <br>  
            <br>
        </div>
    </div>
    <div>
        <div class="restauranteModal" id="restauranteModal">
            <button type="button" class="cerrar" id="cerrarR"><img src="./img/cerrar.png" class="imgB"></button>
            <br>
            <div class="tituloR">
                <h1 class="h1R">Titulo Restaurante</h1>
                <img src="" alt="estrellas">
                <label for="">Numero opiniones</label>
            </div>
            <br>
            <img src="./img/banner.png" alt="banerR" class="portada">
            <br>
            <br>
            <div class="columna">
                <h2 class="h2M">Puntuaciones y opiniones:</h2>
                <label for="">media de puntuacion</label>
                <img src="" alt="Imagen de puntuaciones y opiniones">
            </div>
            <div class="columna">
                <h2 class="h2M">Detalles:</h2>
                <label for="">Rango de precios</label>
                <br>
                <br>
                <label for="">Precio</label>
                <br>
                <br>
                <label for="">Tipos de cociona</label>
                <br>
                <br>
                <label for="">tipos</label>
            </div>
            <div class="columna2">
                <h2 class="h2M">Ubicación y contacto:</h2>
                <label for="">Calle</label>
            </div>
        </div>
        <div>
            <!-- bucle con las opiniones -->
        </div>
    </div>
    <div>
        <?php
            $sql = "SELECT * FROM tbl_restaurante 
            INNER JOIN tbl_valoracion ON tbl_restaurante.valoracion = tbl_valoracion.id_valoracion 
            INNER JOIN tbl_comida_restaurante ON tbl_comida_restaurante.id_resturante = tbl_restaurante.id_restaurante";
        ?>
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
<script src="./js/jsPagina.js"></script><?php
session_start();
require_once("./inc/conexion.php");
if (!isset($_SESSION['username'])){
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
    <link rel="icon" id="favicon" href="https://static.tacdn.com/favicon.ico?v2" type="image/x-icon">
</head>
<body class="body2">
    <nav class="navbar">
        <img src="./img/tripadvisor.svg" class="logo">
        <button class="boton2">Inicio</button>
        <button class="boton2">Restaurantes mejores valorados</button>
        <button class="boton2">Opinion</button>
        <a href="./inc/cerrarSesion.php" class="salir">Cerrar Sesión</a>
        <?php
        if ($_SESSION['rol']==1){
            echo "<a href=''><button class='boton2'>Administrar</button></a>";
        }

        ?>
    </nav>
    <div class="cuerpo">
        <h1>Busca sitios para comer</h1>
        <div class="filtros">
            <select name="" id="" class="mi-select">
                <option value="">Según las estrellas</option>
                <option value="1">1 estrella</option>
                <option value="2">2 estrellas</option>
                <option value="3">3 estrellas</option>
                <option value="4">4 estrellas</option>
                <option value="5">5 estrellas</option>

            </select>  
            <select name="" id="" class="mi-select">
                <option value="">Según el precio medio</option>
                <option value="1">Menos de 10€</option>
                <option value="2">De 10€ a 20€</option>
                <option value="3">De 20€ a 30€</option>
                <option value="4">De 30€ a 40€</option>
                <option value="5">De 40€ a 50€</option>
                <option value="6">Mas de 50€</option>
            </select>
            <select name="" id="" class="mi-select">
            <option value="">tipo de comida</option>
            <?php
                $sql = "SELECT * FROM tipo_comida";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $tipos_comida = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($tipos_comida as $tipo) {
                    echo "<option value='" . $tipo['id_comida'] . "'>" . $tipo['nombre_comida'] . "</option>";
                }
            ?>
            </select>
        </div>
        <br>
        <div>
            <div class="lupa">
                <input type="search" name="" id="" class="campo-busqueda" placeholder="Buscar...">
                <button class="botonL">Buscar</button>
            </div>  
            <br>  
            <br>
        </div>
    </div>
    <div>
        <div class="restauranteModal" id="restauranteModal">
            <button type="button" class="cerrar" id="cerrarR"><img src="./img/cerrar.png" class="imgB"></button>
            <br>
            <div class="tituloR">
                <h1 class="h1R">Titulo Restaurante</h1>
                <img src="" alt="estrellas">
                <label for="">Numero opiniones</label>
            </div>
            <br>
            <img src="./img/banner.png" alt="banerR" class="portada">
            <br>
            <br>
            <div class="columna">
                <h2 class="h2M">Puntuaciones y opiniones:</h2>
                <label for="">media de puntuacion</label>
                <img src="" alt="Imagen de puntuaciones y opiniones">
            </div>
            <div class="columna">
                <h2 class="h2M">Detalles:</h2>
                <label for="">Rango de precios</label>
                <br>
                <br>
                <label for="">Precio</label>
                <br>
                <br>
                <label for="">Tipos de cociona</label>
                <br>
                <br>
                <label for="">tipos</label>
            </div>
            <div class="columna2">
                <h2 class="h2M">Ubicación y contacto:</h2>
                <label for="">Calle</label>
            </div>
        </div>
        <div>
            <!-- bucle con las opiniones -->
        </div>
    </div>
    <div>
        <?php
            $sql = "SELECT * FROM tbl_restaurante 
            INNER JOIN tbl_valoracion ON tbl_restaurante.valoracion = tbl_valoracion.id_valoracion 
            INNER JOIN tbl_comida_restaurante ON tbl_comida_restaurante.id_resturante = tbl_restaurante.id_restaurante";
        ?>
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
