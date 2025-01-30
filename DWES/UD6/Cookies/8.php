<?php

/**
 * @author Adrián López Pascual
 */

/* 
Usa el formulario (Ejercicio 18 UD5) de cálculo de media, mediana y moda donde se indiquen
varios números y pueda seleccionar una o todas las opciones de cálculo sobre esos números y
las muestre guardando estos datos en una Cookie. Se deben mostrar los números con los
cálculos seleccionados en el presente y los números y los cálculos realizados en la ocasión
anterior (cookie).
 */

function media($numeros)
{
    $total = array_sum($numeros); // Sumar todos los valores
    return $total / count($numeros); // Calcular la media
}

function moda($numeros)
{
    $frecuencias = array_count_values($numeros); // Contar las frecuencias
    $maxFrecuencia = max($frecuencias); // Obtener la frecuencia máxima
    return array_keys($frecuencias, $maxFrecuencia); // Retornar los valores que tienen esa frecuencia
}

function mediana($numeros)
{
    sort($numeros); // Ordenar los números
    $count = count($numeros);

    if ($count % 2 == 1) {
        return $numeros[floor($count / 2)]; // Si es impar, retornar el valor central
    } else {
        $indice = $count / 2;
        return ($numeros[$indice - 1] + $numeros[$indice]) / 2; // Si es par, retornar el promedio de los dos centrales
    }
}

// Procesar formulario y cálculos antes de cualquier salida
if (isset($_POST['enviar']) && isset($_POST['numeros']) && is_array($_POST['numeros'])) {
    $numeros = $_POST['numeros'];
    $resultadosActuales = []; // Para guardar los resultados de la ejecución actual

    // Calcular media
    if (isset($_POST["media"])) {
        $media = media($numeros);
        $resultadosActuales['media'] = $media;
    }

    // Calcular moda
    if (isset($_POST["moda"])) {
        $moda = moda($numeros);
        $resultadosActuales['moda'] = implode(", ", $moda);
    }

    // Calcular mediana
    if (isset($_POST["mediana"])) {
        $mediana = mediana($numeros);
        $resultadosActuales['mediana'] = $mediana;
    }

    // Guardar los números y los cálculos actuales en una cookie
    $numerosGuardados = implode(",", $numeros);
    $calculosActuales = [];
    if (isset($resultadosActuales['media'])) {
        $calculosActuales[] = "Media=" . $resultadosActuales['media'];
    }
    if (isset($resultadosActuales['moda'])) {
        $calculosActuales[] = "Moda=" . $resultadosActuales['moda'];
    }
    if (isset($resultadosActuales['mediana'])) {
        $calculosActuales[] = "Mediana=" . $resultadosActuales['mediana'];
    }
    $calculosGuardados = implode("|", $calculosActuales);

    setcookie('numeros', $numerosGuardados, time() + 3600); // Guardar los números como una cadena separada por comas
    setcookie('calculos', $calculosGuardados, time() + 3600); // Guardar los cálculos como una cadena separada por |
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
            <legend>Media/Moda/Mediana</legend>
            <label for="cant">Cantidad:</label>
            <input type="text" name="cant"><br>

            <?php
            // Mostrar campos para números si se ha definido la cantidad
            if (isset($_POST['cant']) && is_numeric($_POST['cant'])) {
                $cantidad = intval($_POST['cant']);
                for ($i = 0; $i < $cantidad; $i++) {
                    echo '<label for="numero' . $i . '">Número ' . ($i + 1) . ':</label>';
                    echo '<input type="number" name="numeros[]" required><br>';
                }
                echo 'Media:<input type="checkbox" name="media">';
                echo 'Moda:<input type="checkbox" name="moda">';
                echo 'Mediana:<input type="checkbox" name="mediana">';
            }
            ?>

            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>

    <?php
    // Mostrar resultados actuales
    if (isset($resultadosActuales)) {
        echo "<h3>Resultados actuales:</h3>";
        if (isset($resultadosActuales['media'])) {
            printf("<p>La media de todos los números es %.2f </p>", $resultadosActuales['media']);
        }
        if (isset($resultadosActuales['moda'])) {
            echo "<p>La moda de todos los números es: " . $resultadosActuales['moda'] . "</p>";
        }
        if (isset($resultadosActuales['mediana'])) {
            echo "<p>La mediana es: " . $resultadosActuales['mediana'] . "</p>";
        }
    }

    // Mostrar cálculos anteriores si existen
    if (isset($_COOKIE['numeros']) && isset($_COOKIE['calculos'])) {
        echo "<h3>Cálculos anteriores:</h3>";
        echo "<p>Números: " . $_COOKIE['numeros'] . "</p>";

        $calculosAnteriores = explode("|", $_COOKIE['calculos']);
        foreach ($calculosAnteriores as $calculo) {
            list($tipo, $valor) = explode("=", $calculo);
            echo "<p>" . ucfirst($tipo) . ": " . $valor . "</p>";
        }
    }
    ?>
</body>

</html>
