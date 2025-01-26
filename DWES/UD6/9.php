<?php

/**
 * @author Adrián López Pascual
 */

/* 
Usa el formulario (Ejercicio 22 UD5) que guarde en una Cookie la preferencia del usuario de si
desea o no recibir publicidad y que muestre la opción anterior y la nueva elegida en caso de que
la modifique.
 */

if (isset($_POST['enviar'])) {
    $zona = $_POST['timezone'];

    // Obtener la hora en la zona seleccionada
    $nZona = new DateTime("now", new DateTimeZone($zona));
    $horaActual = $nZona->format('d.m.Y, H:i:s');

    // Guardar zona horaria y hora actual en cookies
    setcookie('zona_anterior', $zona, time() + 3600); // Guardar zona anterior por 1 hora
    setcookie('hora_anterior', $horaActual, time() + 3600); // Guardar hora anterior por 1 hora

    // Mostrar los datos actuales
    echo "<h3>Hora y zona actual:</h3>";
    echo "<p>Zona horaria: $zona</p>";
    echo "<p>Hora actual: $horaActual</p>";
}

// Mostrar los datos de la cookie (datos anteriores)
if (isset($_COOKIE['zona_anterior']) && isset($_COOKIE['hora_anterior'])) {
    echo "<h3>Hora y zona anterior:</h3>";
    echo "<p>Zona horaria: " . $_COOKIE['zona_anterior'] . "</p>";
    echo "<p>Hora: " . $_COOKIE['hora_anterior'] . "</p>";
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
