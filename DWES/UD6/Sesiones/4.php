<?php

/**
 * @author Adrián López Pascual
 */

/* 
Usa el formulario del ejercicio 5 de Cookies con indicación de la quincena dado el día de la
semana de modo que uses la sesión para mostrar el día y la quincena actuales y además muestre
el día y la quincena anteriores.
 */

session_start(); // Iniciar sesión

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

        // Guardar los datos actuales en la sesión
        $datosActuales = [
            'dia' => $num,
            'quincena' => $quincenaActual
        ];

        // Mostrar la quincena actual
        echo "<h3>Datos actuales:</h3>";
        echo "Día actual: " . $datosActuales['dia'] . "<br>";
        echo "Quincena actual: " . $datosActuales['quincena'] . "<br>";

        // Mostrar los valores anteriores si existen
        if (isset($_SESSION['datos_actuales'])) {
            $datosAnteriores = $_SESSION['datos_actuales'];

            echo "<h3>Datos anteriores:</h3>";
            echo "Día anterior: " . $datosAnteriores['dia'] . "<br>";
            echo "Quincena anterior: " . $datosAnteriores['quincena'] . "<br>";
        } else {
            echo "<h3>No hay datos anteriores.</h3>";
        }

        // Actualizar los datos en la sesión
        $_SESSION['datos_actuales'] = $datosActuales;
    } else {
        echo "<p style='color: red;'>Tienes que indicar un número válido.</p>";
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
            <input type="text" name="dia" required>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>
</html>
