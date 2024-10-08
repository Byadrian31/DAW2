<?php

/**
 * @author Adrián López Pascual
 */

$numeros = readline("Dime la cadena de números ");
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