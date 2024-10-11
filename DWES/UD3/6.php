<?php

/**
 * @author Adrián López Pascual
 */

/*
Escribe un programa que lea tres números positivos y compruebe si son iguales. Por ejemplo:
* Si la entrada fuese 5 5 5, la salida debería ser “hay tres números iguales a 5“.
* Si la entrada fuese 4 6 4, la salida debería ser “hay dos números iguales a 4“.
* Si la entrada fuese 0 1 2, la salida debería ser “no hay números iguales“
*/


$numeros = readline("Dime la cadena de números ");
// Separo $numeros por " ", para comparar cuántos números de la cadena coinciden
$numSep = explode(" ", $numeros);
if ($numSep[0] == $numSep[1] && $numSep[0] == $numSep[2] ) {
    echo "Los tres números son iguales: " . $numSep[0] . "\n";
}elseif ($numSep[1] == $numSep[2] || $numSep[0] == $numSep[1]) {
    echo "Dos números coinciden: " . $numSep[1] . "\n";
}elseif ($numSep[1] == $numSep[2] || $numSep[0] == $numSep[2]) {
    echo "Dos números coinciden: " . $numSep[2] . "\n";
}elseif ($numSep[0] == $numSep[2] || $numSep[0] == $numSep[1]) {
    echo "Dos números coinciden: " . $numSep[0] . "\n";
}else {
    echo "Ningún número coincide \n";
}
?>