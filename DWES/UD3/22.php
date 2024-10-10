<?php

/**
 * @author Adrián López Pascual
 */

$positivos = 0;
$negativos = 0;
$numeros = [];

for ($i = 0; $i < 10; $i++) {
    $num = readline("Dime el número " . $i+1 . ": ");
    $numeros[$i] = $num;
    if ($num < 0) {
        $negativos++;
    } else if($num > 0) {
        $positivos++;
    }
}

echo "Lista de números: \n";
echo "-------------- \n";
foreach ($numeros as $value) {
    echo $value . "\n";
}
echo "-------------- \n";
$posP = $positivos / 10 * 100;
$negP = $negativos / 10 * 100;


printf("Hay %d números positivos de 10, con un porcentaje de %d \n", $positivos, $posP);
printf("Hay %d números negativos de 10, con un porcentaje de %d \n", $negativos, $negP);
?>