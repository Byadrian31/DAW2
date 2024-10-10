<?php
/**
 * @author Adrián López Pascual
 */

// Inicializar los arrays
 $numero = array();
 $cuadrado = array();
 $cubo = array();
 
 // Cargar el array "numero" con valores aleatorios
 for ($i = 0; $i < 20; $i++) {
     $numero[$i] = rand(0, 100);
     $cuadrado[$i] = $numero[$i] ** 2; // Cuadrado
     $cubo[$i] = $numero[$i] ** 3; // Cubo
 }
 
// Mostrar el encabezado
printf("%-10s %-10s %-10s\n", "Número", "Cuadrado", "Cubo");

// Mostrar el contenido de los tres arrays en tres columnas
for ($i = 0; $i < 20; $i++) {
    printf("%-10d %-10d %-10d\n", $numero[$i], $cuadrado[$i], $cubo[$i]);
}
?>

 
?>