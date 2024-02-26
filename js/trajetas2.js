// Selecciona el elemento del carrusel en el DOM
const carousel3 = document.getElementById("carrusel3");

// Selecciona los botones de flecha dentro del contenedor del carrusel
const arrowBtns3 = document.querySelectorAll("#wrapper3 i");

// Obtiene el ancho del primer elemento de tarjeta en el carrusel
const firstCardWidth3 = carousel3.querySelector(".card").offsetWidth;

// Obtiene una lista de los hijos del carrusel
const carouselChildrens3 = Array.from(carousel3.childNodes);

// Variable para indicar si se está arrastrando el carrusel con el mouse
let isDragging3 = false;

// Variables para almacenar las coordenadas iniciales del arrastre
let startX3, startScrollLeft3;

// Calcula el número de tarjetas que caben en la vista del carrusel
const cardPerView3 = Math.round(carousel3.offsetWidth / firstCardWidth3);

// Agrega un evento de click a los botones de flecha para desplazar el carrusel
arrowBtns3.forEach(btn => {
    btn.addEventListener("click", () => {
        carousel3.scrollLeft += btn.id === "left3" ? -firstCardWidth3 : firstCardWidth3;
    });
});

// Función para iniciar el arrastre del carrusel
const dragStart3 = (e) => {
    isDragging3 = true;
    startX3 = e.pageX;
    startScrollLeft3 = carousel3.scrollLeft;
};

// Función para arrastrar el carrusel mientras se mantiene presionado el mouse
const dragging3 = (e) => {
    if (!isDragging3) return;
    carousel3.scrollLeft = startScrollLeft3 - (e.pageX - startX3);
};

// Función para detener el arrastre del carrusel
const dragStop3 = () => {
    isDragging3 = false;
};

// Función para detectar el final del carrusel y realizar un scroll infinito
const infiniteScroll3 = () => {
    if (carousel3.scrollLeft === 0) {
        console.log("Has llegado al final de la izquierda");
    } else if (Math.ceil(carousel3.scrollLeft) === carousel3.scrollWidth - carousel3.offsetWidth) {
        console.log("Has llegado al final de la derecha");
    }
};

// Agrega eventos de mouse y scroll al carrusel
carousel3.addEventListener("mousedown", dragStart3);
carousel3.addEventListener("mousemove", dragging3);
document.addEventListener("mouseup", dragStop3);
carousel3.addEventListener("scroll", infiniteScroll3);