<?php

/**
 * @author Adrián López Pascual
 */

/* 
Usa el formulario (Ejercicio 1 UD5) del selector de operación y las operaciones de suma, resta,
división y multiplicación de modo que se guarde en la Cookie los números y las operaciones
elegidas y muestre el resultado de la operación indicando cuáles han sido los números, las
operaciones elegidas y el resultado en la ejecución actual (formulario) y los números y las
elegidas en la operación anterior a la actual (cookie)
 */

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

// Condición para comprobar si son números o no
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

        // Guardamos la operación actual en una cadena delimitada
        $operacionActual = implode("|", [
            $num1,
            $num2,
            implode(",", $op),
            implode(",", $resultados)
        ]);

        // Recuperamos la operación previa de la cookie (si existe)
        $operacionAnterior = isset($_COOKIE['datos']) ? $_COOKIE['datos'] : null;

        // Guardamos la operación actual en la cookie
        setcookie('datos', $operacionActual, time() + 3600);

        // Mostramos los resultados de la operación actual
        echo "VALORES ACTUALES: <br>";
        foreach ($resultados as $res) {
            echo $res . "<br>";
        }

        // Mostramos los resultados anteriores si existen
        if ($operacionAnterior) {
            // Descomponemos la operación previa
            $datosAnteriores = explode("|", $operacionAnterior);
            $num1Ant = $datosAnteriores[0];
            $num2Ant = $datosAnteriores[1];
            $operacionesAnt = $datosAnteriores[2];
            $resultadosAnt = explode(",", $datosAnteriores[3]);

            echo "<br>VALORES ANTERIORES: <br>";
            echo "Números: " . $num1Ant . " y " . $num2Ant . "<br>";
            echo "Operaciones: " . $operacionesAnt . "<br>";
            echo "Resultados: <br>";
            foreach ($resultadosAnt as $resAnt) {
                echo $resAnt . "<br>";
            }
        } else {
            echo "<br>No hay valores anteriores.";
        }
    } else {
        echo "Tienes que indicar números.";
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
            <input type="text" name="num1"><br>
            <label for="num2">Número 2:</label>
            <input type="text" name="num2"><br>
            <select name="op[]" multiple size="2">
                <option value="+" name="+">Suma</option>
                <option value="-" name="-">Resta</option>
                <option value="*" name="*">Multiplicar</option>
                <option value="/" name="/">Dividir</option>
            </select>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>