//Mensajes de los resultados de las jugadas
var mensajes = {
    tipa: "Tijeras cortan papel",
    papi: "Papel tapa piedra",
    pila:"Piedra aplasta lagarto",
    lasp: "Lagarto envenena a Spock",
    spti: "Spock rompe tijeras",
    tila: "Tijeras decapitan lagarto",
    lapa: "Lagarto devora papel",
    pasp: "Papel desautoriza a Spock",
    sppi: "Spock vaporiza piedra",
    piti: "Piedra aplasta tijeras"
}

//Variables que contendrán los elementos HTML que vayamos a necesitar

window.onload = function(){
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
    const idElement = ev.dataTransfer.getData("id");
    const elemento = document.getElementById(idElement);
    ev.target.innerHTML = ''; // Limpiar el contenedor antes de añadir el nuevo elemento
    ev.target.appendChild(elemento.cloneNode(true)); // Añadir el elemento clonado
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
    document.getElementById("proteccion").className="visible";
    document.getElementById("deliveracion").className="visible";
    setTimeout(mostrarMensaje,2000);
}

function mostrarMensaje() {
    //Mostramos el mensaje en función del resultado de la jugada o de la partida
}

function cargarTablero() {
    //Función donde crearemos los elementos que vayamos a necesitar, junto a sus atributos y eventos
    //La utilizaremos para reiniciar cada jugada
}

/***************************DRAG AND DROP ****************************/

//Funciones para el drag&drop
 
 /***************************FIN DRAG AND DROP **************************/