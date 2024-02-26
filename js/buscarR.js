document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("buscarR").addEventListener("click", function() {
        // Obtener el valor del campo de búsqueda
        var valorBusqueda = document.getElementById("campo-busqueda").value;

        var precio = document.getElementById("precio").value;

        var valoracion = document.getElementById("valoracion").value;

        var tipoC = document.getElementById("tipoC").value;



        // Crear una instancia de XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Definir la función que se ejecutará cuando la solicitud cambie de estado
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.querySelector('.fondoTar').innerHTML = xhr.responseText; // Cambiado de '.carR' a '.fondoTar'
                } else {
                    console.error('Hubo un error en la solicitud.');
                }
            }
        };

        // Crear un objeto FormData y agregar el valor del campo de búsqueda
        xhr.open("POST", "./inc/buscarRes.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Corrección: Cambiar "xhttp" a "xhr"
        xhr.send("nombreResta=" + encodeURIComponent(valorBusqueda) + "&precio=" + encodeURIComponent(precio) + "&valoracion=" + encodeURIComponent(valoracion) + "&tipo_comida=" + encodeURIComponent(tipoC)); // Corrección: Agregar "&" entre los parámetros
    });
    document.getElementById("resetF").addEventListener("click", function() {
        var imagen = document.getElementById('resetF'); // Obtén la imagen (el botón en este caso)
        var grados = 360;
        imagen.style.transform = 'rotate(' + grados + 'deg)';
        document.getElementById("campo-busqueda").value = '';
        document.getElementById("precio").value = '';
        document.getElementById("valoracion").value = '';
        document.getElementById("tipoC").value = '';

        var valorBusqueda = document.getElementById("campo-busqueda").value;
        var precio = document.getElementById("precio").value;
        var valoracion = document.getElementById("valoracion").value;
        var tipoC = document.getElementById("tipoC").value;
        setTimeout(function() {
            imagen.style.transform = 'rotate(0deg)';
        }, 200);

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.querySelector('.fondoTar').innerHTML = xhr.responseText;
                } else {
                    console.error('Hubo un error en la solicitud.');
                }
            }
        };

        xhr.open("POST", "./inc/buscarRes.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("nombreResta=" + encodeURIComponent(valorBusqueda) + "&precio=" + encodeURIComponent(precio) + "&valoracion=" + encodeURIComponent(valoracion) + "&tipo_comida=" + encodeURIComponent(tipoC));
    });
    function cargarRestaurantesCaros() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("carrusel2").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "./inc/caro.php", true);
        xhttp.send();
    }

    // Cargar los restaurantes inicialmente
    cargarRestaurantesCaros();
    script1();
    script2();



    // Actualizar cada minuto
    setInterval(cargarRestaurantesCaros, 60000); // 60000 milisegundos = 1 minuto
    function cargarRestaurantesbaratos() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("carrusel3").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "./inc/barato.php", true);
        xhttp.send();
    }

    // Cargar los restaurantes inicialmente
    cargarRestaurantesbaratos();

    // Actualizar cada minuto
    setInterval(cargarRestaurantesbaratos, 60000); // 60000 milisegundos = 1 minuto
})


function script1() {
    var script = document.createElement('script');

    script.src = './js/tarjetas1.js';

    document.body.appendChild(script);
}

function script2() {
    var script = document.createElement('script');

    script.src = './js/trajetas2.js';

    document.body.appendChild(script);
}