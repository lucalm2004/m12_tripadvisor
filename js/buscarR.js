document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("buscarR").addEventListener("click", function() {
        // Obtener el valor del campo de búsqueda
        var valorBusqueda = document.getElementById("campo-busqueda").value;

        var precio = document.getElementById("precio").value;

        var valoracion = document.getElementById("valoracion").value;


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
        xhr.send("nombreResta=" + encodeURIComponent(valorBusqueda) + "&precio=" + encodeURIComponent(precio) + "&valoracion=" + encodeURIComponent(valoracion)); // Corrección: Agregar "&" entre los parámetros
    });
});