<?php
/**
 * @author Adrián López Pascual
 */

/*
Elabora un programa que lea un número entero y escriba el número resultante de invertir el
orden de sus cifras Puedes usar la función creada para el ejercicio 19
*/

$num = readline("Dime el número: ");
// Uso la función strrev() para invertir el orden de las cifras
function cifras($num){
$invertido = strrev($num);
echo $invertido . "\n";
}

cifras($num);
?>