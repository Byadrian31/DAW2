<?php

/**
 * @author Adrián López Pascual
 */

/*
1. Ejercicio 4 añadiendo selector de operación a aplicar (pueden seleccionarse mínimo una o 
todas las operaciones): Dados dos números enteros realizar operaciones de suma, resta, división y 
multiplicación y mostrar los resultados por pantalla concatenando la operación (expresión con 
operandos y operador) y el resultado. Comprueba que los datos introducidos son los esperados.
*/

// Función para realizar la operación según lo que indique el usuario
function operar($num1, $num2, $op)
{
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
        // Recorrer el array usando la función para mostrar lo indicado
        foreach ($op as $value) {
            echo "<p>" . operar($num1, $num2, $value) . "</p>";
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