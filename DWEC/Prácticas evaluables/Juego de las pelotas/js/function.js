function startContador() {
    const cont = document.getElementById('temporizador');
    let seg = 0;
    let min = 0;
    let h = 0;

    contador = setInterval(() => {
        seg++;
        if (seg == 60) {
            min++;
            seg = 0;
        }
        if (min == 60) {
            h++;
            min = 0;
        }
        cont.textContent = `${h < 10 ? "0" + h : h}:${min < 10 ? "0" + min : min}:${seg < 10 ? "0" + seg : seg}`;
    }, 1000);
}

function reiniciarJuego() {
    const cont = document.getElementById('temporizador');

    cont.textContent = "00:00:00";
    clearInterval(contador);
}

document.addEventListener('DOMContentLoaded', () => {
    const jugar = document.querySelector('.jugar');
    const menu = document.getElementById('menu');
    const juego = document.getElementById('juego');
    const reset = document.querySelector('.reinicio');

    // Ocultar el #juego al principio
    juego.style.display = 'none';
    reset.style.display = 'none';

    jugar.addEventListener('click', () => {
        // Ocultar el menú
        menu.style.display = 'none';
        // Mostrar el pantalla
        juego.style.display = 'block';
        startContador();
        reset.style.display = 'block';
    });

    reset.addEventListener('click', () => {
        // Ocultar el menú
        juego.style.display = 'none';
        reset.style.display = 'none';
        // Mostrar el juego
        menu.style.display = 'block';
        reiniciarJuego();
    });
});