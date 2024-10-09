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


function salarioAumentado($salario,$porcentaje) {
        $salario = $salario + ($salario * $porcentaje / 100);
    return $salario;
}


$trabajadores = [];
$cant = readline("¿Cuántos trabajadores hay? ");
for ($i=0; $i < $cant; $i++) { 
    $trabajador = readline("¿Cuál es el nombre del trabajador? ");
    $salario = readline("¿Cuanto es el sueldo del trabajador? ");
    $trabajadores[$trabajador] = $salario;
}

$porcentaje = readline("¿Cuanto es el porcentaje de aumento? ");

echo "La lista de trabajadores:\n";
echo "--------------------------\n";
foreach ($trabajadores as $trabajador => $salario) {
    $salarioAumentado = salarioAumentado($salario,$porcentaje);
    printf("%s: salario actual (%.2f) y salario aumentado (%.2f)\n", $trabajador, $salario,$salarioAumentado);
}
echo "--------------------------\n";


?>