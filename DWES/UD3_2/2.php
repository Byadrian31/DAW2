<?php
/**
 * @author Adrián López Pascual
 */

 /*
 Escribe un programa que dada una nota (entera) indique su correspondencia en el boletín
(Ejemplo 5 sería SUFICIENTE)
 */

 // Bucle para que la nota no sea < 0 o > 10 
$nota = readline("Dime la nota (0-10) ");
while (10 < $nota || $nota < 0) {
    echo "Porfavor del 0 al 10 \n";
    $nota = readline("Dime la nota (0-10) ");
}

// Condiciones según la nota
if ($nota >= 0 && $nota < 5) {
    echo "SUSPENSO \n";
} elseif ($nota == 5) {
    echo "SUFICIENTE \n";
} elseif ($nota == 6) {
    echo "BIEN \n";
} elseif ($nota >= 7 && $nota <= 8) {
    echo "NOTABLE \n";
} elseif ($nota == 9) {
    echo "SOBRESALIENTE \n";
} elseif ($nota == 10) {
    echo "MATRÍCULA DE HONOR \n";
}
?>