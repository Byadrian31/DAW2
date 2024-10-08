<?php

/**
 * @author Adrián López Pascual
 */

$num = readline("Dime un número: ");
echo "Lista de impares menores que " . $num . "\n";
for ($i=0; $i < $num ; $i++) { 
    if ($i % 2 != 0) {
        echo $i . "\n";
    }
}
?>