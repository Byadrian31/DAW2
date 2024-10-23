<?php
/**
 * @author Adrián López Pascual
 */

 // Condición que espera al botón Enviar
 if (isset($_POST['enviar'])) {
    $num = $_POST['dia'];
    // Comprueba si $num es numérico
    if (is_numeric($num)) {
        // Condicionales para el funcionamiento del ejercicio
        if ($num <= 15 && $num > 0) {
            echo "Primera quincena";
        } else if ($num > 15 && $num < 32) {
            echo "Segunda quincena";
        } else {
            echo "El número es inválido";
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