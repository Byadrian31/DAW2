<?php
/**
 * @author: Adrián López Pascual
 */

 /*
 Dado un vector asociativo de trabajadores con su salario creado solicitando al usuario el nombre
y salario de cada trabajador, crea usando funciones el salario máximo, el salario mínimo y el
salario medio.
 */

 // Función para sacar el salario máximo
function salarioMax($trabajadores) {
    $max = 0;
    foreach ($trabajadores as $salario) {
        if ($salario > $max) {
            $max = $salario;
        }
    }
    return $max;
}

// Función para sacar el salario mínimo
function salarioMin($trabajadores) {
    $min = salarioMax($trabajadores);
    foreach ($trabajadores as $salario) {
        if ($salario < $min) {
            $min = $salario;
        }
    }
    return $min;
}

// Función para sacar el salario medio
function salarioMedio($trabajadores) {
    $media = 0;
    foreach ($trabajadores as $salario) {
        $media += $salario;
    }
    $media = $media / count($trabajadores);
    return $media;
}

// Relleno el array con trabajadores y sus respectivos salarios
$trabajadores = [];
$cant = readline("¿Cuántos trabajadores hay? ");
for ($i=0; $i < $cant; $i++) { 
    $trabajador = readline("¿Cuál es el nombre del trabajador? ");
    $salario = readline("¿Cuánto es el sueldo del trabajador? ");
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