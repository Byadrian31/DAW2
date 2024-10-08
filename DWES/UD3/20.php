<?php
/**
 * @author Adrián López Pascual
 */
$num = readline("Dime el número: ");
function cifras($num){
$invertido = strrev($num);
echo $invertido . "\n";
}

cifras($num);
?>