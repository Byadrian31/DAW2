<?php

/**
 * @author Adrián López Pascual
 */

/*
11. Ejercicio 24 Con los trabajadores del ejercicio anterior, calcular el salario actual y el salario 
aumentado un porcentaje indicado por el usuario
*/

// Función para sacar el salario aumentado de cada trabajador
function salarioAumentado($salario, $porcentaje)
{
    $salario = $salario + ($salario * $porcentaje / 100);
    return $salario;
}

if (isset($_POST['enviar'])) {
    $porcentaje = $_POST["por"];
    // Creo el array con trabajadores y sus respectivos salarios
    $trabajadores = [
        "Alejandro" => 2000,
        "Peter" => 1400,
        "Silvia" => 1200,
        "Adriana" => 1000
    ];

    if (is_numeric($porcentaje)) {
        // Bucle para mostrar la lista de trabajadores
        echo "La lista de trabajadores: <br>";
        echo "-------------------------- <br>";
        foreach ($trabajadores as $trabajador => $salario) {
            $salarioAumentado = salarioAumentado($salario, $porcentaje);
            printf("%s: salario actual (%.2f) y salario aumentado (%.2f) <br>", $trabajador, $salario, $salarioAumentado);
        }
        echo "-------------------------- <br>";

    } else {
        echo "Hay que poner valores numéricos";
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
            <legend>Salarios trabajadores con aumento</legend>
            <label for="aumento">Porcentaje:</label>
            <input type="text" name="por">
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>