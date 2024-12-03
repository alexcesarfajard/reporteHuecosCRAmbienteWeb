document.addEventListener("DOMContentLoaded", () => {
    const images = document.querySelectorAll(".carrusel img");
    let currentIndex = 0;

    // Función para mostrar la imagen activa
    const updateCarousel = () => {
        images.forEach((img, index) => {
            img.classList.toggle("active", index === currentIndex);
        });
    };

    // Mostrar la primera imagen inicialmente
    updateCarousel();

    // Botones de navegación
    const nextButton = document.querySelector("#next");
    const prevButton = document.querySelector("#prev");

    nextButton.addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateCarousel();
    });

    prevButton.addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateCarousel();
    });
});