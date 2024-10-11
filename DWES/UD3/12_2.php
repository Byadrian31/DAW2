<?php

/**
 * @author Adrián López Pascual
 */

/*
Crea un programa para leer las notas de los alumnos de una clase, y que informe del número de
alumnos cuya nota sea mayor de la media de la clase.
*/

//Mismo ejercicio que el 12 pero pidiendo las notas en vez de rand()
$cant = readline("¿Cuántos alumnos hay? ");
$total = 0;
$alumnos = [];

for ($i=0; $i < $cant ; $i++) { 
    $ale = readline("Dime la nota del alumno " . $i+1 . ": ");
    $alumnos[$i] = $ale;
    $total += $ale;
}

$media = $total / $cant;
$almedia = 0;
foreach ($alumnos as $value) {
    if ($value > $media) {
        $almedia ++;
    }
}

printf("El número de alumnos que han superado la media(%d) son %d \n", $media, $almedia);
?>