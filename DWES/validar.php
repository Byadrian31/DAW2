<?php
function validarNombre($nombre)
{
    if (empty($nombre)) {
        return "El nombre no puede estar vacío.";
    } elseif (!ctype_alpha(str_replace(' ', '', $nombre))) {
        return "El nombre solo debe contener letras y espacios.";
    }
    return "";
}


function validarPass($pass)
{

    if (empty($pass)) {
        return "La contraseña no puede estar vacía.";
    } elseif (strlen($pass) < 6) {
        return "La contraseña debe tener al menos 6 caracteres.";
    } elseif (!preg_match('/[A-Z]/', $pass)) {
        return "La contraseña debe contener al menos una mayúscula.";
    } elseif (!preg_match('/[a-z]/', $pass)) {
        return "La contraseña debe contener al menos una minúscula.";
    } elseif (!preg_match('/\d/', $pass)) {
        return "La contraseña debe contener al menos un número.";
    } elseif (preg_match('/\s/', $pass)) {
        return "La contraseña no debe contener espacios.";
    } elseif (!preg_match('/[^A-Za-z0-9]/', $pass)) {
        return "La contraseña  debe contener caracteres especiales.";
    }

    return "";
}

function validarEmail($email)
{
    if (empty($email)) {
        return "El email no puede estar vacío.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "El email no es válido.";
    }
    return "";
}

function validarTelefono($telefono)
{
    if (empty($telefono)) {
        return "El teléfono no puede estar vacío.";
    } elseif (!preg_match('/^\d{9}$/', $telefono)) {
        return "El teléfono debe tener 9 dígitos.";
    }
    return "";
}

function validarCP($cp)
{
    if (empty($cp)) {
        return "El Código Postal no puede estar vacío.";
    } elseif (!preg_match('/^\d{5}$/', $cp)) {
        return "El Código Postal debe tener 5 dígitos.";
    }
    return "";
}

function validarPeso($peso)
{
    if (empty($peso)) {
        return "El peso no puede estar vacío.";
    } elseif (ctype_digit($peso)) {
        return "El peso debe ser un número.";
    } elseif ($peso < 0 && $peso > 200) {
        return "El peso debe estar entre 0 y 200.";
    }
    return "";
}

function validarEdad($edad){
    if (empty($edad)) {
        return "La edad no puede estar vacía.";
    } elseif (!ctype_digit($edad)) {
        return "La edad debe ser un número.";
    } elseif ($edad < 0 && $edad > 120) {
        return "La edad debe estar entre 0 y 120.";
    }
    return "";
}
