<?php

/**
 * @author Adrián López Pascual
 */

$array = [];
$total = 0;
$cant = readline("¿Cuántos números quieres introducir? (mínimo 5) ");
while ($cant < 5 ) {
    echo "Tienes que poner mínimo 5 \n";
    $cant = readline("¿Cuántos números quieres introducir? (mínimo 5) ");
}

    for ($i = 0; $i < $cant; $i++) {
        $num = readline("Dime el número: ");
        $array[$i] = $num;
        $total += $num;
    }
    $total = $total / $cant;
    $totalRe = round($total);
    echo "Números introducidos: ";
    foreach ($array as $value) {
        echo $value;
        echo "  ";
    }
    echo "\n";
    echo "Total sin redondear: " .  $total;
    echo "\n";
    echo "Total con redondeo: " .  $totalRe;
    echo "\n";

