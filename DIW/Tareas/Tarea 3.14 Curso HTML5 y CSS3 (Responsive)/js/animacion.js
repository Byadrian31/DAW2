window.addEventListener('load', () => {
    // Seleccionar la chincheta y el artículo
    const chincheta = document.querySelector('#prim');
    const section = chincheta.closest('section'); // Encuentra el artículo que contiene la chincheta
    const chincheta2 = document.querySelector('#seg');
    const chincheta3 = document.querySelector('#ter');
    const section3 = chincheta3.closest('section'); // Encuentra el artículo que contiene la chincheta

    if (chincheta) {
        // Añade la clase para animar la chincheta
        chincheta.classList.add('chincheta1');
    }

    // Esperar a que termine la animación de la chincheta (1s) antes de animar el artículo
    setTimeout(() => {
        if (section) {
            section.classList.add('article1');
        }
    }, 1000); // 1000ms = 1s (duración de la animación de la chincheta)

    // Esperar a que termine la animación del artículo (0.5s) antes de animar la segunda chincheta
    setTimeout(() => {
        if (chincheta2) {
            chincheta2.classList.add('chincheta2');
        }
    }, 1500);

    // Esperar a que termine la animación de la segunda chincheta (1s) antes de animar la tercera chincheta
    setTimeout(() => {
        if (chincheta3) {
            chincheta3.classList.add('chincheta3');
        }
    }, 2500);

    setTimeout(() => {
        if (section3) {
            section3.classList.add('article3');
        }
    }, 3500);
});
