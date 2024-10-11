<?php

/**
 * @author Adrián López Pascual
 */

/*
Genera un número entre 1 y 15 y calcula su factorial. Nota: El factorial de un número es la
multiplicación de él mismo con sus anteriores. Ejemplo 3!=3*2*1=6
*/


$num = rand(1,15);
$total = 1;
//For para sacar el factorial
for ($i=$num; $i > 0 ; $i--) { 
    $total *= $i;
}
printf("El factorial de %1d es: %1d \n", $num, $total);
?>