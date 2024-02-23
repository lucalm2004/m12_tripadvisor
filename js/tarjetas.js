// Selecciona el elemento del carrusel en el DOM
const carousel = document.querySelector(".carousel");

// Selecciona los botones de flecha dentro del contenedor del carrusel
const arrowBtns = document.querySelectorAll(".wrapper i");

// Obtiene el ancho del primer elemento de tarjeta en el carrusel
const firstCardWidth = carousel.querySelector(".card").offsetWidth;

// Obtiene una lista de los hijos del carrusel
const carouselChildrens = Array.from(carousel.children);

// Variable para indicar si se está arrastrando el carrusel con el mouse
let isDragging = false;

// Variables para almacenar las coordenadas iniciales del arrastre
let startX, startScrollLeft;

// Calcula el número de tarjetas que caben en la vista del carrusel
const cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);

// Agrega un evento de click a los botones de flecha para desplazar el carrusel
arrowBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        carousel.scrollLeft += btn.id === "left" ? -firstCardWidth : firstCardWidth;
    });
});

// Función para iniciar el arrastre del carrusel
const dragStart = (e) => {
    isDragging = true;
    carousel.classList.add("dragging");
    startX = e.pageX;
    startScrollLeft = carousel.scrollLeft;
};

// Función para arrastrar el carrusel mientras se mantiene presionado el mouse
const dragging = (e) => {
    if (!isDragging) return;
    carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
};

// Función para detener el arrastre del carrusel
const dragStop = () => {
    isDragging = false;
    carousel.classList.remove("dragging");
};

// Función para detectar el final del carrusel y realizar un scroll infinito
const infiniteScroll = () => {
    if (carousel.scrollLeft === 0) {
        console.log("Has llegado al final de la izquierda");
    } else if (Math.ceil(carousel.scrollLeft) === carousel.scrollWidth - carousel.offsetWidth) {
        console.log("Has llegado al final de la derecha");
    }
};

// Agrega eventos de mouse y scroll al carrusel
carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("mousemove", dragging);
document.addEventListener("mouseup", dragStop);
carousel.addEventListener("scroll", infiniteScroll);