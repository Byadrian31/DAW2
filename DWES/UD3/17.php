<?php

/**
 * @author Adrián López Pascual
 */
$num = readline("Dime el valor de a: ");


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