<?php

/**
 * @author Adrián López Pascual
 */

/* 
Usa el formulario del ejercicio 10 de Cookies con selección de si se desea publicidad o no de
modo que uses la sesión para mostrar el nombre del usuario y si desea o no publicidad del
usuario actual y además muestre usuario y elección del anterior.
 */

session_start(); // Iniciar sesión

// Procesar el formulario al enviarlo
if (isset($_POST['enviar'])) {
    $email = $_POST['email']; // Obtener el email del formulario
    $recibirPublicidad = isset($_POST['cond']) ? "Sí" : "No"; // Verificar si se aceptó publicidad

    // Guardar los datos actuales en la sesión
    $_SESSION['actual'] = [
        'email' => $email,
        'publicidad' => $recibirPublicidad
    ];

    // Mostrar los datos actuales
    echo "<h3>Usuario actual:</h3>";
    echo "<p>Correo electrónico: <strong>$email</strong></p>";
    echo "<p>Desea recibir publicidad: <strong>$recibirPublicidad</strong></p>";
}

// Mostrar los datos anteriores si existen
if (isset($_SESSION['anterior'])) {
    echo "<h3>Usuario anterior:</h3>";
    $emailAnterior = isset($_SESSION['anterior']['email']) ? $_SESSION['anterior']['email'] : "No disponible";
    $publicidadAnterior = isset($_SESSION['anterior']['publicidad']) ? $_SESSION['anterior']['publicidad'] : "No disponible";

    echo "<p>Correo electrónico: <strong>" . $emailAnterior . "</strong></p>";
    echo "<p>Deseaba recibir publicidad: <strong>" . $publicidadAnterior . "</strong></p>";
}

// Actualizar los datos anteriores con los actuales
if (isset($_SESSION['actual'])) {
    $_SESSION['anterior'] = $_SESSION['actual'];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascual</title>
</head>

<body>

    <h1>Adrián López Pascual</h1>

    <form action="" method="post">
        <fieldset>
            <legend>Correo electrónico</legend>
            <label for="email">Correo electrónico:</label>
            <input type="email" name="email" required> <br>
            Acepto recibir publicidad
            <input type="checkbox" name="cond"> <br>
            <input type="submit" value="Enviar" name="enviar">
            <input type="reset" value="Borrar">
        </fieldset>
    </form>

</body>

</html>
