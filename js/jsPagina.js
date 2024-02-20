document.addEventListener('DOMContentLoaded', function() {
    // Espera a que el DOM esté completamente cargado
    var botonCerrar = document.getElementById('cerrarR');

    // Agrega un event listener para el evento 'click' al botón
    botonCerrar.addEventListener('click', function() {
        // Acción a realizar cuando se hace clic en el botón
        document.getElementById('restauranteModal').style.display="none";
        // Puedes agregar más acciones aquí, como ocultar una ventana modal, etc.
    });
});