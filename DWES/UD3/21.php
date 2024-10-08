<?php

/**
 * @author Adrián López Pascual
 */
$num = readline("Dime el número: ");
function cifras($num)
{
    $longitud = strlen($num);
    return $longitud;
}

while (cifras($num) > 5) {
    echo "El número máximo 5 cifras \n";
    $num = readline("Dime el número: ");
}

$cifra = substr($num,(strlen($num))-2,1);
printf("La penúltima cifra es: %d \n", $cifra );

?>