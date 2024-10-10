<?php
/**
 * @author Adrián López Pascual
 */

$semana = ["Lunes", "Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"];

$num = readline("Dime un número del 1 al 7: ");
while ($num > 7 || $num < 1) {
    echo "Del 1 al 7 porfavor \n";
    $num = readline("Dime un número del 1 al 7: ");
}

echo $semana[$num-1] . "\n";
?>