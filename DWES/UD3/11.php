<?php

/**
 * @author Adrián López Pascual
 */

/*
Diseña un programa para imprimir los números impares menores que N.
*/


$num = readline("Dime un número: ");
echo "Lista de impares menores que " . $num . "\n";
// For para tratar los impares menores
for ($i=0; $i < $num ; $i++) { 
    if ($i % 2 != 0) {
        echo $i . "\n";
    }
}
?>