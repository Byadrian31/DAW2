<?php
/**
 * @author Adrián López Pascual
 */

// Función para sacar el salario máximo
function salarioMax($trabajadores) {
    if (empty($trabajadores)) return 0; // Manejo de array vacío
    return max($trabajadores);
}

// Función para sacar el salario mínimo
function salarioMin($trabajadores) {
    if (empty($trabajadores)) return 0; // Manejo de array vacío
    return min($trabajadores);
}

// Función para calcular el salario medio
function salarioMedio($trabajadores) {
    if (empty($trabajadores)) return 0; // Evita división por 0
    return array_sum($trabajadores) / count($trabajadores);
}

// Función para elegir la operación a realizar
function elegir($op, $trabajadores) {
    switch ($op) {
        case 'max':
            return sprintf("El salario máximo es %.2f <br>", salarioMax($trabajadores));
        
        case 'min':
            return sprintf("El salario mínimo es %.2f <br>", salarioMin($trabajadores));
        
        case 'med':
            return sprintf("El salario medio es %.2f <br>", salarioMedio($trabajadores));

        default:
            return "Opción no válida.";
    }
}
?>
