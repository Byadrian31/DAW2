//Mensajes de los resultados de las jugadas
var mensajes = {
    tipa: "Tijeras cortan papel",
    papi: "Papel tapa piedra",
    pila: "Piedra aplasta lagarto",
    lasp: "Lagarto envenena a Spock",
    spti: "Spock rompe tijeras",
    tila: "Tijeras decapitan lagarto",
    lapa: "Lagarto devora papel",
    pasp: "Papel desautoriza a Spock",
    sppi: "Spock vaporiza piedra",
    piti: "Piedra aplasta tijeras"
}

//Variables que contendrán los elementos HTML que vayamos a necesitar

window.onload = function () {
    // Primero manejamos la pantalla de inicio
    const inicio = document.getElementById('inicio');
    if (inicio) {
        setTimeout(() => {
            inicio.style.opacity = '0';
            setTimeout(() => {
                inicio.style.display = 'none';
            }, 500); // Dar tiempo para la animación de fade out
        }, 5000);
    }
    
    
    asignarElementosHTML();
    cargarEventos();
    
    // Configurar botón de reinicio
    const botonReinicio = document.getElementById('reiniciar');
    botonReinicio.addEventListener('click', () => {
        reiniciarJuego();
        botonReinicio.className = 'boton-reinicio invisible';
        ganar = true;
    });
}

function asignarElementosHTML() {
    //Función que utilizaremos para asignar los elementos HTML que vayamos a utilizar, a las varibales que hemos creado.
    // Contenedor del selec
    let selec = document.getElementById("seleccionado");
    selec.addEventListener("drop", drop);
    selec.addEventListener("dragover", allowDrop);
    selec.addEventListener("click", function (ev) {
        selec.innerHTML = ''; // Limpiar el contenedor
    });

    // Selección de imágenes
    let imgs = document.querySelectorAll("#selector img");
    imgs.forEach(img => {
        img.draggable = true; // Hacer arrastrables
        img.addEventListener("dragstart", drag); // Asociar dragstart
    });
}

function allowDrop(ev) {
    ev.preventDefault(); // Permitir el drop
}

function drag(ev) {
    ev.dataTransfer.setData("id", ev.target.id); // Guardar ID del elemento
}
let ganar = true;
function drop(ev) {
    if (!ganar) return;
    ev.preventDefault();
    const idElement = ev.dataTransfer.getData("id"); // Obtén el id del elemento
    const elemento = document.getElementById(idElement);

    // Mostrar la opción seleccionada por el jugador
    const seleccionado = document.getElementById("seleccionado");
    seleccionado.innerHTML = ''; // Limpiar
    seleccionado.appendChild(elemento.cloneNode(true));

    // Mostrar la elección de la máquina antes de deliverar
    const eleccionMaquina = seleccionMaquina(); // Elección de la máquina
        const rival = document.getElementById("enemigo");
        rival.innerHTML = ''; // Limpiar
        rival.innerHTML = `<img src="img/${eleccionMaquina}.png">`;

    setTimeout(() => {
        deliverar(); // Mostrar mensaje o efecto de preparación

        // Usar otro retraso para calcular el ganador
        setTimeout(() => {
            calcularGanador(idElement, eleccionMaquina); // Determinar el ganador
        }, 2000); // Retraso de 2 segundos para mostrar el ganador

    }, 1000); // Retraso de 1 segundo para mostrar el mensaje de deliverar
}

function divMensaje(jugador, maquina) {
    const combinacion = jugador.slice(0, 2) + maquina.slice(0, 2); // Crear clave para buscar en mensajes
    return combinacion;
}

function divMensajePerdedor(jugador, maquina) {
    const combinacion = maquina.slice(0, 2) + jugador.slice(0, 2); // Crear clave para buscar en mensajes
    return combinacion;
}


