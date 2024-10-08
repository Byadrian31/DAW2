<?php

/**
 * @author Adrián López Pascual
 */
$num1 = readline("Dime el primer número ");
$num2 = readline("Dime el segundo número ");
function potencia($num1,$num2){
    $resultado = pow($num1,$num2);
    return printf("El resultado de la potencia con base %d y exponente %d es %d\n",$num1,$num2,$resultado);
};

echo potencia($num1,$num2);
?>