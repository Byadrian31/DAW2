<?php

/**
 * @author Adrián López Pascual
 */
$array = [];
for ($i = 0; $i < 3; $i++) {
    $num = readline("Dime el número: ");
    $array[$i] = $num;
}


for ($j = 0; $j < count($array) - 1; $j++) {
    for ($i = 0; $i < count($array) - 1 - $j; $i++) {
        if ($array[$i] < $array[$i + 1]) {
            // Intercambiar
            $temp = $array[$i];
            $array[$i] = $array[$i + 1];
            $array[$i + 1] = $temp;
        }
    }
}
echo "Números ordenados de mayor a menor : ";

foreach ($array as $value) {
    echo $value;
    echo "  ";
    # code...
}

echo "\n";
