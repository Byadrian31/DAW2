<?php

/**
 * @author Adrián López Pascual
 */

$encontrado = false;
while (!$encontrado) {
    $tiempo = readline("Dime la horas, minutos, segundos: (h:m:s) ");
    $time = explode(":", $tiempo);
    if (count($time) < 3) {
        $tiempo = readline("Dime la horas, minutos, segundos: (h:m:s) ");

    } else {

        if ($time[0] < 24 && $time[0] >= 0) {
            if ($time[1] < 61 && $time[1] >= 0) {
                if ($time[2] < 61 && $time[2] >= 0) {
                    echo "El tiempo introducido es correcto \n";
                    $encontrado = true;
                } else {
                    echo "Tiempo incorrecto \n";
                }
            } else {
                echo "Tiempo incorrecto \n";
            }
        } else {
            echo "Tiempo incorrecta \n";
        }
    }
}
?>