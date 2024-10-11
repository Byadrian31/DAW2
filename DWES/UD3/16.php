<?php

/**
 * @author Adrián López Pascual
 */

/*
Realiza un programa que resuelva una ecuación de primer grado (del tipo 2(ax - b)=0
*/

$a = readline("Dime el valor de a: ");
$b = readline("Dime el valor de b: ");

//x = b / a
if ($a == 0 || $b == 0) {
    echo "No hay solución \n";
} else {
    $x = $b / $a;
    printf("El valor de x es %.2f \n", $x);
}
?>