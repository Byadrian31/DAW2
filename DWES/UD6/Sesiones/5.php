<?php

/**
 * @author Adrián López Pascual
 */

/* 
Usa el formulario del ejercicio 4 de Cookies del conversor de euros y pesetas de modo que uses
la sesión para mostrar la cantidad, moneda y conversión actuales y además muestre la cantidad,
moneda y conversión anterior.
 */

session_start(); // Iniciar la sesión

// Función para realizar la conversión correspondiente
function convertir($op, $cant)
{
    $cambio = 166.386;
    if ($op == "euros") { 
        $pesetas = $cant * $cambio;
        return $cant . "€ es igual a " . $pesetas . " pesetas";
    } else {
        $euros = $cant / $cambio;
        return $cant . " pesetas es igual a " . $euros . "€";
    }
}

// Condición que espera al botón Enviar
if (isset($_POST['enviar'])) {
    $cant = $_POST['cant'];
    $op = $_POST['conversor'];

    if (is_numeric($cant)) {
        // Realizar la conversión actual
        $conversionActual = convertir($op, $cant);

        // Guardar los datos actuales en la sesión
        $datosActuales = [
            'cantidad' => $cant,
            'operacion' => $op,
            'conversion' => $conversionActual
        ];

        // Mostrar la conversión actual
        echo "<h3>Conversión actual:</h3>";
        echo $conversionActual . "<br>";

        // Mostrar la conversión anterior si existe
        if (isset($_SESSION['conversion_anterior'])) {
            $datosAnteriores = $_SESSION['conversion_anterior'];
            echo "<h3>Conversión anterior:</h3>";
            echo "Cantidad: " . $datosAnteriores['cantidad'] . "<br>";
            echo "Conversión: " . $datosAnteriores['conversion'] . "<br>";
        } else {
            echo "<h3>No hay datos anteriores.</h3>";
        }

        // Guardar los datos actuales como anteriores para la próxima ejecución
        $_SESSION['conversion_anterior'] = $datosActuales;
    } else {
        echo "<p style='color: red;'>Por favor, introduce un valor numérico.</p>";
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
            <legend>€ a pesetas / pesetas a €</legend>
            <label for="conversor">Conversor:</label>
            <input type="radio" name="conversor" value="euros" required> € a pesetas
            <input type="radio" name="conversor" value="pesetas" required> pesetas a €<br>
            <label for="cant">Cantidad:</label>
            <input type="text" name="cant" required><br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>
