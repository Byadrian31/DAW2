<?php
/**
 * @author Adrián López Pascual
 */

/*
Realiza el control de acceso a una caja fuerte. La combinación será un número de 4 cifras. El
programa nos pedirá la combinación para abrirla. Si no acertamos, se nos mostrará el mensaje
“Lo siento, esa no es la combinación” y si acertamos se nos dirá “La caja fuerte se ha abierto
satisfactoriamente”. Tendremos cuatro oportunidades para abrir la caja fuerte.
*/

//Saco 4 números random para posteriormente juntarlos para tener la clave de la caja fuerte
$num1 = rand(0,9);
$num2 = rand(0,9);
$num3 = rand(0,9);
$num4 = rand(0,9);
$clave = $num1 . $num2 . $num3 . $num4;

//While con 4 intentos para sacar la clave
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