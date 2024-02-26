function limitarLongitud(element, maxLength) {
    // Verifica si la longitud del valor del elemento es mayor que la longitud máxima
    if (element.value.length > maxLength) {
        // Si es mayor, recorta el valor del elemento a la longitud máxima
        element.value = element.value.slice(0, maxLength);
    }
}

function validarLog() {
    var userL = document.getElementById('userL').value;
    var pwdL = document.getElementById('pwdL').value;

    document.getElementById('userL').style.boxShadow = "";
    document.getElementById('pwdL').style.boxShadow = "";

    var valido = true;
    if (userL == "") {
        document.getElementById('userL').style.boxShadow = "0 0 5px 1px red";
        valido = false;
    }
    if (pwdL == "") {
        document.getElementById('pwdL').style.boxShadow = "0 0 5px 1px red";
        valido = false;
    }

    return valido;
}

function validarReg() {
    var userR = document.getElementById('userR').value;
    var nombreR = document.getElementById('nombreR').value;
    var corrR = document.getElementById('corrR').value;
    var contra1R = document.getElementById('contra1R').value;
    var contra2R = document.getElementById('contra2R').value;

    document.getElementById('userR').style.boxShadow = "";
    document.getElementById('nombreR').style.boxShadow = "";
    document.getElementById('corrR').style.boxShadow = "";
    document.getElementById('contra1R').style.boxShadow = "";
    document.getElementById('contra2R').style.boxShadow = "";

    var valido = true;
    if (userR == "") {
        document.getElementById('userR').style.boxShadow = "0 0 5px 1px red";
        valido = false;
    }
    if (nombreR == "") {
        document.getElementById('nombreR').style.boxShadow = "0 0 5px 1px red";
        valido = false;
    }
    if (contra1R == "") {
        document.getElementById('contra1R').style.boxShadow = "0 0 5px 1px red";
        valido = false;
    }
    if (contra2R == "") {
        document.getElementById('contra2R').style.boxShadow = "0 0 5px 1px red";
        valido = false;
    }
    if (corrR == "") {
        document.getElementById('corrR').style.boxShadow = "0 0 5px 1px red";
        valido = false;
    } else {
        // Validar formato de correo electrónico usando una expresión regular
        var correoValido = /\S+@\S+\.\S+/;
        if (!correoValido.test(corrR)) {
            document.getElementById('corrR').style.boxShadow = "0 0 5px 1px red";
            valido = false;
        }
    }
    if (contra1R !== contra2R) {
        document.getElementById('contra1R').style.boxShadow = "0 0 5px 1px red";
        document.getElementById('contra2R').style.boxShadow = "0 0 5px 1px red";
        valido = false;
    }

    return valido;
}
document.addEventListener("DOMContentLoaded", function() {
    // Obtener el formulario de inicio de sesión y agregar un event listener
    var formLogin = document.getElementById('log');
    formLogin.addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar el envío automático del formulario
        validarLog(); // Llamar a la función de validación de inicio de sesión
    });

    // Obtener el formulario de registro y agregar un event listener
    var formRegister = document.getElementById('reg');
    formRegister.addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar el envío automático del formulario
        validarReg(); // Llamar a la función de validación de registro
    });
});
document.addEventListener("DOMContentLoaded", function() {
    var btnRegistro = document.getElementById('cambiarARegistro');
    var btnInicio = document.getElementById('cambiarAInicio');
    var divLog = document.getElementById('log');
    var divReg = document.getElementById('reg');

    btnRegistro.addEventListener('click', function() {
        divLog.style.display = 'none';
        divReg.style.display = 'block';
    });

    btnInicio.addEventListener('click', function() {
        divLog.style.display = 'block';
        divReg.style.display = 'none';
    });
});