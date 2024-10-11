<?php

/**
 * @author Adrián López Pascual
 */

/*
Crea un programa para leer las notas de los alumnos de una clase, y que informe del número de
alumnos cuya nota sea mayor de la media de la clase.
*/


$cant = readline("¿Cuántos alumnos hay? ");
$total = 0;
$alumnos = [];

//For para almacenar el total y $alumnos con las notas e los alumnos
for ($i=0; $i < $cant ; $i++) { 
    $ale = rand(0,10);
    $alumnos[$i] = $ale;
    $total += $ale;
}

//Sacar media de nostas
$media = $total / $cant;
$almedia = 0;
foreach ($alumnos as $value) {
    if ($value > $media) {
        $almedia ++;
    }
}

printf("El número de alumnos que han superado la media(%d) son %d \n", $media, $almedia);
?>