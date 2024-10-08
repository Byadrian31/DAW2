<?php

/**
 * @author Adrián López Pascual
 */
$a = readline("Dime el valor de a: ");
$b = readline("Dime el valor de b: ");

if ($a == 0 || $b == 0) {
    echo "No hay solución \n";
} else {
    $x = $b / $a;
    printf("El valor de x es %.2f \n", $x);
}
?>