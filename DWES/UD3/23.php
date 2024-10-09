<?php
/**
 * @author: Adrián López Pascual
 */
function salarioMax($trabajadores) {
    $max = 0;
    foreach ($trabajadores as $salario) {
        if ($salario > $max) {
            $max = $salario;
        }
    }
    return $max;
}

function salarioMin($trabajadores) {
    $min = salarioMax($trabajadores);
    foreach ($trabajadores as $salario) {
        if ($salario < $min) {
            $min = $salario;
        }
    }
    return $min;
}

function salarioMedio($trabajadores) {
    $media = 0;
    foreach ($trabajadores as $salario) {
        $media += $salario;
    }
    $media = $media / count($trabajadores);
    return $media;
}

$trabajadores = [];
$cant = readline("¿Cuántos trabajadores hay? ");
for ($i=0; $i < $cant; $i++) { 
    $trabajador = readline("¿Cuál es el nombre del trabajador? ");
    $salario = readline("¿Cuanto es el sueldo del trabajador? ");
    $trabajadores[$trabajador] = $salario;
}

echo "La lista de trabajadores:\n";
echo "--------------------------\n";
foreach ($trabajadores as $trabajador => $salario) {
    echo "$trabajador: $salario\n";
}
echo "--------------------------\n";
printf("El salario máximo es %.2f\n", salarioMax($trabajadores));
printf("El salario mínimo es %.2f\n", salarioMin($trabajadores));
printf("El salario medio es %.2f\n", salarioMedio($trabajadores));

?>