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
    const juego = document.getElementById('juego');
    juego.innerHTML = '<div class="mensaje"></div>'; // Limpiar el área de juego
}

function crearPelotas(numPelotas) {
    const juego = document.getElementById('juego');
    juego.innerHTML = '<div class="mensaje"></div>'; // Limpiar pelotas anteriores

    const juegoWidth = juego.clientWidth; // Ancho del contenedor
    const juegoHeight = juego.clientHeight; // Alto del contenedor
    const minSize = 30; // Tamaño mínimo de la pelota
    const maxSize = 100; // Tamaño máximo de la pelota

    for (let i = 0; i < numPelotas; i++) {
        const pelota = document.createElement('div');
        pelota.classList.add('pelota');
        
        // Generar un tamaño aleatorio
        const size = Math.random() * (maxSize - minSize) + minSize; // Tamaño aleatorio entre minSize y maxSize
        pelota.style.width = size + 'px';
        pelota.style.height = size + 'px';
        
        // Asegurarse de que la pelota esté dentro de los límites
        const left = Math.random() * (juegoWidth - size) + 'px';
        const top = Math.random() * (juegoHeight - size) + 'px';
        pelota.style.left = left;
        pelota.style.top = top;

        juego.appendChild(pelota);
    }
}


document.addEventListener('DOMContentLoaded', () => {
    const jugar = document.querySelector('.jugar');
    const menu = document.getElementById('menu');
    const juego = document.getElementById('juego');
    const reset = document.querySelector('.reinicio');
    const numPelotasInput = document.getElementById('numPelotas');

    juego.style.display = 'none';
    reset.style.display = 'none';

    jugar.addEventListener('click', () => {
        menu.style.display = 'none';
        juego.style.display = 'block';
        
        startContador();
        reset.style.display = 'block';
        
        const numPelotas = parseInt(numPelotasInput.value);
        crearPelotas(numPelotas); // Crear las pelotas
    });

    reset.addEventListener('click', () => {
        juego.style.display = 'none';
        reset.style.display = 'none';
        menu.style.display = 'block';
        
        reiniciarJuego();
    });
});
