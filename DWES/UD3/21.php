<?php

/**
 * @author Adrián López Pascual
 */

/*
Escribe un programa que diga cuál es la penúltima cifra de un número entero introducido por
teclado. Se permiten números de hasta 5 cifras. Puedes usar la función creada para el ejercicio
19
*/


$num = readline("Dime el número: ");

function cifras($num)
{
    $longitud = strlen($num);
    return $longitud;
}
// Compruebo si el número tiene 5 cifras
while (cifras($num) > 5) {
    echo "El número máximo 5 cifras \n";
    $num = readline("Dime el número: ");
}

// Saco la penúltima cifra
$cifra = substr($num,(strlen($num))-2,1);
printf("La penúltima cifra es: %d \n", $cifra );

?>