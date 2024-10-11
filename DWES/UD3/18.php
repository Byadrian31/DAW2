<?php

/**
 * @author Adrián López Pascual
 */

 /*
Escribe un programa que diga cuál es la cifra que está en el centro (o las dos del centro si el
número de cifras es par) de un número entero introducido por teclado
 */


$num = readline("Dime el número: ");

// Uso substr() para extraer las cifras del centro, al ser par saco 2 y al ser impar saco 1

if ($num % 2 == 0) {
    print "Las cifras del centro son: " . substr($num,(strlen($num)/2)-1,2) . "\n";
} else {
    print "Las cifras del centro son: " . substr($num,(strlen($num)/2),1) . "\n";
}

?>