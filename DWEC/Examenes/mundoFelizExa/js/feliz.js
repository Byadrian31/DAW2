function feliz(num) {
    var divnum = String(num).split("");
    var i = 0;
    var cont = 0;
    var total = 0;
    var encontrado = false;
    var resultado = false;
    while (encontrado == false) {
        cont = 0;
        while (cont < divnum.length) {
            total += Math.pow(parseInt(divnum[cont]), 2);
            cont++;
        }


        // Volvemos a dividir el resultado para preparar la siguiente interacción
        divnum = total.toString().split("");
        if (total === 1) {
            resultado = true;

        }

        if (i == 9) {

            encontrado = true;
        }

        total = 0;


        i++;

    }
    return resultado;
}


function recorrerCant() {
    // Función para eliminar todos los hijos de los div derecha e izquierda
    eliminar();

    // Variables creadas necesarias para mi lógica
    var cant = document.getElementById("cantidad").value;
    var ini = document.getElementById("inicial").value;

    if (cant < 0 || ini < 0) {
        alert("Solo números positivos");
    } else {
        var cont = 0;
        var cantF = 0;
        var find = false;
        i = ini;
        do {
            // Condición para salir del bucle
            if (cant == cantF) {
                find = true;
            }
            // Condición, en caso de ser feliz crea en el html 
            // <p class="numero,del" onmouseover="cambiarCSS()" onmouseout="outCSS()" ondblclick="nclick()" >númeroFeliz</p>
            if (feliz(i)) {
                var nodoPadre = document.getElementById("izq");
                var parrafo = document.createElement("p");
                parrafo.classList.add("numero");
                parrafo.classList.add("del");
                parrafo.addEventListener("mouseover", cambiarCSS, false);
                parrafo.addEventListener("mouseout", outCSS, false);
                parrafo.addEventListener("dblclick", nclick, false);
                var texto = document.createTextNode(i);
                parrafo.appendChild(texto);
                nodoPadre.appendChild(parrafo);
                cantF++;


                var nodoPadre = document.getElementById("der");
                var parrafo = document.createElement("p");
                parrafo.classList.add("numero");
                parrafo.classList.add("del");
                parrafo.addEventListener("mouseover", cambiarCSS, false);
                parrafo.addEventListener("mouseout", outCSS, false);
                parrafo.addEventListener("dblclick", nclick, false);
                var texto = document.createTextNode(cont);
                parrafo.appendChild(texto);
                nodoPadre.appendChild(parrafo);
                cont = 0;

            } else {
                cont++;
            }
            i++;

        } while (find == false);
    }
}

// Función para eliminar todos los hijos(interior) del div indicado(der o izq)
function eliminar() {
    var derecha = document.getElementById("der");
    while (derecha.firstChild) {
        derecha.removeChild(derecha.firstChild);
    }

    var izquierda = document.getElementById("izq");
    while (izquierda.firstChild) {
        izquierda.removeChild(izquierda.firstChild);
    }


}
//Función para reemplazar el class del elemento al entrar
function cambiarCSS(event) {
    event.target.classList.replace("numero", "change");

}
//Función para reemplazar el class del elemento al salir
function outCSS(event) {
    event.target.classList.replace("change", "numero");

}

//Función para que al hacer click se coloque en el campo indicado
function nclick(event) {
    var texto = event.target.textContent;
    var nclick = document.getElementById("nclick");
    nclick.textContent = texto;
}