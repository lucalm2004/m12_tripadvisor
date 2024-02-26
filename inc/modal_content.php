<?php

session_start();

require_once("./conexion.php");
if (!isset($_SESSION['username'])) {
    header('Location: ../home.php');
    exit();
}

$jsonData = json_decode(file_get_contents("php://input"), true);

$id = isset($jsonData['id']) ? intval($jsonData['id']) : 1;

$stmt = "SELECT r.*, GROUP_CONCAT(c.nombre_comida) as nombre_comida FROM tbl_restaurante r INNER JOIN tbl_user u ON u.id_user = r.propietario INNER JOIN tbl_comida_restaurante cr ON cr.id_restaurante = r.id_restaurante INNER JOIN tipo_comida c ON cr.id_comida = c.id_comida WHERE r.id_restaurante = :id;";

$sql = $pdo->prepare($stmt);
$sql->bindParam(':id', $id);
$sql->execute();

$resultado = $sql->fetch(PDO::FETCH_ASSOC);

// var_dump($resultado);

$nombreRes = $resultado['nombre_restaurante'];
$direccionRes = $resultado['direccion'];
$tipos_comida = $resultado['nombre_comida'];
$imagenRes = $resultado['imagen_banner'];
$precio_medio = $resultado['precio_medio'];
$emailRes = $resultado['email_oficial'];
$id_res = $resultado['id_restaurante'];

?>

