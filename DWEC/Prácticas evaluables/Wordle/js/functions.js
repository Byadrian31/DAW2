// Variables globales
const palabras = ["CEBRA", "ABEJA", "RATON", "ERIZO", "ZORRO", "PULPO", "MANGO"];
let palabraObjetivo = "";
let intentos = 0;
const maxIntentos = 6;

document.body.onload = iniciarJuego;
document.querySelector('.restart-btn').disabled = true;

function iniciarJuego() {
    actualizarGrid();
    document.querySelector('.mensaje').style.display = 'none'; // Escondemos el mensaje al iniciar el juego
}

function agregarLetra(letra) {
    const filaActual = document.querySelector(`#fila${intentos + 1}`);
    const letras = filaActual.querySelectorAll('.letra');
    for (let letraElemento of letras) {
        if (letraElemento.innerText === '') {
            letraElemento.innerText = letra;
            return;
        }
    }
    if (filaActual.querySelectorAll('.letra:not(:empty)').length === 5) {
        document.querySelector('.enviar').disabled = false;
    }
}

function borrarLetra() {
    const filaActual = document.querySelector(`#fila${intentos + 1}`);
    const letras = filaActual.querySelectorAll('.letra');
    for (let i = letras.length - 1; i >= 0; i--) {
        if (letras[i].innerText !== '') {
            letras[i].innerText = '';
            return;
        }
    }
}

function verificarFila() {
    const filaActual = document.querySelector(`#fila${intentos + 1}`);
    const letras = filaActual.querySelectorAll('.letra');
    let respuesta = Array.from(letras).map(letra => letra.innerText).join('');

    if (respuesta.length !== 5) {
        return;
    }

    const letraContada = contarLetras(palabraObjetivo);
    const letrasMarcadas = []; // Para marcar letras que ya están en verde

    // Primer bucle: letras correctas
    for (let i = 0; i < letras.length; i++) {
        if (respuesta[i] === palabraObjetivo[i]) {
            letras[i].style.backgroundColor = 'green';
            actualizarTeclado(respuesta[i], 'green');
            letrasMarcadas[i] = true; // Marcar la letra como correcta
            letraContada[respuesta[i]]--; // Disminuir el conteo de letras
        }
    }

    // Segundo bucle: letras en la palabra pero en posición incorrecta
    for (let i = 0; i < letras.length; i++) {
        if (!letrasMarcadas[i] && respuesta[i] !== palabraObjetivo[i]) { // Solo si no está marcada
            if (palabraObjetivo.includes(respuesta[i]) && letraContada[respuesta[i]] > 0) {
                letras[i].style.backgroundColor = 'yellow';
                actualizarTeclado(respuesta[i], 'yellow');
                letraContada[respuesta[i]]--; // Disminuir el conteo de letras
            } else {
                letras[i].style.backgroundColor = 'gray'; // Letras no están en la palabra
                actualizarTeclado(respuesta[i], 'gray');
            }
        }
    }

    // Comprobación si se ha adivinado la palabra
    if (respuesta === palabraObjetivo) {
        mostrarMensaje("¡Felicidades! Has adivinado la palabra.", "green");
        document.querySelector('.restart-btn').disabled = false;
    } else {
        intentos++;
        if (intentos === maxIntentos) {
            mostrarMensaje(`Te has quedado sin intentos. La palabra era: ${palabraObjetivo}`, "red");
            document.querySelector('.restart-btn').disabled = false;
        } else {
            document.querySelector('.enviar').disabled = true;
        }
    }
}

function mostrarMensaje(texto, color) {
    const mensaje = document.querySelector('.mensaje');
    const reiniciar = document.querySelector('.restart-btn');
    mensaje.innerText = texto;
    mensaje.style.color = color;
    mensaje.style.display = 'block';
    reiniciar.style.display = 'block'; // Mostramos el mensaje
    document.querySelector('.teclado').style.display = 'none'; // Ocultamos el teclado
}

function contarLetras(palabra) {
    const conteo = {};
    for (const letra of palabra) {
        conteo[letra] = (conteo[letra] || 0) + 1;
    }
    return conteo;
}

function actualizarTeclado(letra, estado) {
    const tecla = Array.from(document.querySelectorAll('.tecla')).find(tecla => tecla.textContent === letra);
    if (tecla) {
        if (tecla.style.backgroundColor != "green") {
            tecla.style.backgroundColor = estado;
        }
    }
}

function actualizarGrid() {
    palabraObjetivo = palabras[Math.floor(Math.random() * palabras.length)].toUpperCase();
    console.log("Palabra objetivo:", palabraObjetivo);

    const filas = document.querySelectorAll('.fila');
    filas.forEach(fila => {
        fila.querySelectorAll('.letra').forEach(letra => {
            letra.innerText = '';
            letra.style.backgroundColor = '';
        });
    });

    // Restablecer todas las teclas a blanco
    document.querySelectorAll('.tecla').forEach(tecla => {
        if (tecla.classList.contains("borrar")) {
            tecla.style.backgroundColor = 'red';
        } else if (tecla.classList.contains("enviar")) {
            tecla.style.backgroundColor = 'cyan';
        } else {
            tecla.style.backgroundColor = 'white'; // Cambiar el color de fondo a blanco
            tecla.disabled = false; // Asegurarse de que todas las teclas estén habilitadas
        }
    });
    intentos = 0;
    document.querySelector('.restart-btn').disabled = true;
    document.querySelector('.enviar').disabled = true;
    document.querySelector('.teclado').style.display = 'block'; // Mostramos el teclado al iniciar el juego
    document.querySelector('.mensaje').style.display = 'none';
    document.querySelector('.restart-btn').style.display = 'none';
}

// Eventos de teclado
document.querySelectorAll('.tecla').forEach(tecla => {
    tecla.addEventListener('click', () => {
        if (!tecla.classList.contains('borrar') &&
            !tecla.classList.contains('enviar') &&
            !tecla.classList.contains('reiniciar')) {
            agregarLetra(tecla.textContent.toUpperCase());
        }
    });
});

document.addEventListener('keydown', (event) => {
    const letra = event.key.toUpperCase();

    // Verificamos que sea una letra del alfabeto
    if (/^[A-Z]$/.test(letra)) {
        agregarLetra(letra);
    }
    // Verificamos si se presionó la tecla "Enter" para enviar la fila
    else if (event.key === 'Enter') {
        verificarFila();
    }
    // Verificamos si se presionó la tecla "Backspace" para borrar la última letra
    else if (event.key === 'Backspace') {
        borrarLetra();
    }
});


document.querySelector('.borrar').addEventListener('click', borrarLetra);
document.querySelector('.enviar').addEventListener('click', verificarFila);
document.querySelector('.restart-btn').addEventListener('click', actualizarGrid);
