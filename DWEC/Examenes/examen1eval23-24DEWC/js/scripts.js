let gruposJugadores = [["Futbolistas", "futbol"],
    ["Intérpretes", "interpretes"],
    ["DC", "dc"],
    ["Star Wars", "starwars"],
    ["Marvel", "marvel"]];

//Número de jugadores en cada grupo
let numeroJugadores = 13;

//Número máximo de jugadores por equipo
let maxJugadoresEquipo = 11;

window.onload = function() {

}

//Devuelve un número aleatorio entero entre el mínimo y el máximo indicado, ambos inclusive
function aleatorio(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}