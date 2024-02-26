// $(function() {
//     $(".rateyo").rateYo().on("rateyo.change", function(e, data) {
//         var rating = data.rating;
//         $(this).parent().find('.result').text(rating);
//         $(this).parent().find('input[name=rating]').val(rating);
//     });
// });


// Obtener el formulario por su ID
var form_valoracion = document.getElementById("botonRev");

// Agregar un controlador de eventos para el evento de envío del formulario
form_valoracion.addEventListener("click", function(event) {
    // Prevenir el comportamiento predeterminado de envío del formulario
    event.preventDefault();

    // Obtener el valor del campo de comentario
    var comentario = document.getElementById('comentario').value;

    // Verificar que el campo no esté vacío
    if (comentario.trim() === '') {
        Swal.fire({
            position: 'top-end', // Cambia la posición a 'bottom-end' para mostrar la barra de tiempo abajo
            title: 'Porfavor ingrese un comentario.',
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
        return;
    }

    // Verificar la longitud mínima del comentario
    if (comentario.length < 20) {
        Swal.fire({
            position: 'top-end', // Cambia la posición a 'bottom-end' para mostrar la barra de tiempo abajo
            title: 'Debe tener al menos 20 caracteres.',
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
                    titleElement.style.fontSize = '12px'; // Ajusta el tamaño de la fuente según tus preferencias
                }
            }
        });
        return;
    }

    // Lista de palabras prohibidas
    var palabrasProhibidas = ['nalgas', 'basura', 'trasero', 'mierda', 'puta', 'joder', 'coño', 'cabrón', 'pendejo',
        'cagada', 'gilipollas', 'idiota', 'imbecil', 'estúpido', 'zorra', 'pene', 'vagina',
        'culo', 'mamón', 'maricón', 'mierdoso', 'cabronazo', 'chinga', 'mierdero', 'chuparla',
        'pajero', 'pendejada', 'cagar', 'pedo', 'picha', 'chingar', 'cojones', 'concha',
        'chingada', 'pito', 'chingón', 'jodido', 'cachonda', 'gilipollas', 'hijoputa',
        'cabrón', 'puto', 'mamahuevo', 'pendeja', 'baboso', 'cojudo', 'pelotudo', 'chupapija',
        'verga', 'vulgar', 'prostíbulo', 'madre', 'madre mía', 'madre de Dios', 'desmadre',
        'madrazo', 'madrazo', 'madrecita', 'malparido', 'pichabrava', 'pendejos', 'putos',
        'pendejos', 'coño de su madre', 'me cago en la puta', 'me cago en Dios', 'me cago en todo',
        'cojudo', 'pendeja', 'me cago en Dios', 'me cago en todo', 'me cago en la Virgen', 'tonto del culo',
        'me cago en la leche', 'me cago en el mundo', 'me cago en la hostia', 'me cago en tu puta madre',
        'la concha de tu madre', 'me cago en la leche', 'la puta madre que te parió', 'me cago en la leche de tu puta madre',
        'la hostia', 'me cago en Dios', 'me cago en la Virgen', 'me cago en todo', 'me cago en Dios y en la Virgen',
        'la madre que te parió', 'puto', 'pendejo', 'hijo de puta', 'hijo de mil putas', 'gilipollas', 'cojones', 'mamón',
        'putón', 'cabrón', 'cabronazo', 'me cago en todo lo cagable', 'la puta que te parió', 'mamá huevos',
        'me cago en todos tus muertos', 'me cago en tus muertos', 'me cago en tu puta madre', 'conchatumadre',
        'hijo de la gran puta', 'mierdecilla', 'me cago en todos tus muertos', 'me cago en tus muertos', 'me cago en tu puta madre',
        'la madre que te parió', 'me cago en la puta', 'me cago en todo lo cagable', 'putamadre', 'mamahuevo',
        'hijo de la gran puta', 'hijo de puta', 'me cago en la Virgen', 'me cago en Dios', 'me cago en la puta madre que te parió',
        'me cago en la hostia', 'me cago en la leche', 'me cago en tus muertos', 'coño de tu madre', 'puto amo', 'puto el que lee',
        'me cago en tus muertos', 'me cago en la puta madre que te parió', 'me cago en tus muertos', 'me cago en la puta madre que te parió',
        'hijo de la gran puta', 'me cago en tus muertos', 'me cago en la Virgen', 'me cago en Dios', 'me cago en tus muertos',
        'me cago en la puta madre que te parió', 'la concha de la lora', 'me cago en la puta madre que te parió', 'me cago en tus muertos',
        'hijo de la gran puta', 'me cago en tus muertos', 'me cago en tus muertos', 'me cago en la Virgen', 'me cago en la puta madre que te parió',
        'me cago en la hostia', 'me cago en la leche', 'me cago en tu puta madre', 'putamadre', 'mamahuevo',
        'hijo de la gran puta', 'hijo de puta', 'me cago en la Virgen', 'me cago en Dios', 'me cago en la puta madre que te parió',
        'me cago en la hostia', 'me cago en la leche', 'me cago en tus muertos', 'coño de tu madre', 'puto amo', 'puto el que lee',
        'me cago en tus muertos', 'me cago en la puta madre que te parió', 'me cago en tus muertos', 'me cago en la puta madre que te parió',
        'hijo de la gran puta', 'hijo de fruta'
    ];

    // Verificar si se ingresó alguna palabra prohibida
    for (var i = 0; i < palabrasProhibidas.length; i++) {
        if (comentario.toLowerCase().includes(palabrasProhibidas[i])) {
            Swal.fire({
                position: 'top-end', // Cambia la posición a 'bottom-end' para mostrar la barra de tiempo abajo
                title: 'No puedes poner palabrotas!',
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
            return;
        }
    }
    CrearValoracion();
});

function CrearValoracion() {
    var form_valoracion = document.getElementById("form_valoracion"); // Obtenemos el elemento con el id "form_valoracion"

    // Creamos una nueva instancia de FormData
    var formdata = new FormData(form_valoracion);

    // Creamos un objeto XMLHttpRequest
    var ajax = new XMLHttpRequest();
    // Definimos el método, la URL y establecemos que sea asíncrono
    ajax.open('POST', './inc/valoracion_estrellas.php', true);

    // Definimos la función que se ejecutará cuando la solicitud AJAX esté completa
    ajax.onload = function() {
        // Verificamos si la solicitud fue exitosa (código de estado 200)
        if (ajax.status === 200) {
            console.log(ajax.responseText)
            Swal.fire({
                icon: 'success',
                title: 'Enviado correctamente',
                showConfirmButton: false,
                timer: 1500
            });
            // Resetear el formulario
            form_valoracion.reset();
            id = document.getElementById('id_res').value;

            starComents(id)

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                showCancelButton: false,
                timer: 1500
            });
            form_valoracion.innerHTML = "Error en la solicitud AJAX";
        }
    }

    id_res = document.getElementById('id_res').value;
    ratings = document.getElementById('ratings');
    rating = ratings.innerHTML;
    formdata.append("id_res", id_res);
    console.log(rating)
    formdata.append('rating', rating);
    // Enviamos la solicitud HTTP al servidor con los datos en 'formdata'
    ajax.send(formdata);
}