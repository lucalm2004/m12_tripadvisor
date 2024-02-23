<?php

session_start();

require_once("./conexion.php");

$jsonData = json_decode(file_get_contents("php://input"), true);

$id = isset($jsonData['id']) ? intval($jsonData['id']) : 1;

$stmt = "SELECT r.*, GROUP_CONCAT(c.nombre_comida) as nombre_comida FROM tbl_restaurante r INNER JOIN tbl_user u ON u.id_user = r.propietario INNER JOIN tbl_comida_restaurante cr ON cr.id_restaurante = r.id_restaurante INNER JOIN tipo_comida c ON cr.id_comida = c.id_comida WHERE r.id_restaurante = :id;";

$sql = $pdo->prepare($stmt);
$sql->bindParam(':id', $id);
$sql->execute();

$resultado = $sql->fetch(PDO::FETCH_ASSOC);

// var_dump($resultado);

$nombreRes = $resultado['nombre_restuarante'];
$direccionRes = $resultado['direccion'];
$tipos_comida = $resultado['nombre_comida'];
$imagenRes = $resultado['imagen_banner'];
$precio_medio = $resultado['precio_medio'];
$emailRes = $resultado['email_oficial'];
$id_res = $resultado['id_restaurante'];

?>

<?php

$stmtVal = "SELECT AVG(valoracion) as media_val, COUNT(id_valoracion) as total_val FROM `tbl_valoracion` WHERE restaurante = :id";

$sqlVal = $pdo->prepare($stmtVal);
$sqlVal->bindParam(':id', $id);
$sqlVal->execute();

$resultadoVal = $sqlVal->fetch(PDO::FETCH_ASSOC);

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">


<button type="button" class="cerrar" id="cerrarR"><img src="./img/cerrar.png" class="imgB"></button>
<br>
<div class="tituloR">
    <h1 class="h1R"><?php echo $nombreRes; ?></h1>
    <?php
    if ($resultadoVal['media_val'] == 5) {
        echo "<img src='./img/estrella_valoracion_5.png' class='estrella_foto'>";
    } elseif ($resultadoVal['media_val'] >= 4.5 and $resultadoVal['media_val'] < 5) {
        echo "<img src='./img/estrella_valoracion_4,5.png' class='estrella_foto'>";
    } elseif ($resultadoVal['media_val'] >= 4 and $resultadoVal['media_val'] < 4.5) {
        echo "<img src='./img/estrella_valoracion_4.png' class='estrella_foto'>";
    } elseif ($resultadoVal['media_val'] >= 3.5 and $resultadoVal['media_val'] < 4) {
        echo "<img src='./img/estrella_valoracion_3,5.png' class='estrella_foto'>";
    } elseif ($resultadoVal['media_val'] >= 3 and $resultadoVal['media_val'] < 3.5) {
        echo "<img src='./img/estrella_valoracion_3.png' class='estrella_foto'>";
    } elseif ($resultadoVal['media_val'] >= 2.5 and $resultadoVal['media_val'] < 3) {
        echo "<img src='./img/estrella_valoracion_2,5.png' class='estrella_foto'>";
    } elseif ($resultadoVal['media_val'] >= 2 and $resultadoVal['media_val'] < 2.5) {
        echo "<img src='./img/estrella_valoracion_2.png' class='estrella_foto'>";
    } elseif ($resultadoVal['media_val'] >= 1.5 and $resultadoVal['media_val'] < 2) {
        echo "<img src='./img/estrella_valoracion_1,5.png' class='estrella_foto'>";
    } elseif ($resultadoVal['media_val'] >= 1 and $resultadoVal['media_val'] < 1.5) {
        echo "<img src='./img/estrella_valoracion_1.png' class='estrella_foto'>";
    } elseif ($resultadoVal['media_val'] >= 0.1 and $resultadoVal['media_val'] < 1) {
        echo "<img src='./img/estrella_valoracion_0,5.png' class='estrella_foto'>";
    }
    ?>
</div>
<br>
<div>
    <?php
    if ($_SESSION['rol'] == 1) {
        echo "<button id='fotoPrivadas' class='btnImagen'>Cambiar Imagen</button>";
    }

    ?>
    <button id='btnImagen' class='btnImagen'>Cambiar Imagen</button>
    <img src="./img/<?php echo $imagenRes; ?>" id="imgActive" alt="banerR" class="portada">

</div>
<br>
<br>
<div class="columna">
    <h2 class="h2M">Puntuaciones y opiniones:</h2>
    <label for="">Numero opiniones</label>
    <p><?php echo $resultadoVal['total_val'] ?></p>
    <br>
    <label for="">Media de puntuaciones</label>
    <div>
        <p><?php echo $resultadoVal['media_val'] + 0 ?></p>
        <?php
        if ($resultadoVal['media_val'] == 5) {
            echo "<img src='./img/estrella_valoracion_5.png' class='estrella_foto'>";
        } elseif ($resultadoVal['media_val'] >= 4.5 and $resultadoVal['media_val'] < 5) {
            echo "<img src='./img/estrella_valoracion_4,5.png' class='estrella_foto'>";
        } elseif ($resultadoVal['media_val'] >= 4 and $resultadoVal['media_val'] < 4.5) {
            echo "<img src='./img/estrella_valoracion_4.png' class='estrella_foto'>";
        } elseif ($resultadoVal['media_val'] >= 3.5 and $resultadoVal['media_val'] < 4) {
            echo "<img src='./img/estrella_valoracion_3,5.png' class='estrella_foto'>";
        } elseif ($resultadoVal['media_val'] >= 3 and $resultadoVal['media_val'] < 3.5) {
            echo "<img src='./img/estrella_valoracion_3.png' class='estrella_foto'>";
        } elseif ($resultadoVal['media_val'] >= 2.5 and $resultadoVal['media_val'] < 3) {
            echo "<img src='./img/estrella_valoracion_2,5.png' class='estrella_foto'>";
        } elseif ($resultadoVal['media_val'] >= 2 and $resultadoVal['media_val'] < 2.5) {
            echo "<img src='./img/estrella_valoracion_2.png' class='estrella_foto'>";
        } elseif ($resultadoVal['media_val'] >= 1.5 and $resultadoVal['media_val'] < 2) {
            echo "<img src='./img/estrella_valoracion_1,5.png' class='estrella_foto'>";
        } elseif ($resultadoVal['media_val'] >= 1 and $resultadoVal['media_val'] < 1.5) {
            echo "<img src='./img/estrella_valoracion_1.png' class='estrella_foto'>";
        } elseif ($resultadoVal['media_val'] >= 0.1 and $resultadoVal['media_val'] < 1) {
            echo "<img src='./img/estrella_valoracion_0,5.png' class='estrella_foto'>";
        }
        ?>
    </div>

