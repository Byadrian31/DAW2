<?php

/**
 * @author Adrián López Pascual
 */
$num1 = readline("Dime el primer número ");
$num2 = readline("Dime el segundo número ");
function potencia($num1,$num2){
    $sumT = 0;
    $potencias = [];
    for ($i=0; $i <= $num2 ; $i++) { 
        $resultado = pow($num1,$i);
        $potencias[$i] = $resultado;
        $sumT += $resultado;
        printf("Base %d exponente %d = %d \n",$num1,$i,$resultado);
    }
    echo "Suma total de potencias = " . $sumT . "\n";
};

potencia($num1,$num2);
?>