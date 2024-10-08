function sombra(elemento) {
    elemento.classList.toggle("sombra");
}

function añadir(elemento) {
    var texto = document.getElementById("res");
    console.log("Hola: " + texto.value);
    console.log("Adios: " + elemento.innerText)

    switch (elemento.innerText) {
        case "+":
            var ultimo = texto.value.slice(-1);
            if (texto.value != "" && ultimo != elemento.innerText) {
                texto.value += elemento.innerText;
            }
            break;

        case "-":
            var ultimo = texto.value.slice(-1);
            if (texto.value != "" && ultimo != elemento.innerText) {
                texto.value += elemento.innerText;
            }
            break;

        case "/":
            var ultimo = texto.value.slice(-1);
            if (texto.value != "" && ultimo != elemento.innerText) {
                texto.value += elemento.innerText;
            }
            break;

        case "x":
            var ultimo = texto.value.slice(-1);
            if (texto.value != "" && ultimo != elemento.innerText) {
                texto.value += elemento.innerText;
            }
            break;

        case ".":
            var ultimo = texto.value.slice(-1);
            if (texto.value != "" && ultimo != elemento.innerText) {
                texto.value += elemento.innerText;
            }
            break;

        case "%":
            var ultimo = texto.value.slice(-1);
            if (texto.value != "" && ultimo != elemento.innerText) {
                texto.value += elemento.innerText;
            }
            break;


        default:
            if (texto.value == "0") {
                texto.value = ""
            }
            texto.value += elemento.innerText;
            break;
    }
}

function resultado(elemento) {
    var texto = document.getElementById("res");
    if (texto.value.includes('x')) {
        var res = eval(texto.value.replace(/x/g, '*'));
        if (texto.value.includes("%")) {
            var cadena = texto.value.split("%");
            var operacion = parseFloat(cadena[0]) / 100 * parseFloat(cadena[1]);
            var op = eval(operacion);
            if (!isNaN(op)) {
                texto.value = op;
            }
        } else {
            if (!isNaN(res)) {
                texto.value = res;
            }
        }


    } else {
        var res = eval(texto.value);
        if (texto.value.includes("%")) {
            var cadena = texto.value.split("%");
            var operacion = parseFloat(cadena[0]) / 100 * parseFloat(cadena[1]);
            var op = eval(operacion);
            if (!isNaN(op)) {
                texto.value = op;
            }
        } else {
            if (!isNaN(res)) {
                texto.value = res;
            }
        }
    }
}



function parentesis(elemento) {
    var texto = document.getElementById("res");
    if (!(texto.value.startsWith("(") && texto.value.endsWith(")"))) {
        texto.value = "(" + texto.value + ")";
        console.log(texto.value);
    }
}

function borrarTotal() {
    var texto = document.getElementById("res");
    texto.value = "0";
}

function borrar() {
    var texto = document.getElementById("res");
    texto.value = texto.value.slice(0, -1);
}

document.addEventListener("keydown", function (event) {
    var res = document.getElementById("res");


    if (event.key >= "0" && event.key <= "9") {
        añadir({ innerText: event.key });
    } else if (event.key == "+") {
        añadir({ innerText: "+" });
    } else if (event.key == "-") {
        añadir({ innerText: "-" });
    } else if (event.key == "*") {
        añadir({ innerText: "x" });
    } else if (event.key == "/") {
        añadir({ innerText: "/" });
    } else if (event.key == ".") {
        añadir({ innerText: "." });
    } else if (event.key == "%") {
        añadir({ innerText: "%" });
    } else if (event.key == "(") {
        parentesis();
    } else if (event.key == ")") {
        parentesis();
    } else if (event.key == "Backspace") {
        borrar();
    } else if (event.key == "Delete") {
        borrarTotal();
    } else if (event.key == "Enter") {
        resultado();
    }

});