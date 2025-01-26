<?php

/**
 * @author Adrián López Pascual
 */

/* 
Usa el formulario del ejercicio 8 de Cookies con selección de zona horaria para mostrar la hora
y zona elegidas de modo que uses la sesión para mostrar la zona horaria y hora actuales y
además muestre la zona horaria y hora de la selección anterior.
 */

session_start(); // Iniciar la sesión

// Funciones para cálculos
function media($numeros)
{
    return array_sum($numeros) / count($numeros);
}

function moda($numeros)
{
    $frecuencias = array_count_values($numeros);
    $maxFrecuencia = max($frecuencias);
    return array_keys($frecuencias, $maxFrecuencia);
}

function mediana($numeros)
{
    sort($numeros);
    $count = count($numeros);

    if ($count % 2 == 1) {
        return $numeros[floor($count / 2)];
    } else {
        $indice = $count / 2;
        return ($numeros[$indice - 1] + $numeros[$indice]) / 2;
    }
}

// Procesar formulario
if (isset($_POST['enviar']) && isset($_POST['numeros']) && is_array($_POST['numeros'])) {
    $numeros = $_POST['numeros'];
    $resultadosActuales = []; // Para guardar los resultados de la ejecución actual

    // Calcular media
    if (isset($_POST["media"])) {
        $resultadosActuales['media'] = media($numeros);
    }

    // Calcular moda
    if (isset($_POST["moda"])) {
        $resultadosActuales['moda'] = implode(", ", moda($numeros));
    }

    // Calcular mediana
    if (isset($_POST["mediana"])) {
        $resultadosActuales['mediana'] = mediana($numeros);
    }

    // Guardar los números y resultados actuales en la sesión
    $_SESSION['actual'] = [
        'numeros' => implode(", ", $numeros),
        'resultados' => $resultadosActuales
    ];
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
    if (isset($_SESSION['actual'])) {
        echo "<h3>Resultados actuales:</h3>";
        echo "<p>Números: " . $_SESSION['actual']['numeros'] . "</p>";
        foreach ($_SESSION['actual']['resultados'] as $tipo => $valor) {
            echo "<p>" . ucfirst($tipo) . ": " . $valor . "</p>";
        }
    }

    // Mostrar resultados anteriores si existen
    if (isset($_SESSION['anterior'])) {
        echo "<h3>Resultados anteriores:</h3>";
        echo "<p>Números: " . $_SESSION['anterior']['numeros'] . "</p>";
        foreach ($_SESSION['anterior']['resultados'] as $tipo => $valor) {
            echo "<p>" . ucfirst($tipo) . ": " . $valor . "</p>";
        }
    }

    // Actualizar resultados anteriores
    if (isset($_SESSION['actual'])) {
        $_SESSION['anterior'] = $_SESSION['actual'];
    }
    ?>
</body>

</html>
