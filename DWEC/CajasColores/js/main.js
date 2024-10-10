/*
    Pon aquí las funciones que cambian la forma de los cuadrados a círculos.
*/

function circulo(elemento) {
/*    var radio = elemento.style.borderRadius;
    if (radio == "50%") {
        elemento.style.transition = "1s"
        elemento.style.borderRadius = "0%"
    } else {
        elemento.style.transition = "1s"
        elemento.style.borderRadius = "50%"
    }*/
    elemento.classList.toggle("circulo");
}
function sombra(elemento) {
    elemento.classList.toggle("sombra");
}
function sombraInt(elemento){
    
    elemento.classList.toggle("sombraInt");
}
function eliminar(elemento) {
    elemento.parentNode.remove();
}