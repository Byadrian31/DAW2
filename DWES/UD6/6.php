<?php

/**
 * @author Adrián López Pascual
 */

/* 
Usa el formulario (Ejercicio 9 UD5) de la tabla de multiplicar donde se indique multiplicando y
multiplicador guardando estos datos en una Cookie. Se deben mostrar la tabla, el multiplicando
y multiplicador actual y el multiplicando y multiplicador anterior (cookie).
 */

if (isset($_POST['enviar'])) {
    $num = $_POST['num'];
    $mult = $_POST['mult'];

    if (is_numeric($num) && is_numeric($mult)) {
        // Guardar los valores actuales en una cookie antes de cualquier salida
        $datosActuales = $num . "|" . $mult;
        setcookie('tabla', $datosActuales, time() + 3600); // Guardar por 1 hora

        // Mostrar la tabla de multiplicar actual
        echo "<h2>Tabla de multiplicar del número " . $num . "</h2><br>";
        for ($i = 1; $i <= $mult; $i++) {
            echo $num . " x " . $i . " = " . ($num * $i) . "<br>";
        }

        // Mostrar los valores anteriores si existen
        if (isset($_COOKIE['tabla'])) {
            $datosAnteriores = explode("|", $_COOKIE['tabla']);
            $numAnterior = $datosAnteriores[0];
            $multAnterior = $datosAnteriores[1];

            echo "<br><h3>Valores anteriores:</h3>";
            echo "Multiplicando: " . $numAnterior . "<br>";
            echo "Multiplicador: " . $multAnterior . "<br>";
        } else {
            echo "<br>No hay valores anteriores.";
        }
    } else {
        echo "Por favor, introduce valores numéricos válidos.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascual</title>
</head>

<body>
    <h1>Adrián López Pascual</h1>
    <form action="" method="post">
        <fieldset>
            <legend>Tabla de multiplicar</legend>
            <label for="carácter">Número:</label>
            <input type="text" name="num"> <br>
            <label for="carácter">Multiplicador:</label>
            <select name="mult">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            <br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>
