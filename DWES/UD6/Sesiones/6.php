<?php

/**
 * @author Adrián López Pascual	
 */

/* 
Usa el formulario del ejercicio 6 de Cookies con la tabla de multiplicar de modo que uses la
sesión para mostrar el multiplicando, el multiplicador y la tabla actuales y además muestre el
multiplicando, el multiplicador y la tabla de la ejecución anterior.
 */

session_start(); // Iniciar sesión

if (isset($_POST['enviar'])) {
    $num = $_POST['num'];
    $mult = $_POST['mult'];

    if (is_numeric($num) && is_numeric($mult)) {
        // Guardar los valores actuales en la sesión
        $datosActuales = [
            'multiplicando' => $num,
            'multiplicador' => $mult,
            'tabla' => []
        ];

        // Generar la tabla de multiplicar actual
        for ($i = 1; $i <= $mult; $i++) {
            $datosActuales['tabla'][] = $num . " x " . $i . " = " . ($num * $i);
        }

        // Mostrar la tabla de multiplicar actual
        echo "<h2>Tabla de multiplicar del número " . $num . "</h2><br>";
        foreach ($datosActuales['tabla'] as $linea) {
            echo $linea . "<br>";
        }

        // Mostrar los valores anteriores si existen
        if (isset($_SESSION['datos_anterior'])) {
            $datosAnteriores = $_SESSION['datos_anterior'];

            echo "<br><h3>Valores anteriores:</h3>";
            echo "Multiplicando: " . $datosAnteriores['multiplicando'] . "<br>";
            echo "Multiplicador: " . $datosAnteriores['multiplicador'] . "<br>";
            echo "Tabla anterior:<br>";
            foreach ($datosAnteriores['tabla'] as $linea) {
                echo $linea . "<br>";
            }
        } else {
            echo "<br><h3>No hay valores anteriores.</h3>";
        }

        // Guardar los datos actuales como anteriores para la próxima ejecución
        $_SESSION['datos_anterior'] = $datosActuales;
    } else {
        echo "<p style='color: red;'>Por favor, introduce valores numéricos válidos.</p>";
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
            <input type="text" name="num" required> <br>
            <label for="carácter">Multiplicador:</label>
            <select name="mult" required>
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
