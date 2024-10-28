<?php

/**
 * @author Adrián López Pascual
 */

/*
20. Realiza un programa que pida una hora por teclado y que muestre luego el saludo, esto es: 
buenos días, buenas tardes o buenas noches según la hora. Se utilizarán los tramos de 6 a 12, de 
13 a 20 y de 21 a 5 respectivamente. Sólo se tienen en cuenta las horas, los minutos no se deben 
introducir por teclado.
*/

if (isset($_POST['enviar'])) {
    $hora = $_POST['hora'];
    // Al solo pedir la hora, compruebo si el valor es numérico y que esté entre las 0 y 23
    if (is_numeric($hora) && $hora < 24 && $hora >= 0) {
        // Condiciones para tratar las diferentes horas
        if ($hora > 5 && $hora < 13) {
            echo "Buenos días";
        } elseif ($hora > 12 && $hora < 21) {
            echo "Buenas tardes";
        } else {
            echo "Buenas noches";
        }
    } else {
        echo "La hora $hora no es válida. Asegúrate de usar el formato hh.";
    }
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
            <legend>Hora</legend>
            <label for="carácter">Hora:</label>
            <input type="text" name="hora" placeholder="h">
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>