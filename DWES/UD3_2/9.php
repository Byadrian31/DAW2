<?php

/**
 * @author Adrián López Pascual
 */

/* 
Crear una matriz de tamaño 5x5 y rellenarla de la siguiente forma: la posición M[n,m] debe
contener n+m. Después se debe mostrar su contenido.
*/


$array = [];
// Con este bucle lleno el array con la suma de las posiciones $m y $n
for ($n = 0; $n < 5; $n++) {
    for ($m = 0; $m < 5; $m++) {
        $array[$n][$m] = $n + $m;
    }
}

// Con este for muestro el resultado del 5x5 con tabla
echo "_____________________\n";
for ($n = 0; $n < 5; $n++) {
    echo "| ";
    for ($m = 0; $m < 5; $m++) {
        echo $array[$n][$m] . " | ";
    }
    echo "\n";
        echo "_____________________";

    echo "\n";
}
echo "\n";
?>