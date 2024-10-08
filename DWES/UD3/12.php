<?php

/**
 * @author Adrián López Pascual
 */
$cant = readline("¿Cuántos alumnos hay? ");
$total = 0;
$alumnos = [];
for ($i=0; $i < $cant ; $i++) { 
    $ale = rand(0,10);
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