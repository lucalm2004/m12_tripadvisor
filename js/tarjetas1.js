// Selecciona el elemento del carrusel en el DOM
const carousel2 = document.getElementById("carrusel2");

// Selecciona los botones de flecha dentro del contenedor del carrusel
const arrowBtns2 = document.querySelectorAll("#wrapper2 i");

// Obtiene el ancho del primer elemento de tarjeta en el carrusel
const firstCardWidth2 = carousel2.querySelector(".card").offsetWidth;

// Obtiene una lista de los hijos del carrusel
const carouselChildrens2 = Array.from(carousel2.childNodes);

// Variable para indicar si se está arrastrando el carrusel con el mouse
let isDragging2 = false;

// Variables para almacenar las coordenadas iniciales del arrastre
let startX2, startScrollLeft2;

// Calcula el número de tarjetas que caben en la vista del carrusel
const cardPerView2 = Math.round(carousel2.offsetWidth / firstCardWidth2);

// Agrega un evento de click a los botones de flecha para desplazar el carrusel
arrowBtns2.forEach(btn => {
    btn.addEventListener("click", () => {
        carousel2.scrollLeft += btn.id === "left2" ? -firstCardWidth2 : firstCardWidth2;
    });
});

// Función para iniciar el arrastre del carrusel
const dragStart2 = (e) => {
    isDragging2 = true;
    startX2 = e.pageX;
    startScrollLeft2 = carousel2.scrollLeft;
};

// Función para arrastrar el carrusel mientras se mantiene presionado el mouse
const dragging2 = (e) => {
    if (!isDragging2) return;
    carousel2.scrollLeft = startScrollLeft2 - (e.pageX - startX2);
};

// Función para detener el arrastre del carrusel
const dragStop2 = () => {
    isDragging2 = false;
};

// Función para detectar el final del carrusel y realizar un scroll infinito
const infiniteScroll2 = () => {
    if (carousel2.scrollLeft === 0) {
        console.log("Has llegado al final de la izquierda");
    } else if (Math.ceil(carousel2.scrollLeft) === carousel2.scrollWidth - carousel2.offsetWidth) {
        console.log("Has llegado al final de la derecha");
    }
};

// Agrega eventos de mouse y scroll al carrusel
carousel2.addEventListener("mousedown", dragStart2);
carousel2.addEventListener("mousemove", dragging2);
document.addEventListener("mouseup", dragStop2);
carousel2.addEventListener("scroll", infiniteScroll2);