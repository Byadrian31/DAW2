<?php
/**
 * @author Adrián López Pascual
 */

$num1 = rand(0,9);
$num2 = rand(0,9);
$num3 = rand(0,9);
$num4 = rand(0,9);
$clave = $num1 . $num2 . $num3 . $num4;
$i = 4;
while ($i > 0) {
    $intento = readline("¿Cuál es la clave? \n");
    if ($intento == $clave) {
        echo "La caja fuerte se ha abierto satisfactoriamente \n";
        $i = 0;
    } else {
        echo "Lo siento, esa no es la combinación \n";
        $i--;
        printf("Te quedan %d intentos\n",$i);
        if ($i == 0) {
            echo "Te has quedado sin intentos, adios \n";
        }
    } 
 
}
?>