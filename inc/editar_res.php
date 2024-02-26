<?php
include_once('../inc/conexion.php');

$jsonData = json_decode(file_get_contents("php://input"), true);

$id = isset($jsonData['id']) ? intval($jsonData['id']) : NULL;

$sql = $pdo->prepare("SELECT r.id_restaurante, r.nombre_restaurante, u.username, r.direccion, GROUP_CONCAT(c.nombre_comida) as nombre_comidas, r.imagen_res, r.email_oficial 
FROM tbl_restaurante r 
INNER JOIN 
    tbl_user u ON u.id_user = r.propietario 
INNER JOIN 
    tbl_comida_restaurante cr ON cr.id_restaurante = r.id_restaurante 
INNER JOIN tipo_comida c ON cr.id_comida = c.id_comida 
WHERE r.id_restaurante = :ir");

$sql->bindParam(":ir", $id, PDO::PARAM_INT);
$sql->execute();

$resultado = $sql->fetch(PDO::FETCH_ASSOC);

?>

<div>
    <div>
        <?php

        if ($id == NULL) {
            echo '<form id="form_insert_res" method="post">';
        } else {
            echo '<form id="form_update_res" method="post">';
        }

        ?>
        <div class="overlay">
            <div class="alert-box">
                <span id="formError" style="color: red;"></span><br><br>
                <label for="nombre">Nombre: </label>
                <input id="nombre" type="text" name="nombre" value="<?php echo $resultado['nombre_restaurante']; ?>"><br><br>
                <label for="prop">Propietario: </label>
                <select name="propietario" id="prop">
                    <option value=""></option>
                    <?php
                    $sql = $pdo->prepare('SELECT * FROM tbl_user');
                    $sql->execute();
                    $users = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($users as $user) {
                        $checked = strpos($resultado['username'], $user['username']) !== false ? 'selected' : '';
                        echo '<option value="' . $user['id_user'] . '"' . $checked . '>' . $user['username'] . '</option>';
                    }
                    ?>
                </select><br><br>
                <label for="direc">Direccion: </label>
                <input id="direc" type="text" name="direccion" value="<?php echo $resultado['direccion']; ?>"><br><br>
                <label for="tipo">Tipo comida: </label>
                <div id="tipo">
                    <?php
                    $sql = $pdo->prepare('SELECT * FROM tipo_comida');
                    $sql->execute();
                    $food_types = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($food_types as $food_type) {
                        $checked = strpos($resultado['nombre_comidas'], $food_type['nombre_comida']) !== false ? 'checked' : '';
                        echo '<input class="type_food" type="checkbox" name="tipo_comida[]" value="' . $food_type['id_comida'] . '" ' . $checked . '><label>' . htmlspecialchars($food_type['nombre_comida']) . '</label>';
                    }
                    ?>
                </div>
                <br><br>
                <label for="email">E-mail: </label>
                <input id="email" type="text" name="email" value="<?php echo $resultado['email_oficial']; ?>"><br><br>
                <input id="id_edit" type="hidden" value="<?php echo $resultado['id_restaurante']; ?>">
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
                </form>
                <script src="../js/script.js"></script>
            </div>
        </div>
    </div>
</div>