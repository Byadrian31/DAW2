<?php
/**
 * @author Adrián López Pascual
 */

/*
Leer por teclado y rellenar dos vectores de 10 números enteros y mezclarlos en un tercer vector
de la forma: el 1o de A, el 1o de B, el 2o de A, el 2o de B, etc.
*/

$array1 = [];
$array2 = [];
$array3 = [];
// Bucle para llenar los dos bucles por teclado
for ($i=0; $i < 10; $i++) { 
    $num1 = readline("Dime un número para el primer vector ");
    $num2 = readline("Dime un número para el segundo vector ");
    $array1[$i] = $num1;
    $array2[$i] = $num2;
}

// Con este bucle se llena el tercer vector con los valores de los otros dos
for ($i=0; $i < 10; $i++) { 
    $array3[] = "El " . $i+1 . "º de A = " .$array1[$i];
    $array3[] = "El " . $i+1 . "º de B = " .$array2[$i];
}

echo "Vector 3\n";
// Muestro los valores de $array3
foreach ($array3 as $value) {
    echo $value . ", \n";
}

echo "\n";

?>