<?php

/**
 * @author Adrián López Pascual
 */

/*
Crea una función llamada permutaciones que reciba un vector $V y que cambie la posición de
los elementos dicho vector haciendo permutaciones. Las permutaciones se harán entre los
elementos $V[$N-1] y $V[0], $V[$N-2] y $V[1] , $V[$N-3] y $V[2] etc. siendo $N el tamaño
del vector.
*/


$cant = readline("Dime la cantidad del array siempre par ");
$V = [];
//For para recorrer el array
for ($i = 0; $i < $cant; $i++) {
    $ale = rand(1, 20);
    $V[$i] = $ale;
}

echo "LISTA ORIGINAL: \n";
foreach ($V as $value) {
    echo $value . " --- ";
}
echo "\n";

// Función para cambiar el array
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