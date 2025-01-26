<?php

/**
 * @author Adrián López Pascual
 */

/*
Usa el formulario del ejercicio 3 de Cookies del selector de operación de modo que uses la
sesión para mostrar el resultado de la operación indicando cuáles han sido los números, las
operaciones elegidas y el resultado en la ejecución actual y los números y las operaciones
elegidas en la ejecución anterior a la actual.
 */

session_start(); // Iniciar sesión

// Función para realizar la operación según lo que indique el usuario
function operar($num1, $num2, $op)
{
    $total = 0;
    switch ($op) {
        case '+':
            $total = $num1 + $num2;
            break;

        case '-':
            $total = $num1 - $num2;
            break;

        case '*':
            $total = $num1 * $num2;
            break;

        case '/':
            if ($num2 == 0) {
                $total = "No se puede dividir por 0";
            } else {
                $total = $num1 / $num2;
            }
            break;

        default:
            break;
    }
    return $num1 . " " . $op .  " " . $num2 . " = " . $total;
}

if (isset($_POST['enviar'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    if (is_numeric($num1) && is_numeric($num2)) {
        $op = $_POST['op'];

        // Creamos una cadena de resultados para las operaciones seleccionadas
        $resultados = [];
        foreach ($op as $operation) {
            $resultados[] = operar($num1, $num2, $operation);
        }

        // Guardamos los datos actuales en la sesión
        $operacionActual = [
            'num1' => $num1,
            'num2' => $num2,
            'operaciones' => $op,
            'resultados' => $resultados
        ];

        // Mostrar datos actuales
        echo "<h3>VALORES ACTUALES:</h3>";
        foreach ($resultados as $res) {
            echo $res . "<br>";
        }

        // Mostrar datos anteriores si existen
        if (isset($_SESSION['anterior'])) {
            $datosAnteriores = $_SESSION['anterior'];
            echo "<h3>VALORES ANTERIORES:</h3>";
            $num1Ant = $datosAnteriores['num1'] ?? "No definido";
            $num2Ant = $datosAnteriores['num2'] ?? "No definido";
            $operacionesAnt = $datosAnteriores['operaciones'] ?? [];
            $resultadosAnt = $datosAnteriores['resultados'] ?? [];

            echo "Números: " . $num1Ant . " y " . $num2Ant . "<br>";
            echo "Operaciones: " . implode(", ", $operacionesAnt) . "<br>";
            echo "Resultados:<br>";
            foreach ($resultadosAnt as $resAnt) {
                echo $resAnt . "<br>";
            }
        } else {
            echo "<h3>No hay valores anteriores.</h3>";
        }

        // Guardar los datos actuales como anteriores para la próxima ejecución
        $_SESSION['anterior'] = $operacionActual;
    } else {
        echo "<p style='color: red;'>Tienes que indicar números válidos.</p>";
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
            <legend>Operaciones</legend>
            <label for="num1">Número 1:</label>
            <input type="text" name="num1" required><br>
            <label for="num2">Número 2:</label>
            <input type="text" name="num2" required><br>
            <label for="op">Operaciones:</label><br>
            <select name="op[]" multiple size="4" required>
                <option value="+">Suma</option>
                <option value="-">Resta</option>
                <option value="*">Multiplicar</option>
                <option value="/">Dividir</option>
            </select>
            <br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>
