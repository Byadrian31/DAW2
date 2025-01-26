<?php

/**
 * @author Adrián López Pascual
 */

/* 
Usa el formulario (Ejercicio 2 UD5) de la quincena donde se indique el día de la semana y
muestre la quincena guardando estos datos en una Cookie. Se deben mostrar el día y la
quincena actual y el día y la quincena anterior (cookie).
 */

// Condición que espera al botón Enviar
if (isset($_POST['enviar'])) {
    $num = $_POST['dia'];
    // Comprueba si $num es numérico
    if (is_numeric($num)) {
        // Determina la quincena actual
        $quincenaActual = "";
        if ($num <= 15 && $num > 0) {
            $quincenaActual = "Primera quincena";
        } else if ($num > 15 && $num < 32) {
            $quincenaActual = "Segunda quincena";
        } else {
            echo "El número es inválido";
            exit; // Detenemos la ejecución si el número no es válido
        }

        // Guardar el día y la quincena actual en la cookie
        $datosActuales = $num . "|" . $quincenaActual;
        setcookie('quincena', $datosActuales, time() + 3600); // Guardar por 1 hora

        // Almacenamos los datos anteriores para mostrarlos después
        $datosAnteriores = isset($_COOKIE['quincena']) ? explode("|", $_COOKIE['quincena']) : null;

        // Mostrar la quincena actual
        echo "Día actual: " . $num . "<br>";
        echo "Quincena actual: " . $quincenaActual . "<br>";

        // Mostrar los valores anteriores si existen
        if ($datosAnteriores) {
            $diaAnterior = $datosAnteriores[0];
            $quincenaAnterior = $datosAnteriores[1];

            echo "<br>Día anterior: " . $diaAnterior . "<br>";
            echo "Quincena anterior: " . $quincenaAnterior . "<br>";
        } else {
            echo "<br>No hay valores anteriores.<br>";
        }
    } else {
        echo "Tienes que indicar números";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascual</title>
</head>
<body>
    <h1>Adrián López Pascual</h1>
    <form action="" method="post">
        <fieldset>
            <legend>Quincena</legend>
            <label for="fecha">Dime el día:</label>
            <input type="text" name="dia">
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>
</html>
