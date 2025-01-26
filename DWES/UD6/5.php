<?php

/**
 * @author Adrián López Pascual
 */

/* 
Usa el formulario (Ejercicio 3 UD5) del conversor euros a pesetas y viceversa de la cantidad
introducida por el usuario y guardar los datos en una Cookie. Se deben mostrar la cantidad,
moneda y conversión actual y la cantidad, moneda y conversión anterior (cookie).
 */

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

        // Guardar los datos actuales en una cookie
        $datosActuales = $cant . "|" . $op . "|" . $conversionActual;
        setcookie('conversion', $datosActuales, time() + 3600); // Guardar por 1 hora

        // Mostrar la conversión actual
        echo "Conversión actual:<br>" . $conversionActual . "<br>";

        // Mostrar la conversión anterior si existe
        if (isset($_COOKIE['conversion'])) {
            $datosAnteriores = explode("|", $_COOKIE['conversion']);
            $cantAnterior = $datosAnteriores[0];
            $opAnterior = $datosAnteriores[1];
            $conversionAnterior = $datosAnteriores[2];

            echo "<br>Conversión anterior:<br>";
            echo "Cantidad: " . $cantAnterior . "<br>";
            echo "Conversión: " . $conversionAnterior . "<br>";
        } else {
            echo "<br>No hay datos anteriores.";
        }
    } else {
        echo "Por favor, introduce un valor numérico.";
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
            <input type="radio" name="conversor" value="euros"> € a pesetas
            <input type="radio" name="conversor" value="pesetas"> pesetas a €<br>
            <label for="cant">Cantidad:</label>
            <input type="text" name="cant"><br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>
