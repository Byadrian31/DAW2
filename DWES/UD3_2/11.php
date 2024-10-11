<?php

/**
 * @author Adrián López Pascual
 */

 /*
 Crear y rellenar una tabla de tamaño 10x10, mostrar la suma de cada fila y de cada columna
 */

$tabla = [];

//Rellenar la matriz 10x10
for ($n = 0; $n < 10; $n++) {
    for ($m = 0; $m < 10; $m++) {
        $tabla[$n][$m] = rand(0,10);
    }
}

//Guardar en una variable la suma de las filas
$filas = [];
for ($n = 0; $n < 10; $n++) {
    $fila = 0;
    for ($m = 0; $m < 10; $m++) {
        $fila += $tabla[$n][$m];
    }
    $filas[$n] = $fila;
}

//Guardar en una variable la suma de las columnas
$columnas = [];
for ($m = 0; $m < 10; $m++) {
    $columna = 0;
    for ($n = 0; $n < 10; $n++) {
        $columna += $tabla[$n][$m];
    }
    $columnas[$m] = $columna;
}

// Mostrar la tabla
echo "Tabla:\n";
foreach ($tabla as $fila) {
    foreach ($fila as $valor) {
        echo $valor . " ";
    }
    echo "\n";
}

// Mostrar las sumas de las filas
echo "\nSuma de las filas:\n";
foreach ($filas as $suma) {
    echo $suma . " ";
}
echo "\n";

// Mostrar las sumas de las columnas
echo "\nSuma de las columnas:\n";
foreach ($columnas as $suma) {
    echo $suma . " ";
}
echo "\n";

?>