function calcularGanador(jugador, maquina) {
    if (!ganar) return;
    let resultado = "";
    if (jugador === maquina) {
        resultado = "Empate. Intenta otra vez.";
    } else {
        switch (jugador) {
            case "piedra":
                if (maquina === "papel") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(maquina, jugador));
                } else if (maquina === "tijera") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "lagarto") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "spock") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(maquina, jugador));
                }

                break;

            case "papel":
                if (maquina === "piedra") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "tijera") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(maquina, jugador));
                } else if (maquina === "lagarto") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(maquina, jugador));
                } else if (maquina === "spock") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                }

                break;
            case "tijera":
                if (maquina === "piedra") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(maquina, jugador));
                } else if (maquina === "papel") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "lagarto") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "spock") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(maquina, jugador));
                }

                break;

            case "lagarto":
                if (maquina === "piedra") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(maquina, jugador));
                } else if (maquina === "papel") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "tijera") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(maquina, jugador));
                } else if (maquina === "spock") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                }

                break;

            case "spock":
                if (maquina === "piedra") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "papel") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(maquina, jugador));
                } else if (maquina === "tijera") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "lagarto") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(maquina, jugador));
                }

                break;

            default:
                break;
        }
    }


    if (resultado.includes("Ganaste")) {
        marcadorJugador();
    } else if (resultado.includes("Perdiste")) {
        marcadorMaquina();
    }


    mostrarMensaje(resultado);
    verificarFinDelJuego();
}

function seleccionMaquina() {
    const opciones = ["piedra", "papel", "tijera", "lagarto", "spock"];
    const aleatorio = Math.floor(Math.random() * opciones.length);
    document.getElementById("enemigo").innerHTML = '';
    document.getElementById("enemigo").innerHTML = `<img src="img/${opciones[aleatorio]}.png">`;
    return opciones[aleatorio];
}

function marcadorJugador() {
    const puntoJugador = document.createElement("div");
    puntoJugador.classList.add("punto", "mio");
    document.getElementById("jugador").appendChild(puntoJugador);
}

function marcadorMaquina() {
    const puntoMaquina = document.createElement("div");
    puntoMaquina.classList.add("punto", "suyo");
    document.getElementById("maquina").appendChild(puntoMaquina);
}

function cargarEventos() {
    //Función donde cargaremos los eventos que necesite cada elemento de la partida
}

function deliverar() {
    console.log("deliverar called");
    document.getElementById("proteccion").className = "visible";
    document.getElementById("deliveracion").className = "visible";
    setTimeout(mostrarMensaje, 2000);
}

function mostrarMensaje(mensaje) {
    const mensajeDiv = document.getElementById("mensaje");
    mensajeDiv.className = "visible";
    mensajeDiv.querySelector("p").innerText = mensaje;

    // Ocultar después de 3 segundos
    setTimeout(() => {
        mensajeDiv.className = "invisible";
    }, 2000);
    document.getElementById("proteccion").className = "invisible";
    document.getElementById("deliveracion").className = "invisible";
    document.getElementById("seleccionado").innerHTML = '';
    document.getElementById("enemigo").innerHTML = '<img src="img/interrogante.png">';
}

function verificarFinDelJuego() {
    const puntosJugador = document.querySelectorAll("#jugador .punto").length;
    const puntosMaquina = document.querySelectorAll("#maquina .punto").length;
    const botonReinicio = document.getElementById('reiniciar');

    if (puntosJugador === 8) {
        ganar = false;
        mostrarMensaje("¡Felicidades! Has ganado la partida.");
        botonReinicio.classList.remove('invisible');
        botonReinicio.classList.add('visible');
    } else if (puntosMaquina === 8) {
        ganar = false;
        mostrarMensaje("Lo siento, la máquina ha ganado.");
        botonReinicio.classList.remove('invisible');
        botonReinicio.classList.add('visible');
    }
}



function reiniciarJuego() {
    // Limpiar selecciones
    document.getElementById("seleccionado").innerHTML = '';
    document.getElementById("enemigo").innerHTML = '<img src="img/interrogante.png">';

// Limpiar marcadores
document.getElementById("jugador").innerHTML = '';
document.getElementById("maquina").innerHTML = '';

// Reiniciar estado del juego
ganar = true;

// Ocultar mensajes
document.getElementById("mensaje").className = "invisible";
document.getElementById("proteccion").className = "invisible";
document.getElementById("deliveracion").className = "invisible";
}