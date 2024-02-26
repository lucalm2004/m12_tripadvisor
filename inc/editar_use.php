<link rel="stylesheet" href="./css/admin.css">
<?php
include_once('./conexion.php');

$jsonData = json_decode(file_get_contents("php://input"), true);

$id = isset($jsonData['id']) ? intval($jsonData['id']) : NULL;

$sql = $pdo->prepare("SELECT id_user, username, nombre_completo, mail FROM tbl_user WHERE id_user = :iu");

$sql->bindParam(":iu", $id, PDO::PARAM_INT);
$sql->execute();

$resultado = $sql->fetch(PDO::FETCH_ASSOC);

?>

<div>
    <div>
        <?php
        if ($id == NULL) {
            echo '<form id="form_insert_use" method="post">';
        } else {
            echo '<form id="form_update_use" method="post">';
        }
        ?>
        <div class="overlay">
            <div class="alert-box">
                <span id='formError' style='color: red;'></span><br><br>
                <input type="hidden" id="id_edit" value="<?php echo isset($resultado['id_user']) ? $resultado['id_user'] : NULL; ?>"></input>
                <label for="nombre">Nombre Usuario: </label>
                <input id="nombre" type="text" name="nombre" value="<?php echo isset($resultado['username']) ? $resultado['username'] : NULL; ?>"><br><br>
                <label for="nombreC">Nombre Completo: </label>
                <input id="nombreC" type="text" name="nombre" value="<?php echo isset($resultado['nombre_completo']) ? $resultado['nombre_completo'] : NULL; ?>"><br><br>
                <label for="email">E-mail: </label>
                <input id="email" type="text" name="email" value="<?php echo isset($resultado['mail']) ? $resultado['mail'] : NULL; ?>"><br><br>
                <?php

                if ($id == NULL) {
                    echo '<input type="submit" class="boton_insertar" value="Insertar">';
                    echo '<br>';
                    echo '<br>';
                    echo '<input type="button"  id="cerrar" class="boton_cerrar" value="Cerrar">';
                } else {
                    echo '<input type="submit" class="boton_actualizar" value="Actualizar">';
                    echo '<br>';
                    echo '<br>';
                    echo '<input type="button" id="cerrar" class="boton_cerrar" value="Cerrar">';
                }

                ?>
                <script src="../js/crudUser.js"></script>
                </form>
            </div>
        </div>
    </div>
</div>