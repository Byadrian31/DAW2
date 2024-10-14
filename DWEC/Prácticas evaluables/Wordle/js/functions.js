var palabras = ["cebra", "abeja", "raton", "erizo", "zorro", "pulpo"];
var palabraObjetivo = "";

function escogerPalabra() {
    var indice = Math.floor(Math.random() * palabras.length);
    palabraObjetivo = palabras[indice];
    console.log("Palabra objetivo:", palabraObjetivo);
    console.log(indice);
}

function iniciarJuego() {
    escogerPalabra();
    var fila = fila.getElementByClassName("letra");
}

document.body.onload = iniciarJuego;
