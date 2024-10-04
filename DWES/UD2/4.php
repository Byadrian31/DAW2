<?php
/**
 * @author Adrián López Pascual
 */
$num1 = readline("Dime el primer número ");
$num2 = readline("Dime el segundo número ");
$suma = $num1 . " + " . $num2 . " = " . $num1+$num2;
$resta = $num1 . " - " . $num2 . " = " . $num1-$num2;
$mult = $num1 . " * " . $num2 . " = " . $num1*$num2;
$div = $num1 . " / " . $num2 . " = " . $num1/$num2; 
echo $suma;
echo "\n";
echo $resta;
echo "\n";
echo $mult;
echo "\n";
echo $div;
echo "\n";
?>