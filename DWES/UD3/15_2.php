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
    $reves = array_reverse($V);
    
    echo "LISTA CAMBIADA: \n";
    foreach ($reves as $value) {
        echo $value . " --- ";
    }
    echo "\n";

}
permutaciones($V);
?>