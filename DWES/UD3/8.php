<?php

/**
 * @author Adrián López Pascual
 */

$num = readline("Dime un número: ");
echo "Tabla de multiplicar del número " . $num . "\n";
for ($i=0; $i < 11 ; $i++) { 
    echo $num . "x" . $i . " = " . ($num*$i) . "\n";
}
?>