let contador; // Variable global para el contador
let aciertos = 0;
let fallos = 0;
const aciertosTotales = document.querySelector('.acierto');
const fallosTotales = document.querySelector('.fallo');
let modoSeleccionado = null; // Almacenar el modo seleccionado
let tipoColorSeleccionado = ""; // Almacenar el tipo de color

function startContador() {
    const cont = document.getElementById('temporizador');
    let seg = 0;
    let min = 0;
    let h = 0;

    contador = setInterval(() => {
        seg++;
        if (seg === 60) {
            min++;
            seg = 0;
        }
        if (min === 60) {
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
    aciertos = 0; // Reiniciar aciertos
    fallos = 0; // Reiniciar fallos
    aciertosTotales.textContent = aciertos;
    fallosTotales.textContent = fallos;
}

function crearPelotas(numPelotas) {
    const imgs = ["champ", "star", "fuego", "tanooki", "elefante"];
    const juego = document.getElementById('juego');
    juego.innerHTML = '<div class="mensaje"></div>'; // Limpiar pelotas anteriores

    const juegoWidth = juego.clientWidth;
    const juegoHeight = juego.clientHeight;
    const minSize = 30;
    const maxSize = 100;
    const mitad = Math.floor(numPelotas / 2); // Número de pelotas del color objetivo en el modo "color"

    for (let i = 0; i < numPelotas; i++) {
        const pelota = document.createElement('div');
        pelota.classList.add('pelota');

        // Generar un tamaño aleatorio
        const size = Math.random() * (maxSize - minSize) + minSize;
        pelota.style.width = size + 'px';
        pelota.style.height = size + 'px';

        // Posicionar dentro de los límites
        pelota.style.left = Math.random() * (juegoWidth - size) + 'px';
        pelota.style.top = Math.random() * (juegoHeight - size) + 'px';

        // Asignar color según el modo seleccionado
        if (modoSeleccionado === 'color') {
            // Si estamos en el modo "color", la mitad de las pelotas serán del color objetivo
            if (i < mitad) {
                pelota.classList.add(tipoColorSeleccionado);
                pelota.style.zIndex = 20;
            } else {
                // Seleccionar un color aleatorio diferente del color objetivo
                let randomImg;
                do {
                    randomImg = imgs[Math.floor(Math.random() * imgs.length)];
                } while (randomImg === tipoColorSeleccionado);
                pelota.classList.add(randomImg);
            }
        } else {
            // Modo "todas": asignar colores aleatorios a todas las pelotas
            const randImg = imgs[Math.floor(Math.random() * imgs.length)];
            pelota.classList.add(randImg);
        }

        // Evento de click para eliminar o contar fallos
        pelota.addEventListener('click', () => {
    
            // Eliminar la pelota
            pelota.remove();
            if (modoSeleccionado === 'todas') {
                aciertos++;
                aciertosTotales.textContent = aciertos;
                pelota.remove();
                if (document.querySelectorAll('.pelota').length === 0) {
                    mostrarMensaje("¡Victoria! Has eliminado todas las pelotas.");
                    clearInterval(contador);
                }
            } else if (modoSeleccionado === 'color') {
                const esCorrecta = pelota.classList.contains(tipoColorSeleccionado);
                let cant = document.querySelectorAll(`.${tipoColorSeleccionado}`).length;
                if (esCorrecta) {
                    aciertos++;
                    aciertosTotales.textContent = aciertos;
                } else {
                    fallos++;
                    fallosTotales.textContent = fallos;
                }
                
                // Depuración
                console.log(`Aciertos: ${aciertos}, Fallos: ${fallos}`);
                console.log(cant);
            
                if (document.querySelectorAll(`.${tipoColorSeleccionado}`).length === 0) {
                    mostrarMensaje(aciertos > fallos ? "¡Victoria! Has eliminado todas las pelotas del color correcto." : "¡Derrota! Has eliminado más pelotas incorrectas.");
                    clearInterval(contador);
                }
            }
        });

        juego.appendChild(pelota);
    }
}


function mostrarMensaje(mensaje) {
    const mensajeDiv = document.querySelector('.mensaje');
    mensajeDiv.textContent = mensaje;
}

document.addEventListener('DOMContentLoaded', () => {
    const menu = document.getElementById('menu');
    const juego = document.getElementById('juego');
    const reset = document.querySelector('.reinicio');
    const numPelotasInput = document.getElementById('numPelotas');
    const elTodas = document.querySelector('.eliminarTodas');
    const elColor = document.querySelector('.eliminarColor');
    const jugar = document.querySelector('.jugar');
    const elec = document.querySelector('.eleccion');

    juego.style.display = 'none';
    reset.style.display = 'none';
    elec.style.display = 'none';
    jugar.disabled = true;

    elTodas.addEventListener('click', () => {
        modoSeleccionado = 'todas';
        jugar.disabled = false;
    });

    elColor.addEventListener('click', () => {
        modoSeleccionado = 'color';
        jugar.disabled = false;
        const imgs = ["champ", "star", "fuego", "tanooki", "elefante"];
        tipoColorSeleccionado = imgs[Math.floor(Math.random() * imgs.length)];
        elec.classList.add(tipoColorSeleccionado);
        console.log("Tipo seleccionado para eliminar:", tipoColorSeleccionado);
    });

    jugar.addEventListener('click', () => {
        menu.style.display = 'none';
        juego.style.display = 'block';
        elec.style.display = 'block';

        startContador();
        reset.style.display = 'block';

        const numPelotas = parseInt(numPelotasInput.value);
        crearPelotas(numPelotas);
    });

    reset.addEventListener('click', () => {
        juego.style.display = 'none';
        reset.style.display = 'none';
        menu.style.display = 'block';
        elec.style.display = 'none';
        
        reiniciarJuego();
    });
});
