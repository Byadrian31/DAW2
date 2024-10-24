<?php

/**
 * @author Adrián López Pascual
 */

/*
7. Ejercicio 5 Diseña un programa que determine la cantidad total a pagar por 5 llamadas 
telefónicas de duración a introducir por el usuario de acuerdo a las siguientes premisas: Toda 
llamada que dure menos de 3 minutos tiene un coste de 10 céntimos. Cada minuto adicional a 
partir de los 3 primeros es un paso de contador y cuesta 5 céntimos.
*/
function coste($min)
{
    if ($min < 3) {
        $coste = 0.1;
        printf("La llamada ha costado %.2f € <br>", $coste);
    } else {
        // Una vez pase los 3 minutos se cobra 10cent + 0.05 por minuto
        $total = 0.1;
        for ($i = 3; $i < $min; $i++) {
            $total += 0.05;
        }
        printf("La llamada ha costado %.2f € <br>", $total);
    }
}

// Función para sacar el total de cada llamada
function total($min)
{
    if ($min < 4) {
        $total = 0.1;
    } else {
        // Una vez pase los 3 minutos se cobra 10cent + 0.05 por minuto
        $total = 0.1;
        for ($i = 3; $i < $min; $i++) {
            $total += 0.05;
        }
    }
    return $total;
}

// Función para obtener el total de todas las llamadas
function totalL($ll1,$ll2,$ll3,$ll4,$ll5){
    $totalG = 0;
    $totalG += total($ll1);
    $totalG += total($ll2);
    $totalG += total($ll3);
    $totalG += total($ll4);
    $totalG += total($ll5);
    return $totalG;
}

// Condición para comprobar si se ha pulsado sobre Enviar
if (isset($_POST['enviar'])) {
    $ll1 = $_POST['ll1'];
    $ll2 = $_POST['ll2'];
    $ll3 = $_POST['ll3'];
    $ll4 = $_POST['ll4'];
    $ll5 = $_POST['ll5'];

        // Comprobación de si son todos los valores númericos
    if (
        is_numeric($ll1) && is_numeric($ll2) && is_numeric($ll3) &&
        is_numeric($ll4) && is_numeric($ll5)
    ) {
        // Mostrar cada valor
        echo "Llamada 1: ";
        coste($ll1);
        echo "Llamada 2: ";
        coste($ll2);
        echo "Llamada 3: ";
        coste($ll3);
        echo "Llamada 4: ";
        coste($ll4);
        echo "Llamada 5: ";
        coste($ll5);
        echo "El coste total de las 5 llamadas es: " . totalL($ll1,$ll2,$ll3,$ll4,$ll5) . "€";
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
            <legend>Coste 5 llamadas</legend>
            <label for="carácter">Llamada 1:</label>
            <input type="text" name="ll1"><br>
            <label for="carácter">Llamada 2:</label>
            <input type="text" name="ll2"><br>
            <label for="carácter">Llamada 3:</label>
            <input type="text" name="ll3"><br>
            <label for="carácter">Llamada 4:</label>
            <input type="text" name="ll4"><br>
            <label for="carácter">Llamada 5:</label>
            <input type="text" name="ll5"><br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>
