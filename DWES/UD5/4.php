<?php

/**
 * @author Adrián López Pascual
 */

/*
4. Ejercicio 4. Escribe un programa que calcule el salario semanal de un trabajador teniendo en 
cuenta que las horas ordinarias (40 primeras horas de trabajo) se pagan a 12 euros la hora. A 
partir de la hora 41, se pagan a 16 euros la hora.
*/

// Condición que espera al botón Enviar
if (isset($_POST['enviar'])) {
    $nombre = $_POST['nombre'];
    $horas = $_POST['horas'];
    if (is_numeric($horas)) {
        // Cálculo de horas extra
        if ($horas > 40) {
            $resto = $horas - 40;
            $total = ($resto * 16) + (40 * 12);
            printf("%s tiene un salario semanal de %.2f trabajando %.2f horas  \n", $nombre , $total, $horas);
            // Cálculo de horas
        } else {
            $total = $horas * 12;
            printf("%s tiene un salario semanal de %.2f trabajando %.2f horas \n", $nombre , $total, $horas);
        }
        
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
            <legend>Salario</legend>
            <label for="nombre">Trabajador:</label>
            <input type="text" name="nombre"><br>
            <label for="horas">Horas semanales:</label>
            <input type="text" name="horas"><br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>