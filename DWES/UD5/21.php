<?php

/**
 * @author Adrián López Pascual
 */

/*
21. Realiza un programa donde el usuario seleccione una zona horaria de un máximo de 20 y le 
muestre la hora actual de dicha zona horaria
*/

if (isset($_POST['enviar'])) {
    $zona = $_POST['timezone'];

    $nZona = new DateTime("now", new DateTimeZone($zona)); 
    echo $nZona->format('d.m.Y, H:i:s');
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, content=device-width, initial-scale=1.0">
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