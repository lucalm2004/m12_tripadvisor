document.addEventListener("DOMContentLoaded", function() {
    var btnReg = document.getElementById('login-buttons').addEventListener("click", registrarse);
    var btnLog = document.getElementById('login-button').addEventListener("click", loguearse);
});


var ajax = new XMLHttpRequest();
var READY_STATE_COMPLETE = 4;

function registrarse() {
    var regMail = document.getElementById('corrR').value;
    var regPwd = document.getElementById('contra1R').value;
    var regUsr = document.getElementById('userR').value;
    var name = document.getElementById('nombreR').value;
    var modal = document.getElementById('modal1');
    var formReg = new FormData();
    formReg.append('userR', regUsr)
    formReg.append('contra1R', regPwd)
    formReg.append('corrR', regMail)
    formReg.append('name', name)


    ajax.open('POST', './inc/registro.php');
    ajax.onload = function() {
        if (ajax.status == 200) {
            console.log('mediobien');
            console.log(ajax.responseText);
            if (ajax.responseText == "ok") {
                console.log('bien');
                enviarCorreoDes(regMail);
                modal.style.display = 'block';

            } else {
                Swal.fire({
                    position: 'top-end', // Cambia la posición a 'bottom-end' para mostrar la barra de tiempo abajo
                    title: 'El usuario ya existe.',
                    showConfirmButton: false,
                    toast: true,
                    timer: 2000, // Cerrar después de 2 segundos
                    customClass: {
                        title: 'my-custom-title-class' // Clase personalizada para el título
                    },
                    onOpen: () => {
                        // Selecciona el elemento del título y ajusta el tamaño de la fuente
                        const titleElement = document.querySelector('.my-custom-title-class');
                        if (titleElement) {
                            titleElement.style.fontSize = '18px'; // Ajusta el tamaño de la fuente según tus preferencias
                        }
                    }
                });
            }
        } else {
            Swal.fire({
                position: 'top-end', // Cambia la posición a 'bottom-end' para mostrar la barra de tiempo abajo
                title: 'Error al crear el usuario.',
                showConfirmButton: false,
                toast: true,
                timer: 2000, // Cerrar después de 2 segundos
                customClass: {
                    title: 'my-custom-title-class' // Clase personalizada para el título
                },
                onOpen: () => {
                    // Selecciona el elemento del título y ajusta el tamaño de la fuente
                    const titleElement = document.querySelector('.my-custom-title-class');
                    if (titleElement) {
                        titleElement.style.fontSize = '18px'; // Ajusta el tamaño de la fuente según tus preferencias
                    }
                }
            });
        }
    }
    ajax.send(formReg);
}

function loguearse() {
    console.log('log')
    var regMail = document.getElementById('userL').value;
    var regPwd = document.getElementById('pwdL').value;
    var formReg = new FormData();
    formReg.append('regMail', regMail)
    formReg.append('regPwd', regPwd)

    ajax.open('POST', './inc/login.php');
    ajax.onload = function() {
        if (ajax.status == 200) {
            if (ajax.responseText == "ok") {
                // funcionamiento de que ha ido bien
                console.log('bien');
            } else if (ajax.responseText == "error") {
                Swal.fire({
                    position: 'top-end', // Cambia la posición a 'bottom-end' para mostrar la barra de tiempo abajo
                    title: 'Verifica el usuario o la contraseña.',
                    showConfirmButton: false,
                    toast: true,
                    timer: 2000, // Cerrar después de 2 segundos
                    customClass: {
                        title: 'my-custom-title-class' // Clase personalizada para el título
                    },
                    onOpen: () => {
                        // Selecciona el elemento del título y ajusta el tamaño de la fuente
                        const titleElement = document.querySelector('.my-custom-title-class');
                        if (titleElement) {
                            titleElement.style.fontSize = '18px'; // Ajusta el tamaño de la fuente según tus preferencias
                        }
                    }
                });
            } else {
                Swal.fire({
                    position: 'top-end', // Cambia la posición a 'bottom-end' para mostrar la barra de tiempo abajo
                    title: 'Introduce los datos correspondientes.',
                    showConfirmButton: false,
                    toast: true,
                    timer: 2000, // Cerrar después de 2 segundos
                    customClass: {
                        title: 'my-custom-title-class' // Clase personalizada para el título
                    },
                    onOpen: () => {
                        // Selecciona el elemento del título y ajusta el tamaño de la fuente
                        const titleElement = document.querySelector('.my-custom-title-class');
                        if (titleElement) {
                            titleElement.style.fontSize = '18px'; // Ajusta el tamaño de la fuente según tus preferencias
                        }
                    }
                });
            }
        } else {
            console.log('errorajax');
        }
    }
    ajax.send(formReg);
}


function enviarCorreoDes(email) {
    var ajaxCorreo = new XMLHttpRequest();
    ajaxCorreo.open('POST', './inc/correoSolicitud.php');
    ajaxCorreo.onload = function() {
        if (ajaxCorreo.status == 200) {
            try {
                console.log(ajaxCorreo.responseText);
            } catch (error) {
                console.log('Error al analizar la respuesta JSON:', error.message);
            }
        } else {
            console.log('Error en la solicitud AJAX. Estado:', ajaxCorreo.status);
        }
    };

    ajaxCorreo.onerror = function() {
        console.log('Error en la solicitud AJAX');
    };
    var formReg = new FormData();
    emails = email;
    formReg.append("email", emails);
    ajaxCorreo.send(formReg);
}