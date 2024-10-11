<?php
/**
 * @author Adrián López Pascual
 */

/*
Escribe un programa en que dado un número del 1 a 7 escriba el correspondiente nombre del
día de la semana.
*/
$semana = ["Lunes", "Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"];

//Bucle para que el usuario solo indique número entre el 1 y el 7
$num = readline("Dime un número del 1 al 7: ");
while ($num > 7 || $num < 1) {
    echo "Del 1 al 7 porfavor \n";
    $num = readline("Dime un número del 1 al 7: ");
}

echo $semana[$num-1] . "\n";
?>