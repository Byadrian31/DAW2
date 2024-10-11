<?php

/**
 * @author Adrián López Pascual
 */

/*
Crea la tabla de multiplicar a partir de un número
*/


$num = readline("Dime un número: ");
echo "Tabla de multiplicar del número " . $num . "\n";
// For para crear la tabla de multiplicar
for ($i=0; $i < 11 ; $i++) { 
    echo $num . "x" . $i . " = " . ($num*$i) . "\n";
}
?>