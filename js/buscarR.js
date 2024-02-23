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
})