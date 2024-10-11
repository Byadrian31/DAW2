<?php

/**
 * @author Adrián López Pascual
 */

/*
Escribe una función que calcule todas las potencias de un número hasta llegar al exponente
indicado, las almacene en un vector y muestre el resultado de cada potencia indicando además
la suma de todas las potencias incluyendo la del exponente indicado.
*/

$num1 = readline("Dime el primer número ");
$num2 = readline("Dime el segundo número ");

//Uso la función del ejercicio anterior pero además se almacena en $potencias y calculo la suma total en $sumT
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