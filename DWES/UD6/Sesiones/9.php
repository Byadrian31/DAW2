<?php

/**
 * @author Adrián López Pascual
 */

/* 
Usa el formulario del ejercicio 9 de Cookies con selección de cálculo de media, mediana y
moda de modo que uses la sesión para mostrar los números, la media, mediana y/o moda
seleccionadas actualmente y además muestre los números, la media, mediana y moda de la
selección anterior.
 */

session_start(); // Iniciar sesión

if (isset($_POST['enviar'])) {
    $zona = $_POST['timezone'];

    // Obtener la hora en la zona seleccionada
    $nZona = new DateTime("now", new DateTimeZone($zona));
    $horaActual = $nZona->format('d.m.Y, H:i:s');

    // Guardar los datos actuales en la sesión
    $_SESSION['actual'] = [
        'zona' => $zona,
        'hora' => $horaActual
    ];

    // Mostrar los datos actuales
    echo "<h3>Hora y zona actual:</h3>";
    echo "<p>Zona horaria: $zona</p>";
    echo "<p>Hora actual: $horaActual</p>";
}

// Mostrar los datos anteriores si existen
if (isset($_SESSION['anterior'])) {
    echo "<h3>Hora y zona anterior:</h3>";
    if (isset($_SESSION['anterior']['zona'])) {
        echo "<p>Zona horaria: " . $_SESSION['anterior']['zona'] . "</p>";
    } else {
        echo "<p>Zona horaria: No disponible</p>";
    }

    if (isset($_SESSION['anterior']['hora'])) {
        echo "<p>Hora: " . $_SESSION['anterior']['hora'] . "</p>";
    } else {
        echo "<p>Hora: No disponible</p>";
    }
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
            <legend>Zonas horarias</legend>
            <select name="timezone">
                <option value="Africa/Abidjan">Africa/Abidjan</option>
                <option value="Africa/Juba">Africa/Juba</option>
                <option value="Africa/Harare">Africa/Harare</option>
                <option value="America/Costa_Rica">America/Costa_Rica</option>
                <option value="America/El_Salvador">America/El_Salvador</option>
                <option value="Asia/Colombo">Asia/Colombo</option>
                <option value="Asia/Dubai">Asia/Dubai</option>
                <option value="Europe/Amsterdam">Europe/Amsterdam</option>
                <option value="Europe/Berlin">Europe/Berlin</option>
                <option value="Europe/Madrid">Europe/Madrid</option>
                <option value="Indian/Antananarivo">Indian/Antananarivo</option>
                <option value="Indian/Cocos">Indian/Cocos</option>
                <option value="Pacific/Galapagos">Pacific/Galapagos</option>
                <option value="Pacific/Gambier">Pacific/Gambier</option>
                <option value="Pacific/Marquesas">Pacific/Marquesas</option>
            </select>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>
