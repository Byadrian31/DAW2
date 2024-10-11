<?php

/**
 * @author Adrián López Pascual
 */


/*
Elabora un programa para determinar si una hora leída en la forma horas, minutos y segundos
está correctamente expresada.
*/

//Uso un boolean para manejar el bucle
$encontrado = false;

while (!$encontrado) {
    $tiempo = readline("Dime las horas, minutos, segundos: (h:m:s) ");
    //Separo el string introducido por : con la función explode
    $time = explode(":", $tiempo);
    if (count($time) < 3) {
        $tiempo = readline("Dime las horas, minutos, segundos: (h:m:s) ");

    } else {
        //Condiciones correspondientes para comprobar si la hora es correcta
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