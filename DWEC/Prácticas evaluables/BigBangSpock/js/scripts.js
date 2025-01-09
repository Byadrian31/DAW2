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
    cargarTablero();
    asignarElementosHTML();
    cargarEventos();
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

function drop(ev) {
    ev.preventDefault();
    const idElement = ev.dataTransfer.getData("id"); // Obtén el id del elemento
    const elemento = document.getElementById(idElement);

    // Mostrar la opción seleccionada por el jugador
    const seleccionado = document.getElementById("seleccionado");
    seleccionado.innerHTML = ''; // Limpiar
    seleccionado.appendChild(elemento.cloneNode(true));

    // Llamar a deliverar antes de mostrar el rival
  //  deliverar();

    // Usar un retraso para mostrar la elección del rival y calcular el ganador
  /*  setTimeout(() => {
        const eleccionMaquina = seleccionMaquina(); // Elección de la máquina
        calcularGanador(idElement, eleccionMaquina); // Determinar el ganador
    }, 2000); // Retraso de 2 segundos*/
    seleccionMaquina();
}

function divMensaje(jugador, maquina) {
    const combinacion = jugador.slice(0, 2) + maquina.slice(0, 2); // Crear clave para buscar en mensajes
    return combinacion;
}

function divMensajePerdedor(jugador, maquina) {
    const combinacion = maquina.slice(0, 2) + jugador.slice(0, 2); // Crear clave para buscar en mensajes
    return combinacion;
}


function calcularGanador() {
    const jugador = document.getElementById("seleccionado").firstElementChild.id;
    const maquina = document.getElementById("enemigo").firstElementChild.id;
    console.log(jugador, maquina);
    let resultado = "";
    if (jugador === maquina) {
        resultado = "Empate. Intenta otra vez.";
    } else {
        switch (jugador) {
            case "piedra":
                if (maquina === "papel") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "tijera") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "lagarto") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "spock") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                }

                break;

            case "papel":
                if (maquina === "piedra") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "tijera") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "lagarto") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "spock") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                }

                break;
            case "tijera":
                if (maquina === "piedra") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "papel") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "lagarto") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "spock") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                }

                break;

            case "lagarto":
                if (maquina === "piedra") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "papel") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "tijera") {
                    resultado = "Perdiste. " + mensajes[divMensajePerdedor(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
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
                    resultado = "Perdiste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "tijera") {
                    resultado = "Ganaste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
                } else if (maquina === "lagarto") {
                    resultado = "Perdiste. " + mensajes[divMensaje(jugador, maquina)];
                    console.log(divMensaje(jugador, maquina));
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
}

function seleccionMaquina() {
    const opciones = ["piedra", "papel", "tijera", "lagarto", "spock"];
    const aleatorio = Math.floor(Math.random() * opciones.length);
    document.getElementById("enemigo").innerHTML = '';
    document.getElementById("enemigo").innerHTML = `<img src="img/${opciones[aleatorio]}.png">`;
    //return opciones[aleatorio];
    setTimeout(deliverar, 1800);
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


function continuar() {
    //Función que lanzamos cuando pulsamos al botón continuar
    //Volvemos a ocultar el mensaje;
    document.getElementById("mensaje").className = "invisible";
    document.getElementById("proteccion").className = "invisible";
    document.getElementById("deliveracion").className = "invisible";

    //Si es una jugada reiniciamos todo menos los contadores de puntos.
    //Si es el final de la partida, también incluimos los contadores de puntos.
    cargarTablero();
}

function deliverar() {
    console.log("deliverar called");
    document.getElementById("proteccion").className = "visible";
    document.getElementById("deliveracion").className = "visible";
    setTimeout(calcularGanador, 2000);
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


function cargarTablero() {
    //Función donde crearemos los elementos que vayamos a necesitar, junto a sus atributos y eventos
    //La utilizaremos para reiniciar cada jugada
}

function reiniciarJuego() {
    // Limpiar selecciones
    document.getElementById("seleccionado").innerHTML = '';
    document.getElementById("enemigo").innerHTML = '<img src="img/interrogante.png">';

    // Si alguien gana 10 puntos, reiniciar también los marcadores
    if (puntosJugador === 10 || puntosMaquina === 10) {
        puntosJugador = 0;
        puntosMaquina = 0;
        document.getElementById("jugador").innerHTML = '';
        document.getElementById("maquina").innerHTML = '';
    }
}
