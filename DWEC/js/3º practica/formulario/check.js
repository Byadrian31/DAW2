function checkNombre() {
    var nombre = document.getElementById("nombre").value;
    var labelNombre = document.querySelector("label[for='nombre']");
    var regex = /\d/;  // La expresión regular \d busca cualquier dígito (número)

    // Si contiene números o está vacío
    if (regex.test(nombre) || nombre.trim() === "") {
        // Cambiar el texto del label
        labelNombre.textContent = "Nombre incorrecto:";
        labelNombre.style.color = "red";
        document.getElementById("nombre").value = ""
    } else {

        labelNombre.textContent = "Nombre:";
        labelNombre.style.color = "initial";
    }

}

function checkApellido() {
    var apellido = document.getElementById("apellidos").value;
    var labelApellido = document.querySelector("label[for='apellidos']"); // Selecciona el label por su atributo 'for'
    var regex = /\d/;  // La expresión regular \d busca cualquier dígito (número)

    // Si contiene números o está vacío
    if (regex.test(apellido) || apellido.trim() === "") {
        // Cambiar el texto del label
        labelApellido.textContent = "Apellidos incorrectos:";
        labelApellido.style.color = "red";
        document.getElementById("apellidos").value = ""
    } else {

        labelApellido.textContent = "Apellidos:";
        labelApellido.style.color = "initial";
    }
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
    if (!resultado || correo.trim() === "") {
        labelEmail.textContent = "E-mail incorrecto:";
        labelEmail.style.color = "red";
        document.getElementById("email").value = ""
    } else {

        labelEmail.textContent = "Email:";
        labelEmail.style.color = "initial";
    }
}

function checkDNI() {
    var dni = document.getElementById("dni").value;
    var labelDNI = document.querySelector("label[for='dni']"); // Selecciona el label por su atributo 'for'

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
        document.getElementById("dni").value = ""
    } else {

        labelDNI.textContent = "DNI:";
        labelDNI.style.color = "initial";
    }
}

function checkPass() {
    var pass = document.getElementById("password").value;
    var labelPass = document.querySelector("label[for='password']"); // Selecciona el label por su atributo 'for'
    /*

    Minimo 8 caracteres
    Maximo 15
    Al menos una letra mayúscula
    Al menos una letra minucula
    Al menos un dígito
    No espacios en blanco
    Al menos 1 caracter especial

    */
    var restricciones = regexp_password = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&.])[A-Za-z\d$@$!%*?&]{8}/;

    var resultado = restricciones.test(pass);

    if (!resultado || pass.trim() === "") {
        labelPass.textContent = "Password incorrecta:";
        labelPass.style.color = "red";
        document.getElementById("password").value = ""
        alert(`
        Mínimo 8 caracteres
        Máximo 15
        Al menos una letra mayúscula
        Al menos una letra minúscula
        Al menos un dígito
        No espacios en blanco
        Al menos 1 carácter especial
        `)
    } else {

        labelPass.textContent = "Password:";
        labelPass.style.color = "initial";
    }

}

function checkPass2() {
    var pass = document.getElementById("password").value;
    var pass2 = document.getElementById("password2").value;
    var labelPass = document.querySelector("label[for='password2']"); // Selecciona el label por su atributo 'for'

    if (pass !== pass2 || pass2.trim() === "") {
        labelPass.textContent = "Las password no coinciden:";
        labelPass.style.color = "red";
        document.getElementById("password2").value = ""
    } else {

        labelPass.textContent = "Repetir password:";
        labelPass.style.color = "initial";
    }

}

function checkIp() {
    var ip = document.getElementById("ip").value;
    var labelIP = document.querySelector("label[for='ip']"); // Selecciona el label por su atributo 'for'
    res = 0;
    resultadoTotal = false;
    var split = ip.split(".");
    if (split.length == 4) {
        for (let i = 0; i < split.length; i++) {
            var numero = parseInt(split[i]);
            if (numero >= 0 && numero <= 255 && !isNaN(numero)) {
                res++;
            } else {
                res--;
            }
        }
        console.log(res);
        if (res == 4) {
            resultadoTotal = true;
        }
    }

    if (!resultadoTotal || ip.trim() === "") {
        labelIP.textContent = "IP incorrecta:";
        labelIP.style.color = "red";
        document.getElementById("ip").value = ""
    } else {

        labelIP.textContent = "IP:";
        labelIP.style.color = "initial";
    }

}