<?php

/**
 * @author Adrián López Pascual
 */
$cant = readline("Dime la cantidad del array siempre par ");
$V = [];

for ($i = 0; $i < $cant; $i++) {
    $ale = rand(1, 20);
    $V[$i] = $ale;
}

echo "LISTA ORIGINAL: \n";
foreach ($V as $value) {
    echo $value . " --- ";
}
echo "\n";

function permutaciones($V)
{
    $N = count($V);
    $cont = 1;
    for ($i = 0; $i < count($V)/2 ; $i++) {
        $cambio = $V[$i];
        $V[$i] = $V[$N - $cont];
        $V[$N - $cont] = $cambio;
        $cont++;
    }
    echo "LISTA CAMBIADA: \n";
    foreach ($V as $value) {
        echo $value . " --- ";
    }
    echo "\n";
};

permutaciones($V);
?>