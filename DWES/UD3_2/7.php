<?php
/**
 * @author Adrián López Pascual
 */

 /*
Define tres arrays de 20 números enteros cada uno, con nombres “numero”, “cuadrado” y
“cubo”. Carga el array “numero” con valores aleatorios entre 0 y 100. En el array “cuadrado” se
deben almacenar los cuadrados de los valores que hay en el array “numero”. En el array “cubo”
se deben almacenar los cubos de los valores que hay en “numero”. A continuación, muestra el
contenido de los tres arrays dispuesto en tres columnas
  */


 $numero = array();
 $cuadrado = array();
 $cubo = array();
 
 // Lleno el array $numero con valores aleatorios
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