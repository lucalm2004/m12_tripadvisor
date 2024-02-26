crud();

var checkboxes = document.querySelectorAll('.checkbox');

document.getElementById('wordU').addEventListener('keyup', function () {
    execCrud();
});

document.getElementById('orderU').addEventListener('change', function () {
    execCrud();
});

document.getElementById('newuser').addEventListener('click', function () {
    var xhr = new XMLHttpRequest();
    var url = './inc/editar_use.php';

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('alert').innerHTML = xhr.responseText;
            cerrar_alert();
            checkInsert();
        }
    };

    xhr.send();
});

function execCrud(pageNumber) {
    var word = document.getElementById('wordU').value;
    var order = document.getElementById('orderU').value;

    crud(word, order, pageNumber);
}

function crud(word, order, pageNumber) {
    var jsonData = {
        word: word,
        order: order,
        page: pageNumber
    };

    var jsonString = JSON.stringify(jsonData);

    var xhr = new XMLHttpRequest();
    var url = './inc/crud_content_use.php';

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var body = document.getElementById('bodyCrud');
            body.innerHTML = xhr.responseText;
        }
    };

    xhr.send(jsonString);
}

function editar_use(id) {
    var jsonData = {
        id: id,
    };

    var jsonString = JSON.stringify(jsonData);

    var xhr = new XMLHttpRequest();
    var url = './inc/editar_use.php';

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('alert').innerHTML = xhr.responseText;
            cerrar_alert();
            checkUpdate();
        }
    };

    xhr.send(jsonString);
}

function elim_use(id) {
    Swal.fire({
        title: "Seguro que quieres eliminar?",
        text: "El usuario se perdera para siempre",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si"
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarReal(id); // Call the eliminarReal function here
        }
    });
}

function eliminarReal(id) {
    var jsonData = {
        id: id,
    };

    var jsonString = JSON.stringify(jsonData);

    var xhr = new XMLHttpRequest();
    var url = './inc/elim_use.php';

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            execCrud();
            Swal.fire({
                position: 'top-end',
                title: 'Usuario eliminado correctamente.',
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

    xhr.send(jsonString);

}

function checkUpdate() {
    document.getElementById('form_update_use').addEventListener('submit', function (evt) {
        evt.preventDefault();

        var id = document.getElementById('id_edit').value;
        var name = document.getElementById('nombre').value;
        var ncompleto = document.getElementById('nombreC').value;
        var email = document.getElementById('email').value;

        if (name !== '' && ncompleto !== '' && email !== '') {
            if (validate(email)) {
                var jsonData = {
                    id: id,
                    name: name,
                    ncompleto: ncompleto,
                    email: email,
                };

                var jsonString = JSON.stringify(jsonData);

                var xhr = new XMLHttpRequest();
                var url = './inc/update_use.php';

                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-type', 'application/json');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        execCrud();
                        if (xhr.responseText === 'Transaction successful.') {
                            document.getElementById('alert').innerHTML = "";
                            Swal.fire({
                                position: 'top-end',
                                title: 'Usuario modificado correctamente.',
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
                            errorValid(xhr.responseText);
                        }
                    }
                };

                xhr.send(jsonString);
            } else {
                errorValid('Formato de email no valido')
            }
        } else {
            errorValid('Todos los campos son obligatorios')
        }

    });
}

function checkInsert() {
    document.getElementById('form_insert_use').addEventListener('submit', function (evt) {
        evt.preventDefault();

        var name = document.getElementById('nombre').value;
        var ncompleto = document.getElementById('nombreC').value;
        var email = document.getElementById('email').value;

        if (name !== '' && ncompleto !== '' && email !== '') {
            if (validate(email)) {
                var jsonData = {
                    name: name,
                    ncompleto: ncompleto,
                    email: email,
                };

                var jsonString = JSON.stringify(jsonData);

                var xhr = new XMLHttpRequest();
                var url = './inc/insert_use.php';

                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-type', 'application/json');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        if (xhr.responseText === 'Transaction successful.') {
                            execCrud();
                            document.getElementById('alert').innerHTML = "";
                            Swal.fire({
                                position: 'top-end',
                                title: 'Usuario creado correctamente.',
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
                            errorValid(xhr.responseText);
                        }
                    }
                };

                xhr.send(jsonString);
            } else {
                errorValid('Formato de email no valido')
            }
        } else {
            errorValid('Todos los campos son obligatorios')
        }
    });
}


function changePage(pageNumber) {
    var checkedValues = [];
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            checkedValues.push(checkbox.value);
        }
    });

    execCrud(pageNumber);
}

function validate(value) {
    console.log(value);
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(value);
}

function errorValid(error) {
    document.getElementById('formError').innerHTML = error;
}

function cerrar_alert() {
    document.getElementById('cerrar').addEventListener('click', function () {
        document.getElementById('alert').innerHTML = "";
    });

}
