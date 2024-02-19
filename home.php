<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<style>
    
</style>
</head>
<body class="body1">
    <div class="botonesTop">
        <button id="cambiarARegistro" class="boton">Registrarse</button>
        <button id="cambiarAInicio" class="boton">Iniciar sesión</button>
    </div>
    <div class="divL" id="log">
        <form action="" method="post">
            <img src="./img/tripadvisor.svg">
            <br>
            <br>
            <label for="">Usuario</label>
            <br>
            <input type="text" id="userL" maxlength="50">
            <br>
            <br>
            <label for="">Contraseña</label>
            <br>
            <input type="password" id="pwdL" maxlength="12">
            <br>
            <br>
            <button type="submit" id="login-button" class="button1">Enviar</button>
        </form>
    </div>
    <div class="divL" id="reg">
        <form action="" method="post">
            <img src="./img/tripadvisor.svg">
            <br>
            <br>
            <label for="">Usuario</label>
            <br>
            <input type="text" id="userR" maxlength="50">
            <br>
            <br>
            <label for="">Nombre Completo</label>
            <br>
            <input type="text" id="nombreR" maxlength="100">
            <br>
            <br>
            <label for="">Correo Electrónico</label>
            <br>
            <input type="text" id="corrR" maxlength="100">
            <br>
            <br>
            <label for="">Contraseña</label>
            <br>
            <input type="password" id="contra1R" maxlength="12">
            <br>
            <br>
            <label for="">Confirmar contraseña</label>
            <br>
            <input type="password" id="contra2R" maxlength="12">
            <br>
            <br>
            <button type="submit" id="login-buttons" class="button1">Enviar</button>
        </form>
    </div>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <label for="codigo">Introduzca el código que le ha llegado al correo:</label>
            <br>
            <input type="number" id="codigo">
            <br>
            <button type="submit" id="codigo" class="button1">Verificar</button>
        </div>
</body>
</html>
<script src="./js/validaciones.js"></script>
<script src="./js/loginRegister.js"></script> 
