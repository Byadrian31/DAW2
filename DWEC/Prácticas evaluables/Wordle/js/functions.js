var palabras = ["cebra", "abeja", "raton", "erizo", "zorro", "pulpo"];
var palabraObjetivo = "";

function escogerPalabra() {
    var indice = Math.floor(Math.random() * palabras.length);
    palabraObjetivo = palabras[indice];
    console.log("Palabra objetivo:", palabraObjetivo);
}

function iniciarJuego() {
    escogerPalabra();
    actualizarGrid();
}

// Añadir letras
// -------------------------------------------------------------------------------------------------
var intentos = 0; // Contador de intentos
var letrasIntroducidas = []; // Array para almacenar letras de la fila actual

function introducirLetra(letra) {
    var filaActual = document.querySelector(`#fila${intentos + 1}`); // Selecciona la fila actual
    var letras = filaActual.querySelectorAll('.letra'); // Selecciona todas las letras en la fila

    for (var i = 0; i < letras.length; i++) {
        if (letras[i].textContent === '') { // Si la casilla está vacía
            letras[i].textContent = letra; // Introduce la letra
            letrasIntroducidas.push(letra); // Guarda la letra en el array
            i = letras.length; // Salimos del bucle
        }
    }

    // Habilita o deshabilita el botón "Enviar"
    if (letrasIntroducidas.length === 5) {
        document.querySelector('.enviar').disabled = false; // Habilita el botón Enviar
    }
}

document.querySelectorAll('.tecla').forEach(tecla => {
    tecla.addEventListener('click', () => {
        if (!tecla.classList.contains('borrar') && !tecla.classList.contains('enviar') && !tecla.classList.contains('reiniciar')) {
            introducirLetra(tecla.textContent); // Llama a la función con la letra de la tecla
        }
    });
});
// -------------------------------------------------------------------------------------------------

// Funcionamiento botones
// -------------------------------------------------------------------------------------------------

function actualizarGrid() {
    var filas = document.querySelectorAll('.fila'); // Selecciona todos los campos con class fila (1-6)
    filas.forEach(fila => { // Con el foreach
        fila.querySelectorAll('.letra').forEach(letra => {
            letra.textContent = ''; // Limpia el contenido de la letra
            letra.style.backgroundColor = ''; // Resetea el color de fondo
        });
    });
    intentos = 0;
    letrasIntroducidas = []; // Resetea el array de letras introducidas
    document.querySelector('.enviar').disabled = true; // Deshabilita el botón Enviar
}

function borrarLetra() {
    var filaActual = document.querySelector(`#fila${intentos + 1}`);
    var letras = filaActual.querySelectorAll('.letra');

    for (var i = letras.length - 1; i >= 0; i--) { // Recorremos desde el final
        if (letras[i].textContent !== '') { // Si encontramos una letra
            letras[i].textContent = ''; // La borramos
            letrasIntroducidas.pop(); // Elimina la última letra del array
            i = -1; // Salimos del bucle
        }
    }
}

// Manejar el evento del botón "Enviar"
function verificarFila() {
    if (letrasIntroducidas.length !== 5) {
        alert("Faltan letras. Introduce 5 letras antes de enviar."); // Mensaje si faltan letras
        return;
    }

    var respuesta = letrasIntroducidas.join(''); // Junta los valores de las letras

    if (respuesta === palabraObjetivo) {
        alert("¡Felicidades! Has adivinado la palabra.");
    } else {
        intentos++; // Incrementa el contador de intentos
        letrasIntroducidas = []; // Resetea el array para la siguiente fila
        if (intentos === 6) {
            alert("Te has quedado sin intentos. La palabra era: " + palabraObjetivo);
        } else {
            document.querySelector('.enviar').disabled = true; // Deshabilita el botón Enviar
        }
    }
}

// -------------------------------------------------------------------------------------------------


// Añadiendo Listener en los campos correspondientes
// -------------------------------------------------------------------------------------------------
document.querySelector('.borrar').addEventListener('click', borrarLetra);
document.querySelector('.restart-btn').addEventListener('click', actualizarGrid);
document.querySelector('.enviar').addEventListener('click', verificarFila);
document.body.onload = iniciarJuego;
// -------------------------------------------------------------------------------------------------
