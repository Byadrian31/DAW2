<?php

/**
 * @author Adrián López Pascual
 */

 /*
Crear y rellenar por teclado dos matrices de tamaño 3x3, sumarlas y mostrar su suma.
 */

$array1 = [];
$array2 = [];
$array3 = [];

// Rellenar primer vector
for ($n = 0; $n < 3; $n++) {
    for ($m = 0; $m < 3; $m++) {
        $num1 = readline("Dime un número para el primer matriz(posición[" . $n . "][". $m . "]): ");
        $array1[$n][$m] = $num1;
    }
}

// Rellenar segundo vector
for ($n = 0; $n < 3; $n++) {
    for ($m = 0; $m < 3; $m++) {
        $num2 = readline("Dime un número para el segundo matriz(posición[" . $n . "][". $m . "]): ");
        $array2[$n][$m] = $num2;
    }
}

// Vector para la suma de los otros dos vectores
for ($n = 0; $n < 3; $n++) {
    for ($m = 0; $m < 3; $m++) {
        $array3[$n][$m] = "(".$array1[$n][$m] . " + " . $array2[$n][$m] . " = " . $array1[$n][$m]+$array2[$n][$m].")";
        echo $array3[$n][$m] . " ";
    }
    echo "\n";
}
?>