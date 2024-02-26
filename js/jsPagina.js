function closeModal() {
    var botonCerrar = document.getElementById('cerrarR');
    var restauranteModal = document.getElementById('restauranteModal');

    botonCerrar.addEventListener('click', function() {
        restauranteModal.classList.add('ocultar'); // Agregar clase para animar
        restauranteModal.classList.remove('aparecer'); // Agregar clase para animar
        setTimeout(function() {
            restauranteModal.style.display = 'none'; // Ocultar el div después de la animación
        }, 1000); // Tiempo igual al de la transición en CSS
    });
}


function openModal(id) {
    var jsonData = {
        id: id,
    };

    var jsonString = JSON.stringify(jsonData);

    var xhr = new XMLHttpRequest();
    var url = './inc/modal_content.php';

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/json');

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var restModal = document.getElementById('restauranteModal');
            restModal.innerHTML = xhr.responseText;
            restauranteModal.classList.add('aparecer'); // Agregar clase para animar
            restauranteModal.classList.remove('ocultar'); // Elimina clase para
            setTimeout(function() {
                restauranteModal.style.display = 'block'; // Ocultar el div después de la animación
            },500); // Tiempo igual al de la transición en CSS
            closeModal()
            starComents(id);
            btnImagen();
            estrellas();
            cargarScript()
        }
    };

    xhr.send(jsonString);
}

// Script comentarios

function cargarScript() {
    var script = document.createElement('script');

    script.src = './js/estrellas.js';

    document.body.appendChild(script);
}

// Cambio de imagenes

function btnImagen() {
    document.getElementById('btnImagen').onclick = function() {
        id_res = document.getElementById('id_res').value;
        console.log(id_res);
        mostrarSweetAlert(id_res)
    };
}


function mostrarSweetAlert(tipo) {
    Swal.fire({
        title: 'Cambiar Imagen',
        html: '<input type="file" id="fileInput" accept="image/*">',
        showCancelButton: true,
        confirmButtonText: 'Subir',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return new Promise((resolve) => {
                const fileInput = document.getElementById('fileInput');
                const file = fileInput.files[0];

                if (file) {
                    const formData = new FormData();
                    formData.append('file', file);
                    formData.append('tipo', tipo); // Agregar la variable 'tipo'


                    // Enviar la imagen al servidor usando AJAX o Fetch
                    fetch('./inc/upload.php', {
                            method: 'POST',
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Actualizar el src de la imagen
                                var activeImage = document.getElementById('imgActive');

                                const imageUrl = `./img/${data.filename}?timestamp=${new Date().getTime()}`;
                                // Verificar si la imagen activa se encontró antes de intentar actualizar el src
                                if (activeImage) {
                                    activeImage.src = imageUrl;
                                    correoImagen();

                                } else {
                                    console.error('Error: No se encontró la imagen activa en el DOM.');
                                }

                                resolve();
                            } else {
                                Swal.showValidationMessage(`Error: ${data.error}`);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.showValidationMessage('Error al subir la imagen');
                        });
                } else {
                    resolve();
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Imagen Subida!', '', 'success');
        }
    });
}


// estrellas

function estrellas() {

    $(function() {
        $(".rateyo").rateYo().on("rateyo.change", function(e, data) {
            var rating = data.rating;
            $(this).parent().find('.result').text(rating);
            $(this).parent().find('input[name=rating]').val(rating);
        });
    });
}

// correo de cambio

function correoImagen() {
    var ajaxCorreo = new XMLHttpRequest();
    ajaxCorreo.open('POST', './inc/correoAlerta.php');
    ajaxCorreo.onload = function() {
        if (ajaxCorreo.status == 200) {
            console.log(ajaxCorreo.responseText);
            if (ajaxCorreo.responseText == 'mal') {
                Swal.fire({
                    position: 'top-end',
                    title: 'No se a podido enviar el correo.',
                    showConfirmButton: false,
                    toast: true,
                    timer: 3000, // Cerrar después de 2 segundos
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
                    position: 'top-end',
                    title: 'Aviso de cambio de banner enviado.',
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
                position: 'top-end',
                title: 'No se a podio enviar el correo.',
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
    };
    ajaxCorreo.onerror = function() {
        console.log('Error en la solicitud AJAX');
    };
    var emailRe = document.getElementById("emailRes");
    emails = emailRe.innerHTML;
    var nombreRes = document.getElementById("nombreRes");
    nombre = nombreRes.innerHTML;
    var formReg = new FormData();
    formReg.append("email", emails);
    formReg.append("nombre", nombre);
    ajaxCorreo.send(formReg);
}