<?php
try{
    
$stmtVal = "SELECT AVG(valoracion) as media_val, COUNT(id_valoracion) as total_val FROM `tbl_valoracion` WHERE restaurante = :id";

$sqlVal = $pdo->prepare($stmtVal);
$sqlVal->bindParam(':id', $id);
$sqlVal->execute();

$resultadoVal = $sqlVal->fetch(PDO::FETCH_ASSOC);

}catch(PDOException $e){
    echo "Error: $e";
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">


<button type="button" class="cerrar" id="cerrarR"><img src="./img/cerrar.png" class="imgB"></button>
<br>
<div class="tituloR">
    <h1 id="nombreRes" class="h1R"><?php echo $nombreRes; ?></h1>
    <?php
    if ($resultadoVal['media_val'] == 5) {
        echo "<img src='./img/estrella_valoracion_5.png' class='estrella_foto3'>";
    } elseif ($resultadoVal['media_val'] >= 4.5 and $resultadoVal['media_val'] < 5) {
        echo "<img src='./img/estrella_valoracion_4,5.png' class='estrella_foto3'>";
    } elseif ($resultadoVal['media_val'] >= 4 and $resultadoVal['media_val'] < 4.5) {
        echo "<img src='./img/estrella_valoracion_4.png' class='estrella_foto3'>";
    } elseif ($resultadoVal['media_val'] >= 3.5 and $resultadoVal['media_val'] < 4) {
        echo "<img src='./img/estrella_valoracion_3,5.png' class='estrella_foto3'>";
    } elseif ($resultadoVal['media_val'] >= 3 and $resultadoVal['media_val'] < 3.5) {
        echo "<img src='./img/estrella_valoracion_3.png' class='estrella_foto3'>";
    } elseif ($resultadoVal['media_val'] >= 2.5 and $resultadoVal['media_val'] < 3) {
        echo "<img src='./img/estrella_valoracion_2,5.png' class='estrella_foto3'>";
    } elseif ($resultadoVal['media_val'] >= 2 and $resultadoVal['media_val'] < 2.5) {
        echo "<img src='./img/estrella_valoracion_2.png' class='estrella_foto3'>";
    } elseif ($resultadoVal['media_val'] >= 1.5 and $resultadoVal['media_val'] < 2) {
        echo "<img src='./img/estrella_valoracion_1,5.png' class='estrella_foto3'>";
    } elseif ($resultadoVal['media_val'] >= 1 and $resultadoVal['media_val'] < 1.5) {
        echo "<img src='./img/estrella_valoracion_1.png' class='estrella_foto3'>";
    } elseif ($resultadoVal['media_val'] >= 0.1 and $resultadoVal['media_val'] < 1) {
        echo "<img src='./img/estrella_valoracion_0,5.png' class='estrella_foto3'>";
    }
    ?>
</div>
<br>
<div>
    <?php
    if ($_SESSION['rol'] == 1) {
        echo "<button id='btnImagen' class='btnImagen'>Cambiar Imagen</button>";
    } else{
        echo "<button id='btnImagen' style='visibility: hidden'; class='btnImagen'>Cambiar Imagen</button>";
    }

    ?>
    <img src="./img/<?php echo $imagenRes; ?>" id="imgActive" class="bannerImg" alt="banerR" class="portada">

</div>
<br>
<br>
<div class="columna">
    <h2 class="h2M">Puntuaciones y opiniones:</h2>
    <label for="">Numero opiniones:</label>
    <p><?php echo $resultadoVal['total_val'] ?></p>
    <br>
    <label for="">Media de puntuaciones:</label>
    <div class="estreN">
        <?php
        if ($resultadoVal['media_val'] == 5) {
            echo "<img src='./img/estrella_valoracion_5.png' class='estrella_foto3'>";
        } elseif ($resultadoVal['media_val'] >= 4.5 and $resultadoVal['media_val'] < 5) {
            echo "<img src='./img/estrella_valoracion_4,5.png' class='estrella_foto3'>";
        } elseif ($resultadoVal['media_val'] >= 4 and $resultadoVal['media_val'] < 4.5) {
            echo "<img src='./img/estrella_valoracion_4.png' class='estrella_foto3'>";
        } elseif ($resultadoVal['media_val'] >= 3.5 and $resultadoVal['media_val'] < 4) {
            echo "<img src='./img/estrella_valoracion_3,5.png' class='estrella_foto3'>";
        } elseif ($resultadoVal['media_val'] >= 3 and $resultadoVal['media_val'] < 3.5) {
            echo "<img src='./img/estrella_valoracion_3.png' class='estrella_foto3'>";
        } elseif ($resultadoVal['media_val'] >= 2.5 and $resultadoVal['media_val'] < 3) {
            echo "<img src='./img/estrella_valoracion_2,5.png' class='estrella_foto3'>";
        } elseif ($resultadoVal['media_val'] >= 2 and $resultadoVal['media_val'] < 2.5) {
            echo "<img src='./img/estrella_valoracion_2.png' class='estrella_foto3'>";
        } elseif ($resultadoVal['media_val'] >= 1.5 and $resultadoVal['media_val'] < 2) {
            echo "<img src='./img/estrella_valoracion_1,5.png' class='estrella_foto3'>";
        } elseif ($resultadoVal['media_val'] >= 1 and $resultadoVal['media_val'] < 1.5) {
            echo "<img src='./img/estrella_valoracion_1.png' class='estrella_foto3'>";
        } elseif ($resultadoVal['media_val'] >= 0.1 and $resultadoVal['media_val'] < 1) {
            echo "<img src='./img/estrella_valoracion_0,5.png' class='estrella_foto3'>";
        }
        ?>
        <label  class="numeroR2"><?php echo round($resultadoVal['media_val'], 1, PHP_ROUND_HALF_DOWN); ?></label>
    </div>

</div>
<div class="columna">
    <h2 class="h2M">Detalles:</h2>
    <label for="">Precio Medio:</label>
    <br>
    <p><?php echo $precio_medio . '€ ';
        $veces = $precio_medio / 25;
        // // for ($i = 0; $i < $veces; $i++) {
        // //     echo "€";
        // // }
        // echo ')'
        ?>
    </p>
    <br>
    <label for="">Tipos de cocina:</label>
    <br>
    <p><?php echo $tipos_comida; ?></p>
    <br>
</div>
<div class="columna">
    <h2 class="h2M">Ubicación y contacto:</h2>
    <label for="">Calle:</label>
    <p><?php echo $direccionRes; ?></p>
    <br>
    <label for="">E-mail de contacto:</label>
    <p id="emailRes"><?php echo $emailRes; ?></p>

</div>

<br>
<br>
<div class="comentarios">
    <div class="posicion">
        <div>
            <h2>Escribe tu opinión</h2> 
        </div>
    </div>
</div>
    <div>
        <form method="post" id="form_valoracion" style="padding: 0; margin: 0;">
            <?php
            echo "<input type='hidden' id='id_res' value=".$id_res.">"
            ?>
            <div>
                <textarea name="comentario" id="comentario" class="review" placeholder="Escribe tu reseña…" rows="5" minlength="1" style="height: calc(131px);"></textarea>
            </div>
   </div>
    <div>
        <div class="rateyo" id="rating" data-rateyo-rating="0" data-rateyo-num-stars="5" data-rateyo-score="3">
        </div>
            <span style="margin-left:0.5%">Puntuacion:</span>
            <span id="ratings" class="result">0</span>
            <input type="hidden" name="rating">
            <butt on class="botonReview" id="botonRev" name="add" type="submit"><span>Comentar</span></button>
        </div>
        </div>
    </form>
    <br>
    <br>
    <br>

<div style="margin-top: -150px;" class="checo">
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
<br>
<br>
<div id="comentarios_display"></div>
<div id="pagination"></div>
<br>
<br>
</div>
<script src="./js/imagen.js"></script>
<!-- <script src="./js/estrellas.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>