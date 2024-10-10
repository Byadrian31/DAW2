function checkNombre() {
    var nombre = document.getElementById("nombre").value;
    var labelNombre = document.querySelector("label[for='nombre']");
    var regex = /\d/;  // La expresión regular \d busca cualquier dígito (número)
    var encontrado = false;

    // Si contiene números o está vacío
    if (regex.test(nombre) || nombre.trim() === "") {
        // Cambiar el texto del label
        labelNombre.textContent = "Nombre incorrecto:";
        labelNombre.style.color = "red";
    } else {

        labelNombre.textContent = "Nombre:";
        labelNombre.style.color = "initial";
        encontrado = true;
    }
    return encontrado;
}

function checkCorreo() {
    // Restricciones:
    // Empezar la cadena /^
    // Permitir carácteres de A-Z (tanto minúsculas como mayúsculas)
    // Permitir carácteres numéricos 0-9
    // Permitir carácteres especiales ._%+-
    // El + entre secciones indica que la sección puede repetir tantos carácteres como se desee
    // Hay tres secciones divididas en 
    // 1º /^[a-zA-Z0-9._%+-]
    // 2º @[a-zA-Z0-9.-]
    // 3º \.[a-zA-Z]{2,}
    // Requiere mínimo dos letras {2,}
    // Finalizar cadena $/
    var correo = document.getElementById("email").value;
    var labelEmail = document.querySelector("label[for='email']"); // Selecciona el label por su atributo 'for'
    var restricciones = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var resultado = restricciones.test(correo);
    var encontrado = false;

    if (!resultado || correo.trim() === "") {
        labelEmail.textContent = "E-mail incorrecto:";
        labelEmail.style.color = "red";

    } else {

        labelEmail.textContent = "Email:";
        labelEmail.style.color = "initial";
        encontrado = true;
    }
    return encontrado;
}

function checkDNI() {
    var dni = document.getElementById("dni").value;
    var labelDNI = document.querySelector("label[for='dni']"); // Selecciona el label por su atributo 'for'
    var encontrado = false;

    if (dni.length == 9) {
        var resultado = false
        var num_dni = dni.split("");
        // Para sacar bien el resto se resta 1 al resultado 
        var resto = parseInt(num_dni[0, 8]) % 23 - 1;
        //console.log(resto);
        var letras = ["T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"];
        var let_dni = letras[resto];
        if (num_dni[9] === let_dni) {
            resultado = true;
        }
    }
    if (!resultado || dni.trim() === "") {
        labelDNI.textContent = "DNI incorrecto:";
        labelDNI.style.color = "red";

    } else {

        labelDNI.textContent = "DNI:";
        labelDNI.style.color = "initial";
        encontrado = true;
    }
    return encontrado;
}

function checkForm(listadoId) {
    if (checkNombre() && checkCorreo() && checkDNI()) {
        var nombre = document.getElementById("nombre").value;
        var correo = document.getElementById("email").value;
        var dni = document.getElementById("dni").value;
        var copia = nombre + " " + correo + " " + dni;

        var nodoPadre = document.getElementById(listadoId);
        var parrafo = document.createElement("p");
        parrafo.addEventListener("dblclick", changeValue, false);
        var texto = document.createTextNode(copia);
        parrafo.appendChild(texto);
        nodoPadre.appendChild(parrafo);
    } else {
        alert("Valores incorrectos");
    }
}


function select() {
    var opcion = document.getElementById("select").value;
    if (opcion) {
        checkForm(opcion);
    } else {
        alert("Selecciona una opción");
    }
}

function changeValue(event) {
    var opcion = document.getElementById("select").value;
    // Comprobar si el texto que seleccionamos el id del nodoPadre no sea el mismo que a donde se va a desplazar
    if (event.target.parentNode.id === opcion) {
        alert("No puedes desplazarte al mismo sitio");
    } else {

        var texto = event.target.textContent;
        var nodoPadre = document.getElementById(opcion);

        // Crear un nuevo párrafo con el texto
        var nuevoParrafo = document.createElement("p");
        nuevoParrafo.textContent = texto;
        nuevoParrafo.addEventListener("dblclick", changeValue, false);
        nodoPadre.appendChild(nuevoParrafo);

        // Eliminar el párrafo original
        event.target.remove();
    }

}