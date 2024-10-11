<?php

/**
 * @author Adrián López Pascual
 */

/*
Diseña un programa que determine la cantidad total a pagar por una llamada telefónica de
acuerdo a las siguientes premisas: Toda llamada que dure menos de 3 minutos tiene un coste de
10 céntimos. Cada minuto adicional a partir de los 3 primeros es un paso de contador y cuesta 5
céntimos.
*/

$minLlamada = readline("¿Cuántos minutos has hablado? ");
if ($minLlamada < 3) {
    echo "La llamada ha costado 10 céntimos\n";
} else {
    // Una vez pase los 3 minutos se cobra 10cent + 0.05 por minuto
    $total = 0.1;
    for ($i=3; $i < $minLlamada ; $i++) { 
        $total += 0.05;
    }

echo "La llamada ha costado: ".$total."\n";
}
?>