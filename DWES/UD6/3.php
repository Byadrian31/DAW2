<?php

/**
 * @author Adrián López Pascual
 */

/*
Usa el formulario (Ejercicio 1 UD5) del selector de operación y las operaciones de suma, resta,
división y multiplicación de modo que se guarde en la Cookie los números y las operaciones
elegidas y muestre el resultado de la operación indicando cuáles han sido los números, las
operaciones elegidas y el resultado en la ejecución actual (formulario) y los números y las
elegidas en la operación anterior a la actual (cookie).
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

        // Guardamos los números, las operaciones seleccionadas y los resultados en una cookie
        $texto = implode(",", [$num1, $num2, implode(",", $op), implode(",", $resultados)]);
        setcookie('datos', $texto, time() + 3600);  // Guardamos en la cookie

        // Ahora mostramos los resultados de las operaciones actuales
        echo "VALORES ACTUALES: <br>";
        foreach ($resultados as $res) {
            echo $res . "<br>";
        }

        // Mostramos los resultados anteriores si la cookie está presente
        if (isset($_COOKIE['datos'])) {
            $cookie = $_COOKIE['datos'];  // Obtenemos el valor de la cookie
            $cookie = explode(",", $cookie);  // Dividimos la cookie en partes

            $n1 = $cookie[0];
            $n2 = $cookie[1];
            $operar = $cookie[2];  // Las operaciones seleccionadas en una cadena separada por comas
            $res = explode(",", $cookie[3]);  // Los resultados separados por ","

            // Mostramos los valores anteriores correctamente
            echo "<br>VALORES ANTERIORES: <br>";
            echo "Números: " . $n1 . " y " . $n2 . "<br>";
            echo "Operaciones: " . $operar . "<br>";

            // Recorrer todos los resultados anteriores (si hay más de uno)
            echo "Resultados: <br>";
            foreach ($res as $resultado) {
                echo $resultado . "<br>";
            }
        } else {
            echo "No hay valores anteriores.";
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
