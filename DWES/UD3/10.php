<?php

/**
 * @author Adrián López Pascual
 */

/*
Genera un número entre 1 y 20 y calcula su sumatorio. Nota: El sumatorio de un número es la
suma de él mismo con sus anteriores. Ejemplo ∑3=3+2+1=6
*/

$num = rand(1,20);
$total = 0;
// For para sacar el sumatorio
for ($i=$num; $i > 0 ; $i--) { 
    $total += $i;
}
printf("El sumatorio de %1d es: %1d \n", $num, $total);
?>