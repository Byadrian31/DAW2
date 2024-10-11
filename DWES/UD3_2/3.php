<?php

/**
 * @author Adrián López Pascual
 */

 /*
 Escribe un programa que calcule la media aritmética de 7 notas y la muestre junto con su
 correspondencia en el boletín que has realizado en el ejercicio anterior
 */
//Función para sacar el texto del boletín según la nota

function boletin($nota)
{
    $texto = "";
    if ($nota >= 0 && $nota < 5) {
        $texto = "SUSPENSO \n";
    } elseif ($nota < 6 && $nota >= 5) {
        $texto = "SUFICIENTE \n";
    } elseif ($nota < 7 && $nota >= 6) {
        $texto = "BIEN \n";
    } elseif ($nota >= 7 && $nota <= 8) {
        $texto = "NOTABLE \n";
    } elseif ($nota >= 9 && $nota < 10) {
        $texto = "SOBRESALIENTE \n";
    } elseif ($nota == 10) {
        $texto = "MATRÍCULA DE HONOR \n";
    }
    return $texto;
}

//Sacar 7 notas para realizar su media
$media = 0;
for ($i = 0; $i < 7; $i++) {
    $nota = rand(0, 10);
    while (10 < $nota || $nota < 0) {
        echo "Porfavor del 0 al 10 \n";
        $nota = readline("Dime la nota " . $i + 1 . " (0-10): ");
    }
    $media += $nota;
}

$mediaT = $media / 7;
$notaBoletin = boletin($mediaT);

printf("La media de las 7 notas es %.2f por lo tanto queda en %s \n", $mediaT , $notaBoletin);
?>