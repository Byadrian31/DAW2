<?php

/**
 * @author Adrián López Pascual
 */

/*
Escribe una función que calcule A elevado a B, siendo A y B números enteros. 
*/

$num1 = floor(readline("Dime el primer número "));
$num2 = floor(readline("Dime el segundo número "));

//Uso la función pow() para calcular A elevado a B
function potencia($num1,$num2){
    $resultado = pow($num1,$num2);
    return printf("El resultado de la potencia con base %d y exponente %d es %d\n",$num1,$num2,$resultado);
};

echo potencia($num1,$num2);
?>