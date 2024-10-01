function changeCircle(element) {
    element.style.transition = "1s"
    element.style.borderRadius = "50%"
    //document.getElementsByClassName("cuadrado").style.borderRadius("50%");
}

function changeSquare(element) {
    //document.getElementById("red").style.borderRadius("50%");
    element.style.transition = "1s"
    element.style.borderRadius = "0%"
}

function shadowOut(element) {
    element.style.shadow = "0px 0px 0px"
}