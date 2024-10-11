<?php

/**
 * @author Adrián López Pascual
 */

/*
Escribe un programa que lea una lista de diez números y determine cuántos son positivos, y
cuántos son negativos (muestra los números, la cantidad de positivos y negativos y el porcentaje
de cada grupo)
*/

$positivos = 0;
$negativos = 0;
$numeros = [];


for ($i = 0; $i < 10; $i++) {
    $num = readline("Dime el número " . $i+1 . ": ");
    $numeros[$i] = $num;
    if ($num < 0) {
        $negativos++;
    } else if($num > 0) {
        $positivos++;
    }
}

echo "Lista de números: \n";
echo "-------------- \n";
// For para mostrar los números
foreach ($numeros as $value) {
    echo $value . "\n";
}
echo "-------------- \n";

// Porcentaje de los numeros positivos y negativos
$posP = $positivos / 10 * 100;
$negP = $negativos / 10 * 100;


printf("Hay %d números positivos de 10, con un porcentaje de %d \n", $positivos, $posP);
printf("Hay %d números negativos de 10, con un porcentaje de %d \n", $negativos, $negP);
?>