</div>
<div class="columna">
    <h2 class="h2M">Detalles:</h2>
    <label for="">Precio Medio</label>
    <br>
    <p><?php echo $precio_medio . '€ (';
        $veces = $precio_medio / 25;
        for ($i = 0; $i < $veces; $i++) {
            echo "€";
        }
        echo ')'
        ?>
    </p>
    <br>
    <label for="">Tipos de cocina</label>
    <br>
    <p><?php echo $tipos_comida; ?></p>
    <br>
</div>
<div class="columna">
    <h2 class="h2M">Ubicación y contacto:</h2>
    <label for="">Calle</label>
    <p><?php echo $direccionRes; ?></p>
    <br>
    <label for="">E-mail de contacto</label>
    <p><?php echo $emailRes; ?></p>

</div>


<div class="comentarios">
    <div class="posicion">
        <div>Write your review</div>
        <div>
            <button type="button" class="unstyle">
                <div class="icon-with-text">
                    <svg viewBox="0 0 25 24" width="20px" height="20px">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.433 1.782a.75.75 0 01.75.75v1a.75.75 0 01-1.5 0v-1a.75.75 0 01.75-.75zm7.245 3.286a.75.75 0 010 1.06l-.707.708a.75.75 0 01-1.06-1.061l.707-.707a.75.75 0 011.06 0zm-14.446.035a.75.75 0 011.06 0L7 5.81a.75.75 0 01-1.06 1.061l-.708-.707a.75.75 0 010-1.06zm5.295 2.865C9.103 9.115 8.82 10.486 9.03 11.79c.219 1.362.982 2.645 1.624 3.399l.18.21v1.292h4.05v-1.238l.122-.186c.903-1.39 1.453-2.897 1.489-4.211.034-1.284-.414-2.357-1.505-3.067-1.796-1.168-3.716-.51-4.463-.022zm-.862-1.23c1.015-.68 3.638-1.635 6.143-.005 1.609 1.047 2.232 2.663 2.186 4.364-.043 1.602-.672 3.298-1.61 4.798v2.297h-7.05v-2.247c-.724-.915-1.532-2.34-1.785-3.917-.282-1.76.135-3.713 2.067-5.253l.024-.02.025-.016zm-5.806 6.03a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm14.913 0a.75.75 0 01.75-.75h1a.75.75 0 110 1.5h-1a.75.75 0 01-.75-.75zm-7.928 7.342v.608h4.035v-.608h-4.035zm-1.5-.65c0-.47.38-.85.85-.85h5.335c.47 0 .85.38.85.85v1.846a.983.983 0 01-.308.7.808.808 0 01-.542.212h-5.335a.808.808 0 01-.543-.212.984.984 0 01-.308-.7V19.46z"></path>
                    </svg>
                    <span>Review tips</span>
                </div>

            </button>
        </div>
    </div>
    <div>
        <form method="post" id="form_valoracion" style="padding: 0; margin: 0;">
            <?php
            echo "<input type='hidden' id='id_res' value=".$id_res.">"
            ?>
            <div>
                <textarea name="comentario" id="comentario" class="review" placeholder="This spot is great for a casual night out…" rows="5" minlength="1" style="height: calc(131px);"></textarea>
            </div>
    </div>
    <div>
        <div class="rateyo" id="rating" data-rateyo-rating="0" data-rateyo-num-stars="5" data-rateyo-score="3">
        </div>
        <span style="margin-left:0.5%">Rating:</span>
        <span id="ratings" class="result">0</span>
        <input type="hidden" name="rating">
        <button class="botonReview" id="botonRev" style="margin-bottom: 10%;" name="add" type="submit"><span>Submit review</span></button>
    </div>
        </div>
    </form>


<div style="margin-top: -150px;">
    <input id="5" class="checkboxComents" type="checkbox" value="5">
    <label for="5">Excelente</label><br>

    <input id="4" class="checkboxComents" type="checkbox" value="4">
    <label for="4">Muy bueno</label><br>

    <input id="3" class="checkboxComents" type="checkbox" value="3">
    <label for="3">Normal</label><br>

    <input id="2" class="checkboxComents" type="checkbox" value="2">
    <label for="2">Malo</label><br>

    <input id="1" class="checkboxComents" type="checkbox" value="1">
    <label for="1">Pésimo</label><br>
</div>
<div id="comentarios_display">

</div>
<br><br>
</div>
<script src="./js/imagen.js"></script>
<!-- <script src="./js/estrellas.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>