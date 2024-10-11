<?php
/**
 * @author: Adrián López Pascual
 */

/*
Con los trabajadores del ejercicio anterior, calcular el salario actual y el salario aumentado un
porcentaje indicado por la variable
*/

// Función para sacar el salario aumentado de cada trabajador
 function salarioAumentado($salario,$porcentaje) {
        $salario = $salario + ($salario * $porcentaje / 100);
    return $salario;
}


$trabajadores = [];
$cant = readline("¿Cuántos trabajadores hay? ");
for ($i=0; $i < $cant; $i++) { 
    $trabajador = readline("¿Cuál es el nombre del trabajador? ");
    $salario = readline("¿Cuánto es el sueldo del trabajador? ");
    $trabajadores[$trabajador] = $salario;
}

$porcentaje = readline("¿Cuánto es el porcentaje de aumento? ");

echo "La lista de trabajadores:\n";
echo "--------------------------\n";

// Imprimo la lista de trabajadores con su salario actual y su salario aumentado
foreach ($trabajadores as $trabajador => $salario) {
    $salarioAumentado = salarioAumentado($salario,$porcentaje);
    printf("%s: salario actual (%.2f) y salario aumentado (%.2f)\n", $trabajador, $salario,$salarioAumentado);
}
echo "--------------------------\n";


?>