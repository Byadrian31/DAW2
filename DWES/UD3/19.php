<?php
/**
 * @author Adrián López Pascual
 */

/*
Realiza un programa que nos diga cuántos dígitos tiene un número dado
*/

// Uso la función strlen() para contar el número de dígitos
$num = readline("Dime el número: ");
$longitud = strlen($num);
echo $longitud . "\n";
?>