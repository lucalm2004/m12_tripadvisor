document.addEventListener('DOMContentLoaded', function() {
    var botonCerrar = document.getElementById('cerrarR');
    var restauranteModal = document.getElementById('restauranteModal');

    botonCerrar.addEventListener('click', function() {
        restauranteModal.classList.add('ocultar'); // Agregar clase para animar
        setTimeout(function() {
            restauranteModal.style.display = 'none'; // Ocultar el div después de la animación
        }, 1000); // Tiempo igual al de la transición en CSS
    });
});
