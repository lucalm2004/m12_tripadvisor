document.getElementById('btnImagen').onclick = function() {
    mostrarSweetAlert('id')
};
var activeImage = document.getElementById('imgActive');

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
                                const imageUrl = `./img/${data.filename}`;





                                // Verificar si la imagen activa se encontró antes de intentar actualizar el src
                                if (activeImage) {

                                    activeImage.src = imageUrl;
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