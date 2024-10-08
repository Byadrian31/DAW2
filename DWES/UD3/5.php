<?php

/**
 * @author Adrián López Pascual
 */

$minLlamada = readline("¿Cuántos minutos has hablado? ");
if ($minLlamada < 3) {
    echo "La llamada ha costado 10 céntimos\n";
} else {
    $total = 0.1;
    for ($i=3; $i < $minLlamada ; $i++) { 
        $total += 0.05;
    }

echo "La llamada ha costado: ".$total."\n";
}
?>