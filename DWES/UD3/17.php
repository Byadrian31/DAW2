<?php

/**
 * @author Adrián López Pascual
 */

/*
Realiza un programa que diga si un número introducido por teclado es par y/o divisible entre 3
*/

$num = readline("Dime el valor de a: ");

// Condiciones para saber si es par o divisible entre 3
if ($num % 2 == 0 && $num % 3 == 0) {
    printf("El número %d es par y divisible entre 3\n", $num);
}elseif ($num % 3 == 0){
    printf("El número %d es divisible entre 3\n", $num);
}elseif ($num % 2 == 0){
    printf("El número %d es par \n", $num);
}  else {
    printf("El número %d no es par y no es divisible entre 3\n", $num); 
}
?>